<div>
   <div class="card-body">
      <div wire:loading wire:target="store">
         <x-loader/>
      </div>
      <div wire:loading wire:target="delete">
         <x-loader/>
      </div>
      <div wire:loading wire:target="updateSize">
         <x-loader/>
      </div>
      @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible" role="alert">{{session('success')}}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <div class="p-2 w-100">
         <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add" style="float:right;">Add Size</button>
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
                        <th>Category</th>
                        <th>Product</th>
                        <th>Style Code</th>
                        <th>MRP</th>
                        <th>Selling Price</th>
                        <th>Image</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($data as $key => $pros)
                     <tr>
                        <td> {{ $key +1 }} </td>
                        <td>{{ ucwords($pros->cat->name) }}</td>
                        <td>{{ ucwords($pros->product_name) }}</td>
                        <td>{{ strtoupper($pros->style_code) }}</td>
                        <td>{{ strtoupper($pros->mrp) }}</td>
                        <td>{{ strtoupper($pros->selling_price) }}</td>
                        <td><img src="{{ $pros->image }}" width="100" height="100" /></td>
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
   <!-- End Add Inventory -->
   <!-- Add Modal -->
   <div wire:ignore.self class="modal" id="add" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Add Size</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='store()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Categories</label>
                           <select class="form-control" wire:model='link_id'>
                              <option value="">Select Category</option>
                              @foreach($category as $categ)
                              <option value="{{$categ->id}}">{{$categ->name}}</option>
                              @endforeach
                           </select>
                           @error('link_id')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <div class="row">
                                 @foreach($fields as $index => $field)
                              <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                                <label for="nameExLarge" class="form-label">Product Name</label>
                                 <input type="text" class="form-control" wire:model="fields.{{ $index }}.product_name">
                                 @error('link_id')<span class="text-danger">{{$message}}</span>@enderror
                              </div>
                              <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                                <label for="nameExLarge" class="form-label">Style Code</label>
                                 <input type="text" class="form-control" wire:model="fields.{{ $index }}.style_code">
                                 @error('link_id')<span class="text-danger">{{$message}}</span>@enderror
                              </div>
                              <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                                <label for="nameExLarge" class="form-label">MRP</label>
                                 <input type="text" class="form-control" wire:model="fields.{{ $index }}.mrp">
                                 @error('link_id')<span class="text-danger">{{$message}}</span>@enderror
                              </div>
                              <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                                <label for="nameExLarge" class="form-label">Selling Price</label>
                                 <input type="text" class="form-control" wire:model="fields.{{ $index }}.selling_price">
                                 @error('link_id')<span class="text-danger">{{$message}}</span>@enderror
                              </div>
                              <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                                <label for="nameExLarge" class="form-label">Image</label>
                                 <input type="file" class="form-control" wire:model="fields.{{ $index }}.image">
                                 @error('fields.*.image')<span class="text-danger">{{$message}}</span>@enderror
                              </div>
                              <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                                 <button class="btn btn-danger float-right" type="button" wire:click="removeField({{ $index }})">-</button>
                                 @endforeach
                                 <button class="btn btn-success float-right" type="button" wire:click="addField">+</button>
                              </div>
                           </div>
                           @error('size')<span class="text-danger">{{$message}}</span>@enderror
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
               <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Size</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closemodal"></button>
            </div>
            <div class="modal-body">
                              <form wire:submit.prevent='update()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Categories</label>
                           <input type="hidden" wire:model='sub_id'>
                           <select class="form-control" wire:model='link_id'>
                              <option value="">Select Category</option>
                              @foreach($category as $categ)
                              <option value="{{$categ->id}}">{{$categ->name}}</option>
                              @endforeach
                           </select>
                           @error('link_id')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Product Name</label>
                                 <input type="text" class="form-control" wire:model="product_name">
                           @error('product_name')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Style Code</label>
                                 <input type="text" class="form-control" wire:model="style_code">
                           @error('style_code')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">MRP</label>
                                 <input type="text" class="form-control" wire:model="mrp">
                           @error('mrp')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Selling Price</label>
                                 <input type="text" class="form-control" wire:model="selling_price">
                           @error('selling_price')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Image</label>
                           <input type="file" class="form-control" wire:model='image'>
                           @error('image')<span class="text-danger">{{$message}}</span>@enderror
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
   <!-- Delete modal -->
   <div wire:ignore.self class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myLargeModalLabel">Delete Size</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form wire:submit.prevent='delete()'>
               <input type="hidden" wire:model='size_id'>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-outline-dark">Delete</button>
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>