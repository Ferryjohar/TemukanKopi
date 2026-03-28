<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Temukan Kopi</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #006341 0%, #004d32 100%);
        }

        .login-container {
            display: flex;
            background-color: #008a5e;
            border-radius: 30px;
            overflow: hidden;
            width: 850px;
            max-width: 95%;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .login-form-section {
            background-color: white;
            padding: 60px;
            flex: 1;
            border-radius: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h1 {
            font-family: 'Georgia', serif;
            font-size: 48px;
            margin: 0;
            color: #222;
        }

        .divider {
            height: 1px;
            background-color: #ccc;
            margin: 25px 0;
        }

        .input-group {
            margin-bottom: 15px;
        }

        input, select {
            width: 100%;
            padding: 12px 20px;
            border: 1px solid #999;
            border-radius: 25px;
        }

        .role-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .btn-login {
            background-color: #006341;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            width: 180px;
        }

        .btn-login:hover {
            background-color: #004d32;
        }

        .error {
            color: red;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .login-image-section {
            flex: 1;
            padding: 40px;
        }

        .image-card {
            width: 100%;
            height: 100%;
            background-image: url('{{ asset("images/kopi.jpg") }}');
            background-size: cover;
            border-radius: 25px;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            .login-image-section {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="login-form-section">
        <h1>temukan<br>kopi.</h1>
        <div class="divider"></div>

        {{-- ERROR LOGIN --}}
        @if(session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.login.proses') }}" method="POST">
            @csrf

            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="role-container">
                <span>Role :</span>
                <select name="role">
                    <option value="admin">Admin</option>
                    <option value="superadmin">Super Admin</option>
                </select>
            </div>

            <button type="submit" class="btn-login">LOGIN</button>

            @if(session('error'))
            <div style="color: red; margin-bottom: 10px;">
                {{ session('error') }}
            </div>
            @endif
        </form>
    </div>

    <div class="login-image-section">
        <div class="image-card"></div>
    </div>

</div>

</body>
</html>