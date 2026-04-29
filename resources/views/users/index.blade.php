@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <br>
@endsection

@section('content')
    <div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="modalAlertLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white" id="modalAlertHeader">
                    <h5 class="modal-title" id="modalAlertTitle">Alerta</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalAlertMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="modalConfirmDeleteLabel">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalConfirmDeleteLabel">Confirmar deshabilitación</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalConfirmDeleteMessage">¿Seguro que deseas deshabilitar este usuario?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btn_confirm_delete" class="btn btn-danger btn-sm">Deshabilitar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <!-- 🔹 Header -->
        <div class="card-header d-flex align-items-center">

            <h4 class="card-title mb-0"><b>Usuarios</b></h4>

            <!-- 🔽 Dropdown de estados -->
            <div class="ml-auto">
                <div class="dropdown">
                    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fas fa-filter"></i> Filtrar estado
                    </button>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item filtro-estado" data-estado="todos" href="#">Todos</a>
                        <a class="dropdown-item filtro-estado" data-estado="habilitado" href="#">Habilitados</a>
                        <a class="dropdown-item filtro-estado" data-estado="deshabilitado" href="#">Deshabilitados</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- 🔹 Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabla-usuarios" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="check-all"></th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Perfil</th>
                            <th>Cargo</th>
                            <th>Fecha Registro</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('users.mod_crear_usu')
    @include('users.mod_editar_usu')
    @include('users.mod_editar_pass')
    @include('users.mod_con_usu')
@endsection

@section('js')
    <script>
        window.routes = {
            usersData: "{{ route('users.data') }}",
            createUser: "{{ route('usuarios.store') }}",
            updateUserBase: "{{ url('/adm/usuarios') }}",
            updateUserPasswordBase: "{{ url('/adm/usuarios') }}",
            deleteUserBase: "{{ url('/adm/usuarios') }}",
            infoList: "{{ route('usuarios.info_list_usu') }}"
        };
    </script>
    <script src="{{ asset('js/users/index.js') }}"></script>
@endsection
