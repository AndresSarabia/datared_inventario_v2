window.MotivoIngresoTable = (function () {
    let table;

    function init() {

        table = $('#tabla-motivo-ingreso').DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: window.routes.motivoIngresoData,
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
                { data: 'descripcion', name: 'descripcion' },
                { data: 'obsv', name: 'obsv' },
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
                },
                notFound: "No se encontraron registros"
            },
            dom: "<'row'<'col-md-6'B><'col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
            buttons: [
                {
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
                    buttons: [
                        {
                            text: 'Nuevo Motivo de Ingreso',
                            action: function () {
                                $('#mod_cre_moting').modal('show');
                            }
                        }
                    ]
                },
                {
                    extend: 'collection',
                    text: '<i class="fas fa-edit"></i> Modificar',
                    className: 'btn btn-secondary',
                    buttons: [
                        {
                            text: 'Actualizar Motivo de Ingreso',
                            action: function () {

                                let data = getSelected();


                                if (!data) {
                                    console.log("data");

                                    showAlert('warning', 'Advertencia', 'Por favor, selecciona un registro para modificar.');
                                    return;
                                }

                                MotivoIngresoCrud.fillEditModal(data);

                                $('#mod_edi_moting').modal('show');
                            }
                        },
                        {
                            text: 'Eliminar Motivo de Ingreso',

                            action: function () {

                                let data = getSelected();

                                if (!data) {

                                    showAlert('warning', 'Advertencia', 'Por favor, selecciona un registro para eliminar.');
                                    return;
                                }

                                MotivoIngresoCrud.openDeleteModal(data);
                            }
                        }
                    ]
                },
                {
                    extend: 'collection',
                    text: '<i class="fas fa-file-export"></i> Informe',
                    className: 'btn btn-secondary',
                    buttons: [
                        {
                            text: 'Listado Motivo de Ingreso',
                            action: function () {
                                window.open(window.routes.infoListMotivoIngreso, '_blank');
                            }
                        }
                    ]
                }
            ]
        });

        initSelection();

        return table;
    }

    function initSelection() {

        $('#tabla-motivo-ingreso tbody').on('click', 'tr', function (e) {

            if ($(e.target).is('input[type="checkbox"]')) return;

            let checkbox = $(this).find('input.row-checkbox');

            table.$('tr.selected').removeClass('selected');
            $('.row-checkbox').prop('checked', false)

            $(this).addClass('selected');

            checkbox.prop('checked', true);
        });

        $('#tabla-motivo-ingreso tbody').on('change', '.row-checkbox', function () {

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
                $('#tabla-motivo-ingreso tbody tr').addClass('selected');
            } else {
                $('#tabla-motivo-ingreso tbody tr').removeClass('selected');
            }
        });
    }

    function getSelected() {
        return table.row('.selected').data();
    }

    return {
        init,
        getSelected,
        reload: () => table.ajax.reload()
    }
})();