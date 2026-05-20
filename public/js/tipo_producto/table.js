window.TipoProductoTable = (function () {
    let table;

    function init() {

        table = $('#tabla-tipo-producto').DataTable({
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

                    buttons: [
                        {
                            text: 'Nuevo Tipo Producto',

                            action: function () {
                                $('#mod_cre_tip').modal('show');
                            }
                        }
                    ]
                },
                {
                    extend: 'collection',
                    text: '<i class="fas fa-edit"></i> Modificar',

                    buttons: [
                        {
                            text: 'Actualizar Tipo Producto',

                            action: function () {

                                let data = getSelected();
                                console.log(data);

                                if (!data) {

                                    showAlert(
                                        'warning',
                                        'Atención',
                                        'Selecciona un registro.'
                                    );

                                    return;
                                }

                                TipoProductoCrud.fillEditModal(data);

                                $('#mod_edi_tip').modal('show');
                            }
                        },
                        {
                            text: 'Eliminar Tipo Producto',

                            action: function () {

                                let data = getSelected();

                                if (!data) {
                                    showAlert(
                                        'warning',
                                        'Atención',
                                        'Selecciona un registro.'
                                    );
                                    return;
                                }

                                TipoProductoCrud.openDeleteModal(data);
                            }
                        }
                    ]
                },
                {
                    extend: 'collection',
                    text: '<i class="fas fa-file-alt"></i> Informe',

                    buttons: [{
                        text: 'Listado Tipo Producto',

                        action: function () {
                            window.open(window.routes.infoListTipoProducto, '_blank');
                        }
                    }]
                }
            ]
        });

        initSelection();

        return table;
    }

    function initSelection() {

        $('#tabla-tipo-producto tbody').on('click', 'tr', function (e) {

            if ($(e.target).is('input[type="checkbox"]')) return;

            let checkbox = $(this).find('.row-checkbox');

            table.$('tr.selected').removeClass('selected');
            $('.row-checkbox').prop('checked', false);

            $(this).addClass('selected');

            checkbox.prop('checked', true);
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
    }

    function getSelected() {

        return table.row('.selected').data();
    }

    return {
        init,
        getSelected,
        reload: () => table.ajax.reload()
    };
})();