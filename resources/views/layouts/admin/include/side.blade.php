<div class="vertical-menu">
   <!-- LOGO -->
   <div class="navbar-brand-box">
      <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
      <span class="logo-sm">
      <img src="{{asset('admin/assets/images/logo.png')}}" alt="" height="26">
      </span>
      <span class="logo-lg">
      <img src="{{asset('admin/assets/images/logo.png')}}" alt="" height="26">
      </span>
      </a>
      <a href="{{route('admin.dashboard')}}" class="logo logo-light">
      <span class="logo-sm">
      <img src="{{asset('admin/assets/images/logo.png')}}" alt="" height="26">
      </span>
      <span class="logo-lg">
      <img src="{{asset('admin/assets/images/logo.png')}}" alt="" height="26">
      </span>
      </a>
   </div>
   <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
   <i class="fa fa-fw fa-bars"></i>
   </button>
   <div data-simplebar class="sidebar-menu-scroll">
      <!--- Sidemenu -->
      <div id="sidebar-menu">
         <!-- Left Menu Start -->
         <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" data-key="t-menu">Menu</li>
            <li>
               <a href="{{route('admin.dashboard')}}">
               <i class="bx bx-home-circle nav-icon"></i>
               <span class="menu-item" data-key="t-dashboard">Dashboard</span>
               </a>
            </li>
            <li>
               <a href="javascript: void(0);" class="has-arrow">
               <i class="bx bxl-product-hunt nav-icon"></i>
               <span class="menu-item" data-key="t-ecommerce">My Links</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="{{route('admin.linkcategory')}}" data-key="t-category"><i class="bx bx-hash nav-icon"></i>Link Category</a></li>
                  <li><a href="{{route('admin.linkproduct')}}" data-key="t-category"><i class="bx bx-hash nav-icon"></i>Link Product</a></li>
                  <li><a href="{{route('admin.linkbanner')}}" data-key="t-category"><i class="bx bx-hash nav-icon"></i>Link Banner</a></li>
                  <li><a href="{{route('admin.linkuser')}}" data-key="t-category"><i class="bx bx-hash nav-icon"></i>Link Orders</a></li>
               </ul>
            </li>
            <li>
               <a href="javascript: void(0);" class="has-arrow">
               <i class="bx bx-home-circle nav-icon"></i>
               <span class="menu-item" data-key="t-ecommerce">Banner</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="{{route('admin.banner')}}" data-key="t-state"> <i class="bx bx-hash nav-icon"></i>Banner</a></li>
                  <li><a href="{{route('admin.home.banner')}}" data-key="t-city">
                     <i class="bx bx-hash nav-icon"></i>Home Banner</a>
                  </li>
               </ul>
            </li>
            <li>
               <a href="{{route('admin.wardrobe')}}">
               <i class="bx bx-home-circle nav-icon"></i>
               <span class="menu-item" data-key="t-dashboard">Wardrobe</span>
               </a>
            </li>
            <li>
               <a href="{{route('admin.coupon')}}">
               <i class="bx bx-home-circle nav-icon"></i>
               <span class="menu-item" data-key="t-dashboard">Coupon</span>
               </a>
            </li>
            <li>
               <a href="javascript: void(0);" class="has-arrow">
               <i class="bx bxl-product-hunt nav-icon"></i>
               <span class="menu-item" data-key="t-ecommerce">Products</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="{{route('admin.category')}}" data-key="t-category"><i class="bx bx-hash nav-icon"></i>Category</a></li>
                  <li><a href="{{route('admin.subcategory')}}" data-key="t-sub-category"><i class="bx bx-hash nav-icon"></i>Sub-Category</a></li>
                  <li><a href="{{route('admin.product')}}" data-key="t-products"><i class="bx bx-hash nav-icon"></i>Products</a></li>
                  <li><a href="{{route('admin.color')}}" data-key="t-colors"><i class="bx bx-hash nav-icon"></i>Colors</a></li>
                  <li><a href="{{route('admin.size')}}" data-key="t-size"><i class="bx bx-hash nav-icon"></i>Size</a></li>
                  <li><a href="{{route('admin.color.image')}}" data-key="t-size"><i class="bx bx-hash nav-icon"></i>Product Image</a></li>
                  <li><a href="{{route('admin.product.detail')}}" data-key="t-size"><i class="bx bx-hash nav-icon"></i>Product Details</a></li>
                  <li><a href="{{route('admin.inventory')}}" data-key="t-size"><i class="bx bx-hash nav-icon"></i>Inventory</a></li>
               </ul>
            </li>
            <li>
               <a href="javascript: void(0);" class="has-arrow">
               <i class="bx bx-map nav-icon"></i>
               <span class="menu-item" data-key="t-ecommerce">Location</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="{{route('admin.state')}}" data-key="t-state"> <i class="bx bx-hash nav-icon"></i>State</a></li>
                  <li><a href="{{route('admin.city')}}" data-key="t-city">
                     <i class="bx bx-hash nav-icon"></i>City</a>
                  </li>
               </ul>
            </li>
            <li>
               <a href="javascript: void(0);" class="has-arrow">
               <i class="bx bx-map nav-icon"></i>
               <span class="menu-item" data-key="t-ecommerce">Bash</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="{{route('admin.bash')}}" data-key="t-state"> <i class="bx bx-hash nav-icon"></i>Bash</a></li>
                  <li><a href="{{route('admin.bash.product')}}" data-key="t-city">
                     <i class="bx bx-hash nav-icon"></i>Bash Product</a>
                  </li>
               </ul>
            </li>
            <li>
               <a href="{{route('admin.exhibition')}}">
               <i class="bx bx-home-circle nav-icon"></i>
               <span class="menu-item" data-key="t-dashboard">Exhibition</span>
               </a>
            </li>
            <li>
               <a href="{{route('admin.order')}}">
               <i class="bx bx-home-circle nav-icon"></i>
               <span class="menu-item" data-key="t-dashboard">Orders</span>
               </a>
            </li>
            <li>
               <a href="{{route('admin.user')}}">
               <i class="bx bx-home-circle nav-icon"></i>
               <span class="menu-item" data-key="t-dashboard">User</span>
               </a>
            </li>
            <li>
               <a href="javascript: void(0);" class="has-arrow">
               <i class="bx bx-map nav-icon"></i>
               <span class="menu-item" data-key="t-ecommerce">Return or Replace</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="{{route('admin.return')}}" data-key="t-state"> <i class="bx bx-hash nav-icon"></i>Return</a></li>
                  <li><a href="{{route('admin.replace')}}" data-key="t-city">
                     <i class="bx bx-hash nav-icon"></i>Replace</a>
                  </li>
               </ul>
            </li>
            <li>
               <a href="javascript: void(0);" class="has-arrow">
               <i class="bx bxs-user-detail nav-icon"></i>
               <span class="menu-item" data-key="t-ecommerce">Suppliers</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="{{route('admin.supplier')}}" data-key="t-supplier"><i class="bx bx-hash nav-icon"></i> Supplier</a></li>
               </ul>
            </li>
            <li>
               <a href="javascript: void(0);" class="has-arrow">
               <i class="bx bxs-bank nav-icon"></i>
               <span class="menu-item" data-key="t-ecommerce">Accounts</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">
                  <li><a href="{{route('admin.account')}}" data-key="t-account"><i class="bx bx-hash nav-icon"></i> Account</a></li>
               </ul>
            </li>
         </ul>
      </div>
      <!-- Sidebar -->
   </div>
</div>