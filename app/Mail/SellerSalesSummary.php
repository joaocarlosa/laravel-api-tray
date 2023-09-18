<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SellerSalesSummary extends Mailable
{
    use Queueable, SerializesModels;

    public $totalSales;
    public $totalCommission;

    /**
     * @return void
     */
    public function __construct($totalSales, $totalCommission)
    {
        $this->totalSales = $totalSales;
        $this->totalCommission = $totalCommission;
    }

    /**
     * @return $this
     */
    public function build()
    {
        return $this->view('email.sellerSalesSummary')
            ->with([
                'totalSales' => $this->totalSales,
                'totalCommission' => $this->totalCommission,
            ]);
    }
}
