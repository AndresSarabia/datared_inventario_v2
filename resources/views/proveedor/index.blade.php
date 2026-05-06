@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <br>
@endsection

@section('content')
    <div class="card">
        <!-- 🔹 Header -->
        <div class="card-header d-flex align-items-center">

            <h4 class="card-title mb-0"><b>Listado de Proveedores</b></h4>

        </div>

        <!-- 🔹 Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabla-proveedores" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="check-all"></th>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Razón Social</th>
                            <th>Tipo Proveedor</th>
                            <th>Teléfono</th>
                            <th>Contacto</th>
                            <th>Celular</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
