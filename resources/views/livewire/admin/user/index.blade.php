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
      <div class="mt-3">
         <div class="form-group col-md-3 col-lg-3 col-sm-12 col-12 mb-3">
            <label for="search">Search</label>
            <input type="text" wire:model="search" class="form-control" id="search">
         </div>
      </div>
      <div class="table-responsive" style="margin-top: 20px;">
         <table class="table table-sm table-bordered border-dark mb-0 text-center">
            <thead>
               <tr>
                  <th>S. No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contact</th>
                  <th>Purchase</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @forelse($data as $key => $user)
               <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ ucwords($user->name) }}</td>
                  <td>{{ ucwords($user->email) }}</td>
                  <td>{{ ucwords($user->number) }}</td>
                  <td> {{ $orderTotal }} </td>
                  <td><button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#view" wire:click="viewDetailProduct({{$user->id}})"><i class="fas fa-eye"></i></button></td>
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