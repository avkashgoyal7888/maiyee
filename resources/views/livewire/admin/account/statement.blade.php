<div>
   <div class="card-body">
      <div class="mt-3">
         <form>
            <div class="row">
               <div class="form-group col-md-3 col-lg-3 col-sm-12 col-12 mb-3">
                  <label for="start_date">Start Date</label>
                  <input type="date" wire:model="startDate" class="form-control" id="start_date">
               </div>
               <div class="form-group col-md-3 col-lg-3 col-sm-12 col-12 mb-3">
                  <label for="end_date">End Date</label>
                  <input type="date" wire:model="endDate" class="form-control" id="end_date">
               </div>
               <div class="form-group col-md-3 col-lg-3 col-sm-12 col-12 mb-3">
               </div>
               <div class="form-group col-md-3 col-lg-3 col-sm-12 col-12 mb-3">
                  <label for="search">Search</label>
                  <input type="text" wire:model="search" class="form-control" id="search">
               </div>
            </div>
         </form>
      </div>
      <div class="table-responsive" style="margin-top: 20px;">
         <button type="button" class="btn btn-sm btn-success mb-3" wire:click="exportExcel">
            <h4 class="text-white m-0"><i class="fas fa-file-excel"></i></h4>
         </button>
         <table class="table table-sm table-bordered border-dark mb-0 text-center">
            <thead>
               <tr>
                  <th>S. No.</th>
                  <th>Nickname</th>
                  <th>Order Id</th>
                  <th>Transection Date</th>
                  <th>Perticular</th>
                  <th>Debit</th>
                  <th>Credit</th>
                  <th>Effective Balance</th>
               </tr>
            </thead>
            <tbody>
               @forelse($data as $key => $accounts)
               <tr>
                  <td> {{ $key +1 }} </td>
                  <td>{{ ucwords($accounts->account_name)}}</td>
                  <td>{{$accounts->order_id}}</td>
                  <td>{{ date('d-M-y', strtotime($accounts->transaction_date)) }}</td>
                  <td>
                     @if($accounts->transaction_type == 0)
                     <p class="text-success">{{ ucwords($accounts->perticuler) }}</p>
                     @elseif($accounts->transaction_type == 1)
                     <p class="text-danger">{{ ucwords($accounts->perticuler) }}</p>
                     @endif
                  </td>
                  <td>
                     @if($accounts->transaction_type == 1)
                     <p class="text-danger">{{$accounts->amount}}</p>
                     @else
                     <p><b>-</b></p>
                     @endif
                  </td>
                  <td>
                     @if($accounts->transaction_type == 0)
                     <p class="text-success">{{$accounts->amount}}</p>
                     @else
                     <p><b>-</b></p>
                     @endif
                  </td>
                  <td>{{$accounts->effective_balance}}</td>
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