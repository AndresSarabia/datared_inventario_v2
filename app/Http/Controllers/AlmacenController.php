<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Http\Requests\StoreAlmacenRequest;
use App\Http\Requests\UpdateAlmacenRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $almacenes = Almacen::where('estado', '1')->get();
        return view('almacen.index', compact('almacenes'));
    }

    public function datatables()
    {
        $almacenes = Almacen::where('estado', '1')->get();

        return datatables()->of($almacenes)
            ->addColumn('estado_badge', function ($almacen) {
                return $almacen->estado
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
     * @param  \App\Http\Requests\StoreAlmacenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlmacenRequest $request)
    {
        // Obtener el último código
        $lastAlmacen = Almacen::orderBy('codigo', 'desc')->first();
        
        $newCode = '0001';
        
        if ($lastAlmacen && !empty($lastAlmacen->codigo)) {
            $numCode = (int) $lastAlmacen->codigo + 1;
            $newCode = str_pad($numCode, 4, '0', STR_PAD_LEFT);
        }

        // Crear almacén con el código generado
        $data = $request->validated();
        $data['codigo'] = $newCode;

        Almacen::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Almacén creado exitosamente.',
            'codigo' => $newCode,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function show(Almacen $almacen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function edit(Almacen $almacen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlmacenRequest  $request
     * @param  \App\Models\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlmacenRequest $request, Almacen $almacen)
    {
        $almacen->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Almacén actualizado exitosamente.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Almacen $almacen)
    {
        $almacen->estado = '0';
        $almacen->save();

        return response()->json([
            'success' => true,
            'message' => 'Almacén eliminado exitosamente.',
        ]);
    }

    public function info_list_alm()
    {
        $almacenes = Almacen::where('estado', '1')->get();
        $usu_log = auth()->user()->nombre . ' ' . auth()->user()->apellidos;

        $pdf = Pdf::loadView('almacen.info_list_alm', compact('almacenes', 'usu_log'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('listado_almacenes.pdf');
    }
}
