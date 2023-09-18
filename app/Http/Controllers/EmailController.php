<?php

namespace App\Http\Controllers;

use App\Mail\SalesSummary;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminSalesSummary;
use App\Models\Seller;
use App\Models\Sale;
use App\Models\User;
use App\Mail\SellerSalesSummary;

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

    public function sendAdminSalesSummary()
    {
        if (auth()->user()->role === 'admin') {
            $totalSalesToday = Sale::whereDate('sale_date', today())->sum('value');
            $totalCommissionToday = Sale::whereDate('sale_date', today())->sum('commission');

            $admins = User::where('role', 'admin')->get();

            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new AdminSalesSummary($totalSalesToday, $totalCommissionToday));
            }

            return response()->json(['message' => 'Emails sent successfully']);
        } else {
            return response()->json(['message' => 'Not authorized'], 401);
        }
    }

    public function resendSellerSummaryEmail($seller_id)
    {

        if (auth()->user()->role === 'admin') {

            $seller = Seller::find($seller_id);

            if (!$seller) {
                return response()->json(['message' => 'Vendedor não encontrado'], 404);
            }

            $totalSales = Sale::where('seller_id', $seller_id)->sum('value');
            $totalCommission = Sale::where('seller_id', $seller_id)->sum('commission');

            Mail::to($seller->email)->send(new SellerSalesSummary($totalSales, $totalCommission));

            return response()->json(['message' => 'E-mail de resumo de vendas reenviado com sucesso.']);

        } else {
            return response()->json(['message' => 'Não autorizado'], 401);
        }
    }

}
