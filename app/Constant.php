<?php 

/**
 * Config cho plugin
 */
define('ROOT', realpath(dirname(__FILE__) . '/../'));



define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] .'/../');

/** --- Environment --- **/
define('ENV_ENVIRONMENT', getenv("APP_ENV", 'dev'));   //dev, pro
define('BRAND_NAME', getenv("BRAND_NAME"));
define('BRAND_DOMAIN', getenv("BRAND_DOMAIN"));
define('DOMAIN_WEB', getenv("FRONTEND_HOST"));

/** Các DB sử dụng **/
define('DB_DATA', 'data');
define('DB_LOG', 'log');

/** ======= Cac kieu du lieu add vao form ======= **/
define('DATA_STRING', 0);   //Kieu String
define('DATA_INTEGER', 1);  //Kieu Integer
define('DATA_DOUBLE', 2);   //Kieu Double
define('DATA_EMAIL', 3);    //Kieu Email can validate
define('DATA_TIME', 4);

define('DATA_FORM', 0); //Du lieu duoc lay tu form
define('DATA_VARIABLE', 1); //Du lieu duoc lay tu bien
define('DATA_DEFAULT', 2); //Du lieu duoc lay mặc định
/** ======= End of cac kieu du lieu add vao form ======= **/

/** --- Giới tính --- **/
define('SEX_MALE', 1);
define('SEX_FEMALE', 2);
define('SEX_UNISEX', 3);

/** --- Các kiểu dữ liệu dùng trong class DataTable --- **/
define('TAB_TEXT', 1);    //Kieu Text
define('TAB_NUMBER', 2);    //Kieu số
define('TAB_ARRAY', 3);     //Kiểu mảng danh sách
define('TAB_IMAGE', 4); //Kiểu hiển thị ảnh
define('TAB_DATE', 5);  //Kiểu hiển thị ngày tháng
define('TAB_CHECKBOX', 6);  //Kiểu checkbox
define('TAB_SELECT_MULTI', 7);  //Kiểu select 2 multi
define('TAB_DATE_TIME', 8);  //Kiểu hiển thị ngày tháng có thêm giờ 
define('TAB_RANGE_PRICE', 9);  //Kiểu hiển thị box nhập giá
define("TAB_ACTION", 10);
define("TAB_MODAL", 11);

/** Các kiểu get dữ liệu dùng cho hàm getValue **/
define('GET_STRING', 'str');
define('GET_INT', 'int');
define('GET_DOUBLE', 'dbl');
define('GET_ARRAY', 'arr');

define('GET_GET', 'GET');
define('GET_POST', 'POST');
define('GET_SESSION', 'SESSION');
define('GET_COOKIE', 'COOKIE');
define('GET_JSON', 'JSON');
define('GET_CMD', '_CMD');

/** --- Các kiểu dữ liệu dùng để lưu log --- **/
define('FIELD_TEXT', 1);   //Kiểu trường lưu log dạng text
define('FIELD_DATABASE', 2);    //Kiểu trường lưu log cần lấy ra text theo ID của 1 bảng trong database
define('FIELD_CONSTANT', 3);    //Kiểu trường lưu log dạng lấy theo constant
define('FIELD_TIME', 4);

/** --- Mật khẩu mặc định khi tạo tk Admin --- **/
define('PWD_DEFAULT', '123456');

/** --- Các biến khác --- **/
define('CURRENT_TIME', time());

/** Số lượng ID tối đa cho 1 bảng lưu log **/
define('LOG_AMOUNT_ID', 5000);

/** --- MÃ thông báo API --- **/
define('RES_ERROR', 422); // Trường hợp return các lỗi
define('RES_SUCCESS', 200); // Trường hợp return data thành công 
define('RES_TOKEN_EXPIRE', 401); // Access token hết hiệu lực
define('RES_REDIRECT', 302);    //Redirect đến 1 URL
define('RES_SYSTEM_ERROR', 500);

/*Chế độ truy cập*/
define('MODE_ACTION_CMD', 'cmd');
define('MODE_ACTION_API', 'api');
define('MODE_ACTION_FRONTEND', 'frontend');
define('MODE_ACTION_INDEX', 'index');

/*Đường dẫn upload/show tệp tin*/
define('UPLOAD_PATH_PRODUCT_IMG', '../public/uploads/picture/product/');
define('SHOW_PATH_PRODUCT_IMG', '/uploads/picture/product/');
define('UPLOAD_PATH_IMG', '../public/uploads/picture/main/');
define('SHOW_PATH_IMG', '/uploads/picture/main/');

/* Kích thước ảnh */
define('SIZE_LARGE', 'large');
define('SIZE_MEDIUM', 'medium');
define('SIZE_SMALL', 'small');
define('SIZE_SMALL_LEST', 'smalllest');

/* Các loại giảm giá */
define('PROMOTION_MONEY', 1);
define('PROMOTION_PERCENT', 2);

/* Nhóm ctv */
define('CTV_BASIC', 0);
define('CTV_SPECIAL', 1);

/* Các loại thuộc tính sản phẩm */
define('PRODUCT_ATTR_INT', 1);
define('PRODUCT_ATTR_TEXT', 2);
define('PRODUCT_ATTR_LIST', 3);

/** --- Các kiểu ghi Log --- **/
define('LOG_CREATE', 1);    //Log create record
define('LOG_UPDATE', 2);    //Log update
define('LOG_VIEW', 3);  //Log các hành động view
define('LOG_DELETE', 4);

/** --- Loại danh mục --- **/
define('CATEGORY_PRODUCT', 0);    //Sản phẩm default
define('CATEGORY_POST', 1);    //Bài viết

/** --- Loại danh mục --- **/
define('BANNER_HOME_1', 1);
define('BANNER_HOME_2', 2);
define('BANNER_HOME_3', 3);
define('BANNER_HOME_4', 4);
define('BANNER_HOME_5', 5);
define('BANNER_MOBILE_6',6);

/** --- Loại sàn TMĐT --- **/
define('ECOMMERCE_STORE_TIKTOK', 1);

define('ECOMMERCE_MAPPING_PRODUCT', 1);
define('ECOMMERCE_MAPPING_PRODUCT_VARIATION', 2);
define('ECOMMERCE_MAPPING_PRODUCT_IMAGE', 3);


// Loại trang
define("PAGE_PRODUCT_CATEGORY", 1);
define("PAGE_PRODUCT_DETAIL", 2);
define("PAGE_PRODUCT_DETAIL_VARIANT", 3);
define("PAGE_BLOG_CATEGORY", 4);
define("PAGE_BLOG_DETAIL", 5);
define("PAGE_SINGLE", 6);
define("PAGE_CART_SUCCESS", 7);
define("PAGE_CART_CHECKOUT", 8);

// Loại nội dung sp
define("PRODUCT_CONTENT_WEB", 0);
define("PRODUCT_CONTENT_TIKTOK", 1);

define("STATUS_INACTIVE", 0);
define("STATUS_ACTIVE", 1);

define("GROUP_MKT", 1);
define("GROUP_SALE", 2);

define("EX_CARD_VISION_DISTANCE", 1);
define("EX_CARD_VISION_NEUTRAL", 2);
define("EX_CARD_VISION_READING", 3);

define("EX_CARD_EYEWEAR_SINGLE", 1);
define("EX_CARD_EYEWEAR_BIFOCAL", 2);
define("EX_CARD_EYEWEAR_PROGRESSIVE", 3);
define("EX_CARD_EYEWEAR_SET", 4);
define("EX_CARD_EYEWEAR_CONTACT_LENS_SOFT", 5);
define("EX_CARD_EYEWEAR_CONTACT_LENS_HARD", 6);

/** --- Kiểu giảm giá của voucher --- **/
define('VOUCHER_TYPE_PERCENT', 1);  //Giảm theo %
define('VOUCHER_TYPE_MONEY', 2);    //Giảm theo số tiền

define('CFG_CURRENT_TIME', time());
// define('IMAGE_BASE_URL', );
