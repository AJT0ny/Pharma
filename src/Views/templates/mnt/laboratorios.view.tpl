<h1 class="page-title">Laboratorios.</h1>
<hr>
<div class="grid-2">
  <section class="desc-sect">
    <p class="dsc">
      Lista de laboratorios que proveen medicamentos, presentan su id, nombre y una pequeña descripcion.
    </p>
  </section>
  <section class="search">
    <form method="GET">
      <input type="hidden" name="page" value="mnt_laboratorios">
      <input type="hidden" name="list" value="{{list}}">
      <label class="buscar" for="search">Buscar por nombre:</label>
      <input type="text" name="search" value="{{searchValue}}"/>
      <button class="btnGuardar" type="submit">Buscar</button>
    </form>
  </section>
</div>
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
        <td><div class="pharm-dsc">{{laboratorioDescripcion}}</div></td>
        <td>
          <div class="buttons">
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
          </div>
        </td>
      </tr>
      {{endfor laboratorio}}
    </tbody>
  </table>
  {{if noData}}
    <h2 class="no-data">No hay datos para mostrar :(</h2>
  {{endif noData}}
  <div class="pages">
    {{if previous}}
    <a class="page" href="index.php?page=mnt_laboratorios&list={{prevBtn}}{{if search}}&search={{searchValue}}{{endif search}}">Anterior</a>
    {{endif previous}}
    {{if numberPages}}
      {{foreach nPages}}
        <a class="page" href="index.php?page=mnt_laboratorios&list={{number}}">{{number}}</a>
      {{endfor nPages}}
    {{endif numberPages}}
    {{if next}}
      <a class="page" href="index.php?page=mnt_laboratorios&list={{nextBtn}}{{if search}}&search={{searchValue}}{{endif search}}">Siguiente</a>
    {{endif next}}
  </div>
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
