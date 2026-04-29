{{-- VENTANA MODAL --}}
<div class="modal fade" id="mod_edi_pas" tabindex="-1" role="dialog" aria-labelledby="mod_edi_pas_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mod_edi_pas_label">Actualizar Password Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id='message-error_pas' class="alert alert-danger danger" role='alert' style="display: none">
                    <strong id="error_pas"></strong>
                </div>
                <form id="form_upd_pas_usu">
                    @csrf
                    <input type="hidden" name="user_id" id="edit_pass_user_id">

                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for = "password">Contraseña Actual</label>
                            <input type="password" name="current_password" id ="mypassword_edi_pas" class="form-control"
                                placeholder="Contraseña Actual">
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for = "password">Contraseña Nueva</label>
                            <input type="password" name="password" id ="password_edi_pas" class="form-control"
                                placeholder="Contraseña Nueva">
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for = "password_confirt">Confirmar Contraseña Nueva</label>
                            <input type="password" name="password_confirmation" id ="password_confirmation_edi_pas"
                                class="form-control" placeholder="Confirmar Contraseña Nueva">
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal-footer">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button type="button" class="btn btn-info btn-sm m-t-10" data-dismiss="modal"
                                    id="btn_can_pas_usu">
                                    Cancelar
                                </button>
                                <button type="button" id="btn_act_pas_usu" class="btn btn-success btn-sm m-t-10">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
