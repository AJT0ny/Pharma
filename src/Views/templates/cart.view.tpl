<div class="hero-cart set-bg-cart" style="background-image: url('public/imgs/pharma/farmacia-carrito.jpg');">
    <div class="hero_text">
        <h2 class="display-2 text-white ">Carrito</h2>
        <p>Detalles de su carrito de compra, y proceder checkout.</p>
    </div>
</div>

<section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Productos</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{foreach productoEnCarrito}}
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="public/imgs/pharma/productos/{{productoImagen}}" alt="">
                                        <h5>{{productoNombre}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        ${{productoPrecio}}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input readonly type="text" value="{{carritoProductoCantidad}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        {{totalProducto}}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <i class="fas fa-times close-icon"></i>
                                    </td>
                                </tr>
                                {{endfor productoEnCarrito}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">Continuar comprando...</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Actualizar carrito</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="msg-time">
                        <p>
                            Nota: <br>El carrito se limpiara luego de 24 horas, agradeceriamos que realice sus compras antes de este periodo de tiempo.<br>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Total del carrito</h5>
                        <ul>
                            <li>Subtotal <span>{{subTotalCarrito}}</span></li>
                            <li>Total <span>{{totalCarrito}}</span></li>
                        </ul>
                        <a href="#" class="primary-btn">Realizar Compra</a>
                    </div>
                </div>
            </div>
        </div>
    </section>