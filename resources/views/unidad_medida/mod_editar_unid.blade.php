{{-- VENTANA MODAL --}}
<div class="modal fade" id="mod_edit_unid" tabindex="-1" role="dialog" aria-labelledby="edit_Mod_Lab">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="edit_Mod_Lab">Editar Unidad de Medida</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="message-error-edi" class="alert alert-danger" role="alert" style="display: none">
                    <ul id="error-edi" class="mb-0"></ul>
                </div>

                <form id="form_editar_unid" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id" id="id_edi">
                    <input type="hidden" name="estado" id="estado_edi_hidden" value="1">

                    <div class="row">
                        <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <label for="codigo">Código</label>
                            <input type="text" name="codigo" id="cod_edi" class="form-control" readonly
                                value="0">
                        </div>
                        <div class="form-group col-lg-6 col-sm-6 col-md-6 col-xs-12">
                            <label for="estado">Estado</label>
                            <input type="text" id="est_edi" class="form-control" value="Habilitado" readonly>
                        </div>

                        <div class="form-group col-lg-7 col-sm-7 col-md-7 col-xs-12">
                            <label for="descripcion">Descripción</label>
                            <input type="text" name="descripcion" id="descrip_edi" class="form-control"
                                placeholder="Escriba la descripción">
                        </div>

                        <div class="form-group col-lg-5 col-sm-5 col-md-5 col-xs-12">
                            <label for="abreviatura">Abreviatura</label>
                            <input type="text" name="abreviatura" id="abrev_edi" class="form-control"
                                placeholder="Escriba la abreviatura">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="btn_can_edi_unid" class="btn btn-info btn-sm m-t-10"
                    data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_act_unid" class="btn btn-success btn-sm m-t-10">Guardar</button>
            </div>
        </div>
    </div>
</div>
