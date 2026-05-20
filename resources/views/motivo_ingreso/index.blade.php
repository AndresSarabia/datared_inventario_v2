@extends('adminlte::page')

@section('title', 'Motivos de Ingreso')

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

            <h4 class="card-title mb-0"><b>Listado de Motivos de Ingreso</b></h4>

        </div>

        <!-- 🔹 Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabla-motivo-ingreso" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="check-all"></th>
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
    @include('motivo_ingreso.mod_cre_moting')
    @include('motivo_ingreso.mod_edi_moting')
@endsection
@section('js')
    <script>
        window.routes = {
            motivoIngresoData: "{{ route('motivo_ingreso.data') }}",
            createMotivoIngreso: "{{ route('motivo_ingreso.store') }}",
            motivoIngresoBase: "{{ url('motivo_ingreso') }}",
            infoListMotivoIngreso: "{{ route('motivo_ingreso.info_list_mot') }}",
        }
    </script>
    <script src="{{ asset('js/shared/alerts.js') }}"></script>
    <script src="{{ asset('js/motivo_ingreso/index.js') }}"></script>
    <script src="{{ asset('js/motivo_ingreso/table.js') }}"></script>
    <script src="{{ asset('js/motivo_ingreso/crud.js') }}"></script>
@endsection
