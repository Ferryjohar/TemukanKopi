<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Temukan Kopi</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        /* Bagian Kiri (Form) */
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
            line-height: 1.1;
        }

        .divider {
            width: 100%;
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
            font-size: 16px;
            outline: none;
            color: #666;
        }

        .role-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .role-label {
            font-size: 16px;
            color: #444;
            white-space: nowrap;
        }

        .btn-login {
            background-color: #006341;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            width: 180px;
            transition: background 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            background-color: #004d32;
        }

        /* Bagian Kanan (Gambar) */
        .login-image-section {
            flex: 1;
            padding: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-card {
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&q=80&w=1000'); /* Gambar placeholder kopi */
            background-size: cover;
            background-position: center;
            border-radius: 25px;
        }

        /* Responsif untuk HP */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                width: 90%;
            }
            .login-image-section {
                display: none; /* Sembunyikan gambar di layar kecil */
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-form-section">
            <h1>temukan<br>kopi.</h1>
            <div class="divider"></div>
            
            <form action="proses_login.php" method="POST">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                
                <div class="role-container">
                    <span class="role-label">Role :</span>
                    <select name="role">
                        <option value="superadmin">Super Admin</option>
                        <option value="admin">Admin</option>
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