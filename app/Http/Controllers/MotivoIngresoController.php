<?php

namespace App\Http\Controllers;

use App\Models\MotivoIngreso;
use App\Http\Requests\StoreMotivoIngresoRequest;
use App\Http\Requests\UpdateMotivoIngresoRequest;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function datatables()
    {
        $motivosIngreso = MotivoIngreso::where('estado', '1')->get();

        return datatables()->of($motivosIngreso)
            ->addColumn('estado_badge', function ($motivo) {
                return $motivo->estado
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
     * @param  \App\Http\Requests\StoreMotivoIngresoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMotivoIngresoRequest $request)
    {
        if($request->validated()){
            $data = $request->all();

            $motivo = MotivoIngreso::create($data);

            return response()->json([
                'success' => true, 
                'message' => 'Motivo de ingreso creado exitosamente', 
                'data' => $motivo
            ], 201);
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
        $motivoIngreso->update($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Motivo de ingreso actualizado exitosamente.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MotivoIngreso  $motivoIngreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(MotivoIngreso $motivoIngreso)
    {
        $motivoIngreso->estado = '0';
        $motivoIngreso->save();

        return response()->json([
            'success' => true,
            'message' => 'Motivo de ingreso deshabilitado exitosamente.',
        ]);
    }

    public function info_list_mot()
    {
        $motings = MotivoIngreso::where('estado', '1')->get(['id', 'descripcion']);
        $usu_log = auth()->user()->name . ' ' . auth()->user()->apellidos;

        $pdf = Pdf::loadView('motivo_ingreso.info_list_moting', compact('motings', 'usu_log'));

        return $pdf->stream('motivos_ingreso.pdf');
    }
}
