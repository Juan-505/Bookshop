# HƯỚNG DẪN CHẠY DỰ ÁN BOOKSHOP (NEWCHAPTER)

Dự án này là website bán hàng sách cơ bản (Mini eCommerce) được xây dựng bằng framework **Laravel 11**, sử dụng cơ sở dữ liệu **MySQL** và **Vite** để compile giao diện.

---

## 🛠️ YÊU CẦU HỆ THỐNG
- **PHP**: 8.2 trở lên
- **Composer**: Quản lý thư viện PHP
- **NodeJS & npm**: Để build tài nguyên giao diện (Vite)
- **MySQL** (XAMPP)

---

## 🚀 CÁC BƯỚC CÀI ĐẶT & CHẠY DỰ ÁN

### 1. Cài đặt các thư viện PHP & NodeJS
Mở terminal tại thư mục dự án `bookshop/` và chạy các lệnh:

```bash
# Cài đặt thư viện Laravel
composer install

# Cài đặt thư viện Javascript
npm install
```

### 2. Cấu hình môi trường (`.env`)
- Sao chép file `.env.example` thành `.env`:
  ```bash
  cp .env.example .env
  ```
- Mở file `.env` vừa tạo và cập nhật cấu hình kết nối database của bạn. Ví dụ:
  ```env
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3307         # Cổng MySQL của tôi (3307)
  DB_DATABASE=bookshop
  DB_USERNAME=root
  DB_PASSWORD=         
  ```

- Khởi tạo APP KEY cho ứng dụng:
  ```bash
  php artisan key:generate
  ```

### 3. Nhập dữ liệu cơ sở dữ liệu (Database)
Dự án đi kèm file cơ sở dữ liệu mẫu `bookshop.sql` chứa cấu trúc và dữ liệu đầy đủ của sách, danh mục và người dùng:
1. Tạo một cơ sở dữ liệu mới trong MySQL có tên là `bookshop`.
2. Import file `bookshop.sql` (nằm ở thư mục cha hoặc thư mục dự án của bạn) vào cơ sở dữ liệu `bookshop` thông qua phpMyAdmin, Navicat hoặc dòng lệnh:
   ```bash
   mysql -u root -p bookshop < database/mysql/bookshop.sql
   ```

*(Lưu ý: Bạn cũng có thể chạy `php artisan db:seed` nếu muốn đặt lại hoặc khởi tạo dữ liệu mặc định).*

### 4. Build Assets (CSS & JS)
Để giao diện hiển thị đúng với thiết kế (sử dụng TailwindCSS và Javascript cho giỏ hàng):
```bash
# Build production bundle
npm run build
```

### 5. Chạy Local Server
Khởi động máy chủ phát triển của Laravel:
```bash
php artisan serve
```
Mở trình duyệt truy cập đường dẫn: **`http://127.0.0.1:8000`**

---

## 👤 TÀI KHOẢN DÙNG THỬ (TEST ACCOUNTS)

Hệ thống đã có sẵn 2 tài khoản phân quyền dùng thử:

1. **Tài khoản Admin (Quản trị viên)**
   - **Email**: `admin@bookshop.test`
   - **Mật khẩu**: `password`
   - *Quyền hạn*: Quản lý danh mục, quản lý sản phẩm (sách), quản lý danh sách & phân quyền user, quản lý & cập nhật trạng thái đơn hàng.

2. **Tài khoản User (Khách hàng)**
   - **Email**: `user@bookshop.test`
   - **Mật khẩu**: `password`
   - *Quyền hạn*: Xem danh sách sản phẩm, lọc/tìm kiếm sách, thêm vào giỏ hàng, đặt hàng (checkout), xem thông tin cá nhân và lịch sử đơn hàng tại Dashboard.

---

## ✨ CÁC CHỨC NĂNG CHÍNH ĐÃ HOÀN THÀNH

1. **Authentication (Đăng nhập / Đăng ký)**: Custom Auth, validate email độc nhất, mật khẩu tối thiểu 6 ký tự, mã hóa bảo mật, remember me, giới hạn số lần đăng nhập sai (Login throttling).
2. **Authorization (Phân quyền)**:
   - Sử dụng `RoleMiddleware` kiểm tra role người dùng.
   - Admin truy cập các route `/admin/*`. User thường chỉ được truy cập `/dashboard`.
3. **Danh mục & Sản phẩm (CRUD)**:
   - Admin CRUD đầy đủ cho Category & Product.
   - Chặn xóa danh mục khi còn chứa danh mục con hoặc sản phẩm. Chặn xóa sản phẩm khi đã có đơn hàng.
4. **Hiển thị & Tìm kiếm**: Lọc sản phẩm theo danh mục cha/con, tìm kiếm thông minh theo từ khóa tên sách.
5. **Giỏ hàng (Cart)**: Giỏ hàng dạng Session/LocalStorage dành cho khách chưa đăng nhập, tự động đồng bộ lên Database khi đăng nhập.
6. **Thanh toán (Checkout)**: Lưu thông tin người nhận, lưu snapshot sản phẩm để tránh ảnh hưởng khi giá sách thay đổi, bảo mật giao dịch bằng Database Transaction.
7. **Quản lý đơn hàng (Admin)**: Xem chi tiết đơn hàng, quản lý và chuyển đổi trạng thái đơn hàng (chờ xử lý, đang giao, đã giao, đã hủy...).
