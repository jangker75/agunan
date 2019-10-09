@include('tema.header')
<body class="body-login">
  <div class="container">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="box-kotak-login">
        <div class="header-box-login">
          <h3>LOGIN</h3>
          <p>Welcome back, Please login <br> to your account</p>
        </div>
        <form method="POST" class="form-login" action="loginsales">
          {{csrf_field()}}
          <div class="area-form">
            <div class="box-form-login bb-1">
              <label>Email</label>
              <input type="text" class="form-control form-input" placeholder="Email" name="email">
            </div>
            <div class="box-form-login">
              <label>Password</label>
              <input type="password" class="form-control form-input" id="input-password" placeholder="Password" name="password">
              <i class="fa fa-eye see-password"></i>
            </div>
          </div>
          <div class="form-action-login">
            <div class="checkbox icheck ceklis_welcome">
              <label>
                <input type="checkbox" class="flat-red" checked>
                <span class="remember-me">Remember Me</span>
              </label>
            </div>
            <div class="forget-password pull-right">
              <a href="forget-password">Forgot Password?</a>
            </div>
          </div>
          <input type="submit" id="sa-title" class="btn btn-primary" style="width: 100px" value="Login">
        </form>
        
        
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 login-side-right">
      <h1>Lelang Agunan</h1>
    </div>
  </div>
</body>
@include('tema.script')
@if (\Session::has('error'))
  <script type="text/javascript">
    swal({   
        title: "Error",   
        text: '{!!  \Session::get('error') !!}',
        confirmButtonColor: "#196AC8",   
    });
  </script>
@endif
<script>
  $(function () {
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-yellow',
      radioClass   : 'iradio_flat-yellow'
    })
    var p = true;
    $('.see-password').click(function(){
      if (p==true) {
        $('#input-password').attr('type','text');
        p = false
      }else if (p==false) {
        $('#input-password').attr('type','password');
        p = true
      }
    })
  });
</script>