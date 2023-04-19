<div>
   <div class="card-body">
      <div wire:loading wire:target="store">
         <x-loader/>
      </div>
      <div wire:loading wire:target="delete">
         <x-loader/>
      </div>
      <div wire:loading wire:target="updateProduct">
         <x-loader/>
      </div>
      @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible" role="alert">{{session('success')}}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <div class="p-2 w-100">
         <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add" style="float:right;">Add Product</button>
      </div>
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
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($data as $key => $pros)
                     <tr>
                        <td> {{ $key +1 }} </td>
                        <td>{{ ucwords($pros->name) }}</td>
                        <td>{{ ucwords($pros->category->cat_name) }}</td>
                        <td> {{ ucwords($pros->subcategory->sub_name) }} </td>
                        <td>
                           <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit" wire:click="editProduct({{$pros->id}})"><i class="fas fa-pen"></i></button>&nbsp;&nbsp;
                           <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete" wire:click="deleteProduct({{$pros->id}})"><i class="fas fa-trash"></i></button>
                        </td>
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
   <!-- end tab pane -->
   <!-- Add Modal -->
   <div wire:ignore.self class="modal" id="add" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Add Product</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='store()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Categories</label>
                           <select class="form-control" wire:model='category_id' wire:change="updateSubcategories()">
                              <option>Select Category</option>
                              @foreach($category as $categ)
                              <option value="{{$categ->id}}">{{$categ->cat_name}}</option>
                              @endforeach
                           </select>
                           @error('category_id')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Sub Categories</label>
                           <select class="form-control" wire:model="subcategory_id">
                              <option>Select A Sub-Category</option>
                              @foreach($subcategories as $subcategory)
                              <option value="{{ $subcategory->id }}">{{ $subcategory->sub_name }}</option>
                              @endforeach
                           </select>
                           @error('subcategory_id')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Product Name</label>
                           <input type="text" class="form-control" placeholder="Enter Product Name" wire:model='name'>
                           @error('name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">HSN Code</label>
                           <input type="text" class="form-control" placeholder="Enter HSN Code" wire:model='hsn_code'>
                           @error('hsn_code')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">GST Rate</label>
                           <input type="text" class="form-control" placeholder="0.00" wire:model='gst_rate'>
                           @error('gst_rate')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">MRP</label>
                           <input type="text" class="form-control" placeholder="0.00" wire:model='mrp'>
                           @error('mrp')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Discount</label>
                           <input type="text" class="form-control" placeholder="Enter discount" wire:model='discount'>
                           @error('discount')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="address" class="form-label">Product Description</label>
                           <textarea class="form-control" placeholder="Product Description" wire:model='description'></textarea>
                           @error('description')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="address" class="form-label">Product Detail</label>
                           <textarea class="form-control" placeholder="Product Detail" wire:model='details'></textarea>
                           @error('details')<span class="text-danger">{{$message}}</span>@enderror
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
   <!-- Add Modal end-->
   <!--  Edit Supplier Modal -->
   <div wire:ignore.self class="modal" id="edit" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Supplier</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closemodal"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='updateProduct()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Categories</label>
                           <select class="form-control" wire:model='category_id' wire:change="viewSubcategories()">
                              @foreach($category as $categ)
                              <option value="{{$categ->id}}">{{$categ->cat_name}}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Sub Categories</label>
                           <select class="form-control" wire:model="subcategory_id">
                              @foreach($subcategories as $subcategory)
                              <option value="{{ $subcategory->id }}">{{ $subcategory->sub_name }}</option>
                              @endforeach
                           </select>
                           @error('subcategory_id')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Product Name</label>
                           <input type="text" class="form-control" wire:model='name'>
                           @error('name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">HSN Code</label>
                           <input type="text" class="form-control" wire:model='hsn_code'>
                           @error('hsn_code')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">MRP</label>
                           <input type="text" class="form-control" wire:model='mrp'>
                           @error('mrp')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">GST Rate</label>
                           <input type="text" class="form-control" wire:model='gst_rate'>
                           @error('gst_rate')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Discount</label>
                           <input type="text" class="form-control" wire:model='discount'>
                           @error('discount')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="address" class="form-label">Product Description</label>
                           <textarea class="form-control" wire:model='description'></textarea>
                           @error('description')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="address" class="form-label">Product Detail</label>
                           <textarea class="form-control" wire:model='details'></textarea>
                           @error('details')<span class="text-danger">{{$message}}</span>@enderror
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
   <!-- Delete modal -->
   <div wire:ignore.self class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myLargeModalLabel">Delete Product</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form wire:submit.prevent='delete()'>
               <input type="hidden" wire:model='pro_id'>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-outline-dark">Delete</button>
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- end tab pane -->