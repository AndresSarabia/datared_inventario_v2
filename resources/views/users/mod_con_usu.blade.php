{{-- VENTANA MODAL --}}
<div class="modal fade" id="mod_con_usu" tabindex="-1" role="dialog" aria-labelledby="mod_con_usu_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mod_con_usu_label">Consulta Datos Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id='message-error' class="alert alert-danger danger" role='alert' style="display: none">
                    <strong id="error"></strong>
                </div>
                <form id="form_con_usu">
                    <div class="row">
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label for = "nombre">Nombre</label>
                            <input type="text" id ="nombre_con" readonly="true" class="form-control"
                                placeholder="Escriba el nombre">
                        </div>
                        <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-12">
                            <label for = "Apellidos">Apellidos</label>
                            <input type="text" id="apellidos_con" readonly="true" class="form-control"
                                placeholder="Escriba los apellidos">
                        </div>
                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <label for = "C.I.">C.I.</label>
                            <input type="text" id ="ci_con" readonly="true" class="form-control"
                                placeholder="C.I.">
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label for = "Género">Género</label>
                            <input type="text" id ="sexo_con" readonly="true" class="form-control"
                                placeholder="C.I.">
                        </div>
                        <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label for = "estado">Estado</label>
                            <input type="text" id ="estado_con" class="form-control" readonly='true'>
                        </div>
                        <div class="form-group  col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label for = "Dirección">Dirección</label>
                            <input type="text" id ="direccion_con" readonly="true" class="form-control"
                                placeholder="Escriba la dirección">
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label for = "telefono">Teléfono</label>
                            <input type="text" id ="telefono_con" readonly="true" class="form-control"
                                placeholder="Num. Telf/Cel">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for = "email">E-mail</label>
                            <input type="text" id ="email_con" readonly="true" class="form-control"
                                placeholder="Escriba el correo">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for = "cargo">Cargo</label>
                            <input type="text" id ="cargo_con" readonly="true" class="form-control"
                                placeholder="Escriba el cargo">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for = "perfil">Perfil</label>
                            <input type="text" id ="perfil_con" readonly="true" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="modal-footer">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
