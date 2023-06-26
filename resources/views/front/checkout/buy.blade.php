@extends('layouts.front.app')
@section('css')
<title>Checkout</title>
<style>
   #cartDiscount, #cartTotal {
   display: table-cell;
   }
</style>
@stop
@section('content')
<!--Page Title-->
<div class="page section-header text-center">
   <div class="page-title">
      <div class="wrapper">
         <h1 class="page-width">Checkout</h1>
      </div>
   </div>
</div>
<!--End Page Title-->
<div class="container">
   <div class="alert alert-success text-uppercase" id="shippingFree" role="alert" style="display: none;">
      <i class="icon anm anm-truck-l icon-large"></i> &nbsp;<strong>Congratulations!</strong> You've got free shipping!
   </div>
   <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
         <div class="customer-box returning-customer">
            <h3><i class="icon anm anm-home"></i> Saved Addresses<a href="#customer-login" id="customer" class="text-white text-decoration-underline" data-toggle="collapse"> Click here to choose</a></h3>
            <div id="customer-login" class="collapse customer-content">
               <div class="customer-info">
                  <p class="coupon-text">If you have shopped with us before, please select your saved address for billing &amp; Shipping process.</p>
                  <form id="saved-address">
                     <div class="row">
                        <div class="form-group col-md-12 col-lg-12 col-xl-12 required">
                           <label for="input-country">Saved Adresses<span class="required-f">*</span></label>
                           <select name="state_id" id="user-address">
                              <option value=""> --- Choose Address --- </option>
                              @foreach($user as $users)
                              <option value="{{$users->id}}" data-name="{{$users->name}}" data-email="{{$users->email}}" data-contact="{{$users->contact}}" data-address="{{$users->address}}" data-landmark="{{$users->landmark}}" data-state="{{$users->state}}" data-city="{{$users->city}}" data-pin="{{$users->pin_code}}">{{$users->name}}.{{$users->address}}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="form-group col-md-12 col-lg-12 col-xl-12 required">
                           <label for="input-country">Address<span class="required-f">*</span></label>
                           <textarea disabled id="fullAddress" readonly>
                           </textarea>
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
                     <select name="state_id" id="couponCode">
                        <option value=""> --- Choose Code --- </option>
                        @foreach($coupon as $coupons)
                        <option value="{{$coupons->id}}" data-code="{{$coupons->coupon_code}}">Use {{$coupons->coupon_code}} ** and get flat {{$coupons->coupon_price}} @if($coupons->coupon_type == 'amount') Rupees @else % @endif on order above {{$coupons->order_value}}</option>
                        @endforeach
                     </select>
                     <label class="required get" for="coupon-code"><span class="required-f">*</span> Coupon</label>
                     <form id="applyCoupon">
                        <input name="coupon_code" id="coupon-code" type="text" class="mb-3 input-field">
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
            <form id="billing-details-form">
               <fieldset>
                  <h2 class="login-title mb-3">Billing details</h2>
                  <div class="row">
                     <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                        <label for="input-firstname">First Name <span class="required-f">*</span></label>
                        <input name="name" type="text" class="input-field name">
                     </div>
                     <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                        <label for="input-email">E-Mail </label>
                        <input name="email" type="email" class="input-field email">
                     </div>
                     <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                        <label for="input-telephone">Telephone <span class="required-f">*</span></label>
                        <input name="contact" type="tel" class="input-field contact">
                     </div>
                     <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                        <label for="input-address-1">Address <span class="required-f">*</span></label>
                        <input name="address" type="text" class="input-field address">
                     </div>
                     <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                        <label for="input-address-1">Landmark</label>
                        <input name="landmark" type="text" class="input-field landmark">
                     </div>
                     <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                        <label for="input-country">State<span class="required-f">*</span></label>
                        <input name="state" type="text" class="input-field state">
                     </div>
                     <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                        <label for="input-country">City<span class="required-f">*</span></label>
                        <input name="city" type="text" class="city input-field">
                     </div>
                     <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                        <label for="input-postcode">Post Code <span class="required-f">*</span></label>
                        <input name="pin" type="text" class="input-field pin">
                     </div>
                  </div>
               </fieldset>
               <fieldset>
                  <div class="row">
                     <div class="form-group form-check col-md-12 col-lg-12 col-xl-12">
                        <label class="form-check-label padding-15px-left">
                        <input type="checkbox" class="form-check-input" name="saved"><strong>Save Address For Future?</strong>
                        </label>
                     </div>
                  </div>
               </fieldset>
               <fieldset>
                  <div class="row">
                     <div class="form-group col-md-12 col-lg-12 col-xl-12">
                        <label for="input-company">Order Notes (If there are special instructions for your order)</label>
                        <textarea name="notes" class="form-control resize-both input-field" rows="3" id="notes"></textarea>
                     </div>
                  </div>
               </fieldset>
            </form>
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
                           <th>Seling Price</th>
                           <th>List Price</th>
                           <th>Qty</th>
                           <th>Subtotal</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td class="text-left">{{$cart->product->name}}</td>
                           <td>₹{{$cart->product->mrp}}</td>
                           <td>₹{{$cart->product->discount}}</td>
                           <td>{{$cart->quantity}}</td>
                           <td id="carttotal">₹{{$cart->price * $cart->quantity}}</td>
                        </tr>
                     </tbody>
                     <tfoot class="font-weight-600">
                        <tr id="shipping" style="display: none;">
                           <td colspan="4" class="text-right">Shipping </td>
                           <td>₹99.00</td>
                        </tr>
                        <tr id="charge" style="display: none;">
                           <td colspan="4" class="text-right">Shipping </td>
                           <td>₹0</td>
                        </tr>
                        <tr>
                           <td colspan="4" class="text-right">Total</td>
                           <td id="sval">₹{{$cartTotal}}</td>
                        </tr>
                        <tr id="discount" style="display: none;">
                           <td colspan="4" class="text-right">Discount</td>
                           <td id="cartDiscount"></td>
                        </tr>
                        <tr id="total" style="display: none;">
                           <td colspan="4" class="text-right">Final Price</td>
                           <td id="cartTotal"></td>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
            <hr />
            <div class="your-payment">
               <form id="place">
                  <h2 class="payment-title mb-3">payment method</h2>
                  <div class="payment-method">
                     <div class="row">
                        <input name="coupon_code" id="coupon_codes" type="text" >
                        <input type="hidden" id="addressid" name="addressid"/>
                        <input type="hidden" class="name" name="name"/>
                        <input type="hidden" name="email" class="email" type="email">
                        <input type="hidden" name="contact" class="contact" type="tel">
                        <input type="hidden" name="address" class="address">
                        <input type="hidden" name="landmark" class="landmark" type="text">
                        <input type="hidden" name="state" class="state" type="text">
                        <input type="hidden" name="city" class="city" type="text">
                        <input type="hidden" name="pin_code" class="pin" type="text">
                        <input type="hidden" name="order_notes" class="notes" type="text">
                        <input type="hidden" type="checkbox" name="saveaddress" class="form-check-input" id="check" value="1">
                        <div class="form-group col-md-4 col-lg-4 col-xl-4 ">
                           <input type="radio" id="cash" name="payment_method" value="cash" />
                           <label for="cash" style="font-size:14px"> Cash On Delivery</label>
                        </div>
                        <div class="form-group col-md-4 col-lg-4 col-xl-4 ">
                           <input type="radio" id="payu" name="payment_method" value="payu" />
                           <label for="payu" style="font-size:14px"> Pay Now</label>
                        </div>
                     </div>
                     <div class="order-button-payment">
                        <button class="btn" value="Place order" type="submit">Place order</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@stop
@section('js')
<script>
   $(document).ready(function(){
   
      $('#couponCode').on('change', function() {
              var  selectedCoupon = $(this).find(':selected');
               if(selectedCoupon.val() !== '') {
                  // Fill in the input fields with the address details and make them readonly
                  $('#coupon-code').val(selectedCoupon.data('code')).prop('readonly', true);
                  $('#coupon_codes').val(selectedCoupon.data('code')).prop('readonly', true);
              }
          });
   
      $('input[type="radio"]').click(function() {
      if($(this).attr('id') == 'cash') {
         $('#payu').prop('checked', false);
      } else if($(this).attr('id') == 'payu') {
         $('#cash').prop('checked', false);
      }
   });
   
   const cashRadio = $('#cash');
   const payuRadio = $('#payu');
   
   cashRadio.click(function() {
      if (cashRadio.is(':checked')) {
         payuRadio.prop('checked', false);
      }
   });
   
   payuRadio.click(function() {
      if (payuRadio.is(':checked')) {
         cashRadio.prop('checked', false);
      }
   });
   
      $('input[name="saved"]').change(function() {
   $('#check').prop('checked', $(this).prop('checked'));
   });
   
      $('.input-field').on('input', function() {
   var fieldName = $(this).attr('name');
   $('.' + fieldName).val($(this).val());
   });
   
   
      $('#user-address').change(function() {
      var selectedAddressId = $(this).val();
      $('#addressid').val(selectedAddressId);
   });
      $('#place').on('submit', function(e) {
           e.preventDefault(); // prevent default form submission
           let fd = new FormData(this);
           fd.append('_token', "{{ csrf_token() }}");
    
           $.ajax({
               url: "{{ route('web.buy.create') }}",
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
            timeOut: 500,
            progressBar: true,
            closeButton: true
        });
    } else if (result.status === true) {
        toastr.success(result.msg, 'Success', {
            timeOut: 500,
            progressBar: true,
            closeButton: true,
            onHidden: function() {
                if ($('#cash').prop('checked')) {
                    window.location.href = "{{ route('order.cod') }}";
                } else if ($('#payu').prop('checked')) {
                    window.location.href = "{{ route('payment.pay') }}";
                }
            }
        });
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
      $('#user-address').on('change', function() {
              var  selectedAddress = $(this).find(':selected');
               if(selectedAddress.val() !== '') {
                  // Fill in the input fields with the address details and make them readonly
                  $('.name').val(selectedAddress.data('name')).prop('readonly', true);
                  $('.email').val(selectedAddress.data('email')).prop('readonly', true);
                  $('.contact').val(selectedAddress.data('contact')).prop('readonly', true);
                  $('.address').val(selectedAddress.data('address')).prop('readonly', true);
                  $('.landmark').val(selectedAddress.data('landmark')).prop('readonly', true);
                  $('.state').val(selectedAddress.data('state')).prop('readonly', true);
                  $('.city').val(selectedAddress.data('city')).prop('readonly', true);
                  $('.pin').val(selectedAddress.data('pin')).prop('readonly', true);
              } else {
                  // Clear the input fields and make them editable
                  $('.name').val('').prop('readonly', false);
                  $('.email').val('').prop('readonly', false);
                  $('.contact').val('').prop('readonly', false);
                  $('.address').val('').prop('readonly', false);
                  $('.landmark').val('').prop('readonly', false);
                  $('.state').val('').prop('readonly', false);
                  $('.city').val('').prop('readonly', false);
                  $('.pin').val('').prop('readonly', false);
              }
          });
      $('#user-address').on('change', function() {
      var selected = $(this).val();
      var fullAddress = '';
      @foreach($user as $users)
        if ('{{$users->id}}' === selected) {
          fullAddress += '{{$users->name}} ';
          fullAddress += '{{$users->email}} ';
          fullAddress += '{{$users->contact}} ';
          fullAddress += '{{$users->address}} ';
          fullAddress += '{{$users->landmark}} ';
          fullAddress += '{{$users->state}} ';
          fullAddress += '{{$users->city}} ';
          fullAddress += '{{$users->pin_code}} ';
        }
      @endforeach
      $('#fullAddress').val(fullAddress);
      $('#fullAddress').prop('disabled', false);
    });
   $('#applyCoupon').on('submit', function(e) {
             e.preventDefault(); // prevent default form submission
             let fd = new FormData(this);
             fd.append('_token', "{{ csrf_token() }}");
      
             $.ajax({
                 url: "{{ route('web.apply.coupon.buy') }}",
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
                if(result.discount) {
        $('#cartDiscount').text(result.discount);
        $('#discount').show();
    }
    if(result.newCartTotal) {
        $('#cartTotal').text(result.newCartTotal);
        $('#total').show();
    } 
   
    if(result.newCartTotal > 2000) {
        $('#cartTotal').text(result.newCartTotal);
        $('#shipping').show();
    } 
   
    if(result.newCartTotal > 2000) {
        $('#cartTotal').text(result.newCartTotal);
        $('#charge').show();
    } 
         // table with new cart total
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
   
   var cartTotal = parseInt("{{$cartTotal}}");
   
   if (cartTotal < 2000) {
    $('#shipping').show();
   } else {
   $('#charge').show();
   }
   if (cartTotal > 2000) {
    $('#shippingFree').show();
   }
   
   
   
   })
</script>
@stop