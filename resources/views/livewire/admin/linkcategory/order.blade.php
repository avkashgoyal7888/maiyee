<div>
   <div class="card-body">
    <div class="form-group col-md-3 col-lg-3 col-sm-12 col-12 mb-3">
         <label for="search">Search</label>
         <input type="text" wire:model="search" class="form-control" id="search">
      </div>
      <div class="table-responsive" style="margin-top: 20px;">
         <table class="table table-sm table-bordered border-dark mb-0 text-center">
            <button type="button" class="btn btn-sm btn-success" wire:click="exportExcel"><i class='bx bxs-file-export'></i>Excel</button>
            <thead>
               <tr>
                  <th>Name</th>
                  <th>{{ ucwords($order->user->name) }}</th>
                  <th>Contact Number</th>
                  <th>{{ ucwords($order->user->number) }}</th>
                  <th>MRP</th>
                  <th>Selling Price</th>
               </tr>
            </thead>
            <thead>
               <tr>
                  <th>S. No.</th>
                  <th>Category</th>
                  <th>Product Name</th>
                  <th>Style Code</th>
                  <th>MRP</th>
                  <th>Selling Price</th>
               </tr>
            </thead>
            <tbody>
               @forelse($data as $key => $order)
               <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ ucwords($order->product->cat->name) }}</td>
                  <td>{{ ucwords($order->product->product_name) }}</td>
                  <td>{{ ucwords($order->product->style_code) }}</td>
                  <td>{{ ucwords($order->product->mrp) }}</td>
                  <td>{{ ucwords($order->product->selling_price) }}</td>
               </tr>
               @empty
               <tr>
                  <td colspan="3">No Record Found</td>
               </tr>
               @endforelse
            </tbody>
         </table>
      </div>
   </div>
</div>