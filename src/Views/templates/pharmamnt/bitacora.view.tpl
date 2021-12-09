<h1>{{mode_dsc}}</h1>
<section>
  <form action="index.php?page=mnt_bitacora&mode={{mode}}&bitacoracod={{bitacoracod}}"
    method="POST" >
    <section>
    <label for="bitacoracod">Código</label>
    <input type="hidden" id="bitacoracod" name="bitacoracod" value="{{bitacoracod}}"/>
    <input type="hidden" id="mode" name="mode" value="{{mode}}" />
    <input type="hidden" id="xsrftoken" name="xsrftoken" value="{{xsrftoken}}" />
    <input type="text" readonly name="bitacoracoddummy" value="{{bitacoracod}}"/>
    </section>
    <section>
      <label for="bitusuario">Usuario</label>
      <input type="text" {{readonly}} name="bitusuario" value="{{bitusuario}}" maxlength="45" placeholder="Usuario de la bitacora"/>
    </section>
    <section>
      <label for="bitacorafch">Fecha</label>
      <input type="date" {{readonly}} name="bitacorafch" value="{{bitacorafch}}" maxlength="45" placeholder="Fecha de la Bitacora"/>
    </section>
    <section>
      <label for="bitprograma">Programa</label>
      <input type="text" {{readonly}} name="bitprograma" value="{{bitprograma}}" maxlength="45" placeholder="Programa de Bitacora"/>
    </section>
    <section>
      <label for="bitdescripcion">Descripcion</label>
      <input type="text" {{readonly}} name="bitdescripcion" value="{{bitdescripcion}}" maxlength="45" placeholder="descripcion de la bitacora"/>
    </section>
    <section>
      <label for="bitImpuesto">Impuesto</label>
      <input type="number" {{readonly}} name="bitImpuesto" value="{{bitImpuesto}}" maxlength="45" placeholder="Impuesto de la bitacora"/>
    </section>
    <section>
      <label for="bitSubtotal">Subtotal</label>
      <input type="number" {{readonly}} name="bitSubtotal" value="{{bitSubTotal}}" maxlength="45" placeholder=maxlength="45" placeholder="Subtotal de la bitacora"/>
    </section>
    <section>
      <label for="bitTotal">Total</label>
      <input type="number" {{readonly}} name="bitTotal" value="{{bitTotal}}" maxlength="45" placeholder=maxlength="45" placeholder="Total de la bitacora"/>
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
      <button type="button" id="btnCancelar">Cancelar</button>
    </section>
  </form>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function(){
      document.getElementById("btnCancelar").addEventListener("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=pharmamnt_bitacoras");
      });
  });
</script>