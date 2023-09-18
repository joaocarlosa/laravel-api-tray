<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminSalesSummary extends Mailable
{
    use Queueable, SerializesModels;

    public $sales;
    public $commission;

    /**
     * @param $sales
     * @param $commission
     */
    public function __construct($sales, $commission)
    {
        $this->sales = $sales;
        $this->commission = $commission;
    }

    /**
     * @return $this
     */
    public function build()
    {
        return $this->subject('Admin Sales Summary')
            ->view('email.adminSalesSummary')
            ->with([
                'totalSales' => $this->sales,
                'totalCommission' => $this->commission,
            ]);
    }
}

