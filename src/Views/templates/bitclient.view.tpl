<h1>Historial de mis Compras</h1>
<section class="WWFilter">

</section>
<section class="WWList">
  <table>
    <thead>
      <tr>
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
        <td>{{bitacorafch}}</td>
        <td>{{bitprograma}}</td>
        <td>{{bitdescripcion}}</td>
        <td>${{bitImpuesto}}</td>
        <td>${{bitSubtotal}}</td>
        <td>${{bitTotal}}</td>
      </tr>
      {{endfor items}}
    </tbody>
  </table>
</section>