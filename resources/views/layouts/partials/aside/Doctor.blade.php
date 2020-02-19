<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('Dashboard') }}" class="brand-link">
        <img src="{{ asset('admin-lte/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
        <span class="brand-text font-weight-light">Nutriología</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @include('layouts.partials.aside.userpanel.userpanel')

        <!-- Sidebar Menu -->
        <nav class="mt-2  ">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                  <li class="nav-item">
                      <a href="{{ route('Dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }} ">
                          <i class="nav-icon fa fa-dashboard" aria-hidden="true"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('patients.create') }}" class="nav-link {{ request()->is('patients/new-patient') ? 'active' : '' }} ">
                          <i class="nav-icon fa fa-user-plus" aria-hidden="true"></i>
                          <p>
                              Nuevo Paciente
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('patients.index') }}" class="nav-link {{ request()->is('patients') ? 'active' : '' }} ">
                          <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                          <p>
                              Mis Pacientes
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('event.index') }}?open=true" class="nav-link">
                          <i class="nav-icon fa fa-calendar-plus" aria-hidden="true"></i>
                          <p>
                              Nueva cita
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('event.index') }}" class="nav-link {{ request()->is('appointments') ? 'active' : '' }} ">
                          <i class="nav-icon fa fa-calendar-alt" aria-hidden="true"></i>
                          <p>
                              Mi Agenda
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('index.payment.method') }}" class="nav-link {{ request()->is('administrar-pagos-de-pacientes') ? 'active' : '' }} ">
                          <i class="nav-icon fa fa-money-bill" aria-hidden="true"></i>
                          <p>
                              Recibir Pagos
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('config') }}" class="nav-link {{ request()->is('configuration') ? 'active' : '' }} ">
                          <i class="nav-icon fa fa-pencil-alt" aria-hidden="true"></i>
                          <p>
                              Configurar
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
