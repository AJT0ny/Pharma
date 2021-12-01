<div class="hero-shop set-bg-shop" style="background-image: url('public/imgs/pharma/farmacia.png');">
    <div class="hero_text">
        <h2>SHOP</h2>
        <p>Compra lo que desees en nuestra gran variedad de productos.</p>
    </div>
</div>
<section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar bg-sidebar p-4">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                                {{foreach presentacion}}
                                    <input type="hidden" name="presentacionId" value="{{presentacionId}}"/>
                                    <li><a href="#">{{presentacionNombre}}</a></li>
                                {{endfor presentacion}}
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="range-slider">
                                    <div class="price-input">
                                        <div class="price-input">
                                        <p>
                                            De:
                                        </p>
                                        $ <input type="text" id="minamount">
                                        <p>
                                            Hasta:
                                        </p>
                                        $ <input type="text" id="maxamount">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Latest Products</h4>
                                <div class="latest-product__slider">
                                    {{foreach productoReciente}}
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-pic-container">
                                                <img class="latest-product__item__pic" src="public/imgs/pharma/productos/{{productoImagen}}" alt="{{productoNombre}}">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{productoNombre}}</h6>
                                                <span>${{productoPrecio}}</span>
                                            </div>
                                        </a>
                                    {{endfor productoReciente}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div>
                        <div >
                            <div class="section-title">
                                <h2>Productos</h2>
                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Buscar por nombre:</span>
                                    <input type="text" name="productoNombre" value="{{productoNombre}}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{totalProductos}}</span> Products found</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{foreach producto}}
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item__container">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" style="background-image: url('public/imgs/pharma/productos/{{productoImagen}}');">
                                        <div class="product__item__pic__hover">
                                            <span><a href="index.php?page=details&productoNombre={{productoId}}"><i class="fa fa-shopping-cart"></i></a></span>
                                        </div>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="index.php?page=details&productoNombre={{productoId}}">{{productoNombre}}</a></h6>
                                        <h5>${{productoPrecio}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{endfor producto}}
                    </div>
                </div>
            </div>
        </div>
    </section>