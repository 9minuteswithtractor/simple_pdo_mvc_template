<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | BLOG</title>



</head>

<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f3f4f6; margin: 0;">
    <div style="width: 100%; max-width: 320px; background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center;">
        <h2 style="margin-bottom: 20px; color: #333;">Login</h2>
        <form action="/api/login" method="POST">
            <div class="login-form" style="margin-bottom: 15px; text-align: left;">
                <label for="username" style="display: block; font-size: 14px; color: #555;">Username</label>
                <input type="text" id="username" name="username" required
                    style="width: 93%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;">
            </div>

            <div style="margin-bottom: 15px; text-align: left;">
                <label for="password" style="display: block; font-size: 14px; color: #555;">Password</label>
                <input type="password" id="password" name="password" required
                    style="width: 93%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px;">
            </div>

            <button type="submit"
                style="width: 100%; max-width: 320px; background: black; color: white; font-size: large; padding: 20px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); ">
                Log In
            </button>
        </form>

        <p style=" margin-top: 15px; font-size: 14px; color: #555;">
            Don't have an account? <a href="/api/register" style="color: #2563eb; text-decoration: none;">Sign up</a>
        </p>
    </div>

</body>

</html>