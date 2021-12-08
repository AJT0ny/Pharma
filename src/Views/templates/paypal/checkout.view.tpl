<section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Detalles de Compra</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                          <div class="shoping__cart__table">
                            <table>
                              <thead>
                                <tr>
                                    <th class="shoping__product">Productos</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                </tr>
                              </thead>
                              <tbody>
                                  {{foreach ordenProducto}}
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
                                                    <input readonly type="text" value="{{ordenProductoCantidad}}">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            ${{ordenProductoTotal}}
                                        </td>
                                    </tr>
                                  {{endfor ordenProducto}}
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Tu orden</h4>
                                <div class="checkout__order__subtotal">Subtotal <span>${{ordenSubtotal}}</span></div>
                                <div class="checkout__order__impuesto">Impuesto <span>${{ordenImpuestos}}</span></div>
                                <div class="checkout__order__total">Total <span>${{ordenTotal}}</span></div>
                                <p>Para realizar la orden necesita una cuenta de usuario.</p>
                                <form action="index.php?page=checkout_checkout" method="post">
                                  <a href="index.php?page=action_deleteorder&ordenId={{ordenId}}">Cancelar Orden</a>
                                  <button type="submit">Pagar con PayPal</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
