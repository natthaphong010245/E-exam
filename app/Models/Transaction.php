<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description', 
        'amount',
        'transaction_date'
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2'
    ];

    // Scope เดือน
    public function scopeByMonth($query, $year, $month)
    {
        return $query->whereYear('transaction_date', $year)
                    ->whereMonth('transaction_date', $month);
    }

    // Scope รายรับ
    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }

    // Scope รายจ่าย
    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }

    // ประเภทเป็นภาษาไทย
    public function getTypeThaiAttribute()
    {
        return $this->type === 'income' ? 'รายรับ' : 'รายจ่าย';
    }

    // จัดรูปแบบจำนวนเงิน
    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 2);
    }
}