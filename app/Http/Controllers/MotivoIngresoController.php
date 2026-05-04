<?php

namespace App\Http\Controllers;

use App\Models\MotivoIngreso;
use App\Http\Requests\StoreMotivoIngresoRequest;
use App\Http\Requests\UpdateMotivoIngresoRequest;

class MotivoIngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motivosIngreso = MotivoIngreso::all();
        return view('motivo_ingreso.index', compact('motivosIngreso'));
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
     * @param  \App\Http\Requests\StoreMotivoIngresoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMotivoIngresoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MotivoIngreso  $motivoIngreso
     * @return \Illuminate\Http\Response
     */
    public function show(MotivoIngreso $motivoIngreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MotivoIngreso  $motivoIngreso
     * @return \Illuminate\Http\Response
     */
    public function edit(MotivoIngreso $motivoIngreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMotivoIngresoRequest  $request
     * @param  \App\Models\MotivoIngreso  $motivoIngreso
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMotivoIngresoRequest $request, MotivoIngreso $motivoIngreso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MotivoIngreso  $motivoIngreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(MotivoIngreso $motivoIngreso)
    {
        //
    }
}
