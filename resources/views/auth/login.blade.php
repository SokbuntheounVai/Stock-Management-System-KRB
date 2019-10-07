<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>KHEMRAKBOT | ខេមរបុត្រ | </title>

  <!-- Bootstrap -->
  <link href="{{asset('plugin/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{asset('plugin/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{asset('plugin/nprogress/nprogress.css')}}" rel="stylesheet">
  <!-- Animate.css -->
  <link href="{{asset('plugin/animate.css/animate.min.css')}}" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="{{asset('css/custom.min.css')}}" rel="stylesheet">
</head>

<body class="login">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <form method="POST" action="{{ route('login') }}">
            {{csrf_field()}}
            <h1>User Login</h1>
            <div>
              <input type="text" class="form-control" placeholder="Username" name="username" required="" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Password" name='password' required="" />
            </div>
            @if(count($errors)>0)
            <p class="text-danger text-center">
              Invilid Username or Password!
            </p>
            @endif
            <div>
              <button class="btn btn-default submit" type="submit">Log in</button>
            </div>

            <div class="clearfix"></div>

            <div class="separator">

              <div class="clearfix">
              </div>
              <br />

              <div>
                <h1><i class="fa fa-write"></i> Stock Management System </h1>
                <p>©2016 All Rights Reserved. By KHEMRAKBOT | ខេមរបុត្រ . Privacy and Terms</p>
              </div>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</body>

</html>


<!-- {{bcrypt('admin123')}} -->