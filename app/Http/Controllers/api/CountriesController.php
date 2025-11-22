<?php

namespace App\Http\Controllers\api;

use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountriesController extends Controller
{
    //* Crear un nuevo país
    public function create(Request $request)
    {
        try {
            $request->validate([
                'name'          => 'required|string',
                'official_name' => 'required|string',
                'president'     => 'required|string',
                'capital'       => 'required|string',
                'size'          => 'required|numeric',
                'population'    => 'required|numeric',
                'continent_id'  => 'required|exists:continents,id',
                'language_id'   => 'required|exists:language,id',
                'currency_id'   => 'required|exists:currency,id',
                'flag'          => 'required|file|image',
            ]);
            $path = $request->file('flag')->store('flags', 'public');
            $country = Country::create([
                'name'          => $request->name,
                'official_name' => $request->official_name,
                'president'     => $request->president,
                'capital'       => $request->capital,
                'size'          => $request->size,
                'population'    => $request->population,
                'continent_id'  => $request->continent_id,
                'language_id'   => $request->language_id,
                'currency_id'   => $request->currency_id,
                'latitude'      => $request->latitude,
                'longitude'     => $request->longitude,
                'flag'          => $path,
                'active'        => 1,
                'user_id'       => $request->user()->id
            ]);
            return response()->json([
                'success' => true,
                'status' => 1,
                'message' => 'País creado correctamente',
                'data' => $country
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 0,
                'message' => 'Error al crear el país',
                'error' => $e->getMessage()
            ]);
        }
    }

    //* Actualizar un país
    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);
        if ($country->user_id !== $request->user()->id) {
            return response()->json(['error' => 'No autorizado'], 403);
        }
        if ($request->hasFile('flag')) {
            Storage::disk('public')->delete($country->flag);
            $path = $request->file('flag')->store('flags', 'public');
            $country->flag = $path;
        }
        $country->update($request->all());
        return response()->json([
            'success' => true,
            'status' => 1,
            'message' => 'Datos del País Actualizados',
            'data' => $country
        ]);
    }

    //* Eliminar un país
    public function delete(Request $request, $id)
    {
        $country = Country::findOrFail($id);
        if ($country->user_id !== $request->user()->id) {
            return response()->json(['error' => 'No autorizado'], 403);
        }
        $country->active = false;
        $country->save();
        return response()->json([
            'success' => true,
            'status' => 1,
            'message' => 'País eliminado correctamente',
        ]);
    }


    //* Listar todos los países
    public function list()
    {
        $countries = Country::where('active', 1)
            ->orderBy('id', 'desc')
            ->with(['continent', 'language', 'currency', 'user'])
            ->get();
        return response()->json([
            'success' => true,
            'status' => 1,
            'message' => 'Listado de países',
            'data' => $countries
        ]);
    }

    //* Mostrar un país por ID
    public function show($id)
    {
        try {
            $country = Country::where('id', $id)
                ->where('active', 1)
                ->with(['continent', 'language', 'currency', 'user'])
                ->first();
            return response()->json([
                'success' => true,
                'status' => 1,
                'message' => 'Datos del País',
                'data' => $country
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status' => 0,
                'message' => 'Error al cargar el Pais',
                'error' => $e->getMessage()
            ]);
        }
    }
}
