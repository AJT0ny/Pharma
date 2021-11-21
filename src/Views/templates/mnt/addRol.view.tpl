<section class="depth-1">
  <h1>Añadir rol a usuario</h1>
</section>
<section class="WWList">
  <table >
    <thead>
      <tr>
      <th>Código</th>
      <th>Rol</th>
      <th>Estado</th>
      <th>Seleccionar</th>
      </tr>
    </thead>
    <form method="POST">
    <tbody>
      {{foreach role}}
      <tr>
        <td>{{rolescod}}</td>
        <td>{{rolesdsc}}</td>
        <td>{{rolesest}}</td>
        <td>
            <button type="submit" name="btnGuardar" value="G">Guardar</button>
        </td>
      </tr>
      {{endfor role}}
    </tbody>
  </table>
  <br>
      <button type="button" id="btnCancelar">Cancelar</button>
    </form>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function(){
      document.getElementById("btnCancelar").addEventListener("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_usuarios");
      });
  });
</script>
