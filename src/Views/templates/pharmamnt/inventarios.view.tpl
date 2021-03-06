<h1>Gestión de Inventarios</h1>
<section class="WWFilter">

</section>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>Código</th>
        <th>Existencias</th>
        <th>Fecha de Caducidad</th>
        <th>Producto</th>
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
        <td>{{inventarioId}}</td>
        <td><a href="index.php?page=pharmamnt_inventario&mode=DSP&inventarioId={{inventarioId}}">{{inventarioExistencias}}</a></td>
        <td>{{inventarioFechaCaducidad}}</td>
        <td>{{productoId}}</td>
        <td>
          {{if ~edit_enabled}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="pharmamnt_inventario"/>
              <input type="hidden" name="mode" value="UPD" />
              <input type="hidden" name="inventarioId" value={{inventarioId}} />
              <button type="submit">Editar</button>
          </form>
          {{endif ~edit_enabled}}
          {{if ~delete_enabled}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="pharmamnt_inventario"/>
              <input type="hidden" name="mode" value="DEL" />
              <input type="hidden" name="inventarioId" value={{inventarioId}} />
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
        window.location.assign("index.php?page=pharmamnt_inventario&mode=INS&inventarioId=0");
      });
    });
</script>