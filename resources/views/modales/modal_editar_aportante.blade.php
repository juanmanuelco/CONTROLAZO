
<div id="modal_editar_aportante" class="modal">
    <div style="padding-right:20%; padding-left:20%">
        <div class="modal-content contenedor-bordes-m">
            <div class="modal-header">
                <h3 class="modal-title">Editar aportante</h3>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('actualizar')}}" method="POST">
                    {{ csrf_field() }} 
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" required name="nombre" class="form-control" id="txt_nom_apor">
                </div>
                <div class="form-group">
                    <label for="">Cédula</label>
                    <input type="text" required readonly name="cedula"  class="form-control" id="txt_ced_apor">
                </div>
                <div class="form-group">
                    <label for="">Proceso</label>
                    <select name="proceso"  required id="sel_proc" class="form-control">
                        <option value="NOMINA" selected>NOMINA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Sueldo</label>
                    <input type="number" name="sueldo" required min="1" value="0" step="0.01" class="form-control" id="txt_sue_apor">
                </div>
                <button type="submit" class="btn btn-dark">Guardar cambios</button>
            </form>   
        </div>
    </div>
    
</div>