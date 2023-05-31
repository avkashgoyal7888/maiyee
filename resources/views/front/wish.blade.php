@extends('layouts.front.app')
@section('css')
<title>My-WishList</title>
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
         <h1 class="page-width">Your WishList</h1>
      </div>
   </div>
</div>
<!--End Page Title-->
<div class="container">
    <div id="loader" style="display:none;">
    @include('components.loader')
   </div>
   <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
         <div class=".table-responsive{-sm|-md|-lg|-xl}">
            <table id="cart-table">
               <thead class="cart__row cart__header">
                  <tr>
                     <th class="text-center">Product</th>
                     <th class="text-center">Price</th>
                     <th class="text-center">Remove</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($wish as $carts)
                  <tr class="cart__row border-bottom line1 cart-flex border-top">
                     <td class="cart__image-wrapper cart-flex-item">
                        <a href="{{route('web.product.detail',$carts->product->id)}}"><img class="cart__image" src="{{asset('admin/product/'.$carts->product->image)}}" alt="Elastic Waist Dress - Navy / Small"></a>
                     </td>
                     <td class="cart__meta small--text-center cart-flex-item">
                        <div class="list-view-item__title">
                           <a href="{{route('web.product.detail',$carts->product->id)}}">{{$carts->product->name}} </a>
                        </div>
                     </td>
                     <td class="cart__price-wrapper">
                        <span class="money">₹{{$carts->product->discount}}</span>
                     </td>
                     <td class="cart__price-wrapper">
                        <button data-id="{{$carts->id}}" class="cart__remove deleteWishList" title="Remove tem"><i class="icon icon anm anm-times-l"></i></button>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<!-- Delete modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
   aria-hidden="true" id="deleteWishList" >
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="myLargeModalLabel">Delete Client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="deleteWishListSubmit">
               <div class="modal-body">
                  <p>Are you sure you want to delete this.....</p>
                  <input type="hidden" name="id" id="wishListDeleteId">
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
      $('body').on('click','.deleteWishList',function(){
               $('#deleteWishList').modal('show')
               $('#wishListDeleteId').val($(this).attr('data-id'))
      
               });
      $('#deleteWishListSubmit').on('submit', function(e) {
           e.preventDefault(); // prevent default form submission
           let fd = new FormData(this);
           fd.append('_token', "{{ csrf_token() }}");
    
           $.ajax({
               url: "{{ route('web.delete.wish') }}",
               type: "POST",
               data: fd,
               dataType: 'json',
               processData: false,
               contentType: false,
               beforeSend: function() {
                   $('#addBtn').prop('disabled', true)
                   $('#loader').show(); // show the loader
                   $('#deleteWishList').modal('toggle');
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
   })
</script>
@stop