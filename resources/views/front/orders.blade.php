@extends('layouts.front.app')
@section('css')
<title>My Orders</title>
@stop
@section('content')
<div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper"><h1 class="page-width">Order History</h1></div>
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
                            <button type="button" class="btn-lg btn-success">
  <a href="https://shiprocket.co/tracking/{{$orders->order_id}}" class="text-white">Track Your Order</a>
</button>

                        </div>
                      </div>
                      @foreach($orderdetail as $od)
                    	@if($orders->order_id == $od->order_id)
                      <div class="row no-gutters mt-3">
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
                          <a href="" class="btn btn-danger w-100 mb-2">Return Item</a>
                          <a href="{{route('web.product.detail',$od->product_id)}}" class="btn btn--small-wide checkout" id="cartCheckout">Buy It Again</a>
                          <!-- <input type="submit" name="checkout" id="cartCheckout" class="" value=""> -->
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
@stop
@section('js')
@stop