<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $distance = $request->query('distance', 5);
        $category = $request->query('category');

        $customer = Auth::user()->customer;
        $merchants = Merchant::query()
            ->when($category, function ($query) use ($category) {
                return $query->where('category', $category);
            })
            ->get();
        if ($distance) $merchants = $merchants->where('distance', '<=', $distance);

        return view('dashboard.merchants.index', [
            'merchants' => $merchants,
            'latitude'  => $customer->latitude,
            'longitude' => $customer->longitude,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(Merchant $merchant)
    {
        $merchant->load('menus');
        return view('dashboard.merchants.show', [
            'merchant' => $merchant,
        ]);
    }
}
