<section class="form">
    <h1>{{mode_dsc}}</h1>
  <form action="index.php?page=mnt_presentacion&mode={{mode}}&presentacionId={{presentacionId}}"
    method="POST" >
    <section class="data">
    <label for="presentacionId">Código</label>
    <input type="hidden" id="mode" name="mode" value="{{mode}}" />
    <input type="hidden" id="xsrftoken" name="xsrftoken" value="{{xsrftoken}}" />
    <input type="text" readonly name="presentacionId" value="{{presentacionId}}"/>
    </section>
    <section class="data">
      <label for="presentacionNombre">Nombre</label>
      <input type="text" {{readonly}} name="presentacionNombre" value="{{presentacionNombre}}" maxlength="50" placeholder="Nombre de la presentacion."/>
    </section>
    <section class="data">
      <label class="descripcion" for="presentacionDescripcion">Descripcion</label>
      <textarea name="presentacionDescripcion" type="text" {{readonly}} rows="9" placeholder="Descripcion de la presentacion." >{{presentacionDescripcion}}</textarea>
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