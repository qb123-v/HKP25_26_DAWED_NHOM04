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
```

Sau đó chạy:

```bash
php artisan migrate
```

---

## 🧩 Cài Đặt Frontend

```bash
npm install
```

---

## 🏃‍♂️ Chạy Dự Án

Chạy song song hai lệnh sau ở hai terminal khác nhau:

```bash
npm run dev
php artisan serve
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

Chạy song song hai lệnh sau ở hai terminal khác nhau:

Truy cập trình duyệt tại:  
👉 [http://localhost:8000/admin](http://localhost:8000/admin)

```bash
Tài khoản: admin
Mật khẩu: password123
```

---
