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
        try{
        $request->validate([
            'name' => 'required|string',
            'president' => 'required|string',
            'size' => 'required|numeric|between:0,9999999.9999',
            'population' => 'required|integer',
            'flag' => 'required|string',
            'language' => 'required|string',
            'currency' => 'required|string',
            'region_id' => 'required|integer'
        ]);}catch(\Exception $e){
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
        $country = Country::where($id)
            ->where('active', 1)
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
    public function delete($id)
    {
        $country = Country::where($id)
            ->where('active', 1)
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
            ->get();
        $array = [];
        foreach ($countries as $country) {
            $array[] = [
                'id' => $country->id,
                'name' => $country->name,
                'president' => $country->president,
                'size' => $country->size,
                'population' => $country->population,
                'flag' => $country->flag,
                'language' => $country->language,
                'currency' => $country->currency,
                'region_id' => $country->region_id
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
            'region_id' => $country->region_id
        ] : [];
        return response()->json([
            'success' => $country ? true : false,
            'status' => $country ? 1 : 0,
            'message' => $country ? 'País encontrado' : 'País no encontrado',
            'data' => $array
        ]);
    }

    //* Mostrar un país con filtros
    public function filter(Request $request)
    {
        $sort = $request->input('sortOrder', 1) == 1 ? 'asc' : 'desc';
        $sortfield = $request->input('sortField', 'nombre');
        $limit = $request->input('rows', 10);
        $offset = $request->input('first', 0);
        $condicion = [];
        if (!empty($request->input('globalFilter'))) {
            $filtro = '%' . $request->input('globalFilter') . '%';
            $condicion = function ($query) use ($filtro) {
                $query->where('name', 'like', $filtro)
                    ->orWhere('presiden', 'like', $filtro)
                    ->orWhere('language', 'like', $filtro);
            };
        }
        $countries = Country::where($condicion);
        $total = $countries->count();
        $countries = $countries
            ->orderBy($sortfield, $sort)
            ->offset($offset)
            ->limit($limit)
            ->get()
            ->toArray();
        return response()->json([
            'success' => true,
            'status' => 1,
            'message' => 'Listado de países',
            'data' => $countries,
            'total' => $total
        ]);
    }

    //? Catalogo de regiones
    public function regions()
    {
        // Query para obtener las regiones, teniendo en cuenta que se debe hacer un join con la tabla de regiones
        $regions = Country::select('regions.id', 'regions.name as region', 'countries.name as country')
            ->join('regions', 'countries.region_id', '=', 'regions.id')
            ->where('countries.active', 1)
            ->orderBy('regions.id', 'desc')
            ->get() // Obtener todos los registros
            ->toArray(); // Convertir los registros a un array
        return response()->json([
            'success' => true,
            'status' => 1,
            'message' => 'Listado de regiones',
            'data' => $regions
        ]);
    }

    //? Mostrar los países de una región
    public function countriesByRegion($id)
    {
        $countries = Country::where('region_id', $id)
            ->where('active', 1)
            ->orderBy('id', 'desc')
            ->get();
        $array = [];
        foreach ($countries as $country) {
            $array[] = [
                'id' => $country->id,
                'name' => $country->name,
                'president' => $country->president,
                'size' => $country->size,
                'population' => $country->population,
                'flag' => $country->flag,
                'language' => $country->language,
                'currency' => $country->currency,
                'region_id' => $country->region_id
            ];
        }
        return response()->json([
            'success' => true,
            'status' => 1,
            'message' => 'Listado de países por región',
            'data' => $array
        ]);
    }
}
