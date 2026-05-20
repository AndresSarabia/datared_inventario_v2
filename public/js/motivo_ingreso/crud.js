window.MotivoIngresoCrud = (function () {

    function init() {

        initCreate();

        initEdit();

        initDelete();
    }

    function initCreate() {

        $('#btn_reg_moting').on('click', function () {

            $data = $('#form_crear_moting').serialize();

            $.ajax({
                url: window.routes.createMotivoIngreso,
                method: 'POST',
                data: $('#form_crear_moting').serialize(),

                success: function (response) {
                    $('#mod_cre_moting').modal('hide');

                    MotivoIngresoTable.reload();

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

        $('#btn_act_moting').on('click', function () {

            let id = $('#id_edi').val();
            let data = $('#form_editar_moting').serialize();

            console.log(data);

            $.ajax({

                url: `${window.routes.motivoIngresoBase}/${id}`,

                method: 'PUT',

                data: data,

                success: function (response) {
                    $('#mod_edi_moting').modal('hide');

                    MotivoIngresoTable.reload();

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

            let data = MotivoIngresoTable.getSelected();

            if (!data) return;

            $.ajax({

                url: `${window.routes.motivoIngresoBase}/${data.id}`,
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function (response) {
                    $('#modalConfirmDelete').modal('hide');

                    MotivoIngresoTable.reload();

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
        $('#descripcion_edi').val(data.descripcion);
        $('#observacion_edi').val(data.obsv);
    }

    function handleErrors(xhr) {

        let errors = xhr.responseJSON.errors || {};

        console.log(errors);
    }

    function openDeleteModal(data) {

        $('#modalConfirmDeleteMessage').text(
            `¿Estás seguro de eliminar el motivo de ingreso "${data.descripcion}"?`
        );

        $('#modalConfirmDelete').modal('show');
    }

    return {
        init,
        fillEditModal,
        openDeleteModal
    };

})();