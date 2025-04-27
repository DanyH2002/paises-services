<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\regions as Region;

class Regions extends Controller
{
    //Lista de regiones
    public function list()
    {
        try {
            $regions = Region::all();
            return response()->json([
                'success' => true,
                'status' => 1,
                'message' => 'Regiones obtenidas correctamente',
                'data' => $regions
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 0,
                'message' => 'Error al obtener las regiones',
                'error' => $e->getMessage()
            ]);
        }
    }
}
