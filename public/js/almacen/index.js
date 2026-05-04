$(document).ready(function () {
    let deleteAlmacenId = null;

    let table = $('#tabla-almacenes').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: window.routes.almacenData,
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
                text: 'Nuevo almacén',
                action: function () {
                    $('#mod_cre_alm').modal('show');
                }
            }]
        },
        {
            extend: 'collection',
            text: '<i class="fas fa-edit"></i> Modificar',
            className: 'btn btn-secondary',
            buttons: [{
                text: 'Actualizar almacén',
                action: function () {

                    let data = table.row('.selected').data();

                    if (!data) {
                        showAlert('warning', 'Atención', 'Selecciona un almacén para editar.');
                        return;
                    }

                    fillEditModal(data);
                    $('#mod_edi_alm').modal('show');
                }
            },
            {
                text: 'Eliminar almacén',
                action: function () {

                    let data = table.row('.selected').data();

                    if (!data) {
                        showAlert('warning', 'Atención', 'Selecciona un almacén para eliminar.');
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
            text: '<i class="fas fa-file-alt"></i> Informe',
            className: 'btn btn-secondary',
            buttons: [{
                text: 'Listado almacenes',
                action: function () {
                    window.open(window.routes.infoListAlmacen, '_blank');
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

    $('#tabla-almacenes tbody').on('click', 'tr', function (e) {
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

    $('#tabla-almacenes tbody').on('change', '.row-checkbox', function () {

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
            $('#tabla-almacenes tbody tr').addClass('selected');
        } else {
            $('#tabla-almacenes tbody tr').removeClass('selected');
        }
    });

    $('#btn_reg_alm').on('click', function () {
        let formData = $('#form_crear_alm').serialize();

        $.ajax({
            url: window.routes.createAlmacen,
            method: 'POST',
            data: formData,
            success: function (response) {
                $('#mod_cre_alm').modal('hide');
                $('#form_crear_alm')[0].reset();
                table.ajax.reload();
                showAlert('success', 'Éxito', response.message);
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors || {};
                let errorMessages = Object.values(errors).flat();

                // Limpiar errores previos
                $('#error-alm').html('');

                errorMessages.forEach(msg => {
                    $('#error-alm').append(`<li>${msg}</li>`);
                });

                $('#message-error-alm').show();
            }
        });
    });

    function fillEditModal(data) {
        $('#form_edi_alm input[name="id"]').val(data.id);
        $('#cod_edi').val(data.codigo);
        $('#descrip_edi').val(data.descripcion);
        $('#est_edi').val(data.estado === '1' ? 'Habilitado' : 'Deshabilitado');
    }

    $('#btn_act_alm').on('click', function (e) {
        e.preventDefault();

        let almacenId = $('#form_edi_alm input[name="id"]').val();
        let formData = $('#form_edi_alm').serialize();

        $.ajax({
            url: `${window.routes.almacenBase}/${almacenId}`,
            method: 'PUT',
            data: formData,
            success: function (response) {
                $('#mod_edi_alm').modal('hide');
                $('#form_edi_alm')[0].reset();
                table.ajax.reload();
                showAlert('success', 'Éxito', response.message);
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors || {};
                let errorMessages = Object.values(errors).flat();

                // Limpiar errores previos
                $('#error-alm').html('');

                errorMessages.forEach(msg => {
                    $('#error-alm').append(`<li>${msg}</li>`);
                });

                $('#message-error-alm').show();
            }
        });
    });

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

    function openDeleteModal(data) {
        deleteAlmacenId = data.id;
        $('#modalConfirmDeleteMessage').text(
            '¿Está seguro de eliminar el registro (' + data.codigo + ') - ' + data.descripcion + '?'
        );
        $('#modalConfirmDelete').modal('show');
    }

    $('#btn_confirm_delete').on('click', function () {
        if (!deleteAlmacenId) return;

        $.ajax({
            url: `${window.routes.almacenBase}/${deleteAlmacenId}`,
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