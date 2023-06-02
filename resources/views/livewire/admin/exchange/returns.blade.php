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
                  <th>Order ID</th>
                  <th>Order Date</th>
                  <th>Name</th>
                  <th>Product</th>
                  <th>Color</th>
                  <th>Size</th>
                  <th>Order Value</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @forelse($data as $key => $return)
               <tr>
                  <td>{{ $key + 1 }}</td>
                  <td> {{$return->order_id}} </td>
                  <td>{{$order->order_date}}</td>
                  <td>{{ ucwords($return->user->name) }}</td>
                  <td>{{ ucwords($return->product->name) }}</td>
                  <td><button class="btn btn-lg" style="background-color: {{ $return->color->code }};"></button></td>
                  <td> {{ $return->size->size }} </td>
                  <td> {{ $return->total }} </td>
                  <td>@if($return->status == '0')
                        <b>Requested</b>
                      @elseif($return->status == '1')
                        <b class="text-success">Accepted</b>
                      @elseif($return->status == '2')
                        <b>Pickup</b>
                        @elseif($return->status == '3')
                        <b>Dispatch</b>
                        @elseif($return->status == '4')
                        <b class="text-danger">Rejected</b>
                      @endif</td>
                  <td style="font-size: 20px">
                     <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit" wire:click="editState({{$return->id}})"><i class="fas fa-pen"></i></button>&nbsp;&nbsp;<button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#view" wire:click="viewDetailProduct({{$return->id}})"><i class="fas fa-eye"></i></button>
                  </td>
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
   <!--  View Exchange Modal -->
   <div wire:ignore.self class="modal" id="view" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">View Product Detail</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closemodal"></button>
            </div>
            <div class="modal-body">
               <form>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Order Id</label>
                           <input type="text" class="form-control" wire:model='order_id' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Total</label>
                           <input type="text" class="form-control" wire:model='total' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Order Date</label>
                           <input type="text" class="form-control" wire:model='order_date' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Exchange Date</label>
                           <input type="text" class="form-control" wire:model='created_at' readonly>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Address</label>
                           <textarea class="form-control" placeholder="Product Description" wire:model='address'></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- End Here -->
   <!--  Edit State Modal -->
   <div wire:ignore.self class="modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
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
                           <select class="form-control" wire:model='status'>
                              <option value="1">Accept</option>
                              <option value="2">PickUp</option>
                              <option value="3">Dispatch</option>
                              <option value="4">Reject</option>
                           </select>
                           <input type="hidden" wire:model='ex_id'>
                           @error('status')<span class="text-danger">{{$message}}</span>@enderror
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