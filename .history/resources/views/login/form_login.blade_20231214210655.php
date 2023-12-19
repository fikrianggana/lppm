@extends('login.template_login') <!-- Ini menghubungkan file ini dengan template utama -->

@section('content') <!-- Mulai bagian konten yang akan dimasukkan ke dalam template utama -->

    <style>
        .password-toggle {
            cursor: pointer;
        }

        .input-group .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
    </style>

    <form action="{{ url('LoginController/login') }}" method="POST" autocomplete="off">
        @csrf
        <div class="polman-form-login">
            <h4>Login {{ config('app.title') }}</h4>
            <hr />

            <!-- Konten form login -->
            <div class="form-group">
            <label for="username">
                Username
                <span style="color: red;">*</span>
            </label>
            <input type="text" id="username" name="username" maxlength="10" class="form-control" required=""
                    oninvalid="this.setCustomValidity('Username Wajib Diisi')"
                    oninput="this.setCustomValidity('')">
            </div>

            <div class="form-group">
                <label for="password">
                    Password
                    <span style="color: red;">*</span>
                </label>
                <input id="password" type="password" name="password" class="form-control" required
                        oninvalid="this.setCustomValidity('Password Wajib Diisi')"
                        oninput="this.setCustomValidity('')">
            </div>

            <button id="btnLogin" class="btn btn-primary"style="width: 100%; margin-top: 10px; margin-bottom: 10px;">Masuk</button>
            <!-- <span style="margin-top: 10px;">Anda Mahasiswa Baru? <a href='{{ url('mahasiswa') }}'>Klik disini</a>.</span> -->
        </div>
    </form>

@endsection <!-- Akhir bagian konten -->

@section('scripts') <!-- Mulai bagian script yang akan dimasukkan ke dalam template utama -->

    <script type="text/javascript">
        function showAlert() {
            $("#txtUsername").effect("shake");
            $("#txtPassword").effect("shake");
        }

        function showAlertCaptcha() {
            $("#txtCaptcha").effect("shake");
        }
    </script>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("txtPassword");
            const showEye = document.getElementById("show_eye");
            const hideEye = document.getElementById("hide_eye");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                showEye.classList.add("d-none");
                hideEye.classList.remove("d-none");
            } else {
                passwordInput.type = "password";
                showEye.classList.remove("d-none");
                hideEye.classList.add("d-none");
            }
        }
    </script>

    <script src="https://www.google.com/recaptcha/api.js"></script>

    <script>
        function onSubmit(token) {
          document.getElementById("demo-form").submit();
        }
      </script>

      <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
      <script>
        function onClick(e) {
          e.preventDefault();
          grecaptcha.ready(function() {
            grecaptcha.execute('reCAPTCHA_site_key', {action: 'submit'}).then(function(token) {
                // Add your logic to submit to your backend server here.
            });
          });
        }
    </script>

@endsection <!-- Akhir bagian script -->
