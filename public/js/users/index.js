$(document).ready(function () {
    let deleteUserId = null;

    let table = $('#tabla-usuarios').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: window.routes.usersData,
            type: 'GET'
        },
        columns: [
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function () {
                    return '<input type="checkbox" class="row-checkbox">';
                }
            },
            { data: 'nombre' },
            { data: 'apellidos' },
            { data: 'email' },
            { data: 'perfil_badge', orderable: false, searchable: false },
            { data: 'cargo' },
            { data: 'fecha_registro' },
            { data: 'estado_badge', orderable: false, searchable: false }
        ],
        responsive: true,
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
            },
            {
                extend: 'csv',
                text: '<i class="fas fa-file-csv"></i> CSV',
            },
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Excel',
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> PDF',
            }
            ]
        },
        {
            extend: 'collection',
            text: '<i class="fas fa-plus-circle"></i> Nuevo',
            className: 'btn btn-secondary',
            buttons: [{
                text: 'Nuevo usuario',
                action: function () {
                    $('#mod_cre_usu').modal('show');
                }
            }]
        },
        {
            extend: 'collection',
            text: '<i class="fas fa-edit"></i> Modificar',
            className: 'btn btn-secondary',
            buttons: [{
                text: 'Actualizar datos',
                action: function () {

                    let data = table.row('.selected').data();

                    if (!data) {
                        showAlert('warning', 'Atención', 'Selecciona un usuario para editar.');
                        return;
                    }

                    fillEditModal(data);
                    $('#mod_edit_usu').modal('show');
                }
            },
            {
                text: 'Actualizar password',
                action: function () {

                    let data = table.row('.selected').data();
                    console.log('Datos del usuario seleccionado:', data); // Debug: Ver datos en consola

                    if (!data) {
                        showAlert('warning', 'Atención', 'Selecciona un usuario para editar.');
                        return;
                    }


                    openPasswordModal(data);
                }
            },
            {
                text: 'Eliminar usuario',
                action: function () {

                    let data = table.row('.selected').data();

                    if (!data) {
                        showAlert('warning', 'Atención', 'Selecciona un usuario para eliminar.');
                        return;
                    }

                    let userId = data.id;

                    openDeleteModal(data);
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
                action: function () {
                    let data = table.row('.selected').data();

                    if (!data) {
                        showAlert('warning', 'Atención', 'Selecciona un usuario para consultar.');
                        return;
                    }

                    openConsultModal(data);
                }
            }]
        },
        {
            extend: 'collection',
            text: '<i class="fas fa-file-alt"></i> Informe',
            className: 'btn btn-secondary',
            buttons: [{
                text: 'Listado usuario',
                action: function () {
                    window.open(window.routes.infoList, '_blank');
                }
            }]
        },
        {
            extend: 'collection',
            text: '<i class="fas fa-plus"></i> Almacen',
            className: 'btn btn-secondary',
            buttons: [{
                text: 'Asignar Almacen Tec.',
                action: function () {
                    // window.location.href = "{{ route('usuarios.create') }}";
                }
            },
            {
                text: 'Asignar Almacen Adm.',
                action: function () {
                    // window.location.href = "{{ route('usuarios.create') }}";
                }
            }
            ]
        },
        ],

        columnDefs: [
            { targets: 0, orderable: false, searchable: false, className: 'dt-body-center' }
        ]
    });

    // seleccionar fila
    $('#tabla-usuarios tbody').on('click', 'tr', function (e) {
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

    $('#tabla-usuarios tbody').on('change', '.row-checkbox', function () {

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

    $('#check-all').on('change', function () {
        let checked = this.checked;

        $('.row-checkbox').prop('checked', checked);

        if (checked) {
            $('#tabla-usuarios tbody tr').addClass('selected');
        } else {
            $('#tabla-usuarios tbody tr').removeClass('selected');
        }
    });

    $('#btn_mod_reg_usu').on('click', function () {
        let formData = $('#form_cre_usu').serialize();
        $.ajax({
            url: window.routes.createUser,
            method: 'POST',
            data: formData,
            success: function (response) {
                $('#mod_cre_usu').modal('hide');
                table.ajax.reload();
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                let errorHtml = '<ul>';
                $.each(errors, function (key, value) {
                    errorHtml += '<li>' + value[0] + '</li>';
                });
                errorHtml += '</ul>';
                $('#message-error').html(errorHtml).show();
            }
        });
    });

    $('#btn_edit_reg_usu').on('click', function (e) {
        e.preventDefault();

        let userId = $('#edit_user_id').val();
        let formData = $('#form_edit_usu').serialize();

        $.ajax({
            url: window.routes.updateUserBase + '/' + userId,
            method: 'POST',
            data: formData,
            success: function (response) {
                $('#mod_edit_usu').modal('hide');
                table.ajax.reload();
                showAlert('success', 'Usuario actualizado', 'Los datos se guardaron correctamente.');
            },
            error: function (xhr) {
                let errors = xhr.responseJSON?.errors || {};
                let errorHtml = '<ul>';
                $.each(errors, function (key, value) {
                    errorHtml += '<li>' + value[0] + '</li>';
                });
                errorHtml += '</ul>';
                $('#message-error').html(errorHtml).show();
            }
        });
    });

    function fillEditModal(data) {
        $('#edit_user_id').val(data.id);
        $('#edit_nombre').val(data.nombre);
        $('#edit_apellidos').val(data.apellidos);
        $('#edit_ci').val(data.ci);
        $('#edit_sexo').val(data.sexo);
        $('#edit_direccion').val(data.direccion);
        $('#edit_telefono').val(data.telefono);
        $('#edit_email').val(data.email);
        $('#edit_cargo').val(data.cargo);
        $('#edit_perfil').val(data.perfil);
        $('#edit_password').val('');
        $('#edit_password_confirmation').val('');
    }

    function showAlert(type, title, message) {
        let headerClass = 'bg-info';
        if (type === 'success') headerClass = 'bg-success';
        if (type === 'warning') headerClass = 'bg-warning';
        if (type === 'error') headerClass = 'bg-danger';

        $('#modalAlertHeader').removeClass('bg-info bg-success bg-warning bg-danger').addClass(headerClass);
        $('#modalAlertTitle').text(title);
        $('#modalAlertMessage').text(message);
        $('#modalAlert').modal('show');
    }

    function openPasswordModal(userData) {
        $('#edit_pass_user_id').val(userData.id);
        $('#usuario').text(userData.nombre + ' ' + userData.apellidos);
        $('#message-error_pas').hide().find('#error_pas').empty();
        $('#mypassword_edi_pas').val('');
        $('#password_edi_pas').val('');
        $('#password_confirmation_edi_pas').val('');
        $('#mod_edi_pas').modal('show');
    }

    $('#btn_act_pas_usu').on('click', function (e) {
        e.preventDefault();

        let formData = $('#form_upd_pas_usu').serialize();
        let userId = $('#edit_pass_user_id').val();

        $.ajax({
            url: window.routes.updateUserPasswordBase + '/' + userId + '/password',
            method: 'POST',
            data: formData,
            success: function (response) {
                $('#mod_edi_pas').modal('hide');
                showAlert('success', 'Contraseña actualizada', response.message);
            },
            error: function (xhr) {
                let errors = xhr.responseJSON?.errors || {};
                let errorHtml = '';

                if (typeof errors === 'object') {
                    $.each(errors, function (key, value) {
                        errorHtml += '<li>' + value[0] + '</li>';
                    });
                } else {
                    errorHtml = '<li>' + (xhr.responseJSON?.message || 'Error inesperado') + '</li>';
                }

                $('#message-error_pas').show();
                $('#error_pas').html(errorHtml);
            }
        });
    });

    function openDeleteModal(data) {
        deleteUserId = data.id;
        $('#modalConfirmDeleteMessage').text(
            '¿Deseas deshabilitar al usuario ' + data.nombre + ' ' + data.apellidos + '?'
        );
        $('#modalConfirmDelete').modal('show');
    }

    $('#btn_confirm_delete').on('click', function () {
        if (!deleteUserId) return;

        $.ajax({
            url: window.routes.deleteUserBase + '/' + deleteUserId,
            method: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#modalConfirmDelete').modal('hide');
                table.ajax.reload();
                showAlert('success', 'Usuario deshabilitado', response.message);
            },
            error: function (xhr) {
                let message = xhr.responseJSON?.message || 'Error al deshabilitar el usuario.';
                showAlert('error', 'Error', message);
            }
        });
    });

    function fillConsultModal(data) {
        $('#nombre_con').val(data.nombre || '');
        $('#apellidos_con').val(data.apellidos || '');
        $('#ci_con').val(data.ci || '');
        $('#sexo_con').val(data.sexo || '');
        $('#estado_con').val(
            data.estado == 1 || data.estado === '1' || data.estado === true
                ? 'Habilitado'
                : 'Deshabilitado'
        );
        $('#direccion_con').val(data.direccion || '');
        $('#telefono_con').val(data.telefono || '');
        $('#email_con').val(data.email || '');
        $('#cargo_con').val(data.cargo || '');
        $('#perfil_con').val(data.perfil || '');
    }

    function openConsultModal(data) {
        fillConsultModal(data);
        $('#message-error').hide();
        $('#mod_con_usu').modal('show');
    }
});