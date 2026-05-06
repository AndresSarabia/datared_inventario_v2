{{-- VENTANA MODAL --}}
<div class="modal fade" id="mod_con_alm" tabindex="-1" role="dialog" aria-labelledby="con_Mod_Lab">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="con_Mod_Lab">Consulta Datos Almacén</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form_con_alm" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id" id="id_con">

                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="cod_con">Código</label>
                            <input type="text" name="codigo" id="cod_con" class="form-control" readonly>
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="est_con">Estado</label>
                            <input type="text" name="estado" id="est_con" class="form-control" value="Habilitado"
                                readonly>
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="des_con">Descripción</label>
                            <input type="text" name="descripcion" id="des_con" class="form-control" readonly>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="btn_cer_con" class="btn btn-success btn-sm m-t-10"
                    data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
