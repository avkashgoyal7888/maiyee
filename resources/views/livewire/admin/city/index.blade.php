<div>
   <div class="card-body">
      <div wire:loading wire:target="store">
         <x-loader/>
      </div>
      <div wire:loading wire:target="update">
         <x-loader/>
      </div>
      <div wire:loading wire:target="delete">
         <x-loader/>
      </div>
      @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible" role="alert">{{session('success')}}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <div class="p-2 w-100">
         <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add">Add</button>
      </div>
      <div class="form-group col-md-3 col-lg-3 col-sm-12 col-12 mb-3">
         <label for="search">Search</label>
         <input type="text" wire:model="search" class="form-control" id="search">
      </div>
      <div class="table-responsive" style="margin-top: 20px;">
         <table class="table table-sm table-bordered border-dark mb-0 text-center">
            <thead>
               <tr>
                  <th>S. No.</th>
                  <th>State</th>
                  <th>City</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @forelse($data as $key => $cats)
               <tr>
                  <td> {{ $key + 1}} </td>
                  <td>{{ucwords($cats->state->state_name)}}</td>
                  <td>{{ ucwords($cats->city_name) }}</td>
                  <td style="font-size: 20px">
                     <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit" wire:click="editCity({{$cats->id}})"><i class="fas fa-pen"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;
                     <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete" wire:click="deleteCity({{$cats->id}})"><i class="fas fa-trash"></i></button>
                  </td>
               </tr>
               @empty
               <td colspan="3">No Record Found</td>
               @endforelse
            </tbody>
         </table>
         <div style="margin-top: 10px">{{$data->links()}}</div>
      </div>
   </div>
   <!--  Add City Modal -->
   <div wire:ignore.self class="modal" id="add" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Add City</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='store()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Categories</label>
                           <select class="form-control" wire:model='state_id'>
                              <option value="1">Select states</option>
                              @foreach($state as $states)
                              <option value="{{$states->id}}">{{$states->state_name}}</option>
                              @endforeach
                           </select>
                           @error('state_id')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">City name</label>
                           <input type="text" class="form-control" placeholder="Enter City Name" wire:model='city_name'>
                           @error('city_name')<span class="text-danger">{{$message}}</span>@enderror
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
   <!--  Edit City Modal -->
   <div wire:ignore.self class="modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Edit City</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closemodal"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='update()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">States</label>
                           <select class="form-control" wire:model='state_id'>
                              <option value="1">Select State</option>
                              @foreach($state as $states)
                              <option value="{{$states->id}}">{{$states->state_name}}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">City name</label>
                           <input type="text" class="form-control" wire:model='city_name'>
                           <input type="hidden" wire:model='city_id'>
                           @error('city_name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal" wire:click="closemodal">Close</button>
                     <button type="submit" class="btn btn-success">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- Delete modal -->
   <div wire:ignore.self class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myLargeModalLabel">Delete City</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form wire:submit.prevent='delete()'>
               <input type="hidden" wire:model='city_id'>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-outline-dark">Delete</button>
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>