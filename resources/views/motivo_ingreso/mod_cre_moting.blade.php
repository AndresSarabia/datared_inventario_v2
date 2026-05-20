{{-- VENTANA MODAL --}}
<div class="modal fade" id="mod_cre_moting" tabindex="-1" role="dialog" aria-labelledby="cre_Mod_Lab">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="cre_Mod_Lab">Nuevo Motivo de Ingreso</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="message-error-moting" class="alert alert-danger" role="alert" style="display: none">
                    <ul id="error-moting" class="mb-0"></ul>
                </div>

                <form id="form_crear_moting" autocomplete="off">
                    @csrf
                    <input type="hidden" name="estado" value="1">

                    <div class="row">
                        <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Escriba la descripción" rows="3"></textarea>
                        </div>

                        <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <label for="observaciones">Observaciones</label>
                            <textarea name="obsv" id="observaciones" class="form-control" placeholder="Escriba las observaciones" rows="3"></textarea>
                        </div>

                        <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <label for="estado">Estado</label>
                            <input type="text" id="estado" class="form-control" value="Habilitado" readonly>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="btn_can_moting" class="btn btn-info btn-sm m-t-10"
                    data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_reg_moting" class="btn btn-success btn-sm m-t-10">Guardar</button>
            </div>
        </div>
    </div>
</div>
