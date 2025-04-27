<?php

namespace App\Http\Controllers\api;

use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    //* Crear un nuevo país
    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|unique:countries,name',
                'president' => 'required|string',
                'size' => 'required|numeric',
                'population' => 'required|integer',
                'flag' => 'required|string',
                'language' => 'required|string',
                'currency' => 'required|string',
                'region_id' => 'required|integer',
                'user_id' => 'required|integer'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 0,
                'message' => 'Error al crear el país',
                'error' => $e->getMessage()
            ]);
        }

        $country = new Country();
        $country->name = $request->name;
        $country->president = $request->president;
        $country->size = $request->size;
        $country->population = $request->population;
        $country->flag = $request->flag;
        $country->language = $request->language;
        $country->currency = $request->currency;
        $country->region_id = $request->region_id;
        $country->user_id = $request->user_id;
        $country->active = 1; // Activo por defecto
        $country->save();
        if ($country) {
            return response()->json([
                'success' => true,
                'status' => 1,
                'message' => 'País creado correctamente',
                'data' => $country
            ]);
        } else {
            return response()->json([
                'success' => false,
                'status' => 0,
                'message' => 'Error al crear el país'
            ]);
        }
    }

    //* Actualizar un país
    public function update(Request $request, $id)
    {
        $country = Country::where('id', $id)
            ->where('active', 1)
            ->where('user_id', $request->user_id) // Asegurarse de que el país pertenece al usuario
            ->first();

        if ($country) {
            $country->name = $request->name;
            $country->president = $request->president;
            $country->size = $request->size;
            $country->population = $request->population;
            $country->flag = $request->flag;
            $country->language = $request->language;
            $country->currency = $request->currency;
            $country->region_id = $request->region_id;
            $country->save();
            return response()->json([
                'success' => true,
                'status' => 1,
                'message' => 'País actualizado correctamente',
                'data' => $country
            ]);
        } else {
            return response()->json([
                'success' => false,
                'status' => 0,
                'message' => 'País no encontrado'
            ]);
        }
    }

    //* Eliminar un país
    public function delete(Request $request, $id)
    {
        $country = Country::where('id', $id)
            ->where('active', 1)
            ->where('user_id', $request->user_id)
            ->first();
        if ($country) {
            $country->active = 0;
            $country->save();
            return response()->json([
                'success' => true,
                'status' => 1,
                'message' => 'País eliminado correctamente',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'status' => 0,
                'message' => 'País no encontrado'
            ]);
        }
    }

    //* Listar todos los países
    public function list()
    {
        $countries = Country::where('active', 1)
            ->orderBy('id', 'desc')
            ->with('user')
            ->with('region')
            ->get();
        $array = [];
        foreach ($countries as $country) {
            $array[] = [
                'id' => $country->id,
                'name' => $country->name,
                'president' => $country->president,
                'flag' => $country->flag,
                'region_id' => $country->region_id,
                'region_name' => $country->region ? $country->region->name : null,
                'user_id' => $country->user_id,
                'user_name' => $country->user ? $country->user->name : null,
            ];
        }
        return response()->json([
            'success' => true,
            'status' => 1,
            'message' => 'Listado de países',
            'data' => $array
        ]);
    }

    //* Mostrar un país por ID
    public function show($id)
    {
        $country = Country::where('id', $id)
            ->where('active', 1)
            -> with('user')
            ->with('region')
            ->first();

        $array =  $country ? [
            'id' => $country->id,
            'name' => $country->name,
            'president' => $country->president,
            'size' => $country->size,
            'population' => $country->population,
            'flag' => $country->flag,
            'language' => $country->language,
            'currency' => $country->currency,
            'region_id' => $country->region_id,
            'region_name' => $country->region ? $country->region->name : null,
            'user_id' => $country->user_id,
            'user_name' => $country->user ? $country->user->name : null,
        ] : [];
        return response()->json([
            'success' => $country ? true : false,
            'status' => $country ? 1 : 0,
            'message' => $country ? 'País encontrado' : 'País no encontrado',
            'data' => $array
        ]);
    }
}
