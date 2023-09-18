<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SalesSummary extends Mailable
{
    use Queueable, SerializesModels;

    public $sales;
    public $commission;

    public function __construct($sales, $commission)
    {
        $this->sales = $sales;
        $this->commission = $commission;
    }

    public function build()
    {
        return $this->view('email.salesSummary')
        ->with([
            'totalSales' => $this->sales,
            'totalCommission' => $this->commission,
        ]);
    }
}
