<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html ng-app="qataroffers">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="apple-touch-icon" href="favicon.png">
  <link rel="shortcut icon" href="favicon.png" type="image/png"> 
  <title>مترو ماركت | لوحة التحكم</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
  <link rel="stylesheet" href="{{ elixir('assets/css/app.css') }}">

</head>

<body class="hold-transition skin-red sidebar-mini" ng-controller="MenuController as menu">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">مترو</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>مترو</b> ماركت</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
                  
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{$user->name or ''}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->              
              <!-- Menu Footer-->
              <li class="user-footer">                
                <div class="pull-right">
                  <a href="{{url('/logout')}}" class="btn btn-default btn-flat">تسجل الخروج</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="info">
          <p>{{$user->name or ''}}</p>
        </div>
      </div>

      <!-- search form (Optional) -->
      <!--<form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!--<li class="header">HEADER</li>-->
        <!-- Optionally, you can add icons to the links -->
        <li><a href="{{url('/')}}"><i class="fa fa-cog"></i> <span>الرئيسية</span></a></li>
        <li>
          <a href="{{action('SliderController@index')}}"><i class="fa fa-tags"></i> <span>السلايدر</span></a>
        </li>
        <li>
          <a href="{{action('NotificationsController@index')}}"><i class="fa fa-tags"></i> <span>الإشعارات</span></a>
        </li>
        <li>
          <a href="{{action('PointsMagazineController@index')}}"><i class="fa fa-tags"></i> <span>مجلة النقاط</span></a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>المجلة الدورية</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ action('MagazineBGController@index')}}"><i class="fa fa-circle-o"></i>الخلفية الرئيسية</a></li>
            <li><a href="{{action('MagazineController@index')}}"><i class="fa fa-circle-o"></i>الأعداد</a></li>
          </ul>
        </li>
        <li>
          <a href="{{action('ContactController@index')}}"><i class="fa fa-tags"></i> <span>رسائل الزوار</span></a>
        </li>
        <li><a href="{{action('OffersController@index')}}"><i class="fa fa-tag"></i> <span>العروض</span></a></li>
        <li>
          <a href="{{action('UserController@index')}}"><i class="fa fa-users"></i> <span>المستخدمين</span></a>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  @yield('content')

  <!-- Main Footer -->
  <footer class="main-footer">
    <!--<div class="pull-right hidden-xs">
      Anything you want
    </div>-->
    <strong>حقوق النسخ &copy; {{date('Y',time())}} Metro Market.</strong> جميع الحقوق محفوظة
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
    <!-- Delete Confirmation Modal -->
    <div class="modal modal-danger fade" id="delete-confirmation-modal">
      <div class="modal-dialog">
        <div class="modal-content">
         <form method="POST"  action="" />
         {!! csrf_field() !!}
         <input type="hidden" name="_method" value="DELETE">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">تأكيد الحذف</h4>
          </div>
          <div class="alert callout fade in hidden">
          <h5 class="h4"></h5>
          <ul class="list-unstyled">
          </ul>
          </div>
          <div class="modal-body">
            <p>هل تريد بالتأكيد حذف المحدد ؟</p>
          </div>
          <div class="modal-footer">
            <button type="submit"   class="btn btn-danger">حذف</button>
              <button type="reset" data-dismiss="modal"  class="btn btn-default pull-left">إالغاء الأمر</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- ./ Delete Confirmation Modal -->

<script src="{{ elixir('assets/js/app.js') }}"></script>
@yield('js')

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
