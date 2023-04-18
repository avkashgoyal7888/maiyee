@extends('layouts.front.app')
@section('css')
<title>Disclaimer</title>
<style>
   .block {
   pointer-events: none;
   opacity: 0.5;
   }
</style>
@stop
@section('content')
<!--Page Title-->
<div class="page section-header text-center">
   <div class="page-title">
      <div class="wrapper">
         <h1 class="page-width">Your cart</h1>
      </div>
   </div>
</div>
<!--End Page Title-->
<div class="container">
    <div id="loader" style="display:none;">
    @include('components.loader')
   </div>
   <div class="row">
      <div class="col-12 col-sm-12 col-md-8 col-lg-8 main-col">
         <div class="alert alert-success text-uppercase" role="alert">
            <i class="icon anm anm-truck-l icon-large"></i> &nbsp;<strong>Congratulations!</strong> You've got free shipping!
         </div>
         <div class=".table-responsive{-sm|-md|-lg|-xl}">
            <table id="cart-table">
               <thead class="cart__row cart__header">
                  <tr>
                     <th colspan="2" class="text-center">Product</th>
                     <th class="text-center">Price</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($cart as $carts)
                  <tr class="cart__row border-bottom line1 cart-flex border-top">
                     <td class="cart__image-wrapper cart-flex-item">
                        <a href="#"><img class="cart__image" src="{{asset('admin/color/'.$carts->color->image)}}" alt="Elastic Waist Dress - Navy / Small"></a>
                     </td>
                     <td class="cart__meta small--text-left cart-flex-item">
                        <div class="list-view-item__title">
                           <a href="#">{{$carts->product->name}} </a>
                        </div>
                        <div class="cart__meta-text">
                           Color: Navy<br>Size: {{$carts->size->size}}<br>
                        </div>
                     </td>
                     <td class="cart__price-wrapper">
                        <span class="money">${{$carts->price}}</span>
                        <div class="cart style2">
                           <div class="qtyField">
                              <a class="qtyBtn minus" href="javascript:void(0);" id="minusBtn" data-id="{{ $carts->id }}"><i class="icon icon-minus"></i></a>
                              <input type="hidden" name="id" class="cartupdateId" value="{{ $carts->id }}">
                              <input class="cart__qty-input qty" type="text" name="quantity" id="qty_{{ $carts->id }}" value="{{ $carts->quantity }}" pattern="[0-9]*">
                              <a class="qtyBtn plus" href="javascript:void(0);" id="plusBtn" data-id="{{ $carts->id }}"><i class="icon icon-plus"></i></a>
                           </div>
                        </div>
                        <button data-id="{{$carts->id}}" class="btn btn--secondary cart__remove deleteCart" title="Remove tem"><i class="icon icon anm anm-times-l"></i></button>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
      <div class="col-12 col-sm-12 col-md-4 col-lg-4 cart__footer">
         <div class="cart-note">
         </div>
         <div class="solid-border">
            <div class="row">
               <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Subtotal</strong></span>
               <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money">${{$cartTotal}}</span></span>
            </div>
            <div class="cart__shipping">Shipping &amp; taxes calculated at checkout</div>
            <p class="cart_tearm">
               <label>
               <input type="checkbox" name="tearm" id="cartTearm" class="checkbox" value="tearm" required="">
               I agree with the terms and conditions</label>
            </p>
            <a href="{{route('web.checkout')}}" name="checkout" id="cartCheckout" class="btn btn--small-wide block" value="Checkout">CheckOut</a>
            <div class="paymnet-img"><img src="{{asset('front/assets/images/payment-img.jpg')}}" alt="Payment"></div>
         </div>
      </div>
   </div>
</div>
<!-- Delete modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
   aria-hidden="true" id="deleteClient" >
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="myLargeModalLabel">Delete Client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="deleteAttorneySubmit">
               <div class="modal-body">
                  <p>Are you sure you want to delete this.....</p>
                  <input type="hidden" name="id" id="clientDeleteId">
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Delete</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@stop
@section('js')
<script>
   $(document).ready(function(){
    const $checkbox = $('#cartTearm');
   const $checkoutBtn = $('#cartCheckout');
   
   $checkbox.change(function() {
    if (this.checked) {
      $checkoutBtn.removeClass('block');
    } else {
      $checkoutBtn.addClass('block');
    }
   });
     // Get the initial quantity value
       $('.qtyBtn').click(function() {
       var action = $(this).attr('id').indexOf('plus') !== -1 ? 'plus' : 'minus';
       var cartId = $(this).data('id');
   
       updateQuantity(action, cartId);
   });
   
   function updateQuantity(action, cartId) {
       var currentQuantity = parseInt($('#qty_' + cartId).val());
       var newQuantity = 1; // set default value to 1
   
       if (action == 'plus') {
           newQuantity = currentQuantity + 1;
       } else if (action == 'minus' && currentQuantity > 1) {
           newQuantity = currentQuantity - 1;
       } else {
           return;
       }
   
       $('.cartupdateId[value="' + cartId + '"]').val(cartId); // Update the cart ID input field
   
       $('#qty_' + cartId).val(newQuantity);
   
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
   
       // Disable the button
       $(this).prop('disabled', true);
       $('#loader').show(); // show the loader
   
       $.ajax({
           type: 'POST',
           url: "{{ route('edit.cart') }}",
           data: {
               _token: '{{ csrf_token() }}',
               id: cartId, // Include the cart id in the request
               quantity: newQuantity
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
                   window.location.reload();
                   // $('#deleteClient').modal('toggle');
                   //  $('#client-table').DataTable().ajax.reload(null , false);
               }
           },
           error: function(jqXHR, exception) {
               console.log(jqXHR.responseJSON);
               toastr.error(jqXHR.responseJSON.msg, 'Error', {
                   timeOut: 3000,
                   progressBar: true,
                   closeButton: true
               });
           },
           complete: function() {
               // Re-enable the button
               $('.qtyBtn').prop('disabled', false);
               $('#loader').hide(); // show the loader
           }
       });
   }
       $('body').on('click','.deleteCart',function(){
               $('#deleteClient').modal('show')
               $('#clientDeleteId').val($(this).attr('data-id'))
      
               });
       $('#deleteAttorneySubmit').on('submit', function(e) {
           e.preventDefault(); // prevent default form submission
           let fd = new FormData(this);
           fd.append('_token', "{{ csrf_token() }}");
    
           $.ajax({
               url: "{{ route('web.delete.cart') }}",
               type: "POST",
               data: fd,
               dataType: 'json',
               processData: false,
               contentType: false,
               beforeSend: function() {
                   $('#addBtn').prop('disabled', true)
                   $('#loader').show(); // show the loader
                   $('#deleteClient').modal('toggle');
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
                       window.location.reload();
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
                   $('#loader').hide(); // hide the loader when done
               }
           });
       });
   });
</script>
@stop