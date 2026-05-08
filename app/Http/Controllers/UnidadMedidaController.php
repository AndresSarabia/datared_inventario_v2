<?php

namespace App\Http\Controllers;

use App\Models\UnidadMedida;
use App\Http\Requests\StoreUnidadMedidaRequest;
use App\Http\Requests\UpdateUnidadMedidaRequest;

class UnidadMedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidadesMedida = UnidadMedida::all();
        return view('unidad_medida.index', compact('unidadesMedida'));
    }

    public function datatables()
    {
        $unidadesMedida = UnidadMedida::where('estado', '1')->get();

        return datatables()->of($unidadesMedida)
            ->addColumn('estado_badge', function ($unidad) {
                return $unidad->estado
                    ? '<span class="badge badge-success">Habilitado</span>'
                    : '<span class="badge badge-danger">Deshabilitado</span>';
            })
            ->rawColumns(['estado_badge'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUnidadMedidaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnidadMedidaRequest $request)
    {
        $lastUnidad = UnidadMedida::orderBy('codigo', 'desc')->first();
        $newCode = '001';

        if ($lastUnidad && !empty($lastUnidad->codigo)) {
            $lastCode = (int) $lastUnidad->codigo + 1;
            $newCode = str_pad($lastCode, 3, '0', STR_PAD_LEFT);
        }

        // Crear la nueva unidad de medida con el nuevo código generado
        if($request->validated()){
            $data = $request->all();
            $data['codigo'] = $newCode;

            $unidadMedida = UnidadMedida::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Unidad de medida creada exitosamente',
                'data' => $unidadMedida
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al validar los datos',
                'errors' => $request->errors()
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function show(UnidadMedida $unidadMedida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function edit(UnidadMedida $unidadMedida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUnidadMedidaRequest  $request
     * @param  \App\Models\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnidadMedidaRequest $request, UnidadMedida $unidadMedida)
    {
        $unidadMedida->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Unidad de medida actualizada exitosamente.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnidadMedida $unidadMedida)
    {
        $unidadMedida->estado = '0';
        $unidadMedida->save();

        return response()->json([
            'success' => true,
            'message' => 'Unidad de medida deshabilitada exitosamente.',
        ]);
    }
}
