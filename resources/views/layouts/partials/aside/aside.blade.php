<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('Dashboard') }}" class="brand-link">
        <img src="{{ asset('admin-lte/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
        <span class="brand-text font-weight-light">Nutriología</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ $user->picture == "default.png" ? Storage::url($user->picture) : asset('default.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('config') }}" class="d-block">{{ $user->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if($user->hasRoles('admin'))
                <li class="nav-item">
                      <a href="{{ route('nutritionists.index') }}" class="nav-link {{ request()->is('nutritionists') ? 'active' : '' }} ">
                          <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                          <p>
                            Nutriólogos
                          </p>
                      </a>
                  </li>
                  @endif
                  @if($user->hasRoles('admin'))
                <li class="nav-item">
                      <a href="{{ route('food.index') }}" class="nav-link {{ request()->is('foods') ? 'active' : '' }} ">
                          <i class="nav-icon fa fa-utensils" aria-hidden="true"></i>
                          <p>
                              Alimentos
                          </p>
                      </a>
                  </li>
                  @endif
                  <li class="nav-item">
                      <a href="{{ route('patients.index') }}" class="nav-link {{ request()->is('patients') ? 'active' : '' }} ">
                          <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                          <p>
                              Pacientes
                          </p>
                      </a>
                  </li>
                  @if($user->hasRoles('user'))
                  <li class="nav-item">
                      <a href="{{ route('event.index') }}" class="nav-link {{ request()->is('appointments') ? 'active' : '' }} ">
                          <i class="nav-icon fa fa-calendar-alt" aria-hidden="true"></i>
                          <p>
                              Citas
                          </p>
                      </a>
                  </li>
                  @endif
                  <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Cerrar sesión </p>
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