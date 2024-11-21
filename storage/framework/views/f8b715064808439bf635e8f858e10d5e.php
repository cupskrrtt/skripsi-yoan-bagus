<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="/Logo1.png" alt="logo">
            </span>

            <div class="text header-text">
                <span class="name">Mitra Produksi</span>
                <span class="profession">Konveksi</span>
            </div>
        </div>

        
    </header>

    <div class="menu-bar">
      <div class="menu">
        <li class="search-box">
          
        </li>
        
          <li class="nav-link" id="dashboard-link">
            <a href="/dashboard">
              <i class='bx bx-home-alt icon'></i>
              <span class="text nav-text">Dashboard</span>
            </a>
          </li>
          <li class="nav-link" id="inventory-link">
            <a href="/product">
              <i class = 'bx bx-cart icon'></i>
              <span class="text nav-text">Inventory</span>
            </a>
          </li>
          <li class="nav-link " id="planning-link">
            <a href="/schedule">
              <i class = 'bx bx-book-content icon'></i>
              <span class="text nav-text">Planning</span>
            </a>
          </li>
          <li class="nav-link" id="production-link">
            <a href="/machine">
              <i class = 'bx bx-sitemap icon'></i>
              <span class="text nav-text">Production</span>
            </a>
          </li>
          <li class="nav-link" id="selling-link">
            <a href="/selling">
              <i class='bx bx-shopping-bag icon'></i>
              <span class="text nav-text">Selling</span>
            </a>
          </li>
          <li class="nav-link" id="purchase-link">
            <a href="/purchase">
              <i class='bx bx-purchase-tag-alt icon'></i>
              <span class="text nav-text">Purchase</span>
            </a>
          </li>
          <li class="nav-link" id="cash-link">
            <a href="/cash">
              <i class = 'bx bx-book icon'></i>
              <span class="text nav-text">Cash Book</span>
            </a>
          </li>
          
          <!-- New Utility Tab -->
          <li class="nav-link" id="utility-link">
            <a href="/utility">
              <i class='bx bx-wrench icon'></i>
              <span class="text nav-text">Utility</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="bottom-content">
        <!-- Logout Form -->
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo csrf_field(); ?>
        </form>
        <li class="">
          <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class = 'bx bx-log-out icon'></i>
            <span class="text nav-text">Logout</span>
          </a>
        </li>

        <li class="mode">
          <div class="moon-sun">
            <i class = 'bx bx-moon icon moon'></i>
            <i class = 'bx bx-sun icon sun'></i>
          </div>
          <span class="mode-text text">Dark Mode</span>
          
          <div class="toggle-switch">
            <span class="switch"></span>
          </div>

        </li>
      </div>
    </div>
</nav>
<?php /**PATH /home/cup/personal/dev/projects/skripsi-yoan-bagus/resources/views/partials/sidebar.blade.php ENDPATH**/ ?>