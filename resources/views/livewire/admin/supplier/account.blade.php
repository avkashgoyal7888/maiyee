<div>
   <div class="card-body">
      <div class="form-group col-md-3 col-lg-3 col-sm-12 col-12 mb-3">
                  <label for="search">Search</label>
                  <input type="text" wire:model="search" class="form-control" id="search">
               </div>
      <div class="table-responsive" style="margin-top: 20px;">
         <button type="button" class="btn btn-sm btn-success mb-3" wire:click="exportExcel">
            <h4 class="text-white m-0"><i class="fas fa-file-excel"></i></h4>
         </button>
         <table class="table table-sm table-bordered border-dark mb-0 text-center">
            <thead>
               <tr>
                  <th>Supplier ID</th>
                  <th>Perticular</th>
                  <th>Order Id</th>
                  <th>Debit</th>
                  <th>Credit</th>
                  <th>Effective Balance</th>
               </tr>
            </thead>
            <tbody>
               @forelse ($data as $supplier )
               <tr>
                  <td>{{$supplier->supplier->supplier_id}}</td>
                  <td>{{$supplier->perticuler}}</td>
                  <td>{{$supplier->order_id}}</td>
                  <td>
                     @if($supplier->transaction_type == 1)
                     <p class="text-danger">{{$supplier->amount}}</p>
                     @else
                     <p><b>-</b></p>
                     @endif
                  </td>
                  <td>@if($supplier->transaction_type == 0)
                     <p class="text-success">{{$supplier->amount}}</p>
                     @else
                     <p><b>-</b></p>
                     @endif</td>
                  <td>{{$supplier->effective_balance}}</td>
               </tr>
               @empty
               <td colspan="7">No Record Found</td>
               @endforelse
            </tbody>
         </table>
         <div style="margin-top: 10px">{{$data->links()}}</div>
      </div>
   </div>
</div>