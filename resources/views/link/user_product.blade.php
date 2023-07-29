@extends('layouts.link.app')

@section('content')
<div class="container">
<div class="pb-section">
    @if(isset($linkProducts) && count($linkProducts) > 0)
    <form>
        @csrf
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Style Code</th>
                    <th>Product MRP</th>
                    <th>Product Selling Price</th>
                    <th>Product Image</th>
                    <!-- Add any other product details you want to display in the table -->
                </tr>
            </thead>
            <tbody>
                @foreach($linkProducts as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->style_code }}</td>
                        <td>{{ $product->mrp }}</td>
                        <td>{{ $product->selling_price }}</td>
                        <td><img src="{{ $product->image }}" alt="Product Image" height="50" width="50"></td>
                        <!-- Add any other product details you want to display in the table -->
                        <input type="hidden" name="products[]" value="{{ $product->id }}">
                    </tr>
                @endforeach
            </tbody>
        </table>
        <label for="user_id">User ID:</label>
        <!-- Prefill the user_id input with the link_user_id from the session -->
        <input type="text" name="user_id" id="user_id" required value="{{ Session::get('link_user_id') }}">
        <button type="submit">Submit</button>
    </form>
    @else
    <p>No data found.</p>
    @endif
</div>
</div>
@endsection
