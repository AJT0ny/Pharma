<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{SITE_TITLE}}</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="/{{BASE_DIR}}/public/css/appstyle.css" />
  <script src="https://kit.fontawesome.com/dc88af8176.js" crossorigin="anonymous"></script>
  {{foreach SiteLinks}}
    <link rel="stylesheet" href="/{{~BASE_DIR}}/{{this}}" />
  {{endfor SiteLinks}}
  {{foreach BeginScripts}}
    <script src="/{{~BASE_DIR}}/{{this}}"></script>
  {{endfor BeginScripts}}
</head>
<body>
  <header>
    <input type="checkbox" class="menu_toggle" id="menu_toggle" />
    <label for="menu_toggle" class="menu_toggle_icon" >
      <div class="hmb dgn pt-1"></div>
      <div class="hmb hrz"></div>
      <div class="hmb dgn pt-2"></div>
    </label>
    <h1>{{SITE_TITLE}}</h1>
    <nav id="menu">
      <ul>
        <li><a href="index.php?page=index"><i class="fas fa-home"></i>&nbsp;Inicio</a></li>
        <li><a href="index.php?page=shop"><i class="fas fa-shopping-basket"></i>&nbsp;Tienda</a></li>
      </ul>
    </nav>
    <a class="cart" href="index.php?page=cart"><i class="fas fa-shopping-cart"></i></a>
    <a class="login" href="index.php?page=sec_register"><i class="fas fa-user-plus"></i>&nbsp;Crear Cuenta</a>
    <a class="register" href="index.php?page=sec_login"><i class="fas fa-sign-in-alt"></i>&nbsp;Iniciar Sesión</a>
  </header>
  <main>
  {{{page_content}}}
  </main>
  <footer>
    <div class="grid-3">
      <div>
        <img class="logo-pharma" src="public/imgs/pharma/PharmaDev.png" alt="logo" />
        <hr>
        <p class="contact">Contact info:</p>
        <p class="contact-info">pharmadev@farma.com</p>
        <p class="contact-info">+504 2785 6721</p>
      </div>
      <div class="site-map">
        <h5 class="title-site">SITE MAP</h5>
        <a class="list-pages" href="#">Productos</a>
        <br>
        <a class="list-pages" href="#">Support</a>
        <br>
        <a class="list-pages" href="#">Contacto</a>
      </div>
      <div class="socials">
        <i class="fab fa-facebook-f social-logo"></i>
        <i class="fab fa-instagram social-logo"></i>
        <i class="fab fa-twitter social-logo"></i>
        <i class="fab fa-youtube social-logo"></i>
      </div>
    </div>
    <div>
      <img class="white-line" src="public/imgs/pharma/white-line.png" alt="Linea blanca"/>
    </div>
    <div>Todo los Derechos Reservados 2021 &copy;</div>
  </footer>
  {{foreach EndScripts}}
    <script src="/{{~BASE_DIR}}/{{this}}"></script>
  {{endfor EndScripts}}
</body>
</html>
