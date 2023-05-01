<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Coupon;
use Carbon\Carbon;

class DeleteExpiredCoupons extends Command
{
    protected $signature = 'coupons:delete-expired';
    protected $description = 'Deletes expired coupons from the database.';

    public function handle()
    {
        $now = Carbon::now();
        $coupons = Coupon::where('exp_date', '<=', $now)->delete();
        $this->info("Deleted {$coupons} expired coupons.");
    }
}

