<div>
   <div class="card-body">
      <div wire:loading wire:target="store">
         <x-loader/>
      </div>
      <div wire:loading wire:target="delete">
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
         <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add" style="float:right;">Add Color</button>
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
                        <th>Product</th>
                        <th>Color</th>
                        <th>Image</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($data as $key => $pros)
                     <tr>
                        <td> {{ $key +1 }} </td>
                        <td>{{ ucwords($pros->product->name) }}</td>
                        <td><button class="btn btn-lg" style="background-color: {{ $pros->color->code }};"></button></td>
                        <td width="60%"><img src="{{ asset('admin/color/' . $pros->image) }}" width="300" height="100" /></td>
                        <td>
                           <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit" wire:click="editColor({{$pros->id}})"><i class="fas fa-pen"></i></button>&nbsp;&nbsp;
                           <button type="button" class="btn btn-sm btn-danger" wire:click="delete({{$pros->id}})"><i class="fas fa-trash"></i></button>
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
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Add Color</h5>
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
                           <select class="form-control" wire:model="subcategory_id" wire:change="viewProduct()">
                              <option>Select A Sub-Category</option>
                              @foreach($subcategories as $subcategory)
                              <option value="{{ $subcategory->id }}">{{ $subcategory->sub_name }}</option>
                              @endforeach
                           </select>
                           @error('subcategory_id')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Product</label>
                           <select class="form-control" wire:model="product_id" wire:change="viewColor()">
                              <option>Select A Sub-Category</option>
                              @foreach($product as $products)
                              <option value="{{ $products->id }}">{{ $products->name }}</option>
                              @endforeach
                           </select>
                           @error('product_id')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                           <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Color</label>
                           <select class="form-control" wire:model="color_id">
                              <option>Select A Color</option>
                              @foreach($color as $products)
                              <option value="{{ $products->id }}" style="background-color: 
                                 {{ $products->code }};">Color</option>
                              @endforeach
                           </select>
                           @error('color_id')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                           <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                              @foreach ($fields as $index => $field)
                              <label for="image{{$index}}" class="form-label">Image</label>
                              <input type="file" class="form-control" placeholder="Select Image" wire:model="fields.{{ $index }}.image" accept="image/*">
                              @error("fields.{$index}.image")<span class="text-danger">{{$message}}</span>@enderror
                              <button class="btn btn-danger float-right" type="button" wire:click="removeField({{ $index }})">-</button>
                           @endforeach
                           </div>
                           <button class="btn btn-success float-right" type="button" wire:click="addField">+</button>
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
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Color</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closemodal"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent='updateColor()'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Image</label>
                           <input type="file" class="form-control" wire:model='image'>
                           @error('image')<span class="text-danger">{{$message}}</span>@enderror
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