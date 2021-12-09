<h1>Gestión de Historial de Compras</h1>
<section class="WWFilter">

</section>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>Código</th>
        <th>Usuario</th>
        <th>Fecha</th>
        <th>Programa</th>
        <th>Descripción</th>
        <th>Impuesto</th>
        <th>SubTotal</th>
        <th>Total</th>
        
        
      </tr>
    </thead>
    <tbody>
      {{foreach items}}
      <tr>
        <td>{{bitacoracod}}</td>
        <td>{{bitusuario}}</td>
        <td>{{bitacorafch}}</td>
        <td><a href="index.php?page=pharmamnt_bitacora&mode=DSP&bitacoracod={{bitacoracod}}">{{bitprograma}}</a></td>
        <td>{{bitdescripcion}}</td>
        <td>{{bitImpuesto}}</td>
        <td>{{bitSubtotal}}</td>
        <td>{{bitTotal}}</td>
      </tr>
      {{endfor items}}
    </tbody>
  </table>
</section>