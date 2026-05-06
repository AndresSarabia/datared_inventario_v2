<?php

namespace App\Http\Controllers;

use App\Models\MotivoSalida;
use App\Http\Requests\StoreMotivoSalidaRequest;
use App\Http\Requests\UpdateMotivoSalidaRequest;

class MotivoSalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motivosSalida = MotivoSalida::all();
        return view('motivo_salida.index', compact('motivosSalida'));
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
     * @param  \App\Http\Requests\StoreMotivoSalidaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMotivoSalidaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MotivoSalida  $motivoSalida
     * @return \Illuminate\Http\Response
     */
    public function show(MotivoSalida $motivoSalida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MotivoSalida  $motivoSalida
     * @return \Illuminate\Http\Response
     */
    public function edit(MotivoSalida $motivoSalida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMotivoSalidaRequest  $request
     * @param  \App\Models\MotivoSalida  $motivoSalida
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMotivoSalidaRequest $request, MotivoSalida $motivoSalida)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MotivoSalida  $motivoSalida
     * @return \Illuminate\Http\Response
     */
    public function destroy(MotivoSalida $motivoSalida)
    {
        //
    }
}
