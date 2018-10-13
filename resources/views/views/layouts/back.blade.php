<?php
/******************************************************
* IM - Vocabulary Builder
* Version : 1.0.2
* Copyright© 2016 Imprevo Ltd. All Rights Reversed.
* This file may not be redistributed.
* Author URL:http://imprevo.net
******************************************************/
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ Config::get('SITE_TITLE') }}</title>
  <meta name="keywords" content="HTML5 Admin Template" />
  <meta name="description" content="Porto Admin - Responsive HTML5 Template">
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />


  <!-- Web Fonts  -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

  <!-- Vendor CSS -->
  <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/bootstrap/css/bootstrap.css" />

  <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/font-awesome/css/font-awesome.css" />
  <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/magnific-popup/magnific-popup.css" />
  <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

  <!-- Specific Page Vendor CSS -->
  <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

  <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/bootstrap-formhelper/bootstrap-formhelpers.min.css" />
  <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/jquery-ui/jquery-ui.css" />
  <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/jquery-ui/jquery-ui.theme.css" />
  <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/select2/css/select2.css" />
  <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
  <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
  <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/pnotify/pnotify.custom.css" />
  <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/vendor/summernote/summernote.css" />

  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/stylesheets/theme.css" />

  <!-- Skin CSS -->
  <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/stylesheets/skins/default.css" />

  <!-- Theme Custom CSS -->
  <link rel="stylesheet" href="{{ Config::get('RELATIVE_URL') }}/assets/stylesheets/theme-custom.css">

  <!-- Head Libs -->
  <script src="{{ Config::get('RELATIVE_URL') }}/assets/vendor/modernizr/modernizr.js"></script>
  <script src="{{ Config::get('RELATIVE_URL') }}/assets/vendor/jquery/jquery.js"></script>
  <script src="{{ Config::get('RELATIVE_URL') }}/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
  <script src="{{ Config::get('RELATIVE_URL') }}/assets/vendor/bootstrap-formhelper/bootstrap-formhelpers.min.js"></script>
  <script src="{{ Config::get('RELATIVE_URL') }}/assets/vendor/underscore/underscore-min.js"></script>
  <script src="{{ Config::get('RELATIVE_URL') }}/assets/vendor/async/async.min.js"></script>
  <script src="{{ Config::get('RELATIVE_URL') }}/assets/vendor/summernote/summernote.js"></script>
  <script src="/assets/vendor/pnotify/pnotify.custom.js"></script>
</head>
<body>
  <section class="body">
    <!-- start: header -->
    <header class="header">
      <div class="logo-container">
        <a href="{{ Config::get('RELATIVE_URL') }}/" class="logo">
          <img src="/assets/images/admin-log.png" height="35" alt="Imprevo Admin" />
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
          <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
      </div>

      <!-- start: search & user box -->
      <div class="header-right">

        <!--          <form action="pages-search-results.html" class="search nav-form">
        <div class="input-group input-search">
        <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
        <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
      </span>
    </div>
  </form>

  <span class="separator"></span>

  <ul class="notifications">
  <li>
  <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
  <i class="fa fa-tasks"></i>
  <span class="badge">3</span>
</a>

<div class="dropdown-menu notification-menu large">
<div class="notification-title">
<span class="pull-right label label-default">3</span>
Tasks
</div>

<div class="content">
<ul>
<li>
<p class="clearfix mb-xs">
<span class="message pull-left">Generating Sales Report</span>
<span class="message pull-right text-dark">60%</span>
</p>
<div class="progress progress-xs light">
<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
</div>
</li>

<li>
<p class="clearfix mb-xs">
<span class="message pull-left">Importing Contacts</span>
<span class="message pull-right text-dark">98%</span>
</p>
<div class="progress progress-xs light">
<div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
</div>
</li>

<li>
<p class="clearfix mb-xs">
<span class="message pull-left">Uploading something big</span>
<span class="message pull-right text-dark">33%</span>
</p>
<div class="progress progress-xs light mb-xs">
<div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
</div>
</li>
</ul>
</div>
</div>
</li>
</ul>-->

<span class="separator"></span>

<div id="userbox" class="userbox">
  <a href="#" data-toggle="dropdown">
    <figure class="profile-picture">
      <img src="@if (Auth::user()->photo == null) {{ Config::get('RELATIVE_URL') }}/assets/images/!logged-user.jpg @else {{ Config::get('RELATIVE_URL') }}/public{{Auth::getUser()->photo}} @endif" class="img-circle" alt="User Image">
    </figure>
    <div class="profile-info" data-lock-name="{{ Auth::user()->name}}" data-lock-email="{{ Auth::user()->email}}">
      <span class="name">{{ Auth::user()->name}}</span>
    </div>

    <i class="fa custom-caret"></i>
  </a>

  <div class="dropdown-menu">
    <ul class="list-unstyled">
      <li class="divider"></li>
      <li>
        <a role="menuitem" tabindex="-1" href="{{ Config::get('RELATIVE_URL') }}/profile"><i class="fa fa-user"></i> My profile</a>
      </li>
      <li>
        <a role="menuitem" tabindex="-1" href="{{ Config::get('RELATIVE_URL') }}/signout"><i class="fa fa-power-off"></i> Logout</a>
      </li>
    </ul>
  </div>
</div>
</div>
<!-- end: search & user box -->
</header>
<!-- end: header -->

<div class="inner-wrapper">
  <!-- start: sidebar -->
  <aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
      <div class="sidebar-title">
        Navigation
      </div>
      <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
      </div>
    </div>

    <div class="nano">
      <div class="nano-content">
        <nav id="menu" class="nav-main" role="navigation">
          <ul class="nav nav-main">
            <li>
              <a href="{{ Config::get('RELATIVE_URL') }}/home">
                <i class="fa fa-home"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="nav-parent">
              <a>
                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                <span>Course management</span>
              </a>
              <ul class="nav nav-children">
                <li>
                  <a href="/courses">
                    Course list
                  </a>
                </li>
                <li>
                  <a href="/courses/new">
                    Add new course
                  </a>
                </li>
                <li>
                  <a href="/levels">
                    Add new level
                  </a>
                </li>
                <li>
                  <a href="/modules">
                    Add new module
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-parent">
              <a>
                <i class="fa fa-book" aria-hidden="true"></i>
                <span>Lesson management</span>
              </a>
              <ul class="nav nav-children">
                <li>
                  <a href="/lessons">
                    Lesson list
                  </a>
                </li>
                <li>
                  <a href="/lessons/new">
                    Add new lesson
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-parent">
              <a>
                <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                <span>Quiz management</span>
              </a>
              <ul class="nav nav-children">
                <li>
                  <a href="/quizzes">
                    Quiz list
                  </a>
                </li>
                <li>
                  <a href="/quizzes/new">
                    Add new quiz
                  </a>
                </li>
                <li>
                  <a href="/quizsettings">
                    Quiz Settings
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-parent">
              <a>
                <i class="fa fa-language" aria-hidden="true"></i>
                <span>Word database</span>
              </a>
              <ul class="nav nav-children">
                <li>
                  <a href="/words">
                    Words
                  </a>
                </li>
                <li>
                  <a href="/cats">
                    Categories
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-parent">
              <a>
                <i class="fa fa-tasks" aria-hidden="true"></i>
                <span>Wordset management</span>
              </a>
              <ul class="nav nav-children">
                <li>
                  <a href="/wordsets">
                    Wordset list
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-parent">
              <a>
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>User management</span>
              </a>
              <ul class="nav nav-children">
                <li>
                  <a href="/users">
                    User list
                  </a>
                </li>
                <li>
                  <a href="/users/new">
                    Add new user
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-parent">
              <a>
                <i class="fa fa-wpforms" aria-hidden="true"></i>
                <span>Pages</span>
              </a>
              <ul class="nav nav-children">
                <li>
                  <a href="/pages">
                    Page list
                  </a>
                </li>
                <li>
                  <a href="/pages/new">
                    Add new page
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-parent">
              <a>
                <i class="fa fa-wpforms" aria-hidden="true"></i>
                <span>Blog Management</span>
              </a>
              <ul class="nav nav-children">
                <li>
                  <a href="/blogs">
                    Post list
                  </a>
                </li>
                <li>
                  <a href="/blogs/new">
                    Add new post
                  </a>
                </li>
                <li>
                  <a href="/blogcats">
                    Categories
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-parent">
              <a>
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span>Shopping cart</span>
              </a>
              <ul class="nav nav-children">
                <li>
                  <a href="/products">
                    Products
                  </a>
                </li>
                <li>
                  <a href="/products/new">
                    Add new products
                  </a>
                </li>
                <li>
                  <a href="/orders">
                    Orders
                  </a>
                </li>
                <li>
                  <a href="/shoppingcartsettings">
                    Settings
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-parent">
              <a>
                <i class="fa fa-gears" aria-hidden="true"></i>
                <span>Settings</span>
              </a>
              <ul class="nav nav-children">
                <li>
                  <a href="{{ Config::get('RELATIVE_URL') }}/setting">
                    Settings
                  </a>
                </li>
                <li>
                  <a href="/spams">
                    Spams
                  </a>
                </li>
                <li>
                  <a href="/topalert">
                    Top Alert
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-parent">
              <a>
                <i class="fa fa-bar-chart" aria-hidden="true"></i>
                <span>Business Module</span>
              </a>
              <ul class="nav nav-children">
                <li>
                  <a href="{{ Config::get('RELATIVE_URL') }}/business_setting">
                    Settings
                  </a>
                </li>
                <li>
                  <a href="/company_orders">
                    Companies
                  </a>
                </li>
                <li>
                  <a href="/company_order/new">
                    Add new company
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>

      <script>
      // Maintain Scroll Position
      if (typeof localStorage !== 'undefined') {
        if (localStorage.getItem('sidebar-left-position') !== null) {
          var initialPosition = localStorage.getItem('sidebar-left-position'),
          sidebarLeft = document.querySelector('#sidebar-left .nano-content');

          sidebarLeft.scrollTop = initialPosition;
        }
      }
      </script>
    </div>
  </aside>
  <!-- end: sidebar -->
  <div class="w100">
    @yield('content')
  </div>
</div>
</section>
<!-- Vendor -->
<script src="/assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="/assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="/assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>

<!-- Specific Page Vendor -->
<script src="/assets/vendor/jquery-ui/jquery-ui.js"></script>
<script src="/assets/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>
<script src="/assets/vendor/autosize/autosize.js"></script>
<script src="/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script src="/assets/vendor/jquery-validation/jquery.validate.js"></script>
<script src="/assets/vendor/select2/js/select2.js"></script>
<script src="/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="/assets/vendor/ios7-switch/ios7-switch.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="/assets/javascripts/theme.js"></script>

<!-- Theme Custom -->
<script src="/assets/javascripts/theme.custom.js"></script>

<!-- Theme Initialization Files -->
<script src="/assets/javascripts/theme.init.js"></script>
<script src="/assets/javascripts/common.js"></script>
<script src="/assets/vendor/fuelux/js/spinner.js"></script>

</body>
</html>
