@extends('layouts.app')

@section('title', 'รายการรายรับรายจ่าย')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>รายการรายรับรายจ่าย</h2>
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>เพิ่มรายการใหม่
            </a>
        </div>

        <!-- เดือน -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">ปี</label>
                        <select name="year" class="form-select">
                            @for($i = date('Y'); $i >= date('Y')-5; $i--)
                                <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>
                                    {{ $i + 543 }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">เดือน</label>
                        <select name="month" class="form-select">
                            @php
                                $months = [
                                    '01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม',
                                    '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน',
                                    '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน',
                                    '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'
                                ];
                            @endphp
                            @foreach($months as $num => $name)
                                <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">&nbsp;</label>
                        <div>
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-search me-2"></i>ค้นหา
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- สรุปรายเดือน -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <h5>รายรับ</h5>
                        <h4>{{ number_format($monthlyIncome, 2) }} บาท</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body text-center">
                        <h5>รายจ่าย</h5>
                        <h4>{{ number_format($monthlyExpense, 2) }} บาท</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card {{ $balance >= 0 ? 'bg-info' : 'bg-warning' }} text-white">
                    <div class="card-body text-center">
                        <h5>ยอดคงเหลือ</h5>
                        <h4>{{ number_format($balance, 2) }} บาท</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-secondary text-white">
                    <div class="card-body text-center">
                        <h5>จำนวนรายการ</h5>
                        <h4>{{ $transactions->count() }} รายการ</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- ตารางรายการ -->
        <div class="card">
            <div class="card-body">
                @if($transactions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>วันที่</th>
                                    <th>ประเภท</th>
                                    <th>รายการ</th>
                                    <th class="text-end">จำนวนเงิน</th>
                                    <th>วันที่บันทึก</th>
                                    <th>วันที่แก้ไขล่าสุด</th>
                                    <th class="text-center">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge {{ $transaction->type == 'income' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $transaction->type_thai }}
                                            </span>
                                        </td>
                                        <td>{{ $transaction->description }}</td>
                                        <td class="text-end">{{ $transaction->formatted_amount }}</td>
                                        <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $transaction->updated_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('transactions.edit', $transaction) }}" 
                                                   class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" 
                                                      action="{{ route('transactions.destroy', $transaction) }}" 
                                                      style="display: inline;"
                                                      onsubmit="return confirm('คุณแน่ใจหรือไม่ที่จะลบรายการนี้?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-5x text-muted mb-3"></i>
                        <h5 class="text-muted">ไม่พบรายการในเดือนนี้</h5>
                        <p class="text-muted">คลิกที่ปุ่ม "เพิ่มรายการใหม่" เพื่อเริ่มบันทึกข้อมูล</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection