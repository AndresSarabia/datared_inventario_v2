@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <br>
@endsection

@section('content')
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
                            <th>ID</th>
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
                        @foreach ($users as $user)
                            <tr>
                                <td><input type="checkbox" class="row-checkbox"></td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->nombre }}</td>
                                <td>{{ $user->apellidos }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->perfil == 'administrador')
                                        <span class="badge badge-primary">Administrador</span>
                                    @elseif ($user->perfil == 'supervisor')
                                        <span class="badge badge-info">Supervisor</span>
                                    @elseif ($user->perfil == 'tecnico')
                                        <span class="badge badge-secondary">Técnico</span>
                                    @else
                                        <span class="badge badge-light">{{ $user->perfil }}</span>
                                    @endif
                                </td>
                                <td>{{ $user->cargo }}</td>
                                <td>{{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}</td>
                                <td>
                                    @if ($user->estado == '1')
                                        <span class="badge badge-success">Habilitado</span>
                                    @else
                                        <span class="badge badge-danger">Deshabilitado</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let table = $('#tabla-usuarios').DataTable({
                responsive: {
                    details: {
                        type: 'column',
                        target: 0
                    }
                },
                autoWidth: false,
                scrollX: true,
                language: {
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ registros",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    paginate: {
                        previous: "Anterior",
                        next: "Siguiente"
                    }
                },
                dom: "<'row'<'col-md-6'B><'col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",
                buttons: [{
                        extend: 'collection',
                        text: '<i class="fas fa-upload"></i> Exportar',
                        className: 'btn btn-secondary',
                        buttons: [{
                                extend: 'copy',
                                text: '<i class="fas fa-copy"></i> Copiar',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            },
                            {
                                extend: 'csv',
                                text: '<i class="fas fa-file-csv"></i> CSV',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            },
                            {
                                extend: 'excel',
                                text: '<i class="fas fa-file-excel"></i> Excel',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            },
                            {
                                extend: 'pdf',
                                text: '<i class="fas fa-file-pdf"></i> PDF',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            }
                        ]
                    },
                    {
                        extend: 'collection',
                        text: '<i class="fas fa-plus-circle"></i> Nuevo',
                        className: 'btn btn-secondary',
                        buttons: [{
                            text: 'Nuevo usuario',
                            action: function() {
                                window.location.href = "{{ route('usuarios.create') }}";
                            }
                        }]
                    },
                    {
                        extend: 'collection',
                        text: '<i class="fas fa-edit"></i> Modificar',
                        className: 'btn btn-secondary',
                        buttons: [{
                                text: 'Actualizar datos',
                                action: function() {

                                    let data = table.row('.selected').data();

                                    if (!data) {
                                        alert('Selecciona un usuario');
                                        return;
                                    }

                                    let userId = data[1];
                                    window.location.href = '/adm/usuarios/' + userId + '/edit';
                                }
                            },
                            {
                                text: 'Actualizar password',
                                action: function() {

                                    let data = table.row('.selected').data();

                                    if (!data) {
                                        alert('Selecciona un usuario');
                                        return;
                                    }

                                    let userId = data[1];
                                    window.location.href = '/adm/usuarios/' + userId + '/edit';
                                }
                            },
                            {
                                text: 'Eliminar usuario',
                                action: function() {

                                    let data = table.row('.selected').data();

                                    if (!data) {
                                        alert('Selecciona un usuario');
                                        return;
                                    }

                                    let userId = data[1];

                                    if (confirm('¿Eliminar usuario?')) {
                                        window.location.href = '/adm/usuarios/' + userId +
                                            '/delete';
                                    }
                                }
                            }
                        ]
                    },
                    {
                        extend: 'collection',
                        text: '<i class="fas fa-eye"></i> Consulta',
                        className: 'btn btn-secondary',
                        buttons: [{
                            text: 'Consultar usuario',
                            action: function() {
                                window.location.href = "{{ route('usuarios.create') }}";
                            }
                        }]
                    },
                    {
                        extend: 'collection',
                        text: '<i class="fas fa-file-alt"></i> Informe',
                        className: 'btn btn-secondary',
                        buttons: [{
                            text: 'Listado usuario',
                            action: function() {
                                window.location.href = "{{ route('usuarios.create') }}";
                            }
                        }]
                    },
                    {
                        extend: 'collection',
                        text: '<i class="fas fa-plus"></i> Almacen',
                        className: 'btn btn-secondary',
                        buttons: [{
                                text: 'Asignar Almacen Tec.',
                                action: function() {
                                    window.location.href = "{{ route('usuarios.create') }}";
                                }
                            },
                            {
                                text: 'Asignar Almacen Adm.',
                                action: function() {
                                    window.location.href = "{{ route('usuarios.create') }}";
                                }
                            }
                        ]
                    },
                ],

                columnDefs: [{
                        className: 'control',
                        orderable: false,
                        targets: 0
                    },
                    {
                        targets: -1,
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // seleccionar fila
            $('#tabla-usuarios tbody').on('click', 'tr', function(e) {
                // evitar conflicto si clickeas directamente el checkbox
                if ($(e.target).is('input[type="checkbox"]')) return;

                let checkbox = $(this).find('.row-checkbox');

                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    checkbox.prop('checked', false);
                } else {
                    table.$('tr.selected').removeClass('selected');
                    $('.row-checkbox').prop('checked', false);

                    $(this).addClass('selected');
                    checkbox.prop('checked', true);
                }
            });

            $('#tabla-usuarios tbody').on('change', '.row-checkbox', function() {

                let row = $(this).closest('tr');

                if (this.checked) {
                    table.$('tr.selected').removeClass('selected');
                    $('.row-checkbox').prop('checked', false);

                    row.addClass('selected');
                    $(this).prop('checked', true);
                } else {
                    row.removeClass('selected');
                }
            });

            $('#check-all').on('change', function() {
                let checked = this.checked;

                $('.row-checkbox').prop('checked', checked);

                if (checked) {
                    $('#tabla-usuarios tbody tr').addClass('selected');
                } else {
                    $('#tabla-usuarios tbody tr').removeClass('selected');
                }
            });

            // // filtro por estado
            // $.fn.dataTable.ext.search.push(function(settings, data) {

            //     let filtro = window.estadoFiltro || 'todos';
            //     let estado = data[4]; // columna estado

            //     if (filtro === 'todos') return true;

            //     if (filtro === 'habilitado' && estado.includes('Habilitado')) return true;
            //     if (filtro === 'deshabilitado' && estado.includes('Deshabilitado')) return true;

            //     return false;
            // });

            // // click en dropdown
            // $('.filtro-estado').on('click', function(e) {
            //     e.preventDefault();

            //     let texto = $(this).text();
            //     $('.dropdown-toggle').html('<i class="fas fa-filter"></i> ' + texto);

            //     window.estadoFiltro = $(this).data('estado');
            //     table.draw();
            // });
        });
    </script>
@endsection
