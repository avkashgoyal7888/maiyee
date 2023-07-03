@extends('layouts.front.app')
@section('css')
<title>My Orders</title>
@stop
@section('content')
<div class="page section-header text-center">
   <div class="page-title">
      <div class="wrapper">
         <h1 class="page-width">Order History</h1>
      </div>
   </div>
</div>
<div class="container mt-3 mt-md-5">
   <h5 class="text-charcoal hidden-md-up">Your Orders</h5>
   <div class="row">
      @foreach($order as $orders)
      <div class="col-12">
         <div class="list-group mb-5">
            <div class="list-group-item p-3 bg-snow" style="position: relative;">
               <div class="row w-100 no-gutters">
                  <div class="col-6 col-md">
                     <h6 class="text-charcoal mb-0 w-100">Order Number</h6>
                     <a href="" class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{$orders->order_id}}</a>
                  </div>
                  <div class="col-6 col-md">
                     <h6 class="text-charcoal mb-0 w-100">Date</h6>
                     <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{ date('d-M-y', strtotime($orders->order_date)) }}</p>
                  </div>
                  <div class="col-6 col-md">
                     <h6 class="text-charcoal mb-0 w-100">Total</h6>
                     <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">₹{{$orders->payable}}</p>
                  </div>
                  <div class="col-6 col-md">
                     <h6 class="text-charcoal mb-0 w-100">Payment Mode</h6>
                     <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{$orders->payment_method}}</p>
                  </div>
                  <div class="col-6 col-md">
                     <h6 class="text-charcoal mb-0 w-100">Shipped To</h6>
                     <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{$orders->address}} {{$orders->landmark}} {{$orders->state}} {{$orders->city}} {{$orders->pin_code}}</p>
                  </div>
               </div>
            </div>
            <div class="list-group-item p-3 bg-white">
               <div class="row no-gutters">
                  <div class="col-12 col-md-9 pr-0 pr-md-3">
                     <div class="alert p-2 alert-success w-100 mb-0">
                        <h6 class="text-green mb-0"><b>Shipped</b></h6>
                        <p class="text-green hidden-sm-down mb-0">
                           Est. delivery between 
                           {{ date('d-M', strtotime($orders->order_date)) }} 
                           – 
                           {{ date('d-M', strtotime($orders->order_date . ' +1 week')) }}
                        </p>
                     </div>
                  </div>
                  <div class="col-12 col-md-3">
                     <div class="shopify-payment-button" data-shopify="payment-button">
                        @if($orders->order_pickup =='1')
                        <button type="button" class="btn-lg btn-success">
                        <a href="https://shiprocket.co/tracking/{{$orders->order_id}}" class="text-white">Track Your Order</a>
                        </button>
                        @endif
                     </div>
                  </div>
                  @foreach($orderdetail as $od)
                  @if($orders->order_id == $od->order_id)
                  <div class="row no-gutters mt-3 col-12">
                     <div class="col-3 col-md-1">
                        <img class="img-fluid pr-3" src="{{asset('admin/product/'.$od->product->image)}}">
                     </div>
                     <div class="col-9 col-md-8 pr-0 pr-md-3">
                        <h6 class="text-charcoal mb-2 mb-md-1">
                           <a href="" class="text-charcoal">{{$od->quantity}} x {{$od->product->name}}</a>
                        </h6>
                        <ul class="list-unstyled text-pebble mb-2 small">
                           <li class="">
                              <b>Color:</b> {{$od->color->code}}
                           </li>
                           <li class="">
                              <b>Size:</b> {{$od->size->size}}
                           </li>
                        </ul>
                        <!-- <h6 class="text-charcoal text-left mb-0 mb-md-2"><b>$19.54</b></h6> -->
                     </div>
                     <div class="col-12 col-md-3 hidden-sm-down">
                        @php
    $hasExchange = $ex->contains('order_id', $od->order_id);
@endphp

@if ($hasExchange)
    @foreach ($ex as $exchange)
        @if ($exchange->order_id == $od->order_id)
            <b>@if($exchange->status == '0')
                        <b>Status: Requested</b>
                      @elseif($exchange->status == '1')
                        <b class="text-success">Status: Accepted</b>
                      @elseif($exchange->status == '2')
                        <b>Status: Pickup</b>
                        @elseif($exchange->status == '3')
                        <b>Status: Dispatch</b>
                        @elseif($exchange->status == '4')
                        <b class="text-danger">Status: Rejected</b>
                        @elseif($exchange->status == '5')
                        <b class="text-success">Status: Replace Received</b>
                      @endif
                   </b>
        @endif
    @endforeach
@else
    <button data-id="{{$od->id}}" data-order="{{$od->order_id}}" class="btn btn-danger w-100 mb-2 returnOrReplace" title="Remove item">Return Item</button>
@endif

                     </div>
                  </div>
                  @endif
                  @endforeach
               </div>
            </div>
         </div>
      </div>
      @endforeach
   </div>
</div>
<!-- Return modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
   aria-hidden="true" id="returnModal" >
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="myLargeModalLabel">Return Or Replace</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="returnOrReplaceSubmit">
               <div class="modal-body">
                  <div class="col-md-12 col-lg-12 col-xl-12 p-0">
                     <label for="nameExLarge" class="form-label">Return or Replace<span class="required-f">*</span></label>
                     <select name="option" id="option">
                        <option value=""> --- Choose Option --- </option>
                        <option value="return">Return</option>
                        <option value="replace">Replace</option>
                     </select>
                  </div>
                  <div class="col-md-12 col-lg-12 col-xl-12 p-0">
                     <label for="nameExLarge" class="form-label">Reason<span class="required-f">*</span></label>
                     <textarea name="reason" class="form-control resize-both input-field" rows="3"></textarea>
                  </div>
                  <div class="col-md-12 col-lg-12 col-xl-12 p-0" id="return_payment" style="display:none;">
                     <label for="nameExLarge" class="form-label">Return Payment Details<span class="required-f">*</span></label>
                     <textarea name="return_payment" class="form-control resize-both input-field" rows="2"></textarea>
                  </div>
                  <input type="hidden" name="returnid" id="returnOrReplaceId">
                  <input type="hidden" name="order_id" id="returnOrReplaceOrderId">
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
      $('#option').change(function(){
         if ($(this).val() === 'return') {
            $('#return_payment').show();
         } else {
            $('#return_payment').hide();
         }
      });
     $('body').on('click','.returnOrReplace',function(){
                $('#returnModal').modal('show');
                $('#returnOrReplaceId').val($(this).attr('data-id'));
                $('#returnOrReplaceOrderId').val($(this).attr('data-order'));
     });
   
     $('#returnOrReplaceSubmit').on('submit', function(e) {
            e.preventDefault(); // prevent default form submission
            let fd = new FormData(this);
            fd.append('_token', "{{ csrf_token() }}");
     
            $.ajax({
                url: "{{ route('web.order.submit') }}",
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