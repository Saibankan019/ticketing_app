<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $paymentTypes = [
            ['nama' => 'Transfer Bank'],
            ['nama' => 'E-Wallet (GoPay)'],
            ['nama' => 'E-Wallet (OVO)'],
            ['nama' => 'E-Wallet (Dana)'],
            ['nama' => 'E-Wallet (ShopeePay)'],
            ['nama' => 'Credit Card'],
            ['nama' => 'Debit Card'],
            ['nama' => 'Cash'],
            ['nama' => 'QRIS'],
        ];

        foreach ($paymentTypes as $type) {
            PaymentType::create($type);
        }
    }
}