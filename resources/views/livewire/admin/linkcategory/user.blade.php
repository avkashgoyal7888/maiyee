<div>
   <div class="card-body">
    <div class="form-group col-md-3 col-lg-3 col-sm-12 col-12 mb-3">
         <label for="search">Search</label>
         <input type="text" wire:model="search" class="form-control" id="search">
      </div>
      <div class="table-responsive" style="margin-top: 20px;">
         <table class="table table-sm table-bordered border-dark mb-0 text-center">
            <thead>
               <tr>
                  <th>S. No.</th>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Size</th>
                  <th>Address</th>
                  <th>Total</th>
               </tr>
            </thead>
            <tbody>
               @forelse($data as $key => $user)
               <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ ucwords($user->name) }}</td>
                  <td>{{ ucwords($user->number) }}</td>
                  <td>{{ ucwords($user->size) }}</td>
                  <td>{{ ucwords($user->address) }}</td>
                  <td><td><a class="btn btn-success btn-sm" href="{{ route('admin.linkorder',$user->id) }}">View</a></td></td>
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