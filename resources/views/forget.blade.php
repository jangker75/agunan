@include('tema.header')
<body class="body-login">
  <div class="container">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="box-kotak-login">
        <div class="ic-back-login">
            <a href="{{url('')}}"><img src="{{url('assets/image/ic-back.png')}}"></a>
        </div>
        <div class="header-box-login">
          <h3>Forget Password</h3>
          <p>Input your email address to <br> reset your password</p>
        </div>
        <form class="form-login">
          <div class="area-form">
            <div class="box-form-login">
              <label>Email Address</label>
              <input type="email" class="form-control form-input" placeholder="Email Address" name="">
            </div>
          </div>
          <br><br><br>
          <input type="submit" class="btn btn-primary" style="width: 100px" value="Submit">
        </form>
        
        
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 login-side-right">
      <h1>Lelang Agunan</h1>
    </div>
  </div>
</body>
@include('tema.script')
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