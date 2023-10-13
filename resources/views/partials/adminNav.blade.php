<div class="wrapper">
  <nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
      <a class="sidebar-brand" href="admin/dashboard">
        <span class="align-middle">HESTI</span>
      </a>

      <ul class="sidebar-nav">

        <li class="sidebar-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/admin/dashboard">
            <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item {{ Request::is('admin/employee*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/admin/employee">
            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Employee</span>
          </a>
        </li>
        <li class="sidebar-item {{ Request::is('admin/division*') ? 'active' : '' }}">
          <a class="sidebar-link" href="/admin/division">
            <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Division</span>
          </a>
        </li>

      </ul>
    </div>
  </nav>

  <div class="main">
    <nav class="navbar navbar-expand navbar-light navbar-bg">
      <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
      </a>

      <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
          <li class="nav-item dropdown">
            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
              <i class="align-middle" data-feather="settings"></i>
            </a>

            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
              <span class="text-dark">Selamat datang</span>
              
            </a>
            <div class="dropdown-menu dropdown-menu-end">
              <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Log out</button>
              </form>
            </div>
          </li>
        </ul>
      </div>
    </nav>