<div>
   <div class="card-body">
    <div class="form-group col-md-3 col-lg-3 col-sm-12 col-12 mb-3">
         <label for="search">Search</label>
         <input type="text" wire:model="search" class="form-control" id="search">
      </div>
      <div class="table-responsive" style="margin-top: 20px;">
         <table class="table table-sm table-bordered border-dark mb-0 text-center">
            <button type="button" class="btn btn-sm btn-success" wire:click="exportExcel"><i class='bx bxs-file-export'></i>Excel</button>&nbsp;&nbsp;
            <button type="button" class="btn btn-sm btn-success" wire:click="exportPDF"><i class='bx bxs-file-export'></i>PDF</button>
            <tbody>
               <tr>
                  <td colspan="3">Name</td>
                  <td colspan="3">{{$user->name}}</td>
               </tr>
               <tr>
                  <td colspan="3">Number</td>
                  <td colspan="3">{{$user->number}}</td>
               </tr>
               <tr>
                  <td colspan="3">Address</td>
                  <td colspan="3">{{$user->address}}</td>
               </tr>
               <tr>
                  <td colspan="3">Size</td>
                  <td colspan="3">{{$user->size}}</td>
               </tr>
               <tr>
                  <td colspan="3">Slot</td>
                  <td colspan="3">Date : {{$user->delivery_date}} Time: {{$user->start_time}}-{{$user->end_time}}</td>
               </tr>
               <tr>
                  <td colspan="6"></td>
               </tr>
            </tbody>
         </tbody>
               <tr>
                  <td>S. No.</td>
                  <td>Category</td>
                  <td>Product Name</td>
                  <td>Style Code</td>
                  <td>MRP</td>
                  <td>Selling Price</td>
               </tr>
            </tbody>
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