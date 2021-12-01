<div class="hero_item set-bg" style="background-image: url('public/imgs/pharma/hero-panel.jpg');">
    <div class="hero_text">
        <img class="pharmaDev" src="public/imgs/pharma/PharmaDev.png" alt="hero 1" /><br>
        <span>MEDICINAS PARA LO QUE NECESITES</span>
        <h2>Desde quimicos <br />Hasta Naturales</h2>
        <p>Recogida y entrega gratis disponibles</p>
        <a href="#" class="primary-btn">COMPRA AHORA</a>
    </div>
</div>

<section class="featured spad">
        <div>
            <div class="center">
                <div >
                    <div class="section-title">
                        <h2>Productos Recientes</h2>
                    </div>
                </div>
            </div>
            <div class="container">
                {{foreach productoRecientes}}
                    <div class="featured_box">
                        <div class="container_featured_product">
                            <div class="featured_item">
                                <div class="featured_item_pic set-bg-featured" style="background-image: url('public/imgs/pharma/productos/{{productoImagen}}');">
                                    <div class="featured_item_pic_hover ">
                                        <span><a href="index.php?page=details&productoId={{productoId}}"><i class="fa fa-shopping-cart "></i></a></span>
                                    </div>
                                </div>
                                <div class="featured_item_text">
                                    <h6><a href="index.php?page=details&productoId={{productoId}}">{{productoNombre}}</a></h6>
                                    <h5>${{productoPrecio}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                {{endfor productoRecientes}}
            </div>
        </div>
</section>

<section class="info_pharma spad">
    <div>
        <div class="center">
            <div class="section-title-beneficios">
                <h2>Beneficios</h2>
            </div>
        </div>
        <div class="info_icons">
            <div class="icon-box">
                <i class="fas fa-shipping-fast icon"></i>
                <p class="center-p">
                    Envio gratis en compras mayores a $35
                </p>
            </div>
            <div class="icon-box">
                <i class="fas fa-box icon"></i>
                <p class="center-p">
                    Envío gratis a la tienda
                </p>
            </div>
            <div class="icon-box">
                <i class="fas fa-shopping-bag icon"></i>
                <p class="center-p">
                    Entrega gratis el mismo día con compras mayores a $50
                </p>
            </div>
            <div class="icon-box">
                <i class="fas fa-credit-card icon"></i>
                <p class="center-p">
                    Tarjeta myPharmaDev&trade;
                </p>
            </div>
            <div class="icon-box">
                <i class="fas fa-clinic-medical icon"></i>
                <p class="center-p">
                    Recoger en tan solo 30 minutos
                </p>
            </div>
        </div>
    </div>
</section>

<section class="contact-section spad">
    <div class="center">
            <div class="section-title">
                <h2>Contacto</h2>
            </div>
        </div>
    <div class="container">
        <div class="contact-info-box">
            <div class="contact_divs">
                <div class="contact_widget">
                    <i class="fas fa-phone-alt"></i>
                    <h4>Telefono</h4>
                    <p>+504 2785 6721</p>
                </div>
            </div>
            <div class="contact_divs">
                <div class="contact_widget">
                    <i class="fas fa-map-marker-alt contact_icon"></i>
                    <h4>Direccion</h4>
                    <p>8 ave 3 calle Juticalpa, 16101</p>
                </div>
            </div>
            <div class="contact_divs">
                <div class="contact_widget">
                    <i class="fas fa-clock"></i>
                    <h4>Abiertos de</h4>
                    <p>10:00 am a 11:00 pm</p>
                </div>
            </div>
            <div class="contact_divs">
                <div class="contact_widget">
                    <i class="fas fa-envelope"></i>
                    <h4>Email</h4>
                    <p>pharmadev@farma.com</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1364.6277025586937!2d-86.2208589532301!3d14.67012808830258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f6c1fac807747df%3A0xb2708916ae5d8d81!2sFarmacia%20Sim%C3%A1n!5e0!3m2!1ses-419!2shn!4v1638141050038!5m2!1ses-419!2shn" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    <div class="map-inside">
        <i class="icon_pin"></i>
        <div class="inside-widget">
            <h4>Farmacia PharmaDev</h4>
            <ul>
                <li>Telefono: 2785 6721</li>
                <li>Direccion: 8 ave 3 calle Juticalpa, 16101</li>
            </ul>
        </div>
    </div>
</div>