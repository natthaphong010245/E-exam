@extends('layouts.app')

@section('title', 'แก้ไขรายการ')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>แก้ไขรายการ</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('transactions.update', $transaction) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="type" class="form-label">ประเภท <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                            <option value="">เลือกประเภท</option>
                            <option value="income" {{ old('type', $transaction->type) == 'income' ? 'selected' : '' }}>รายรับ</option>
                            <option value="expense" {{ old('type', $transaction->type) == 'expense' ? 'selected' : '' }}>รายจ่าย</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">รายการ <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="description" 
                               id="description" 
                               class="form-control @error('description') is-invalid @enderror"
                               value="{{ old('description', $transaction->description) }}" 
                               placeholder="ระบุชื่อรายการ"
                               required>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">จำนวนเงิน (บาท) <span class="text-danger">*</span></label>
                        <input type="number" 
                               name="amount" 
                               id="amount" 
                               class="form-control @error('amount') is-invalid @enderror"
                               value="{{ old('amount', $transaction->amount) }}" 
                               placeholder="0.00"
                               step="0.01"
                               min="0.01"
                               required>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="transaction_date" class="form-label">วันที่ใช้จ่าย <span class="text-danger">*</span></label>
                        <input type="date" 
                               name="transaction_date" 
                               id="transaction_date" 
                               class="form-control @error('transaction_date') is-invalid @enderror"
                               value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}" 
                               required>
                        @error('transaction_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>ย้อนกลับ
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-2"></i>อัปเดต
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection