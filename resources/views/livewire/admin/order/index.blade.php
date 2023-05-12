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
                  <th>Order ID</th>
                  <th>Total</th>
                  <th>Order Detail</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @forelse($data as $key => $order)
               <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ ucwords($order->user->name) }}</td>
                  <td>{{ ucwords($order->order_id) }}</td>
                  <td>{{ ucwords($order->payable) }}</td>
                  <td><a class="btn btn-success btn-sm" href="{{ route('admin.order.detail',$order->order_id) }}">View</a></td>
                  <td><button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#view" wire:click="viewDetailProduct({{$order->id}})"><i class="fas fa-eye"></i></button></td>
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
   <!--  Edit Supplier Modal -->
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
                           <label for="nameExLarge" class="form-label">Name</label>
                           <input type="text" class="form-control" wire:model='user_id' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Billing Name</label>
                           <input type="text" class="form-control" wire:model='name' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Contact</label>
                           <input type="text" class="form-control" wire:model='contact' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Email</label>
                           <input type="text" class="form-control" wire:model='email' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Order Date</label>
                           <input type="text" class="form-control" wire:model='order_date' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Address</label>
                           <input type="text" class="form-control" wire:model='address' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Landmark</label>
                           <input type="text" class="form-control" wire:model='landmark' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">State</label>
                           <input type="text" class="form-control" wire:model='state' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">City</label>
                           <input type="text" class="form-control" wire:model='city' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Order Notes</label>
                           <input type="text" class="form-control" wire:model='order_notes' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Taxable</label>
                           <input type="text" class="form-control" wire:model='taxable' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Cgst</label>
                           <input type="text" class="form-control" wire:model='cgst' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Sgst</label>
                           <input type="text" class="form-control" wire:model='sgst' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Igst</label>
                           <input type="text" class="form-control" wire:model='igst' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Total</label>
                           <input type="text" class="form-control" wire:model='total' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Discount</label>
                           <input type="text" class="form-control" wire:model='discount' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Coupon Code</label>
                           <input type="text" class="form-control" wire:model='coupon_code' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Shipping Charges</label>
                           <input type="text" class="form-control" wire:model='shipping_charges' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Payable</label>
                           <input type="text" class="form-control" wire:model='payable' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Payment Method</label>
                           <input type="text" class="form-control" wire:model='payment_method' readonly>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Order Status</label>
                           <input type="text" class="form-control" wire:model='order_status' readonly>
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
</div>