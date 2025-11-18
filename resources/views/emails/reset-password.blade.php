<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Đặt lại mật khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn {
            display: inline-block;
            background: #007bff;
            color: white !important;    
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Đặt lại mật khẩu</h2>
        <p>Xin chào,</p>
        <p>Bạn đã yêu cầu đặt lại mật khẩu. Vui lòng nhấn nút bên dưới để tiếp tục:</p>
        <p class="text-center">
            <a href="{{ $url }}" class="btn">Đặt lại mật khẩu</a>
        </p>
        <p>Nếu bạn không yêu cầu, vui lòng bỏ qua email này.</p>
        <p><strong>Link sẽ hết hạn sau 15 phút.</strong></p>
        <hr>
        <p style="color: #888; font-size: 12px; text-align: center;">
            &copy; {{ date('Y') }} YourApp. All rights reserved.
        </p>
    </div>
</body>

</html>
