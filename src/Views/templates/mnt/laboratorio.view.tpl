<h1>{{mode_dsc}}</h1>
<section class="form">
  <h1>{{mode_dsc}}</h1>
  <form action="index.php?page=mnt_laboratorio&mode={{mode}}&laboratorioId={{laboratorioId}}"
    method="POST" >
    <section class="data">
    <label for="laboratorioId">Código</label>
    <input type="hidden" id="mode" name="mode" value="{{mode}}" />
    <input type="hidden" id="xsrftoken" name="xsrftoken" value="{{xsrftoken}}" />
    <input type="text" readonly name="laboratorioId" value="{{laboratorioId}}"/>
    </section>
    <section class="data">
      <label for="laboratorioNombre">Nombre</label>
      <input type="text" {{readonly}} name="laboratorioNombre" value="{{laboratorioNombre}}" maxlength="50" placeholder="Nombre del Laboratorio."/>
    </section>
    <section class="data">
      <label for="laboratorioDescripcion">Descripcion</label>
      <textarea name="laboratorioDescripcion" type="text" {{readonly}} rows="9" placeholder="Descripcion del laboratorio." >{{laboratorioDescripcion}}</textarea>
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
        window.location.assign("index.php?page=mnt_laboratorios");
      });
  });
</script>