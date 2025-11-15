# 🧭 Hướng Dẫn Chạy Đồ Án HKPDAW_Showbiz

## 🚀 Cài Đặt Ban Đầu

Mở **Terminal** và chạy lần lượt các lệnh sau:

```bash
# B1: Cài đặt thư viện PHP
composer install

# B2: Tạo file môi trường
cp .env.example .env

# B3: Tạo key cho ứng dụng
php artisan key:generate
```

---

## ⚙️ Cấu Hình APP_NAME

Mở file `.env` và chỉnh lại phần cấu hình như sau:

```dotenv
APP_NAME=HKPDAW_Showbiz
```

---

## ⚙️ Cấu Hình Database

Mở file `.env` và chỉnh lại phần cấu hình như sau:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=HKPDAW_Showbiz
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=0306221104@caothang.edu.vn
MAIL_PASSWORD=fblvbwgnpaishctm
MAIL_FROM_ADDRESS=0306221104@caothang.edu.vn
MAIL_FROM_NAME=HKP25_26_DAWED_NHOM04
```

Sau đó chạy:

```bash
php artisan migrate
```

---

## ⚙️ Thêm dữ liệu

Mở **Terminal** và chạy lệnh sau:

```bash
php artisan db:seed
```

---

## 🧩 Cài Đặt Frontend

```bash
npm install
```

---

## 🏃‍♂️ Chạy Dự Án

Chạy song song ba lệnh sau ở ba terminal khác nhau:

```bash
npm run dev
php artisan serve
php artisan queue:work
```

Truy cập trình duyệt tại:  
👉 [http://localhost:8000](http://localhost:8000)

---

## ⚠️ Lưu Ý Quyền Truy Cập Thư Mục

Nếu gặp lỗi quyền truy cập (permission denied) với `storage` hoặc `bootstrap/cache`, hãy chạy:

```bash
chmod -R 775 storage bootstrap/cache
```

---

✅ **Hoàn tất!**

---

## 🏃‍♂️ Truy cập vào trang quản trị


Truy cập trình duyệt tại:  
👉 [http://localhost:8000/admin](http://localhost:8000/admin)

```bash
Tài khoản: admin
Mật khẩu: password123
```

---
