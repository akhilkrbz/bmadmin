<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="./index.html" class="brand-link">
      <!--begin::Brand Image-->
      <img src="{{ asset('assets/dist/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">Bloom Mush</span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>
              Dashboard
            </p>
          </a>
          
        </li>
        
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-box-seam-fill"></i>
            <p>
              Beds
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('beds.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Beds List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('beds.create') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>New Bed</p>
              </a>
            </li>
            
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-basket-fill"></i>
            <p>
              Harvest
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('harvest.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Harvest List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('harvest.create') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>New Harvest</p>
              </a>
            </li>
            
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-currency-dollar"></i>
            <p>
              Ledgers
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('ledgers.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Ledger</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a href="{{ route('ledgers.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Ledger List</p>
              </a>
            </li> -->
            
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-box-seam"></i>
            <p>
              Products
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('products.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Products List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('products.create') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Add Product</p>
              </a>
            </li>
            
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-bag-check"></i>
            <p>
              Purchase
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('purchases.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Purchases</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('purchases.create') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>New Purchase</p>
              </a>
            </li>
            
          </ul>
        </li>


        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-credit-card"></i>
            <p>
              Voucher
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('payment_vouchers.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Vouchers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('payment_vouchers.create') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>New Voucher</p>
              </a>
            </li>
            
          </ul>
        </li>


        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-cart"></i>
            <p>
              Sales
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('sales.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Sales List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('sales.create') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>New Sale</p>
              </a>
            </li>
            
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-credit-card"></i>
            <p>
              Receipts
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('receipts.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Receipts</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('receipts.create') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>New Receipt</p>
              </a>
            </li>
            
          </ul>
        </li>


        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-graph-up"></i>
            <p>
              Reports
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./widgets/small-box.html" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Harvest Report</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./widgets/info-box.html" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Sales Report</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./widgets/info-box.html" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Expense Report</p>
              </a>
            </li>
            
          </ul>
        </li>


      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->