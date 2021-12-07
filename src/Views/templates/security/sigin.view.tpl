<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('public/imgs/pharma/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end justify-content-center text-center">
            <div class="col-lg-7">
              <h2 class="mb-0">Crear una Cuenta</h2>
              <p>Registrese en nuestro sitio y proceda a comprar!</p>
            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="index.php?page=index">Home</a>
        <i class="fas fa-arrow-right mx-3" style="color: #bdbdbd;"></i>
        <span class="current">Crear Cuenta</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">

          <form method="post" action="index.php?page=sec_register">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="username">Username</label>
                            <input class="form-control form-control-lg" type="text" id="txtUsername" name="txtUsername" value="{{txtUsername}}" />
                        </div>
                        {{if errorUsername}}
                          <div class="error col-12 py-10 col-m-8">{{errorUsername}}</div>
                        {{endif errorUsername}}
                        <div class="col-12 py-2 col-m-8" style="color: #bdbdbd;">Primer nombre, segundo nombre, con espacio y no menor a 3 caracteres.</div>
                        <div class="col-md-12 form-group">
                            <label for="txtEmail">Email</label>
                            <input class="form-control form-control-lg" type="email" id="txtEmail" name="txtEmail" value="{{txtEmail}}" />
                        </div>
                        {{if errorEmail}}
                          <div class="error col-12 py-2 col-m-8">{{errorEmail}}</div>
                        {{endif errorEmail}}
                        <div class="col-md-12 form-group">
                            <label for="txtPswd">Contraseña</label>
                            <input class="form-control form-control-lg" type="password" id="txtPswd" name="txtPswd" value="{{txtPswd}}" />
                        </div>
                        {{if errorPswd}}
                          <div class="error col-12 py-2 col-m-8">{{errorPswd}}</div>
                        {{endif errorPswd}}
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-primary btn-lg px-5" id="btnSignin" type="submit">Crear Cuenta</button>
                        </div>
                    </div>
                </div>
            </div>
          </form>  
          
        </div>
    </div>