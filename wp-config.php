<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
define('WP_MEMORY_LIMIT', '512M');
// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define('DB_NAME', 'thuycanh_gw');

/** Username của database */
define('DB_USER', 'thuycanh_admin');

/** Mật khẩu của database */
define('DB_PASSWORD', 'o-X[uGetl%lI');

/** Hostname của database */
define('DB_HOST', 'localhost');

/** Database charset sử dụng để tạo bảng database. */
define('DB_CHARSET', 'utf8');

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'RNiU-8r-ivsO/k^+H=+Kq/2}U&|^m;xH6S6m*/pmX+X7M7wsAg9dfR_zPx0;6V>C');
define('SECURE_AUTH_KEY',  '8{-&$)KzIe)A/N[$#Ky-aN7tGx!c8~{3R9lfB~Aw8>8a>45R,RJQ(FiL69SqB+?K');
define('LOGGED_IN_KEY',    'k!] x+0H<`jTwT+Jfiy|tk0/f.t[1cK+oCQt-rZe2_9_5l-IueX1~u-wpn9+b8Oe');
define('NONCE_KEY',        'E.Zc=3,-8+WfY%W*!X>qQCM7S3>>m;UT-K93T8#wVSQ0gM,8!6)N`tkkseV0r+kl');
define('AUTH_SALT',        '5#,h2zi^=[M)/CVi8L*VW-VrKe:<p[Kv0F8[xXNQ=>~s&Nj]R`j Zo_B{d@zW%Z&');
define('SECURE_AUTH_SALT', 'j9u,<ra$8`-R#.d4 _AYBp[U<su;B>OnbKjHx.YX;n:0sA1S9LeE9,O.-S&={[WY');
define('LOGGED_IN_SALT',   'dO21hNX4+ emzr?,$6+-^J1N_t*/j0tDyBg_c6k$H)P+kwmN$+/?`UA#a-&4{h<{');
define('NONCE_SALT',       '+d%H8VJT)6JtO%@/@COEQvAN_*>d-IX{xRYspFw>[z$;*6d4.&T`NODV g?@L-72');

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'gw_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
