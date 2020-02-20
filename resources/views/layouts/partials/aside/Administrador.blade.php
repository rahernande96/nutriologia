<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('Dashboard') }}" class="brand-link">
        <img src="{{ asset('Logos/Color/logo1.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
        <span class="brand-text font-weight-light">
          <img style="max-width: 120px;" src="{{ asset('Logos/Color/logo2.png') }}">
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @include('layouts.partials.aside.userpanel.userpanel')

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                      <a href="{{ route('nutritionists.index') }}" class="nav-link {{ request()->is('nutritionists') ? 'active' : '' }} ">
                          <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                          <p>
                              Nutriologos
                          </p>
                      </a>
                  </li>
                <li class="nav-item">
                      <a href="{{ route('food.index') }}" class="nav-link {{ request()->is('foods') ? 'active' : '' }} ">
                          <i class="nav-icon fa fa-utensils" aria-hidden="true"></i>
                          <p>
                              Alimentos
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('patients.index') }}" class="nav-link {{ request()->is('patients') ? 'active' : '' }} ">
                          <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                          <p>
                              Pacientes
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Cerrar Sesión </p>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </li>
              </ul>
          </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>