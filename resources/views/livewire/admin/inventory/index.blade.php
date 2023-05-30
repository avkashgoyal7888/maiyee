<div>
    <div class="card-body">
      <!-- Tab panes -->
      <div class="tab-content p-3 text-muted">
         <div class="tab-pane active" id="navpills2-pending" role="tabpanel">
            <div class="form-group col-md-3 col-lg-3 col-sm-12 col-12 mb-3">
               <label for="search">Search</label>
               <input type="text" wire:model="search" class="form-control" id="search">
            </div>
            <div class="table-responsive" style="margin-top: 20px;">
               <table class="table table-sm table-bordered border-dark mb-0 text-center">
                  <thead>
                     <tr>
                        <th>S. No.</th>
                        <th>Product</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Remarks</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($data as $key => $pros)
                     <tr>
                        <td> {{ $key +1 }} </td>
                        <td>{{ ucwords($pros->product->style_code) }}</td>
                        <td><button class="btn btn-lg" style="background-color: {{ $pros->color->code }};"></button></td>
                        <td>{{ strtoupper($pros->size->size) }}</td>
                        <td>@if($pros->status == 0)
                     <p class="text-danger">{{ ucwords($pros->quantity) }}</p>
                     @elseif($pros->status == 1)
                     <p class="text-success">{{ ucwords($pros->quantity) }}</p>
                     @endif</td>
                     <td>{{ ucwords($pros->remarks) }}</td>
                     </tr>
                     @empty
                     <td colspan="5">No Record Found</td>
                     @endforelse
                  </tbody>
               </table>
               <div style="margin-top: 10px">{{$data->links()}}</div>
            </div>
         </div>
         <!-- end tab pane -->
      </div>
      <!-- end tab pane -->
   </div>
</div>
