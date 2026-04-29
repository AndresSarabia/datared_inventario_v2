{{-- VENTANA MODAL --}}
<div class="modal fade" id="mod_cre_usu" tabindex="-1" role="dialog" aria-labelledby="mod_cre_usu">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mod_cre_usu_label">Nuevo Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id='message-error' class="alert alert-danger danger" role='alert' style="display: none">
                    <strong id="error"></strong>
                </div>
                <form id="form_cre_usu" method="POST" action="{{ route('usuarios.store') }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label for = "nombre">Nombre</label>
                            <input type="text" name="nombre" id ="nombre" required class="form-control"
                                placeholder="Escriba el nombre">
                        </div>
                        <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-12">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" required class="form-control"
                                placeholder="Escriba los apellidos">
                        </div>
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label for="ci">C.I.</label>
                            <input type="text" name="ci" id ="ci" required class="form-control"
                                placeholder="C.I.">
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label for = "Género">Género</label>
                            <select class="form-control selectpicker" name="sexo" id="sexo">
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label for = "estado">Estado</label>
                            <input type="text" class="form-control" value="Habilitado" readonly='true'>
                            <input type="hidden" name="estado" value="1">
                        </div>
                        <div class="form-group  col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label for = "Dirección">Dirección</label>
                            <input type="text" name="direccion" id ="direccion" class="form-control"
                                placeholder="Escriba la dirección">
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label for = "telefono">Teléfono</label>
                            <input type="text" name="telefono" id ="telefono" class="form-control"
                                placeholder="Num. Telf/Cel">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for = "email">E-mail</label>
                            <input type="text" name="email" id ="email" required class="form-control"
                                placeholder="Escriba el correo">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for = "cargo">Cargo</label>
                            <input type="text" name="cargo" id ="cargo" class="form-control"
                                placeholder="Escriba el cargo">
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label for = "perfil">Perfil</label>
                            <select class="form-control selectpicker" name="perfil" id="perfil">
                                <option value="administrador">Administrador</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="tecnico">Técnico</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label for = "password">Contraseña</label>
                            <input type="password" name="password" id ="password" required class="form-control"
                                placeholder="Contraseña">
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label for="password_confirmation">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id ="password_confirmation" required
                                class="form-control" placeholder="Confirmar Contraseña">
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal-footer">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button type="button" id="btn_mod_reg_usu" class="btn btn-success btn-sm m-t-10">
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
