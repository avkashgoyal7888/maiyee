@extends('layouts.link.app')

@section('content')
<div class="pb-section">
    @if(isset($linkProducts) && count($linkProducts) > 0)
    <ul>
        @foreach($linkProducts as $product)
            <li>Product ID: {{ $product->id }}</li>
            <li>Product Name: {{ $product->product_name }}</li>
            <li>Product Style Code: {{ $product->style_code }}</li>
            <li>Product MRP: {{ $product->mrp }}</li>
            <li>Product Selling Price: {{ $product->selling_price }}</li>
            <li>Product Image: <img src="{{$product->image}}"> </li>
            <!-- Add any other product details you want to display -->
        @endforeach
    </ul>
    @else
    <p>No data found.</p>
    @endif
</div>
@endsection
