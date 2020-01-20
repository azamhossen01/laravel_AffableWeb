 <!-- Sidebar -->
 <ul class="sidebar navbar-nav">
 <li class="nav-item {{Request::is('home') ? 'active':''}}">
    <a class="nav-link" href="{{route('home')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
    </li>
    {{-- <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-fw fa-folder"></i>
        <span>Pages</span>
      </a>
      <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <h6 class="dropdown-header">Login Screens:</h6>
        <a class="dropdown-item" href="login.html">Login</a>
        <a class="dropdown-item" href="register.html">Register</a>
        <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
        <div class="dropdown-divider"></div>
        <h6 class="dropdown-header">Other Pages:</h6>
        <a class="dropdown-item" href="404.html">404 Page</a>
        <a class="dropdown-item" href="blank.html">Blank Page</a>
      </div>
    </li> --}}
    <li class="nav-item {{Request::is('admin/students*') ? 'active':''}}">
    <a class="nav-link" href="{{route('students.index')}}">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>All Students</span></a>
    </li>
    <li class="nav-item {{Request::is('admin/news*') ? 'active':''}}">
    <a class="nav-link" href="{{route('news.index')}}">
        <i class="fas fa-fw fa-table"></i>
        <span>News</span></a>
    </li>
    <li class="nav-item {{Request::is('admin/teams*') ? 'active':''}}">
    <a class="nav-link" href="{{route('teams.index')}}">
        <i class="fas fa-fw fa-table"></i>
        <span>Team Members</span></a>
    </li>

    <li class="nav-item {{Request::is('admin/payments*') ? 'active':''}}">
      <a class="nav-link" href="{{route('payments.index')}}">
          <i class="fas fa-fw fa-table"></i>
          <span>Payments</span></a>
      </li>
    <li class="nav-item {{Request::is('admin/teams*') ? 'active':''}}">
    {{-- <a class="nav-link" href="{{route('teams.index')}}">
        <i class="fas fa-fw fa-close"></i>
        <span>Team Members</span></a> --}}


        <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="fas fa-fw fa-table"></i>
                                       <span> {{ __('Logout') }}</span>
                                    </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
    </li>
    
  </ul>