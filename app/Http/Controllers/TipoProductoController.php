<?php

namespace App\Http\Controllers;

use App\Models\TipoProducto;
use App\Http\Requests\StoreTipoProductoRequest;
use App\Http\Requests\UpdateTipoProductoRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class TipoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposProducto = TipoProducto::all();
        return view('tipo_producto.index', compact('tiposProducto'));
    }

    public function datatables()
    {
        $tiposProducto = TipoProducto::where('estado', '1')->get();

        return datatables()->of($tiposProducto)
            ->addColumn('estado_badge', function ($tipo) {
                return $tipo->estado
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
     * @param  \App\Http\Requests\StoreTipoProductoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoProductoRequest $request)
    {
        $lastTipo = TipoProducto::orderBy('codigo', 'desc')->first();
        $newCode = '001';

        if ($lastTipo && !empty($lastTipo->codigo)) {
            $lastCode = (int) $lastTipo->codigo + 1;
            $newCode = str_pad($lastCode, 3, '0', STR_PAD_LEFT);
        }

        if($request->validated()){
            $data = $request->all();
            $data['codigo'] = $newCode;

            $tipoProducto = TipoProducto::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Tipo de producto creado exitosamente.',
                'data' => $tipoProducto
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
     * @param  \App\Models\TipoProducto  $tipoProducto
     * @return \Illuminate\Http\Response
     */
    public function show(TipoProducto $tipoProducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoProducto  $tipoProducto
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoProducto $tipoProducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipoProductoRequest  $request
     * @param  \App\Models\TipoProducto  $tipoProducto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipoProductoRequest $request, TipoProducto $tipoProducto)
    {
        $tipoProducto->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Tipo de producto actualizado exitosamente.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoProducto  $tipoProducto
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoProducto $tipoProducto)
    {
        $tipoProducto->estado = '0';
        $tipoProducto->save();

        return response()->json([
            'success' => true,
            'message' => 'Tipo de producto deshabilitado exitosamente.',
        ]);
    }

    public function info_list_tip()
    {
        $tipos = TipoProducto::where('estado', '1')->get();
        $usu_log = auth()->user()->nombre . ' ' . auth()->user()->apellidos;

        $pdf = Pdf::loadView('tipo_producto.info_list_tip', compact('tipos', 'usu_log'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('listado_tipos.pdf');
    }
}
