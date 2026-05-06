@extends('adminlte::page')

@section('title', 'Almacenes')

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

            <h4 class="card-title mb-0"><b>Listado de Almacenes</b></h4>

        </div>

        <!-- 🔹 Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabla-almacenes" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="check-all"></th>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('almacen.mod_crear_alm')
    @include('almacen.mod_editar_alm')
    @include('almacen.mod_con_alm')
@endsection
@section('js')
    <script>
        window.routes = {
            almacenData: "{{ route('almacen.data') }}",
            createAlmacen: "{{ route('almacen.store') }}",
            almacenBase: "{{ url('almacen') }}",
            infoListAlmacen: "{{ route('almacen.info_list_alm') }}",
        };
    </script>
    <script src="{{ asset('js/shared/alerts.js') }}"></script>
    <script src="{{ asset('js/almacen/index.js') }}"></script>
@endsection
