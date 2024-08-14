<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <style>
        .container{
            margin-top: 90px;
        }
        .login {
            padding: 10px;
            margin: auto;
            max-width: 650px;
            width: 100%;
            background: #fff;
            border-radius: 7px;
            box-shadow: 5px 5px 10px rgba(0,0,0,0.3);
            margin-bottom: 20px;
        }
        .login h2 {
            font-weight: 700;
            text-align: center;
            margin: 20px;
        }
        .login-form {
            padding: 2rem;
        }
        .login-form input {
            height: 50px;
            width: 100%;
            padding: 0 15px;
            font-size: 17px;
            margin-bottom: 1.3rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            outline: none;
        }
        .login-form input:focus {
            box-shadow: 0 1px 0 rgba(0,0,0,0.2);
        }
        .login-form a {
            font-size: 16px;
            color: #1e1f29;
            text-decoration: none;
        }
        .login-form a:hover {
            text-decoration: underline;
        }
        .login-form input.button {
            color: #fff;
            background: #1e1f29;
            font-size: 1.2rem;
            font-weight: 500;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.4s;
        }
        .login-form input.button:hover {
            background: #575b83;
        }
        .login1 {
            font-size: 17px;
            text-align: center;
        }
        .login1 a {
            color: #a02c2c;
            cursor: pointer;
        }
        .login1 a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login">
            <h2>Admin Login</h2>
            <div class="login-form">
                <form action="{{ route('login-p') }}" method="POST">
        
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <label for="email">Email:</label>
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        placeholder="name@example.com"
                        required
                    />

                    <label for="password">Password:</label>
                    <input
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        placeholder="Password"
                        required
                    />
                    <input type="submit" class="button" value="Login" />
                </form>
                <div class="login1">
                    <span>
                        Don't have an account?
                        <a href="/register">Register</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
