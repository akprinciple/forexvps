<div class="container-scroller">

<nav class="sidebar sidebar-offcanvas" id="sidebar">
<div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
  <a class="sidebar-brand brand-logo" href="index"><img src="../assets/images/logo.svg" alt="logo" /></a>
  <a class="sidebar-brand brand-logo-mini" href="index"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
</div>
<ul class="nav">
  <li class="nav-item profile">
    <div class="profile-desc">
      <div class="profile-pic">
        <div class="count-indicator">
          <img class="img-xs rounded-circle " src="../assets/images/faces/face15.jpg" alt="">
          <span class="count bg-success"></span>
        </div>
        <div class="profile-name">
          <h5 class="mb-0 font-weight-normal" id="search_username"></h5>
          <span>User</span>
        </div>
      </div>
      <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
      <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
        <a href="#" class="dropdown-item preview-item">
          <div class="preview-thumbnail">
            <div class="preview-icon bg-dark rounded-circle">
              <i class="mdi mdi-settings text-primary"></i>
            </div>
          </div>
          <div class="preview-item-content">
            <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item preview-item">
          <div class="preview-thumbnail">
            <div class="preview-icon bg-dark rounded-circle">
              <i class="mdi mdi-onepassword  text-info"></i>
            </div>
          </div>
          <div class="preview-item-content">
            <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item preview-item">
          <div class="preview-thumbnail">
            <div class="preview-icon bg-dark rounded-circle">
              <i class="mdi mdi-calendar-today text-success"></i>
            </div>
          </div>
          <div class="preview-item-content">
            <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
          </div>
        </a>
      </div>
    </div>
  </li>
  <li class="nav-item nav-category">
    <span class="nav-link">Navigation</span>
  </li>
  <li class="nav-item menu-items">
    <a class="nav-link" href="index">
      <span class="menu-icon">
        <i class="mdi mdi-speedometer"></i>
      </span>
      <span class="menu-title">Dashboard</span>
    </a>
  </li>
  <li class="nav-item menu-items">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <span class="menu-icon">
        <i class="mdi mdi-laptop"></i>
      </span>
      <span class="menu-title">Wallet</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-basic">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> <a class="nav-link" href="wallet">Wallet</a></li>
        <li class="nav-item"> <a class="nav-link" href="payments">Fund Wallet</a></li>
        <li class="nav-item"> <a class="nav-link" href="payment_history">Payment history</a></li>
      </ul>
    </div>
  </li>
  <li class="nav-item menu-items">
    <a class="nav-link" href="vps">
      <span class="menu-icon">
        <i class="mdi mdi-table-large"></i>
      </span>
      <span class="menu-title">VPS</span>
    </a>
  </li>
  <li class="nav-item menu-items">
    <a class="nav-link" href="subscriptions">
      <span class="menu-icon">
        <i class="mdi mdi-playlist-play"></i>
      </span>
      <span class="menu-title">Subscriptions</span>
    </a>
  </li>
  
  <li class="nav-item menu-items">
    <a class="nav-link" href="withdrawal">
      <span class="menu-icon">
        <i class="mdi mdi-chart-bar"></i>
      </span>
      <span class="menu-title">Affiliate Withdrawal</span>
    </a>
  </li>
  <li class="nav-item menu-items">
    <a class="nav-link" href="profile">
      <span class="menu-icon">
        <i class="mdi mdi-contacts"></i>
      </span>
      <span class="menu-title">Profile</span>
    </a>
  </li>
  <li class="nav-item menu-items">
    <a class="nav-link" href="../logout">
      <span class="menu-icon">
        <i class="mdi mdi-logout text-danger"></i>
      </span>
      <span class="menu-title">Logout</span>
    </a>
  </li>
</ul>
</nav>

<!-- partial -->
<div class="container-fluid page-body-wrapper">
<!-- partial:partials/_navbar -->
<nav class="navbar p-0 fixed-top d-flex flex-row">
  <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
    <a class="navbar-brand brand-logo-mini" href="index"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
  </div>
  <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    
    <ul class="navbar-nav navbar-nav-right">
      
      <li class="nav-item nav-settings d-none d-lg-block">
        <a class="nav-link" href="#">
          <i class="mdi mdi-view-grid"></i>
        </a>
      </li>
      
      <li class="nav-item dropdown border-left">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
          <i class="mdi mdi-bell"></i>
          <span class="count bg-danger"></span>
        </a>
        
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
          <div class="navbar-profile">
            <img class="img-xs rounded-circle" src="../assets/images/faces/face15.jpg" alt="">
            <p class="mb-0 d-none d-sm-block navbar-profile-name" id="search_username2"></p>
            <i class="mdi mdi-menu-down d-none d-sm-block"></i>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
          <h6 class="p-3 mb-0">Profile</h6>
          <div class="dropdown-divider"></div>
          <a href="profile" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-success"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject mb-1">Profile</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="../logout" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-logout text-danger"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject mb-1">Log out</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <p class="p-3 mb-0 text-center">Advanced settings</p>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-format-line-spacing"></span>
    </button>
  </div>
</nav> 
<div class="main-panel">
<div class="content-wrapper">