$(document).ready(function () {
    let deleteTipoProductoId = null;

    let table = $('#tabla-tipo-producto').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: window.routes.tipoProductoData,
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
            { data: 'codigo', name: 'codigo' },
            { data: 'descripcion', name: 'descripcion' },
            { data: 'estado_badge', name: 'estado_badge' }
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
        buttons: [
            {
                extend: 'collection',
                text: '<i class="fas fa-plus-circle"></i> Nuevo',
                className: 'btn btn-secondary',
                buttons: [{
                    text: 'Nuevo Tipo de Producto',
                    action: function () {
                        $('#mod_cre_tip').modal('show');
                    }
                }]
            },
            {
                extend: 'collection',
                text: '<i class="fas fa-edit"></i> Modificar',
                className: 'btn btn-secondary',
                buttons: [{
                    text: 'Actualizar Tipo de Producto',
                    action: function () {

                        let data = table.row('.selected').data();

                        if (!data) {
                            showAlert('warning', 'Atención', 'Selecciona un registro para editar.');
                            return;
                        }

                        fillEditModal(data);
                        $('#mod_edi_tip').modal('show');
                    }
                },
                {
                    text: 'Deshabilitar Tipo de Producto',
                    action: function () {

                        let data = table.row('.selected').data();

                        if (!data) {
                            showAlert('warning', 'Atención', 'Selecciona un registro para deshabilitar.');
                            return;
                        }

                        let userId = data.id;

                        openDeleteModal(data);
                    }
                }]
            },
            {
                extend: 'collection',
                text: '<i class="fas fa-file-alt"></i> Informe',
                className: 'btn btn-secondary',
                buttons: [{
                    text: 'Listado Tipos Prods.',
                    action: function () {
                        window.open(window.routes.infoListTipoProducto, '_blank');
                    }
                }]
            },
        ],

        columnDefs: [
            {
                targets: 0,
                orderable: false,
                searchable: false,
                className: 'dt-body-center',
            }
        ],
    });

    $('#tabla-tipo-producto tbody').on('click', 'tr', function (e) {
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

    $('#tabla-tipo-producto tbody').on('change', '.row-checkbox', function () {
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
            $('#tabla-tipo-producto tbody tr').addClass('selected');
        } else {
            $('#tabla-tipo-producto tbody tr').removeClass('selected');
        }
    });

    $('#btn_reg_tip').on('click', function () {
        let formData = $('#form_crear_tip').serialize();

        $.ajax({
            url: window.routes.createTipoProducto,
            method: 'POST',
            data: formData,
            success: function (response) {
                $('#mod_cre_tip').modal('hide');
                $('#form_crear_tip')[0].reset();
                table.ajax.reload();
                showAlert('success', 'Éxito', response.message);
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors || {};
                let errorMessages = Object.values(errors).flat();

                $('#error-tip').html('');

                errorMessages.forEach(msg => {
                    $('#error-tip').append('<li>' + msg + '</li>');
                });

                $('#message-error-tip').show();
            }
        });
    });

    function fillEditModal(data) {
        $('#id_edi').val(data.id);
        $('#codigo_edi').val(data.codigo);
        $('#descripcion_edi').val(data.descripcion);
        $('#estado_edi').val(data.estado === '1' ? 'Habilitado' : 'Deshabilitado');
    };

    $('#btn_act_tip').on('click', function (e) {
        e.preventDefault();

        let tipoProductoId = $('#id_edi').val();
        let formData = $('#form_editar_tip').serialize();

        $.ajax({
            url: `${window.routes.tipoProductoBase}/${tipoProductoId}`,
            method: 'PUT',
            data: formData,
            success: function (response) {
                $('#mod_edi_tip').modal('hide');
                table.ajax.reload();
                showAlert('success', 'Éxito', response.message);
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors || {};
                let errorMessages = Object.values(errors).flat();

                $('#error-tip').html('');

                errorMessages.forEach(msg => {
                    $('#error-tip').append('<li>' + msg + '</li>');
                });

                $('#message-error-tip').show();
            }
        });
    });

    function showAlert(type, title, message) {
        window.pageAlert.show(type, title, message, 10000);
    }

    function openDeleteModal(data) {
        deleteTipoProductoId = data.id;
        $('#modalConfirmDeleteMessage').text(
            '¿Está seguro de eliminar el registro (' + data.codigo + ') - ' + data.descripcion + '?'
        );
        $('#modalConfirmDelete').modal('show');
    }

    $('#btn_confirm_delete').on('click', function () {
        if (!deleteTipoProductoId) return;

        $.ajax({
            url: `${window.routes.tipoProductoBase}/${deleteTipoProductoId}`,
            method: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#modalConfirmDelete').modal('hide');
                table.ajax.reload();
                showAlert('success', 'Éxito', response.message);
            },
            error: function (xhr) {
                $('#modalConfirmDelete').modal('hide');
                showAlert('danger', 'Error', 'No se pudo eliminar el registro. Inténtalo de nuevo.');
            }
        });
    });
});