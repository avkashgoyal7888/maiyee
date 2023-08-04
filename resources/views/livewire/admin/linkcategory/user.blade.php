<div>
   <div class="card-body">
      <div wire:loading wire:target="update">
         <x-loader/>
      </div>
      @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible" role="alert">{{session('success')}}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
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
                  <th>Delivery Date</th>
                  <th>Time</th>
                  <th>Status</th>
                  <th>Action</th>
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
                  <td>{{ ucwords($user->delivery_date) }}</td>
                  <td>{{ $user->start_time .' - '. $user->end_time }}</td>
                  <td><a href="#" class="btn btn-sm {{ $user->status == '0' ? 'btn-warning' : ($user->status == '1' ? 'btn-success' : 'btn-danger') }}"  data-bs-toggle="modal" data-bs-target="#pickupStatus" wire:click="editStatus({{$user->id}})">{{ $user->status == '0' ? 'Pending' : ($user->status == '1' ? 'Deliver' : 'Rejected') }}</a></td>
                  <td><a class="btn btn-success btn-sm" href="{{ route('admin.linkorder',$user->id) }}">View</a></td>
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
   <!--  Pickup status Modal -->
   <div wire:ignore.self class="modal" id="pickupStatus" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Status</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closemodal"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='update()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Status</label>
                           <input type="hidden" wire:model="user_id">
                           <select class="form-control" wire:model="status">
                           <option value="0">Pending</option>
                           <option value="1">Deliver</option>
                           <option value="2">Cancel</option>
                        </select>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-success">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- End Here -->
</div>