@extends('layouts.front.app')
@section('css')
<title>Disclaimer</title>
@stop
@section('content')
        <!--Page Title-->
        <div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper"><h1 class="page-width">Your cart</h1></div>
            </div>
        </div>
        <!--End Page Title-->
        
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 main-col">
                    <div class="alert alert-success text-uppercase" role="alert">
                        <i class="icon anm anm-truck-l icon-large"></i> &nbsp;<strong>Congratulations!</strong> You've got free shipping!
                    </div>
                    <form action="#" method="post" class="cart style2">
                        <div class=".table-responsive{-sm|-md|-lg|-xl}"><table>
                            <thead class="cart__row cart__header">
                                <tr>
                                    <th colspan="2" class="text-center">Product</th>
                                    <th class="text-center">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="cart__row border-bottom line1 cart-flex border-top">
                                    <td class="cart__image-wrapper cart-flex-item">
                                        <a href="#"><img class="cart__image" src="{{asset('front/assets/images/product-images/product-image1.jpg')}}" alt="Elastic Waist Dress - Navy / Small"></a>
                                    </td>
                                    <td class="cart__meta small--text-left cart-flex-item">
                                        <div class="list-view-item__title">
                                            <a href="#">Elastic Waist Dress </a>
                                        </div>
                                        
                                        <div class="cart__meta-text">
                                            Color: Navy<br>Size: Small<br>
                                        </div>
                                    </td>
                                    <td class="cart__price-wrapper">
                                        <span class="money">$735.00</span>

                                        <div class="cart__qty">
                                        <div class="qtyField">
                                                <a class="qtyBtn minus" href="javascript:void(0);"><i class="icon icon-minus"></i></a>
                                                <input class="cart__qty-input qty" type="text" name="updates[]" id="qty" value="1" pattern="[0-9]*">
                                                <a class="qtyBtn plus" href="javascript:void(0);"><i class="icon icon-plus"></i></a>
                                        </div>
                                        </div>

                                        <a href="#" class="btn btn--secondary cart__remove" title="Remove tem"><i class="icon icon anm anm-times-l"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                </div>
                    </form>                   
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 cart__footer">
                    <div class="cart-note">
                    </div>
                    <div class="solid-border">
                      <div class="row">
                        <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Subtotal</strong></span>
                        <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money">$735.00</span></span>
                      </div>
                      <div class="cart__shipping">Shipping &amp; taxes calculated at checkout</div>
                      <p class="cart_tearm">
                        <label>
                          <input type="checkbox" name="tearm" id="cartTearm" class="checkbox" value="tearm" required="">
                           I agree with the terms and conditions</label>
                      </p>
                      <input type="submit" name="checkout" id="cartCheckout" class="btn btn--small-wide checkout" value="Checkout" disabled="disabled">
                      <div class="paymnet-img"><img src="{{asset('front/assets/images/payment-img.jpg')}}" alt="Payment"></div>
                    </div>

                </div>
            </div>
        </div>
@stop
@section('js')
@stop