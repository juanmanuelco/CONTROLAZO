
<div id="modal_editar_sala" class="modal">
    <div style="padding-right:20%; padding-left:20%">
        <div class="modal-content contenedor-bordes-m">
            <div class="modal-header">
                <h3 class="modal-title">Editar Sala</h3>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('editar_sala')}}" method="post" style="padding-bottom:32px">
                {{ csrf_field() }} 
                <input type="hidden" name="id" id="txt_id">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" name="nombre" required id="txt_nombre_sala">
                </div>
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea name="descripcion" id="txt_descripcion_sala" class="form-control" cols="30" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">Capacidad de personas</label>
                    <input type="number" name="capacidad" class="form-control" min="1" step="1" value="0" required id="txt_capacidad_sala">
                </div>
                <div class="form-group">
                    <label for="">Precio por hora $</label>
                    <input type="number" name="precio" class="form-control" min="1" step="0.01" value="0" required id="txt_precio_sala">
                </div>
                <button type="submit" class="btn btn-primary">Registrar sala</button>
            </form>
        </div>
    </div>
    
</div>