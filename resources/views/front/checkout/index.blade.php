@extends('layouts.front.app')
@section('css')
<title>Checkout</title>
@stop
@section('content')
<!--Page Title-->
        <div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper"><h1 class="page-width">Checkout</h1></div>
            </div>
        </div>
        <!--End Page Title-->
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                    <div class="customer-box returning-customer">
                        <h3><i class="icon anm anm-home"></i> Saved Addresses<a href="#customer-login" id="customer" class="text-white text-decoration-underline" data-toggle="collapse"> Click here to choose</a></h3>
                        <div id="customer-login" class="collapse customer-content">
                            <div class="customer-info">
                                <p class="coupon-text">If you have shopped with us before, please select your saved address for billing &amp; Shipping process.</p>
                                <form>
                                    <div class="row">
                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                        <label for="input-country">Saved Adresses<span class="required-f">*</span></label>
                                        <select name="state_id" id="state">
                                            <option value=""> --- Choose Address --- </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                        <label for="input-country">Address<span class="required-f">*</span></label>
                                        <textarea disabled></textarea>
                                    </div>
                                        <div class="col-md-12">
                                         <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                    <div class="customer-box customer-coupon">
                        <h3 class="font-15 xs-font-13"><i class="icon anm anm-gift-l"></i> Have a coupon? <a href="#have-coupon" class="text-white text-decoration-underline" data-toggle="collapse">Click here to enter your code</a></h3>
                        <div id="have-coupon" class="collapse coupon-checkout-content">
                            <div class="discount-coupon">
                                <div id="coupon" class="coupon-dec tab-pane active">
                                    <p class="margin-10px-bottom">Enter your coupon code if you have one.</p>
                                    <label class="required get" for="coupon-code"><span class="required-f">*</span> Coupon</label>
                                    <form id="applyCoupon">
                                    <input name="coupon_code" id="coupon-code" type="text" class="mb-3">
                                    <button class="coupon-btn btn" type="submit">Apply Coupon</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row billing-fields">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 sm-margin-30px-bottom">
                    <div class="create-ac-content bg-light-gray padding-20px-all">
                        <form>
                            <fieldset>
                                <h2 class="login-title mb-3">Billing details</h2>
                                <div class="row">
                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                        <label for="input-firstname">First Name <span class="required-f">*</span></label>
                                        <input name="firstname" value="" id="input-firstname" type="text">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                        <label for="input-email">E-Mail </label>
                                        <input name="email" value="" id="input-email" type="email">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                        <label for="input-telephone">Telephone <span class="required-f">*</span></label>
                                        <input name="telephone" value="" id="input-telephone" type="tel">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                        <label for="input-address-1">Address <span class="required-f">*</span></label>
                                        <input name="address_1" value="" id="input-address-1" type="text">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                        <label for="input-address-1">Landmark</label>
                                        <input name="address_1" value="" id="input-address-1" type="text">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                        <label for="input-country">State<span class="required-f">*</span></label>
                                        <input name="address_1" value="" id="input-address-1" type="text">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                        <label for="input-country">City<span class="required-f">*</span></label>
                                        <input name="address_1" value="" id="input-address-1" type="text">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                        <label for="input-postcode">Post Code <span class="required-f">*</span></label>
                                        <input name="postcode" value="" id="input-postcode" type="text">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <div class="form-group form-check col-md-12 col-lg-12 col-xl-12">
                                        <label class="form-check-label padding-15px-left">
                                            <input type="checkbox" class="form-check-input" value=""><strong>Save Address For Future?</strong>
                                        </label>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="row">
                                    <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                        <label for="input-company">Order Notes (If there are special instructions for your order)</label>
                                        <textarea class="form-control resize-both" rows="3"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="your-order-payment">
                        <div class="your-order">
                            <h2 class="order-title mb-4">Your Order</h2>

                            <div class="table-responsive-sm order-table"> 
                                <table class="bg-white table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Product Name</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($cart as $carts)
                                        <tr>
                                            <td class="text-left">{{$carts->product->name}}</td>
                                            <td>${{$carts->price}}</td>
                                            <td>{{$carts->quantity}}</td>
                                            <td>${{$carts->price}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="font-weight-600">
                                        <tr>
                                            <td colspan="3" class="text-right">Shipping </td>
                                            <td>$50.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right">Total</td>
                                            <td id="cartTotal">${{$cartTotal}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        
                        <hr />

                        <div class="your-payment">
                            <h2 class="payment-title mb-3">payment method</h2>
                            <div class="payment-method">
                                <div class="row">
                                    <div class="form-group col-md-4 col-lg-4 col-xl-4 required">
                                        <input type="radio" id="radio-six" name="notaswitch-one" value="yes" checked/>
                                        <label for="radio-six" style="font-size:14px"> Cash On Delivery</label>
                                    </div>
                                    <div class="form-group col-md-4 col-lg-4 col-xl-4 required">
                                        <input type="radio" id="radio-six" name="notaswitch-one" value="yes" checked/>
                                        <label for="radio-six" style="font-size:14px"> Pay Now</label>
                                    </div>
                                </div>
                                <div class="order-button-payment">
                                    <button class="btn" value="Place order" type="submit">Place order</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
@stop
@section('js')
<script>
	$('#applyCoupon').on('submit', function(e) {
           e.preventDefault(); // prevent default form submission
           let fd = new FormData(this);
           fd.append('_token', "{{ csrf_token() }}");
    
           $.ajax({
               url: "{{ route('web.apply.coupon') }}",
               type: "POST",
               data: fd,
               dataType: 'json',
               processData: false,
               contentType: false,
               beforeSend: function() {
                   $('#addBtn').prop('disabled', true)
               },
               success: function(result) {
    			if (result.status === false) {
        			toastr.error(result.msg, 'Error', {
            		timeOut: 3000,
            		progressBar: true,
            		closeButton: true
        		});
    				} else if (result.status === true) {
        			toastr.success(result.msg, 'Success', {
            		timeOut: 3000,
            		progressBar: true,
            		closeButton: true
        		});
        		$('#cartTotal').text(result.newCartTotal); // Update table with new cart total
        // window.location.reload();
    }
},
               error: function(jqXHR, exception) {
                   console.log(jqXHR.responseJSON);
                   toastr.error(result.msg, 'Error', {
                       timeOut: 3000,
                       progressBar: true,
                       closeButton: true
                   });
               },
               complete: function() {
                   $('#addBtn').prop('disabled', false);
               }
           });
       });
</script>
@stop