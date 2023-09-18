<?php

namespace App\Http\Controllers;

use App\Mail\SalesSummary;
use Illuminate\Support\Facades\Mail;
use App\Models\Seller;


class EmailController extends Controller
{
    public function sendSummaryEmail()
    {
        $sellers = Seller::all();

        foreach ($sellers as $seller) {
            $salesToday = $seller->sales()->whereDate('sale_date', today())->get();
            $totalSales = $salesToday->sum('value');
            $totalCommission = $salesToday->sum('commission');

            Mail::to($seller->email)->send(new SalesSummary($totalSales, $totalCommission));
        }

        return response()->json(['message' => 'Emails sent successfully'], 200);
    }
}
