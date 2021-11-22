<h1>{{mode_dsc}}</h1>
<section>
  <form action="index.php?page=mnt_producto&mode={{mode}}&productoId={{productoId}}"
    method="POST" >
    <section>
    <label for="productoId">Código de laboratorio</label>
    <input type="hidden" id="productoId" name="productoId" value="{{productoId}}"/>
    <input type="hidden" id="mode" name="mode" value="{{mode}}" />
    <input type="hidden" id="xsrftoken" name="xsrftoken" value="{{xsrftoken}}" />
    <input type="text" readonly name="productoIddummy" value="{{productoId}}"/>
    </section>
    <section>
      <label for="productoNombre">laboratorio</label>
      <input type="text" {{readonly}} name="productoNombre" value="{{productoNombre}}" maxlength="45" placeholder="Nombre de laboratorio"/>
    </section>
    <section>
      <label for="productoDescripcion">descripcion</label>
      <input type="text" {{readonly}} name="productoDescripcion" value="{{productoDescripcion}}" maxlength="45" placeholder="descripcion de laboratorio"/>
    </section>
    <section>
      <label for="productoPrecio">Precio</label>
      <input type="number" {{readonly}} name="productoPrecio" value="{{productoPrecio}}" placeholder="Precio de Producto"/>
    </section>
    <section>
      <label for="productoFechaCreado">Fecha Creado</label>
      <input type="date" {{readonly}} name="productoFechaCreado" value="{{productoFechaCreado}}" placeholder="Fecha de Creacion"/>
    </section>
    <section>
      <label for="productoFechaPublicado">Fecha Publicado</label>
      <input type="date" {{readonly}} name="productoFechaPublicado" value="{{productoFechaPublicado}}" placeholder="Fecha de Publicacion"/>
    </section>
    <section>
      <label for="productoFechaEditado">Fecha editado</label>
      <input type="date" {{readonly}} name="productoFechaEditado" value="{{productoFechaEditado}}" placeholder="Fecha de actualizacion"/>
    </section>
    <section>
      <label for="productoActivo">Activo</label>
      <input type="number" {{readonly}} name="productoActivo" value="{{productoActivo}}" placeholder="Estado del Producto"/>
    </section>
    <section>
      <label for="presentacionId">Presentacion</label>
      <input type="number" {{readonly}} name="presentacionId" value="{{presentacionId}}" placeholder="Id de Presentacion"/>
    </section>
    <section>
      <label for="laboratorioId">Laboratorio</label>
      <input type="number" {{readonly}} name="laboratorioId" value="{{laboratorioId}}" placeholder="id de Laboratorio"/>
    </section>
    <section>
      <label for="productoImagen">descripcion</label>
      <input type="text" {{readonly}} name="productoImagen" value="{{productoImagen}}" placeholder="Link de la Imagen"/>
    </section>
    {{if hasErrors}}
        <section>
          <ul>
            {{foreach Errors}}
                <li>{{this}}</li>
            {{endfor Errors}}
          </ul>
        </section>
    {{endif hasErrors}}
    <section>
      {{if showaction}}
      <button type="submit" name="btnGuardar" value="G">Guardar</button>
      {{endif showaction}}
      <button type="button" id="btnCancelar">Cancelar</button>
    </section>
  </form>
</section>


<script>
  document.addEventListener("DOMContentLoaded", function(){
      document.getElementById("btnCancelar").addEventListener("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_productos");
      });
  });
</script>