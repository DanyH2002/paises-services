<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;

class LanguageController extends Controller
{
    public function list()
    {
        try {
            $languages = Language::orderBy('name', 'asc')->get();
            return response()->json([
                'success' => true,
                'status'  => 1,
                'message' => 'Listado de idiomas',
                'data'    => $languages
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status'  => 0,
                'message' => 'Error al cargar los idiomas',
                'error'   => $e->getMessage()
            ]);
        }
    }
}
