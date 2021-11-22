<h1>Inventario.</h1>
<br>
<hr>
<br>
<p>
    Lista de laboratorios que proveen medicamentos, presentan una imagen, nombre, precio e id.
</p>
<br>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>
        <button id="btnAdd">Nuevo</button>
        </th>
      </tr>
    </thead>
    <tbody>
      {{foreach laboratorio}}
      <tr>
        <td>{{laboratorioId}}</td>
        <td><a href="index.php?page=mnt_laboratorio&mode=DSP&laboratorioId={{laboratorioId}}">{{laboratorioNombre}}</a></td>
        <td>{{laboratorioDescripcion}}</td>
        <td>
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_laboratorio"/>
              <input type="hidden" name="mode" value="UPD" />
              <input type="hidden" name="laboratorioId" value={{laboratorioId}} />
              <button type="submit">Editar</button>
          </form>
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="mnt_laboratorio"/>
              <input type="hidden" name="mode" value="DEL" />
              <input type="hidden" name="laboratorioId" value={{laboratorioId}} />
              <button type="submit">Eliminar</button>
          </form>
        </td>
      </tr>
      {{endfor laboratorio}}
    </tbody>
  </table>
  <div class="pages">
    {{if previous}}
    <a class="page" href="index.php?page=mnt_laboratorios&list={{prevBtn}}">Anterior</a>
    {{endif previous}}
    {{foreach nPages}}
      <a class="page" href="index.php?page=mnt_laboratorios&list={{number}}">{{number}}</a>
    {{endfor nPages}}
    {{if next}}
      <a class="page" href="index.php?page=mnt_laboratorios&list={{nextBtn}}">Siguiente</a>
    {{endif next}}
  </div>
  {{search}}
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
