<div>
   <div class="card-body">
      <div class="table-responsive" style="margin-top: 20px;">
         <table class="table table-sm table-bordered border-dark mb-0 text-center">
            <thead>
               <tr>
                  <th>S. No.</th>
                  <th>Product</th>
                  <th>HSN Code</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Taxable</th>
                  <th>GST</th>
                  <th>CGST</th>
                  <th>SGST</th>
                  <th>IGST</th>
                  <th>Total</th>
               </tr>
            </thead>
            <tbody>
               @forelse($data as $key => $order)
               <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ ucwords($order->product->name) }}</td>
                  <td>{{ ucwords($order->product->hsn_code) }}</td>
                  <td>{{ ucwords($order->price) }}</td>
                  <td>{{ ucwords($order->quantity) }}</td>
                  <td>{{ ucwords($order->taxable) }}</td>
                  <td>{{ ucwords($order->gst) }}</td>
                  <td>{{ ucwords($order->cgst) }}</td>
                  <td>{{ ucwords($order->ssst) }}</td>
                  <td>{{ ucwords($order->igst) }}</td>
                  <td>{{ ucwords($order->total) }}</td>
               </tr>
               @empty
               <tr>
                  <td colspan="3">No Record Found</td>
               </tr>
               @endforelse
               <tr>
                  <th colspan="4">Total</th>
                  <td>{{$quantity}}</td>
                  <td>{{$taxable}}</td>
                  <td>{{$gst}}</td>
                  <td>{{$cgst}}</td>
                  <td>{{$sgst}}</td>
                  <td>{{$igst}}</td>
                  <td>{{$total}}</td>
               </tr>
               <tr>
                  <th colspan="10">Coupon Discount ( Coupon Code : {{$orders->coupon_code}})</th>
                  <td>{{$orders->discount}}</td>
               </tr>
               <tr>
                  <th colspan="10">Shipping Charges</th>
                  <td>{{$orders->shipping_charges}}</td>
               </tr>
               <tr>
                  <th colspan="10">Payable</th>
                  <td>{{$orders->payable}}</td>
               </tr>
            </tbody>
         </table>
         <div style="margin-top: 10px">{{$data->links()}}</div>
      </div>
   </div>
</div>