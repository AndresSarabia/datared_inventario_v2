@extends('adminlte::page')

@section('title', 'Unidades de Medida')

@section('content_header')
    <br>
@endsection

@section('content')
    <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="modalConfirmDeleteLabel">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalConfirmDeleteLabel">Confirmar eliminación</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalConfirmDeleteMessage">¿Está seguro de eliminar el registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btn_confirm_delete" class="btn btn-danger btn-sm">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    @include('partials.alert-message')
    <div class="card">
        <!-- 🔹 Header -->
        <div class="card-header d-flex align-items-center">

            <h4 class="card-title mb-0"><b>Listado de Unidades de Medida</b></h4>

        </div>

        <!-- 🔹 Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabla-unidad-medida" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="check-all"></th>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Abreviatura</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('unidad_medida.mod_crear_unid')
    @include('unidad_medida.mod_editar_unid')
@endsection
@section('js')
    <script>
        window.routes = {
            unidadMedidaData: "{{ route('unidad_medida.data') }}",
            createUnidadMedida: "{{ route('unidad_medida.store') }}",
            unidadMedidaBase: "{{ url('unidad_medida') }}",
        };
    </script>
    <script src="{{ asset('js/shared/alerts.js') }}"></script>
    <script src="{{ asset('js/unidad_medida/index.js') }}"></script>
@endsection
