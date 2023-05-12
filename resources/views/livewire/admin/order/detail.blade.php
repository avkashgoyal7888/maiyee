<div>
   <div class="card-body">
      <div class="table-responsive" style="margin-top: 20px;">
         <table class="table table-sm table-bordered border-dark mb-0 text-center">
            <thead>
               <tr>
                  <th>S. No.</th>
                  <th>Name</th>
                  <th>Product</th>
                  <th>Color</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
               </tr>
            </thead>
            <tbody>
               @forelse($data as $key => $order)
               <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ ucwords($order->user->name) }}</td>
                  <td>{{ ucwords($order->product->name) }}</td>
                  <td>{{ ucwords($order->color->code) }}</td>
                  <td>{{ ucwords($order->size->size) }}</td>
                  <td>{{ ucwords($order->price) }}</td>
                  <td>{{ ucwords($order->quantity) }}</td>
                  <td>{{ ucwords($order->total) }}</td>
               </tr>
               @empty
               <tr>
                  <td colspan="3">No Record Found</td>
               </tr>
               @endforelse
            </tbody>
         </table>
         <div style="margin-top: 10px">{{$data->links()}}</div>
      </div>
   </div>
</div>