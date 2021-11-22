<h1>{{mode_dsc}}</h1>
<section>
  <form action="index.php?page=mnt_presentacion&mode={{mode}}&presentacionId={{presentacionId}}"
    method="POST" >
    <section>
    <label for="presentacionId">Códigon de Presentacion</label>
    <input type="hidden" id="presentacionId" name="presentacionId" value="{{presentacionId}}"/>
    <input type="hidden" id="mode" name="mode" value="{{mode}}" />
    <input type="hidden" id="xsrftoken" name="xsrftoken" value="{{xsrftoken}}" />
    <input type="text" readonly name="presentacionIddummy" value="{{presentacionId}}"/>
    </section>
    <section>
      <label for="presentacionNombre">Presentacion</label>
      <input type="text" {{readonly}} name="presentacionNombre" value="{{presentacionNombre}}" maxlength="45" placeholder="Nombre de Presentacion"/>
    </section>
    <section>
      <label for="presentacionDescripcion">descripcion</label>
      <input type="text" {{readonly}} name="presentacionDescripcion" value="{{presentacionDescripcion}}" maxlength="45" placeholder="descripcion de Presentacion"/>
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
        window.location.assign("index.php?page=mnt_presentaciones");
      });
  });
</script>