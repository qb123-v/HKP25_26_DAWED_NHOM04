<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập quản trị</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .box-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 13px;
        }
    </style>
</head>

<body class="">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="width: 400px;">
            <form method="post" action="{{ route('admin.login.post')  }}" novalidate>
                @csrf
                <h4 class="text-center mb-4">Đăng nhập Admin</h4>
                <div class="mb-3">
                    <label for="username" class="form-label">Tài khoản</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                    @error('username')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Mật khẩu</label>

                    <div class="box-password position-relative">
                        <input type="password" class="form-control password-input" id="password" name="password"
                            value="{{ old('password') }}">
                        <div class="box-icon">
                            <button type="button" class="btn p-0 border-0 bg-transparent text-black toggle-password">
                                <i class="fa-solid fa-eye eye-icon"></i>
                            </button>
                        </div>
                    </div>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark w-100 btn-lg">Đăng nhập</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.querySelector('.toggle-password');
            const passwordInput = document.querySelector('.password-input');
            const icon = document.querySelector('.eye-icon');

            toggleBtn.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                if (type === 'text') {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>

</html>