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
            min-height: 100vh;/* Gradasi baru: Hijau gelap ke hijau yang lebih cerah di pojok */
            background: 
            radial-gradient(circle at top right, #008f5d 0%, transparent 40%),
            radial-gradient(circle at bottom left, #008f5d 0%, transparent 40%),
            #004d32; /* Warna dasar hijau tua */
            background-attachment: fixed;
        }

        .login-container {
            display: flex;
            background-color: #008a5e;
            border-radius: 30px;
            overflow: hidden;
            width: 850px;
            max-width: 95%;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
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
            margin-left: 10px;
            gap: 30px;
            margin-bottom: 30px;
        }

        .btn-login {
            background-color: #006341;
            color: white;
            margin-left: 70px;
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
            background-image: url('{{ asset("images/kopi.png") }}');
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
                <span style="white-space: nowrap;">Role :</span>
                <select name="role">
                    <option value="admin">Admin</option>
                    <option value="superadmin">Super Admin</option>
                </select>
            </div>

            <button type="submit" class="btn-login">LOGIN</button>

        </form>
    </div>

    <div class="login-image-section">
        <div class="image-card"></div>
    </div>

</div>

</body>
</html>