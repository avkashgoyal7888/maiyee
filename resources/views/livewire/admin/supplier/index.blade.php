<div>
   <div class="card-body">
      <div wire:loading wire:target="store">
         <x-loader/>
      </div>
      <div wire:loading wire:target="update">
         <x-loader/>
      </div>
      @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible" role="alert">{{session('success')}}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <div class="p-2 w-100">
         <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add" style="float:right;">Add Supplier</button>
      </div>
      <br>
      <div class="form-group col-md-3 col-lg-3 col-sm-12 col-12 mb-3">
         <label for="search">Search</label>
         <input type="text" wire:model="search" class="form-control" id="search">
      </div>
      <div class="table-responsive" style="margin-top: 20px;">
         <table class="table table-sm table-bordered border-dark mb-0 text-center">
            <thead>
               <tr>
                  <th>S. No.</th>
                  <th>Supplier ID</th>
                  <th>Supplier Name</th>
                  <th>Created By</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Account</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @forelse ($data as $key => $supplier )
               <tr>
                  <td> {{ $key +1 }} </td>
                  <td>{{$supplier->supplier_id}}</td>
                  <td>{{$supplier->sname}}</td>
                  <td>{{Auth::guard('admin')->user()->name}}</td>
                  <td>{{$supplier->created_at}}</td>
                  <td>{{$supplier->updated_at}}</td>
                  <td><a class="btn btn-success btn-sm" href="{{ route('admin.supplier.account',$supplier->id) }}">View</a></td>
                  <td style="font-size: 20px">
                     <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#view" wire:click="viewsupplier({{$supplier->id}})"><i class="fas fa-eye"></i></button>
                     <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit" wire:click="editsupplier({{$supplier->id}})"><i class="fas fa-pen"></i></button>
                     <button type="button" class="btn btn-sm btn-danger" wire:click="delete({{$supplier->id}})"><i class="fas fa-trash"></i></button>
                  </td>
               </tr>
               @empty
               <td colspan="7">No Record Found</td>
               @endforelse
            </tbody>
         </table>
         <div style="margin-top: 10px">{{$data->links()}}</div>
      </div>
   </div>
   <!--  Add Supplier Modal -->
   <div wire:ignore.self class="modal" id="add" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Add Supplier</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='store()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Supplier name</label>
                           <input type="text" class="form-control" placeholder="Enter Company Name" wire:model='sname'>
                           @error('sname')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Contact Person</label>
                           <input type="text" class="form-control" placeholder="Enter Contact Person Name" wire:model='name'>
                           @error('name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Contact Number</label>
                           <input type="text" class="form-control" placeholder="Enter Contact Number" wire:model='number'>
                           @error('number')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Email</label>
                           <input type="text" class="form-control" placeholder="Enter Email" wire:model='email'>
                           @error('email')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">State</label>
                           <select class="form-control" wire:model='state_id' wire:change="updateCities()">
                              <option>Select State</option>
                              @foreach($state as $states)
                              <option value="{{$states->id}}">{{$states->state_name}}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Cities</label>
                           <select class="form-control" wire:model="city_id">
                              <option>Select City</option>
                              @foreach($city as $cities)
                              <option value="{{ $cities->id }}">{{ $cities->city_name }}</option>
                              @endforeach
                           </select>
                           @error('city_id')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="address" class="form-label">Address</label>
                           <textarea class="form-control" placeholder="Address" wire:model='address'></textarea>
                           @error('address')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">GST Number</label>
                           <input type="text" class="form-control" placeholder="Enter GST Number" wire:model='gst'>
                           @error('gst')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Account Number</label>
                           <input type="text" class="form-control" placeholder="Enter Account Number" wire:model='account'>
                           @error('account')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Bank Name</label>
                           <input type="text" class="form-control" placeholder="Enter Bank Name" wire:model='bank'>
                           @error('bank')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">IFSC Code</label>
                           <input type="text" class="form-control" placeholder="Enter IFSC Code" wire:model='ifsc'>
                           @error('ifsc')<span class="text-danger">{{$message}}</span>@enderror
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
   <!--  View Supplier Modal -->
   <div wire:ignore.self class="modal" id="view" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">View Supplier</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closemodal"></button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                     <label for="nameExLarge" class="form-label">Supplier name</label>
                     <input type="text" class="form-control" wire:model='sname' disabled>
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                     <label for="nameExLarge" class="form-label">Contact Person</label>
                     <input type="text" class="form-control" wire:model='name' disabled>
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                     <label for="nameExLarge" class="form-label">Contact Number</label>
                     <input type="text" class="form-control" wire:model='number' disabled>
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                     <label for="nameExLarge" class="form-label">Email</label>
                     <input type="text" class="form-control" wire:model='email' disabled>
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                     <label for="nameExLarge" class="form-label">State</label>
                     <input type="text" class="form-control" wire:model='state_id' disabled>
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                     <label for="nameExLarge" class="form-label">City</label>
                     <input type="text" class="form-control" wire:model='city_id' disabled>
                  </div>
                  <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                     <label for="address" class="form-label">Address</label>
                     <textarea class="form-control" wire:model='address' disabled></textarea>
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                     <label for="nameExLarge" class="form-label">GST Number</label>
                     <input type="text" class="form-control" wire:model='gst' disabled>
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                     <label for="nameExLarge" class="form-label">Account Number</label>
                     <input type="text" class="form-control" wire:model='account' disabled>
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                     <label for="nameExLarge" class="form-label">Bank Name</label>
                     <input type="text" class="form-control" wire:model='bank' disabled>
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                     <label for="nameExLarge" class="form-label">IFSC Code</label>
                     <input type="text" class="form-control" wire:model='ifsc' disabled>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-bs-dismiss="modal" wire:click="closemodal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <!--  Edit Supplier Modal -->
   <div wire:ignore.self class="modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Supplier</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closemodal"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='update()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Supplier name</label>
                           <input type="text" class="form-control" placeholder="Enter Company Name" wire:model='sname'>
                           @error('sname')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Contact Person</label>
                           <input type="text" class="form-control" placeholder="Enter Contact Person Name" wire:model='name'>
                           @error('name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Contact Number</label>
                           <input type="text" class="form-control" placeholder="Enter Contact Number" wire:model='number'>
                           @error('number')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Email</label>
                           <input type="text" class="form-control" placeholder="Enter Email" wire:model='email'>
                           @error('email')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">State</label>
                           <select class="form-control" wire:model='state_id' wire:change="viewCities()">
                              @foreach($state as $states)
                              <option value="{{$states->id}}">{{$states->state_name}}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">City</label>
                           <select class="form-control" wire:model="city_id">
                              @foreach($city as $cities)
                              <option value="{{ $cities->id }}">{{ $cities->city_name }}</option>
                              @endforeach
                           </select>
                           @error('city_id')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="address" class="form-label">Address</label>
                           <textarea class="form-control" placeholder="Address" wire:model='address'></textarea>
                           @error('address')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">GST Number</label>
                           <input type="text" class="form-control" placeholder="Enter GST Number" wire:model='gst'>
                           @error('gst')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Account Number</label>
                           <input type="text" class="form-control" placeholder="Enter Account Number" wire:model='account'>
                           @error('account')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Bank Name</label>
                           <input type="text" class="form-control" placeholder="Enter Bank Name" wire:model='bank'>
                           @error('bank')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">IFSC Code</label>
                           <input type="text" class="form-control" placeholder="Enter IFSC Code" wire:model='ifsc'>
                           @error('ifsc')<span class="text-danger">{{$message}}</span>@enderror
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
</div>