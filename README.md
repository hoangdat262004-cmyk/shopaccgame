# Shop Acc Game (SHOPGAMING)

Đây là mã nguồn website bán tài khoản game (Shop Acc Game) được xây dựng trên nền tảng PHP với kiến trúc MVC (Model-View-Controller) tự viết. Hệ thống hỗ trợ đầy đủ các tính năng cho một shop bán nick game, bán hòm thư ngẫu nhiên (Túi mù/Random), vòng quay may mắn, và hệ thống tiếp thị liên kết (Affiliate).

## Các Tính Năng Nổi Bật

### 1. Dành Cho Khách Hàng (User)
- **Đăng ký / Đăng nhập:** Quản lý tài khoản cá nhân, đổi mật khẩu.
- **Nạp Tiền:** Hỗ trợ nạp tiền qua thẻ cào (Tích hợp API gachthe1s).
- **Mua Tài Khoản (Nick):**
  - Mua nick bình thường.
  - Mua "Túi mù" (Random acc) - Khách hàng sẽ nhận được 1 mã số ngẫu nhiên kèm tài khoản/mật khẩu bên trong.
- **Giỏ hàng:** Thêm các tài khoản vào giỏ hàng và thanh toán cùng lúc.
- **Tiếp thị liên kết (Affiliate):** Lấy link giới thiệu để nhận phần trăm hoa hồng khi người khác mua hàng.
- **Lịch sử giao dịch:** Xem lịch sử nạp tiền, lịch sử mua nick, lịch sử chơi minigame, rút tiền.

### 2. Dành Cho Quản Trị Viên (Admin)
- **Quản lý Danh Mục (Categories):** Hỗ trợ danh mục cha và danh mục con (VD: Nick Tự Chọn -> Liên Quân).
- **Quản lý Tài Khoản (Accounts):** 
  - Thêm, sửa, xóa tài khoản game.
  - Hỗ trợ đăng nhiều mã số (nick con) vào trong cùng 1 sản phẩm (dành cho tính năng Túi mù).
  - Cho phép tải ảnh bìa riêng cho từng nick con.
  - Tính năng xóa nhiều nick cùng lúc.
- **Quản lý Giao Dịch & Nạp Tiền:** Theo dõi biến động số dư của người dùng.
- **Quản lý Minigame & Cày Thuê:** Thiết lập phần thưởng vòng quay, quản lý đơn cày thuê.

## Hướng Dẫn Cài Đặt (Cho Localhost/Hosting)

### Bước 1: Cấu hình Cơ Sở Dữ Liệu (Database)
1. Tạo một cơ sở dữ liệu MySQL trắng (Ví dụ: `shopaccgame`).
2. Import file SQL chứa cấu trúc và dữ liệu mẫu (nếu có) vào database vừa tạo.
3. Mở file `app/core/config.php` và cấu hình thông số kết nối Database:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', ''); // Mật khẩu database của bạn
   define('DB_NAME', 'shopaccgame');
   ```

### Bước 2: Cấu hình Đường Dẫn (BASEURL)
Mở file `app/core/config.php` và thay đổi hằng số `BASEURL` thành tên miền hoặc đường dẫn thư mục của bạn:
```php
// Ví dụ trên localhost:
define('BASEURL', 'http://localhost/shopaccgame');

// Ví dụ trên Hosting thật:
define('BASEURL', 'https://hoangdatth.id.vn');
```

### Bước 3: Đẩy Code Lên Hosting
- Tải toàn bộ source code này lên thư mục public của hosting (thường là `public_html` hoặc `htdocs`).
- Đảm bảo file `.htaccess` ở thư mục gốc hoạt động (chuyển hướng request vào thư mục `public/`).

## Cấu Trúc Thư Mục (MVC)
- `app/controllers/`: Chứa các bộ điều khiển logic (Admin, Home, Account, Payment, ...).
- `app/models/`: Chứa các lớp giao tiếp với Database (UserModel, AccountModel, ...).
- `app/views/`: Chứa giao diện HTML/CSS/JS được chia thành các phần (`home`, `admin`, `account`, ...).
- `app/core/`: Chứa các tệp lõi của hệ thống (App.php để điều hướng, Controller.php để tải view/model, Database.php để kết nối PDO).
- `public/`: Thư mục công khai chứa file `index.php` (điểm truy cập duy nhất), CSS, JS, và thư mục `uploads/` (nơi lưu trữ hình ảnh tải lên).

## Lưu ý về Cổng Thanh Toán
Hiện tại, logic nạp thẻ cào trong file `app/controllers/Payment.php` đang được đặt ở **Chế độ Nạp Test** (Giả lập thành công 100% để phục vụ việc kiểm thử). 
Khi bạn muốn website hoạt động chính thức và kết nối thật với API `gachthe1s`, hãy mở file `app/controllers/Payment.php` ra, bỏ comment đoạn mã CURL gọi API và comment lại đoạn giả lập.

## Hỗ Trợ
Nếu có bất kỳ thay đổi nào ở Localhost, hãy nhớ Upload các file đã thay đổi lên Hosting (đặc biệt là các thư mục `app/controllers`, `app/views`, `app/models` và `public/uploads`) để cập nhật tính năng mới nhất.
