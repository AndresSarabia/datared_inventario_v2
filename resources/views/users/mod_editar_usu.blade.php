{{-- VENTANA MODAL --}}
<div class="modal fade" id="mod_edit_usu" tabindex="-1" role="dialog" aria-labelledby="mod_edit_usu">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mod_edit_usu_label">Actualizar Datos del Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id='message-error' class="alert alert-danger danger" role='alert' style="display: none">
                    <strong id="error"></strong>
                </div>
                <form id="form_edit_usu" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="user_id" id="edit_user_id">
                    <div class="row">
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label for = "nombre">Nombre</label>
                            <input type="text" name="nombre" id="edit_nombre" required class="form-control"
                                placeholder="Escriba el nombre">
                        </div>
                        <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-12">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" id="edit_apellidos" required class="form-control"
                                placeholder="Escriba los apellidos">
                        </div>
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label for="ci">C.I.</label>
                            <input type="text" name="ci" id="edit_ci" required class="form-control"
                                placeholder="C.I.">
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label for = "Género">Género</label>
                            <select class="form-control selectpicker" name="sexo" id="edit_sexo">
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label for = "telefono">Teléfono</label>
                            <input type="text" name="telefono" id ="edit_telefono" class="form-control"
                                placeholder="Num. Telf/Cel">
                        </div>
                        <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label for = "Dirección">Dirección</label>
                            <input type="text" name="direccion" id ="edit_direccion" class="form-control"
                                placeholder="Escriba la dirección">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for = "email">E-mail</label>
                            <input type="text" name="email" id ="edit_email" required class="form-control"
                                placeholder="Escriba el correo">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for = "cargo">Cargo</label>
                            <input type="text" name="cargo" id ="edit_cargo" class="form-control"
                                placeholder="Escriba el cargo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal-footer">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button type="button" id="btn_edit_reg_usu" class="btn btn-success btn-sm m-t-10">
                                    Guardar
                                </button>
                                <button type="button" class="btn btn-info btn-sm m-t-10" data-dismiss="modal"
                                    id="btn_can_usu">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
