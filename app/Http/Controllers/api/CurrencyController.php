<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;


class CurrencyController extends Controller
{
    public function list()
    {
        try {
            $currencies = Currency::orderBy('name', 'asc')->get();
            return response()->json([
                'success' => true,
                'status'  => 1,
                'message' => 'Listado de monedas',
                'data'    => $currencies
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status'  => 0,
                'message' => 'Error al cargar las monedas',
                'error'   => $e->getMessage()
            ]);
        }
    }
}
