window.TipoProductoCrud = (function () {

    function init() {

        initCreate();

        initEdit();

        initDelete();
    }

    function initCreate() {

        $('#btn_reg_tip').on('click', function () {

            $.ajax({
                url: window.routes.createTipoProducto,
                method: 'POST',
                data: $('#form_crear_tip').serialize(),

                success: function (response) {

                    $('#mod_cre_tip').modal('hide');

                    TipoProductoTable.reload();

                    showAlert(
                        'success',
                        'Éxito',
                        response.message
                    );
                },

                error: handleErrors
            });
        });
    }

    function initEdit() {

        $('#btn_act_tip').on('click', function () {

            let id = $('#id_edi').val();

            $.ajax({

                url: `${window.routes.tipoProductoBase}/${id}`,

                method: 'PUT',

                data: $('#form_editar_tip').serialize(),

                success: function (response) {

                    $('#mod_edi_tip').modal('hide');

                    TipoProductoTable.reload();

                    showAlert(
                        'success',
                        'Éxito',
                        response.message
                    );
                },

                error: handleErrors
            });
        });
    }

    function initDelete() {

        $('#btn_confirm_delete').on('click', function () {

            let data = TipoProductoTable.getSelected();

            if (!data) return;

            $.ajax({

                url: `${window.routes.tipoProductoBase}/${data.id}`,

                method: 'DELETE',

                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function (response) {

                    $('#modalConfirmDelete').modal('hide');

                    TipoProductoTable.reload();

                    showAlert(
                        'success',
                        'Éxito',
                        response.message
                    );
                }
            });
        });
    }

    function fillEditModal(data) {

        $('#id_edi').val(data.id);

        $('#codigo_edi').val(data.codigo);

        $('#descripcion_edi').val(data.descripcion);
    }

    function handleErrors(xhr) {

        let errors = xhr.responseJSON.errors || {};

        console.log(errors);
    }

    function openDeleteModal(data) {

        $('#modalConfirmDeleteMessage').text(
            `¿Está seguro de eliminar el registro (${data.codigo}) - ${data.descripcion}?`
        );

        $('#modalConfirmDelete').modal('show');
    }

    return {
        init,
        fillEditModal,
        openDeleteModal
    };
})();