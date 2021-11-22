<h1>Gestión de laboratorios</h1>
<section class="WWFilter">

</section>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>Código</th>
        <th>Laboratorio</th>
        <th>Descripcion</th>
        <th>
          {{if new_enabled}}
          <button id="btnAdd">Nuevo</button>
          {{endif new_enabled}}
        </th>
      </tr>
    </thead>
    <tbody>
      {{foreach items}}
      <tr>
        <td>{{laboratorioId}}</td>
        <td><a href="index.php?page=mnt_laboratorio&mode=DSP&laboratorioId={{laboratorioId}}">{{laboratorioNombre}}</a></td>
        <td>{{laboratorioDescripcion}}</td>
        <td>
          {{if ~edit_enabled}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_laboratorio"/>
              <input type="hidden" name="mode" value="UPD" />
              <input type="hidden" name="laboratorioId" value={{laboratorioId}} />
              <button type="submit">Editar</button>
          </form>
          {{endif ~edit_enabled}}
          {{if ~delete_enabled}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_laboratorio"/>
              <input type="hidden" name="mode" value="DEL" />
              <input type="hidden" name="laboratorioId" value={{laboratorioId}} />
              <button type="submit">Eliminar</button>
          </form>
          {{endif ~delete_enabled}}
        </td>
      </tr>
      {{endfor items}}
    </tbody>
  </table>
</section>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("btnAdd").addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_laboratorio&mode=INS&laboratorioId=0");
      });
    });
</script>