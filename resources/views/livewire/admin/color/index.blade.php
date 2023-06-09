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
                        <th>Color Category</th>
                        <th>Image</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($data as $key => $pros)
                     <tr>
                        <td> {{ $key +1 }} </td>
                        <td>{{ ucwords($pros->product->style_code) }}</td>
                        <td><button class="btn btn-lg" style="background-color: {{ $pros->code }};"></button></td>
                        <td> {{ $pros->color_category }} </td>
                        <td><img src="{{ $pros->image }}" width="100" height="100" /></td>
                        <td>
                           <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit" wire:click="editColor({{$pros->id}})"><i class="fas fa-pen"></i></button>&nbsp;&nbsp;
                           <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete" wire:click="deleteColor({{$pros->id}})"><i class="fas fa-trash"></i></button>
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
                           <select class="form-control" wire:model="product_id">
                              <option>Select A Sub-Category</option>
                              @foreach($product as $products)
                              <option value="{{ $products->id }}">{{ $products->name }}</option>
                              @endforeach
                           </select>
                           @error('product_id')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Color Category</label>
                           <select class="form-control" wire:model="color_category">
                              <option>Select A Color Category</option>
                              <option value="black">Black</option>
                              <option value="white">White</option>
                              <option value="blue">Blue</option>
                              <option value="pink">Pink</option>
                              <option value="purple">Purple</option>
                              <option value="beige">Beige</option>
                              <option value="brown">Brown</option>
                              <option value="off_white">Off White</option>
                              <option value="gold">Gold</option>
                              <option value="green">Green</option>
                              <option value="grey">Grey</option>
                              <option value="khaki">Khaki</option>
                              <option value="maroon">Maroon</option>
                              <option value="red">Red</option>
                              <option value="multi_color">Multi Color</option>
                              <option value="orange">Orange</option>
                              <option value="silver">Silver</option>
                              <option value="yellow">Yellow</option>
                              <option value="teal">Teal</option>
                              <option value="wine">Wine</option>
                              <option value="turquoise">Turquoise</option>
                              <option value="coffee">Coffee</option>
                              <option value="peach">Peach</option>
                           </select>
                           @error('color_category')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Color</label>
                           <input type="color" class="form-control" placeholder="Enter Color" wire:model="code">
                           @error("code")<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 col-12 mb-3">
                           <label for="image" class="form-label">Image</label>
                           <input type="file" class="form-control" placeholder="Select Image" wire:model="image" accept="image/*">
                           @error("image")<span class="text-danger">{{$message}}</span>@enderror
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
                           <label for="nameExLarge" class="form-label">Color Category</label>
                           <select class="form-control" wire:model="color_category">
                              <option>Select A Color Category</option>
                              <option value="black">Black</option>
                              <option value="white">White</option>
                              <option value="blue">Blue</option>
                              <option value="pink">Pink</option>
                              <option value="purple">Purple</option>
                              <option value="beige">Beige</option>
                              <option value="brown">Brown</option>
                              <option value="off_white">Off White</option>
                              <option value="gold">Gold</option>
                              <option value="green">Green</option>
                              <option value="grey">Grey</option>
                              <option value="khaki">Khaki</option>
                              <option value="maroon">Maroon</option>
                              <option value="red">Red</option>
                              <option value="multi_color">Multi Color</option>
                              <option value="orange">Orange</option>
                              <option value="silver">Silver</option>
                              <option value="yellow">Yellow</option>
                              <option value="teal">Teal</option>
                              <option value="wine">Wine</option>
                              <option value="turquoise">Turquoise</option>
                              <option value="coffee">Coffee</option>
                              <option value="peach">Peach</option>
                           </select>
                           @error('color_category')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-12 mb-3">
                           <label for="nameExLarge" class="form-label">Color Name</label>
                           <input type="hidden" wire:model='color_id'>
                           <input type="color" class="form-control" wire:model='code'>
                           @error('code')<span class="text-danger">{{$message}}</span>@enderror
                        </div>
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
   <!-- Delete modal -->
   <div wire:ignore.self class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="myLargeModalLabel">Delete Color</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form wire:submit.prevent='delete()'>
               <input type="hidden" wire:model='color_id'>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-outline-dark">Delete</button>
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>