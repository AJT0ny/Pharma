<div class="hero-cart set-bg-cart" style="background-image: url('public/imgs/pharma/farmacia-carrito.jpg');">
    <div class="hero_text">
        <h2 class="display-2 text-white ">Carrito</h2>
        <p>Detalles de su carrito de compra, y proceder checkout.</p>
    </div>
</div>

<section class="shoping-cart spad">
    <form method="POST">
        <input type="hidden" name="usuario_usercod" value="{{usuario_usercod}}">
        <input type="hidden" name="sumaProductos" value="{{sumaProductos}}">
        <input type="hidden" name="impuesto" value="{{impuesto}}">
        <input type="hidden" name="totalCarrito" value="{{totalCarrito}}">
        <input type="hidden" name="carritoId" value="{{carritoId}}">
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
                                        <div class="price">
                                            <div class="pro-price">
                                                $<input type="text" readonly value="{{productoPrecio}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input readonly type="text" value="{{carritoProductoCantidad}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        ${{carritoProductoTotal}}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="index.php?page=action_delete&carritoProductoId={{carritoProductoId}}"><i class="fas fa-times close-icon"></i></a>
                                    </td>
                                </tr>
                                {{endfor productoEnCarrito}}
                            </tbody>
                        </table>
                        {{if noHayCarrito}}
                            <h3 class="noHayCarrito">No se han agregado productos al carrito.</h3>
                        {{endif noHayCarrito}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="index.php?page=shop" class="cart-btn continue-btn">Continuar comprando...</a>
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
                            <li>Subtotal <span>${{if noHayCarrito}}0{{endif noHayCarrito}}{{sumaProductos}}</span></li>
                            <li>Total <span>${{if noHayCarrito}}0{{endif noHayCarrito}}{{totalCarrito}}</span></li>
                        </ul>
                        <button type="submit" {{if noHayCarrito}}disabled{{endif noHayCarrito}} class="primary-btn">Realizar Compra</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>