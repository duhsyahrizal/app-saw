<header class="topbar">
  <!-- ============================================================== -->
  <!-- Navbar scss in header.scss -->
  <!-- ============================================================== -->
  <nav data-navbarbg="skin1">
    <div class="nav-wrapper">
      <!-- ============================================================== -->
      <!-- Logo you can find that scss in header.scss -->
      <!-- ============================================================== -->
      <a href="javascript:void(0)" class="brand-logo" data-logobg="skin6">
        <span class="icon">
          <img class="dark-logo" src="/template/assets/images/logo.jpeg" width="40">
        </span>
        <div class="text" style="color: #444; margin-left: .625rem; font-size: 16px !important; font-weight: bold;">
          AIS System
        </div>
      </a>
      <!-- ============================================================== -->
      <!-- Logo you can find that scss in header.scss -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Left topbar icon scss in header.scss -->
      <!-- ============================================================== -->
      <ul class="left">
        <li class="hide-on-med-and-down">
          <a href="javascript: void(0);" class="nav-toggle">
            <span class="bars bar1"></span>
            <span class="bars bar2"></span>
            <span class="bars bar3"></span>
          </a>
        </li>
        <li class="hide-on-large-only">
          <a href="javascript: void(0);" class="sidebar-toggle">
            <span class="bars bar1"></span>
            <span class="bars bar2"></span>
            <span class="bars bar3"></span>
          </a>
        </li>
      </ul>
      <!-- ============================================================== -->
      <!-- Left topbar icon scss in header.scss -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Right topbar icon scss in header.scss -->
      <!-- ============================================================== -->
      <ul class="right">
        <!-- ============================================================== -->
        <!-- Profile icon scss in header.scss -->
        <!-- ============================================================== -->
        <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="user_dropdown"><img
              src="/template/assets/images/users/2.jpg" alt="user" class="circle profile-pic"></a>
          <ul id="user_dropdown" class="mailbox dropdown-content dropdown-user">
            <li>
              <div class="dw-user-box">
                <div class="u-img"><img src="/template/assets/images/users/2.jpg" alt="user"></div>
                <div class="u-text">
                  <h4>{{ \Auth::user()->name }}</h4>
                  <p>{{ \Auth::user()->email }}</p>
                  <a class="waves-effect waves-light btn-small red white-text">View Profile</a>
                </div>
              </div>
            </li>
            <li role="separator" class="divider"></li>
            <li><a href="/logout" style="color: grey !important;"><i class="material-icons"
                  style="color: red !important;">power_settings_new</i>
                Logout</a></li>
          </ul>
        </li>
      </ul>
      <!-- ============================================================== -->
      <!-- Right topbar icon scss in header.scss -->
      <!-- ============================================================== -->
    </div>
  </nav>
  <!-- ============================================================== -->
  <!-- Navbar scss in header.scss -->
  <!-- ============================================================== -->
</header>