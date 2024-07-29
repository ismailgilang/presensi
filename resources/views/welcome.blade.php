<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="shortcut icon" href="{{asset('foto/logo.png')}}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fff;
      color: #000;
    }

    .hidden {
      opacity: 0;
      transition: opacity 3s ease;
    }

    .login-container {
      height: 100vh;
    }

    .login-container .form-control {
      background-color: #f5f5f5;
      border-color: #ccc;
      color: #000;
    }

    .form-control::-webkit-input-placeholder {
      color: #000;
    }

    .card {
      background-color: #fff;
      border: none;
      border-radius: 15px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1), 0 6px 6px rgba(0, 0, 0, 0.1);
    }

    .card-header-logo {
      position: relative;
      margin-bottom: 20px;
    }

    .card-header-logo img {
      position: relative;
      top: -70px;
      border-radius: 50%;
    }

    .loading-container {
      text-align: center;
      position: absolute;
      width: 100%;
      height: 100vh;
      background-color: #fff;
      z-index: 99;
      transition: opacity 0.5s ease;
    }

    #loading-screen.hidden {
      opacity: 0;
      visibility: hidden;
    }

    .loading-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      opacity: 1;
      transition: opacity 0.5s;
    }

    .loading-container.hidden {
      opacity: 0;
    }

    .loader {
      display: flex;
      align-items: center;
    }

    .bar {
      display: inline-block;
      width: 10px;
      height: 100px;
      background-color: rgba(0, 0, 255, .5);
      border-radius: 10px;
      animation: scale-up4 1s linear infinite;
    }

    .bar:nth-child(1) {
      animation-delay: .30s;
    }

    .bar:nth-child(2) {
      height: 150px;
      margin: 0 15px;
      animation-delay: .45s;
    }

    .bar:nth-child(3) {
      height: 200px;
      animation-delay: .6s;
    }

    .bar:nth-child(4) {
      height: 150px;
      margin: 0 15px;
      animation-delay: .75s;
    }

    .bar:nth-child(5) {
      animation-delay: .90s;
    }

    @keyframes scale-up4 {
      20% {
        transform: scaleY(1.5);
      }

      40% {
        transform: scaleY(1);
      }
    }
  </style>
  <script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
</head>

<body>
  <div class="loading-container" id="loading-screen">
    <div class="loader" id="loading-screen">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>
  </div>
  <div class="container">
    <div class="row justify-content-center align-items-center login-container">
      <div class="col-md-5">
        <div class="card">
          <div class="card-body">
            <div class="card-header-logo text-center">
              <img src="{{asset('foto/logo.png')}}" alt="Logo" style="width: 120px;">
              <h2 class="text-center mb-6" style="position: relative; top:-30px">Login</h2>
            </div>
            <form action="{{url('proses_login')}}" method="POST" id="logForm">
              {{ csrf_field() }}
              @if ($errors->has('username_salah'))
              <div class="alert alert-danger">
                {{ $errors->first('username_salah') }}
              </div>
              @endif

              <!-- Menampilkan pesan error untuk password salah -->
              @if ($errors->has('password_salah'))
              <div class="alert alert-danger">
                {{ $errors->first('password_salah') }}
              </div>
              @endif

              <!-- Menampilkan pesan error untuk login gagal umum -->
              @if ($errors->has('login_gagal'))
              <div class="alert alert-danger">
                {{ $errors->first('login_gagal') }}
              </div>
              @endif
              <div class="mb-3">
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                  <input type="text" class="form-control" placeholder="Username" name="username">
                </div>
              </div>
              <div class="mb-3">
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
                  <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                  <span class="input-group-text" id="toggle-password"><i class="fas fa-eye"></i></span>
                </div>
              </div>
              <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script>
    window.addEventListener('load', function() {
      setTimeout(function() {
        const loadingScreen = document.getElementById('loading-screen');
        loadingScreen.classList.add('hidden');
      }, 2000);
    });
  </script>
  <script>
    document.getElementById('toggle-password').addEventListener('click', function() {
      const passwordField = document.getElementById('password');
      const passwordFieldType = passwordField.getAttribute('type');
      const eyeIcon = this.querySelector('i');

      if (passwordFieldType === 'password') {
        passwordField.setAttribute('type', 'text');
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
      } else {
        passwordField.setAttribute('type', 'password');
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
      }
    });
  </script>

</body>

</html>