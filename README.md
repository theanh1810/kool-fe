Cách triển khai webiste

- Cài đặt Laravel 8 và Xampp bản 7.4.33
+ Setting file .env 
  - Cài APP_URL = đường dẫn website
  - Cài APP_ASSET = đường đẫn truy cập thư mực Asset
  - Cài đặt port database, Ở đây sử dụng DB_PORT = 3308
  - Tạo database name và import database. Sau đó đổi DB_DATABASE = tên database name vừa tạo 
+ Setting thư viện:
  - cài đặt thư viện composer
  - Chạy lệnh composer install để cài đặt thư viện 
  - Chạy lệnh composer dump-autoload để cập nhật lại các lớp
  - Chạy lên php artisan key để cập nhật key vào APP_KEY
  - Sau đó chạy lệnh php artisan serve để chạy chương trình