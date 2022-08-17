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
        <!-- ============================================================== -->
        <!-- Notification icon scss in header.scss -->
        <!-- ============================================================== -->
        <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="noti_dropdown"><i
              class="material-icons">notifications</i></a>
          <ul id="noti_dropdown" class="mailbox dropdown-content">
            <li>
              <div class="drop-title">Notifications</div>
            </li>
            <li>
              <div class="message-center">
                <!-- Message -->
                <a href="#">
                  <span class="btn-floating btn-large red"><i class="material-icons">link</i></span>
                  <span class="mail-contnet">
                    <h5>Launch Admin</h5>
                    <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span>
                  </span>
                </a>
                <!-- Message -->
                <a href="#">
                  <span class="btn-floating btn-large blue"><i class="material-icons">date_range</i></span>
                  <span class="mail-contnet">
                    <h5>Event today</h5>
                    <span class="mail-desc">Just a reminder that you have event</span>
                    <span class="time">9:10 AM</span>
                  </span>
                </a>
                <!-- Message -->
                <a href="#">
                  <span class="btn-floating btn-large cyan"><i class="material-icons">settings</i></span>
                  <span class="mail-contnet">
                    <h5>Settings</h5>
                    <span class="mail-desc">You can customize this template as you want</span>
                    <span class="time">9:08 AM</span>
                  </span>
                </a>
                <!-- Message -->
                <a href="#">
                  <span class="btn-floating btn-large green"><i class="material-icons">face</i></span>
                  <span class="mail-contnet">
                    <h5>Lily Jordan</h5>
                    <span class="mail-desc">Just see the my admin!</span>
                    <span class="time">9:02 AM</span>
                  </span>
                </a>
              </div>
            </li>
            <li>
              <a class="center-align" href="javascript:void(0);"> <strong>Check all notifications</strong>
              </a>
            </li>
          </ul>
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