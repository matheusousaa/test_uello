<?php

namespace App\Http\Controllers;

use App\Models\ShippingPrices;
use Illuminate\Http\Request;

class ShippingPricesController extends Controller
{
    public function index()
    {
        // $shippingPrices = ShippingPrices::get();
        // return view('index', compact('shippingPrices'));

        return view('index');
    }

    public function save(Request $request)
    {
        try {
            if ($request->arrayToProcess[0] == 'from_postcode') {
                return $request->arrayToProcess;
            }

            $fromPostcode = $request->arrayToProcess[0];
            $toPostcode = $request->arrayToProcess[1];
            $fromWeight = number_format(floatval($request->arrayToProcess[2]), 2);
            $toWeight = number_format(floatval($request->arrayToProcess[3]), 2);
            $cost = number_format(floatval($request->arrayToProcess[4]), 2);

            ShippingPrices::create([
                'from_postcode' => $fromPostcode,
                'to_postcode' => $toPostcode,
                'from_weight' => $fromWeight,
                'to_weight' => $toWeight,
                'cost' => $cost
            ]);

            return $request->arrayToProcess;

        } catch (\Throwable $th) {
            return $th;
        }
    }
}
