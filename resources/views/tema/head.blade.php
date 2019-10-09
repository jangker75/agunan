<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <a href="{{url('home')}}" class="navbar-brand navbar-judul-logo">Lelang Agunan</a>
      </div>

      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{Session::get('foto_sales')}}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs user-name-session">{{Session::get('nama_sales')}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{Session::get('foto_sales')}}" style="margin-right: 10px" class="img-circle pull-left" alt="User Image">

                <p>
                  <b style="font-size: 13px">{{Session::get('nama_sales')}}</b>
                  <small>{{Session::get('email_sales')}}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a  href="javascript:void(0)" onclick="swal({
                      title: 'Do you want to logout ?',
                      type:'info',
                      showCancelButton:true,
                      allowOutsideClick:true,
                      confirmButtonColor: '#DD6B55',
                      confirmButtonText: 'Logout',
                      cancelButtonText: 'Cancel',
                      closeOnConfirm: false
                      }, function(){
                      location.href = '{{url('logout')}}';

                      });"  class="tombol-logout">Logout</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</header>