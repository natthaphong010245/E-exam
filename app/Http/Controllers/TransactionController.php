<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('m'));
        
        $transactions = Transaction::byMonth($year, $month)
                                 ->orderBy('transaction_date', 'desc')
                                 ->orderBy('created_at', 'desc')
                                 ->get();

        // คำนวณสรุปรายเดือน
        $monthlyIncome = Transaction::byMonth($year, $month)->income()->sum('amount');
        $monthlyExpense = Transaction::byMonth($year, $month)->expense()->sum('amount');
        $balance = $monthlyIncome - $monthlyExpense;

        return view('transactions.index', compact(
            'transactions', 'year', 'month', 
            'monthlyIncome', 'monthlyExpense', 'balance'
        ));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date'
        ]);

        Transaction::create($request->all());

        return redirect()->route('transactions.index')
                        ->with('success', 'บันทึกรายการสำเร็จ!');
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date'
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')
                        ->with('success', 'อัปเดตรายการสำเร็จ!');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')
                        ->with('success', 'ลบรายการสำเร็จ!');
    }

    // รายงานรายเดือน
    public function monthlyReport(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('m'));
        
        $transactions = Transaction::byMonth($year, $month)
                                 ->orderBy('transaction_date', 'desc')
                                 ->get();

        $income = $transactions->where('type', 'income');
        $expense = $transactions->where('type', 'expense');
        
        $totalIncome = $income->sum('amount');
        $totalExpense = $expense->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('transactions.monthly-report', compact(
            'transactions', 'income', 'expense',
            'totalIncome', 'totalExpense', 'balance',
            'year', 'month'
        ));
    }
}