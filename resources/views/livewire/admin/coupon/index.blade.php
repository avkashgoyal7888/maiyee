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
         <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add" style="float: right;">Add Coupon</button>
      </div>
      <br>
      <div class="mt-3">
         <form>
            <div class="row">
               <div class="form-group col-md-3 col-lg-3 col-sm-12 col-12 mb-3">
                  <label for="search">Search</label>
                  <input type="text" wire:model="search" class="form-control" id="search">
               </div>
            </div>
         </form>
      </div>
      <div class="table-responsive" style="margin-top: 20px;">
         <table class="table table-sm table-bordered border-dark mb-0 text-center">
            <thead>
               <tr>
                  <th>Coupon Code</th>
                  <th>Value</th>
                  <th>Type</th>
                  <th>Order Value</th>
                  <th>Expiary Date</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @forelse($data as $coupon)
               <tr>
                  <td>{{$coupon->coupon_code}}</td>
                  <td>{{$coupon->coupon_price}}</td>
                  @if($coupon->coupon_type === 'amount')
                  <td> Amount</td>
                  @else
                  <td>{{$coupon->coupon_type}}</td>
                  @endif
                  <td>{{$coupon->order_value}}</td>
                  <td>{{$coupon->exp_date}}</td>
                  <td style="font-size: 20px">
                     <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit" wire:click="editStore({{$coupon->id}})"><i class="fas fa-pen"></i></button>&nbsp;&nbsp;
                     <button type="button" class="btn btn-sm btn-danger" wire:click="delete({{$coupon->id}})"><i class="fas fa-trash"></i></button>
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
   <!--  Add Coupon Modal -->
   <div wire:ignore.self class="modal" id="add" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Add Coupon</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='stores()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Coupon Value</label>
                           <input type="text" class="form-control" placeholder="00" wire:model='coupon_value'>
                           @error('coupon_value')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Coupon Type</label>
                           <select class="form-control" wire:model='coupon_type'>
                              <option>Select Type</option>
                              <option value="amount">Amount</option>
                              <option value="%">%</option>
                           </select>
                           @error('coupon_type')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Type</label>
                           <select class="form-control" wire:model='type'>
                              <option>Select Type</option>
                              <option value="user">User</option>
                              <option value="admin">Admin</option>
                           </select>
                           @error('coupon_type')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Order Value</label>
                           <input type="number" class="form-control" placeholder="00" wire:model='order_value'>
                           @error('order_value')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Expiery Date</label>
                           <input type="date" class="form-control"  wire:model='exp_date'>
                           @error('exp_date')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Quantity</label>
                           <input type="number" class="form-control" placeholder="00" wire:model='quantity'>
                           @error('quantity')<span class="text-danger">{{$message}}</span>@enderror
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
   <!--  Edit Account Modal -->
   <div wire:ignore.self class="modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Account</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closemodal"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='updateStore()'>
                  <input type="hidden" wire:model="ac_id">
                  <div class="modal-body">
                     <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                        <label for="nameExLarge" class="form-label">Coupon Code</label>
                        <input type="text" class="form-control" placeholder="00" wire:model='coupon_code'>
                        @error('coupon_codes')<span class="text-danger">{{$message}}</span>@enderror
                     </div>
                     <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                        <label for="nameExLarge" class="form-label">Coupon Value</label>
                        <input type="text" class="form-control" placeholder="00" wire:model='coupon_value'>
                        @error('coupon_value')<span class="text-danger">{{$message}}</span>@enderror
                     </div>
                     <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                        <label for="nameExLarge" class="form-label">Coupon Type</label>
                        <select class="form-control" wire:model='coupon_type'>
                           <option>Select Type</option>
                           <option value="amount">Amount</option>
                           <option value="%">%</option>
                        </select>
                        @error('coupon_type')<span class="text-danger">{{$message}}</span>@enderror
                     </div>
                     <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                        <label for="nameExLarge" class="form-label">Type</label>
                        <select class="form-control" wire:model='type'>
                           <option>Select Type</option>
                           <option value="user">User</option>
                           <option value="admin">Admin</option>
                        </select>
                        @error('type')<span class="text-danger">{{$message}}</span>@enderror
                     </div>
                     <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                        <label for="nameExLarge" class="form-label">Order Value</label>
                        <input type="text" class="form-control" placeholder="00" wire:model='order_value'>
                        @error('order_value')<span class="text-danger">{{$message}}</span>@enderror
                     </div>
                     <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                        <label for="nameExLarge" class="form-label">Expiary Date</label>
                        <input type="text" class="form-control"  wire:model='exp_date'>
                        @error('exp_date')<span class="text-danger">{{$message}}</span>@enderror
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
<!-- End Here -->
</div>