<h1>{{mode_dsc}}</h1>
<section>
  <form action="index.php?page=mnt_usuario&mode={{mode}}&usercod={{usercod}}"
    method="POST" >
    <section>
    <label for="usercod">Código</label>
    <input type="hidden" id="usercod" name="usercod" value="{{usercod}}"/>
    <input type="hidden" id="mode" name="mode" value="{{mode}}" />
    <input type="hidden" id="xsrftoken" name="xsrftoken" value="{{xsrftoken}}" />
    <input type="text" readonly name="usercoddummy" value="{{usercod}}"/>
    </section>
    <section>
      <label for="useremail">Email</label>
      <input type="text" {{readonly}} name="useremail" value="{{useremail}}" maxlength="64" placeholder="Email de usuario"/>
    </section>
    <section>
      <label for="userest">Estado</label>
      {{if readonly}}
       <input type="hidden" id="userestdummy" name="userest" value="" />
      {{endif readonly}}
      <select id="userest" name="userest" {{if readonly}}disabled{{endif readonly}}>
        <option value="ACT" {{userest_ACT}}>Activo</option>
        <option value="INA" {{userest_INA}}>Inactivo</option>
        <option value="PLN" {{userest_PLN}}>Planificación</option>
      </select>
    </section>
    <h2>Roles Usuario</h2>
    <section class="WWList">
      <table>
        <thead>
          <tr>
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Estado</th>
            {{ifnot readonly}}
            <th><a href="index.php?page=mnt_addRol&usercod={{usercod}}">Añadir</a></th>
            {{endifnot readonly}}
          </tr>
        </thead>
        <tbody>
          {{foreach role}}
            <tr>
              <td>{{rolescod}}</td>
              <td><a href="index.php?page=mnt_usuarioAccion&mode=DSP&usercod={{usercod}}&rolescod={{rolescod}}">{{rolesdsc}}</a></td>
              <td>{{roleuserest}}</td>
              {{if ~canDelete}}
              <td><a href="index.php?page=mnt_usuarioAccion&mode=DEL&usercod={{usercod}}&rolescod={{rolescod}}">Eliminar</a></td>
              {{endif ~canDelete}}
            </tr>
          {{endfor role}}
        </tbody>
      </table>
    </section>
    <br>
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
        window.location.assign("index.php?page=mnt_usuarios");
      });
  });
</script>