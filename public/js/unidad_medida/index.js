$(document).ready(function () {
    let deleteUnidadMedidaId = null;

    let table = $('#tabla-unidad-medida').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: window.routes.unidadMedidaData,
            type: 'GET',
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
            { data: 'id' },
            { data: 'codigo' },
            { data: 'descripcion' },
            { data: 'abreviatura' },
            { data: 'estado_badge' },
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
                    text: 'Nueva Unidad de Medida',
                    action: function () {
                        $('#mod_cre_unid').modal('show');
                    }
                }]
            },
            {
                extend: 'collection',
                text: '<i class="fas fa-edit"></i> Modificar',
                className: 'btn btn-secondary',
                buttons: [{
                    text: 'Actualizar Unidad',
                    action: function () {

                        let data = table.row('.selected').data();

                        if (!data) {
                            showAlert('warning', 'Atención', 'Selecciona un registro para editar.');
                            return;
                        }

                        fillEditModal(data);
                        $('#mod_edit_unid').modal('show');
                    }
                },
                {
                    text: 'Deshabilitar Unidad',
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
            }
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

    $('#tabla-unidad-medida tbody').on('click', 'tr', function (e) {
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

    $('#tabla-unidad-medida tbody').on('change', '.row-checkbox', function () {

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
            $('#tabla-unidad-medida tbody tr').addClass('selected');
        } else {
            $('#tabla-unidad-medida tbody tr').removeClass('selected');
        }
    });

    $('#btn_reg_unid').on('click', function () {
        let formData = $('#form_crear_unid').serialize();

        $.ajax({
            url: window.routes.createUnidadMedida,
            method: 'POST',
            data: formData,
            success: function (response) {
                $('#mod_cre_unid').modal('hide');
                $('#form_crear_unid')[0].reset();
                table.ajax.reload(null, false);
                showAlert('success', 'Éxito', response.message);
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors || {};
                let errorMessages = Object.values(errors).flat();

                //Limpiar errores previos
                $('#error-unid').html('');

                errorMessages.forEach(msg => {
                    $('#error-unid').append(`<div>${msg}</div>`);
                });

                $('#message-error-unid').show();
            }
        });
    });

    function fillEditModal(data) {
        $('#id_edi').val(data.id);
        $('#cod_edi').val(data.codigo);
        $('#descrip_edi').val(data.descripcion);
        $('#abrev_edi').val(data.abreviatura);
    }

    $('#btn_act_unid').on('click', function (e) {
        e.preventDefault();

        let unidadId = $('#id_edi').val();
        let formData = $('#form_editar_unid').serialize();

        $.ajax({
            url: `${window.routes.unidadMedidaBase}/${unidadId}`,
            method: 'PUT',
            data: formData,
            success: function (response) {
                $('#mod_edit_unid').modal('hide');
                table.ajax.reload(null, false);
                showAlert('success', 'Éxito', response.message);
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors || {};
                let errorMessages = Object.values(errors).flat();

                //Limpiar errores previos
                $('#error-edi').html('');

                errorMessages.forEach(msg => {
                    $('#error-edi').append(`<div>${msg}</div>`);
                });

                $('#message-error-edi').show();
            }
        });

    });

    function showAlert(type, title, message) {
        window.pageAlert.show(type, title, message, 10000);
    }

    function openDeleteModal(data) {
        deleteUnidadId = data.id;
        $('#modalConfirmDeleteMessage').text(
            '¿Está seguro de eliminar el registro (' + data.codigo + ') - ' + data.descripcion + '?'
        );
        $('#modalConfirmDelete').modal('show');
    }

    $('#btn_confirm_delete').on('click', function () {
        if (!deleteUnidadId) return;

        $.ajax({
            url: `${window.routes.unidadMedidaBase}/${deleteUnidadId}`,
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
                showAlert('error', 'Error', 'No se pudo eliminar el registro. Inténtalo de nuevo.');
            }
        });
    });

});