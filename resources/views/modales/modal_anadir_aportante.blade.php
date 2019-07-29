
<div id="modal_anadir_aportante" class="modal">
        <div style="padding-right:20%; padding-left:20%">
            <div class="modal-content contenedor-bordes-m">
                <div class="modal-header">
                    <h3 class="modal-title">Añadir aportante</h3>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('anadir')}}" method="POST">
                        {{ csrf_field() }} 
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" required name="nombre_a" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="">Cédula</label>
                        <input type="text" required  name="cedula_a"  class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="">Proceso</label>
                        <select name="proceso_a"  required  class="form-control">
                            <option value="NOMINA" selected>NOMINA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Sueldo</label>
                        <input type="number" name="sueldo_a" required min="1" value="0" step="0.01" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="">Tipo</label>
                        <select name="tipo_a"  required  class="form-control">
                            <option value="APORTANTE">APORTANTE</option>
                            <option value="SOCIO">SOCIO</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-dark">Guardar cambios</button>
                </form>   
            </div>
        </div>
        
    </div>