<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>SIMAK | Login</title>
        <link rel="icon" href="{{ asset('img/simak_icon.png') }}" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>

    <body>

        <div class="login-card">
            <div class="login-form">
                <h3>Input Your Credentials</h3>
                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="#" class="text-decoration-none">Forgot Password?</a>
                    </div>

                    <button type="submit" id="loginButton" class="btn btn-gradient w-100 mb-3">Login</button>
                </form>
            </div>

            <div class="login-image"></div>
        </div>

        <script src="{{ asset('js/login.js') }}"></script>
        
    </body>
</html>
