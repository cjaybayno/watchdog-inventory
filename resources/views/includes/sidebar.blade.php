	  <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
=        <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{!! asset($avatar) !!}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{ $name }}</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Active</a>
            </div>
          </div>
		  <br>
          <!-- search form (Optional) 
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
           /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ $dashboardActiveMenu or '' }}"><a href="{{ URL::to('dashboard') }}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
			<li class="treeview {{ $itemActiveMenu or '' }} {{ $itemCategoryActiveMenu or ''  }} {{ $itemUomActiveMenu or '' }}">
			  <a href="#"><i class="fa fa-cart-plus"></i><span>Items</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="{{ $itemActiveMenu or '' }}"><a href="{{ URL::route('items') }}"><i class="fa fa-angle-double-right"></i>List</a></li>
                <li class="{{ $itemCategoryActiveMenu or '' }}"><a href="{{ URL::route('items_category') }}"><i class="fa fa-angle-double-right"></i>Category</a></li>
                <li class="{{ $itemUomActiveMenu or '' }}"><a href="{{ URL::route('items_uom') }}"><i class="fa fa-angle-double-right"></i>UOM</a></li>
              </ul>
            </li>
			
			<li class="{{ $branchActiveMenu or '' }}"><a href="{{ URL::route('branches') }}"><i class="fa fa-building"></i><span>Branches</span></a></li>
			<li class="{{ $supplierActiveMenu or '' }}"><a href="{{ URL::route('suppliers') }}"><i class="fa fa-industry"></i><span>Suppliers</span></a></li>
			
			<li class="{{ $purchaseActiveMenu or '' }}"><a href="{{ URL::to('purchases') }}"><i class="fa fa-money"></i><span>Purchase</span></a></li>
			
			<li class="treeview">
			  <a href="#"><i class="fa fa-cubes"></i><span>Stocks</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class=""><a href="#"><i class="fa fa-angle-double-right"></i>Receive Items</a></li>
                <li class=""><a href="#"><i class="fa fa-angle-double-right"></i>Movements</a></li>
                <li class=""><a href="#"><i class="fa fa-angle-double-right"></i>Adjustments</a></li>
              </ul>
            </li>
			
		  </ul><!-- /.sidebar-menu -->
		  <ul class="sidebar-menu">
            <li class="header">USER MANAGEMENT</li>
			<li class="{{ $userActiveMenu or '' }}"><a href="{{ URL::to('user') }}"><i class="fa fa-user"></i><span>Users</span></a></li>
			<li><a href="#"><i class="fa fa-users"></i><span>Groups</span></a></li>
			<li><a href="#"><i class="fa fa-mouse-pointer"></i><span>Access</span></a></li>
		  </ul>
        </section>
        <!-- /.sidebar -->
      </aside>