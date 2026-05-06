@extends('adminlte::page')

@section('title', 'Motivos de Ingreso')

@section('content_header')
    <br>
@endsection

@section('content')
    <div class="card">
        <!-- 🔹 Header -->
        <div class="card-header d-flex align-items-center">

            <h4 class="card-title mb-0"><b>Listado de Motivos de Ingreso</b></h4>

        </div>

        <!-- 🔹 Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabla-motivos-ingreso" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="check-all"></th>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Observaciones</th>
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
