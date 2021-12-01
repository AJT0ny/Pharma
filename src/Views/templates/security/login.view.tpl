<section class="fullCenter">
  <form class="grid" method="post" action="index.php?page=sec_login{{if redirto}}&redirto={{redirto}}{{endif redirto}}">
    <section class="depth-1 row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3 section-head-login">
      <h1 class="col-12 text-center" >Iniciar Sesión</h1>
    </section>
    <section class="depth-1 py-5 row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3">
      <div class="row linea">
        <div class="col-9 right">
          <i class="fas fa-user fa-2x icon"></i>
          <input class="width-full label-data" type="email" id="txtEmail" name="txtEmail" value="{{txtEmail}}" placeholder="Correo Electronico" />
        </div>
        {{if errorEmail}}
          <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorEmail}}</div>
        {{endif errorEmail}}
      </div>
      <div class="row linea">
        <div class="col-9 right">
         <i class="fas fa-lock fa-2x icon"></i>
         <input class="width-full label-data " type="password" id="txtPswd" name="txtPswd" value="{{txtPswd}}" placeholder="Contraseña" />
        </div>
        {{if errorPswd}}
        <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorPswd}}</div>
        {{endif errorPswd}}
      </div>
    {{if generalError}}
      <div class="row">
        {{generalError}}
      </div>
    {{endif generalError}}
    <div class="row right flex-end px-4">
      <button class=" button" id="btnLogin" type="submit">Iniciar Sesión</button>
    </div>
    </section>
  </form>
</section>
