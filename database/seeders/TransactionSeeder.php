<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        // ข้อมูลทดสอบสำหรับ 2 เดือนย้อนหลัง
        $months = [
            Carbon::now()->subMonth(1), // เดือนที่แล้ว
            Carbon::now()               // เดือนนี้
        ];

        foreach ($months as $month) {
            // รายรับ (10 รายการต่อเดือน)
            $incomeItems = [
                ['description' => 'เงินเดือน', 'amount' => 45000.00],
                ['description' => 'โบนัส', 'amount' => 15000.00],
                ['description' => 'งานเสริม', 'amount' => 8000.00],
                ['description' => 'ดอกเบี้ยเงินฝาก', 'amount' => 250.00],
                ['description' => 'ขายของออนไลน์', 'amount' => 3500.00],
                ['description' => 'รับสอนพิเศษ', 'amount' => 2000.00],
                ['description' => 'เงินปันผล', 'amount' => 1200.00],
                ['description' => 'ค่าคอมมิชชั่น', 'amount' => 1500.00],
                ['description' => 'เงินจากผู้ปกครอง', 'amount' => 5000.00],
                ['description' => 'รายได้อื่นๆ', 'amount' => 800.00]
            ];

            // รายจ่าย (10 รายการต่อเดือน)
            $expenseItems = [
                ['description' => 'ค่าเช่าบ้าน', 'amount' => 12000.00],
                ['description' => 'ค่าอาหาร', 'amount' => 8000.00],
                ['description' => 'ค่าน้ำมันรถ', 'amount' => 2500.00],
                ['description' => 'ค่าไฟฟ้า', 'amount' => 1800.00],
                ['description' => 'ค่าน้ำ', 'amount' => 500.00],
                ['description' => 'ค่าโทรศัพท์', 'amount' => 599.00],
                ['description' => 'ค่าประกันสุขภาพ', 'amount' => 3500.00],
                ['description' => 'ซื้อเสื้อผ้า', 'amount' => 2200.00],
                ['description' => 'ค่าของใช้ในบ้าน', 'amount' => 1500.00],
                ['description' => 'ค่าบันเทิง', 'amount' => 1200.00]
            ];

            // สร้างรายรับ
            foreach ($incomeItems as $item) {
                Transaction::create([
                    'type' => 'income',
                    'description' => $item['description'],
                    'amount' => $item['amount'],
                    'transaction_date' => $month->copy()->addDays(rand(1, $month->daysInMonth)),
                    'created_at' => $month->copy()->addDays(rand(1, $month->daysInMonth))->addHours(rand(8, 18))->addMinutes(rand(0, 59)),
                ]);
            }

            // สร้างรายจ่าย
            foreach ($expenseItems as $item) {
                Transaction::create([
                    'type' => 'expense',
                    'description' => $item['description'],
                    'amount' => $item['amount'],
                    'transaction_date' => $month->copy()->addDays(rand(1, $month->daysInMonth)),
                    'created_at' => $month->copy()->addDays(rand(1, $month->daysInMonth))->addHours(rand(8, 18))->addMinutes(rand(0, 59)),
                ]);
            }
        }
    }
}