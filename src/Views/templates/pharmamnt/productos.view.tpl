<h1>Gestión de Productos</h1>
<section class="WWFilter">

</section>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>Código</th>
        <th>Producto</th>
        <th>Descripcion</th>
        <th>Codigo</th>
        <th>Precio</th>
        <th>Fecha Creado</th>
        <th>Fecha Publicado</th>
        <th>Fecha Editado</th>
        <th>Activo</th>
        <th>Presentacion</th>
        <th>Laboratorio</th>
        <th>Imagen</th>
        <th></th>
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
        <td>{{productoId}}</td>
        <td><a href="index.php?page=mnt_producto&mode=DSP&productoId={{productoId}}">{{productoNombre}}</a></td>
        <td>{{productoDescripcion}}</td>
        <td>{{productoCodigo}}</td>
        <td>{{productoPrecio}}</td>
        <td>{{productoFechaCreado}}</td>
        <td>{{productoFechaPublicado}}</td>
        <td>{{productoFechaEditado}}</td>
        <td>{{productoActivo}}</td>
        <td>{{presentacionId}}</td>
        <td>{{laboratorioId}}</td>
        <td>{{productoImagen}}</td>
        <td>
          {{if ~edit_enabled}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_producto"/>
              <input type="hidden" name="mode" value="UPD" />
              <input type="hidden" name="productoId" value={{productoId}} />
              <button type="submit">Editar</button>
          </form>
          {{endif ~edit_enabled}}
          {{if ~delete_enabled}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_producto"/>
              <input type="hidden" name="mode" value="DEL" />
              <input type="hidden" name="productoId" value={{productoId}} />
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
        window.location.assign("index.php?page=mnt_producto&mode=INS&productoId=0");
      });
    });
</script>