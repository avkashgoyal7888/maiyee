@extends('layouts.front.app')
@section('css')
<title>Pay-Now</title>
@stop
@section('content')
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
         <div class="your-order-payment">
            <div class="your-order">
               <h2 class="order-title mb-4">Your Order</h2>
               <div class="table-responsive-sm order-table">
                  <table class="bg-white table table-bordered table-hover text-center">
                     <thead>
                        <tr>
                           <th class="text-left">Name</th>
                           <th class="text-left">Discount</th>
                           <th class="text-left">Total</th>
                           <th class="text-left">Payable</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td class="text-left">{{$payment->name}}</td>
                           <td class="text-left">{{$payment->discount}}</td>
                           <td class="text-left">{{$payment->total}}</td>
                           <td class="text-left">{{$payment->payable}}</td>
                           
                        </tr>
                     </tbody>
                  </table>
               </div>
               <form method="post" action="{{ $payuEndpoint }}">
    @csrf
    @foreach ($params as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
    <button type="submit" class="btn mt-2">Pay Now</button>
</form>
            </div>
         </div>
      </div>

@stop
@section('js')
@stop