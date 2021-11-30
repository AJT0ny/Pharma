<h1>{{mode_dsc}}</h1>
<section>
  <form action="index.php?page=pharmamnt_inventario&mode={{mode}}&inventarioId={{inventarioId}}"
    method="POST" >
    <section>
    <label for="inventarioId">Código de inventario</label>
    <input type="hidden" id="inventarioId" name="inventarioId" value="{{inventarioId}}"/>
    <input type="hidden" id="mode" name="mode" value="{{mode}}" />
    <input type="hidden" id="xsrftoken" name="xsrftoken" value="{{xsrftoken}}" />
    <input type="text" readonly name="inventarioIddummy" value="{{inventarioId}}"/>
    </section>
    <section>
      <label for="inventarioExistencias">Numero de Existencias</label>
      <input type="number" {{readonly}} name="inventarioExistencias" value="{{inventarioExistencias}}" placeholder="Existencias de Inventario"/>
    </section>
    <section>
      <label for="inventarioFechaCaducidad">Fecha de Caducidad</label>
      <input type="date" {{readonly}} name="inventarioFechaCaducidad" value="{{inventarioFechaCaducidad}}" placeholder="Caducidad del Inventario"/>
    </section>
    <section>
      <label for="productoId">Producto</label>
      {{if readonly}}
       <input type="hidden" id="productoIddummy" name="productoId" value="" />
      {{endif readonly}}
      <select id="productoId" name="productoId" {{if readonly}}disabled{{endif readonly}}>
        {{prueba}}
      </select>
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
        window.location.assign("index.php?page=pharmamnt_inventarios");
      });
  });
</script>