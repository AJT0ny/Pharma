<div class="hero-details set-bg-details" style="background-image: url('public/imgs/pharma/details.png');">
    <div class="hero_text">
        <h2 class="display-2 text-white ">Detalles</h2>
        <p>Mira los detalles del producto.</p>
    </div>
</div>

    <!-- Product Details Section Begin -->
<section class="product-details spad">
    <form method="POST" >
        <input type="hidden" name="userId" value="{{userId}}">
        <input type="hidden" name="usuario_usercod" value="{{usuario_usercod}}">
        <input type="hidden" name="carritoEstado" value="{{carritoEstado}}">
        <input type="hidden" name="carritoId" value="{{carritoId}}">
        <input type="hidden" name="carritoProductoActivo" value="{{carritoProductoActivo}}">
        <input type="hidden" name="productoId" value="{{productoId}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="public/imgs/pharma/productos/{{productoImagen}}" alt="{{productoNombre}}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{productoNombre}}</h3>
                        <div class="product__details__price">${{productoPrecio}}</div>
                        <p>{{productoDescripcion}}</p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" name="carritoProductoCantidad" maxlength="2" value="{{carritoProductoCantidad}}">
                                </div>
                            </div>
                        </div>
                        <button class="primary-btn" type="submit" name="btnGuardar" value="G">Añadir al carrito</button>
                        <ul>
                            <li><b>Laboratorio</b> <span>{{laboratorioNombre}}</span></li>
                            <li><b>Disponibilidad</b> <span>{{inventarioExistencias}}</span></li>
                            <li><b>Envio</b> <span>Entrega a domicilio<samp> Disponibilidad en su tienda mas cercana</samp></span></li>
                            <li><b>Presentacion</b> <span>{{presentacionNombre}}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Descripcion</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Informacion del producto</h6>
                                    <p>{{productoDescripcion}}</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Productos Relacionados</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                {{foreach ProductosRelacionados}}
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" style="background-image: url('public/imgs/pharma/productos/{{productoImagen}}');">
                            <ul class="product__item__pic__hover">
                                
                                <li><a href="index.php?page=details&productoId={{productoId}}"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="index.php?page=details&productoId={{productoId}}">{{productoNombre}}</a></h6>
                            <h5>{{productoPrecio}}</h5>
                        </div>
                    </div>
                </div>
                {{endfor ProductosRelacionados}}
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

  