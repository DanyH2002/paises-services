<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Continents;

class ContinentController extends Controller
{
    public function list()
    {
        try {
            $continents = Continents::orderBy('name', 'asc')->get();
            return response()->json([
                'success' => true,
                'status'  => 1,
                'message' => 'Listado de continentes',
                'data'    => $continents
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status'  => 0,
                'message' => 'Error al cargar los continentes',
                'error'   => $e->getMessage()
            ]);
        }
    }
}
