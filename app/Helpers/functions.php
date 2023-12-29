<?php

if (!function_exists('currency_format')) {
   function currency_format($number, $suffix = 'đ') {
        if (!empty($number)) {
   return number_format($number, 0, ',', '.') . "{$suffix}";
   }
}
};



// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value
function CallAPI($method, $url, $data = false, $token = '')
{
    $headers = [];

    // Khỏi tạo
    $curl = curl_init();

    // Đính kèm data để gửi đi
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;

        case "IMG":
            curl_setopt($curl, CURLOPT_POST, 1);
            $headers[] = "content-disposition: attachment; filename={$data["slug"]}.jpg; cache-control: no-cache";
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data["image"]);
            break;

        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    if(!empty($token)) {
        $headers[] = "Authorization: Bearer ". $token;
    }

    if(!empty($headers)) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }

    //Chỉ định url của api
    curl_setopt($curl, CURLOPT_URL, $url);


    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

function raw_image($url){
    $ch = curl_init ($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
    $raw=curl_exec($ch);
    curl_close ($ch);
    return $raw;
}

function generate_random_string($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generate_order_code() {
    $value  = substr(date('Y'), -1); // Lấy số cuối của năm
    $value .= date('md'); // Lấy tháng - ngày
    $value .= rand(1001, 9999);
    return $value;
}


function show_money($money, $symbol = '₫') {
    return format_number($money) . '' . $symbol;
}

function is_dev_environment()
{
    if (getenv('APP_ENV') !== "production") {
        return true;
    }

    return false;
}

function flattenArray($array) {
    $result = [];

    foreach ($array as $item) {
        if (is_array($item)) {
            $result = array_merge($result, flattenArray($item));
        } else {
            $result[] = $item;
        }
    }

    return $result;
}
function filterOutSetValues($array) {
    $newArray = [];
    foreach ($array as $key => $value) {
        if (!isset($value)) {
            $newArray[$key] = $value;
        }
    }
    return $newArray;
}



function trimPrefix($str)
{
    return preg_replace('/^\//', '', $str);
}

/**
 * is_product_environment()
 * Check dev OR pro environment.
 *
 * @return boolean
 */
function is_product_environment()
{
    if (getenv("APP_ENV") === 'production') {
        return true;
    }

    return false;
}

/**
 * getValue()
 * Lấy giá trị của 1 input
 *
 * @param mixed  $value_name:   Tên của input
 * @param string $data_type:    GET_INT, GET_STRING, GET_DOUBLE, GET_ARRAY
 * @param string $method:       GET_POST, GET_GET, GET_SESSION, GET_COOKIE
 * @param int    $default_value: Giá trị mặc định nếu ko có input $value_name
 * @param int    $advance:      1: removeInjection, 3: replaceQuot, 2: htmlspecialbo
 *
 * @return
 */
function getValue($value_name, $data_type = GET_INT, $method = GET_GET, $default_value = 0, $advance = 0)
{
    $value =   $default_value;

    switch ($method) {
        case GET_GET:
            if (isset($_GET[$value_name])) {
                $value = $_GET[$value_name];
            }
            break;

        case GET_POST:
            if (isset($_POST[$value_name])) {
                $value = $_POST[$value_name];
            }
            break;

        case GET_COOKIE:
            if (isset($_COOKIE[$value_name])) {
                $value = $_COOKIE[$value_name];
            }
            break;

        case GET_SESSION:
            if (isset($_SESSION[$value_name])) {
                $value = $_SESSION[$value_name];
            }
            break;

        case GET_JSON:
            $result = json_decode(file_get_contents('php://input'), true);
            if (isset($result[$value_name])) {
                $value = $result[$value_name];
            }
            break;

        case GET_CMD:
            if (isset($_REQUEST[GET_CMD][$value_name])) {
                $value = $_REQUEST[GET_CMD][$value_name];
            }
            break;

        default:
            if (isset($_GET[$value_name])) {
                $value = $_GET[$value_name];
            }
            break;
    }

    //Xử lý dữ liệu cho chuẩn
    switch ($data_type) {
        case GET_INT:
            $value  =   str_replace(',', '', $value);
            $value  =   (int)$value;
            if ("INF" == strval($value)) {  //Nếu số nằm ngoài phạm vi xử lý
                return 0;
            }
            break;

        case GET_STRING:
            $value  =   trim(strval($value));
            switch ($advance) {
                case 1:
                    //Remove injection cho cau query
                    $value = removeInjection($value);
                    break;
                case 2:
                    $value = replaceQuot($value);
                    break;
                case 3:
                    $value = htmlspecialbo($value);
                    break;
            }
            break;

        case GET_DOUBLE:
            $value  =   str_replace(',', '', $value);
            $value  =   (float)$value;
            if ("INF" == strval($value)) {
                return 0;
            }
            break;

        case GET_ARRAY:
            $value  =   (array) $value;
            break;
    }

    return $value;
}


/**
 * Convert 1 array chứa các ID thành các ID dạng Integer để tránh fake Injection
 * @return Array ID  
 **/
function get_integer_value_array($array_id)
{

    $list_id    =   [];
    foreach ($array_id as $id) {
        $list_id[]  =   (int)$id;
    }

    return $list_id;
}

/**
 * str_totime()
 * Convert time tu String sang Integer.
 *
 * @param string $string dd/mm/YYYY [H:i:s]
 *
 * @return integer
 */
function str_totime($string = '')
{
    $time_return    =   0;

    $string  =  trim($string);
    if ('' == $string) {
        return $time_return;
    }

    $string =   str_replace('-', '/', $string);

    //Bẻ dấu cách trong trường hợp có thêm giờ (dd/mm/YYY H:i:s)
    $arr_string     =   explode(' ', $string);
    $string_date    =   $arr_string[0];
    $string_hour    =   isset($arr_string[1]) ? $arr_string[1] : '';

    //Bẻ chuỗi ngày
    $arr_date   =   explode('/', $string_date);

    if (3 == count($arr_date)) {
        $day    =   (int) $arr_date[0];
        $month  =   (int) $arr_date[1];
        $year   =   (int) $arr_date[2];

        //Kiểm tra ngày hợp lệ thì convert
        if (checkdate($month, $day, $year)) {
            $time_return =   strtotime($month . '/' . $day . '/' . $year . ' ' . $string_hour);
        }
    }

    return intval($time_return);
}

/**
 * get_time_of_day()
 * Lay time unix cua 1 ngay theo H:i.
 *
 * @param mixed  $time  H:i
 * @param string $type: From or To, neu la from thi tinh tu 0 phut 0 giay, to thi tru di 1s de tinh 00:59s
 *                      VD: 8:00 - 9:00 thi se la 8:00:00 - 8:59:59
 *
 * @return Time unix tinh tu 00:00 cua 1 ngay
 */
function get_time_of_day($time, $type = 'from')
{
    //Tách dấu : để lấy giờ và phút rồi tính tổng thành số
    $exp    =   explode(':', $time);
    $hour   =   (int) trim($exp[0]) % 24;    //Tránh trường hợp nhập lớn hơn 24h;
    $minute =   (isset($exp[1]) ? (int) trim($exp[1]) % 60 : 0);

    $time_unix  =   $hour * 3600 + $minute * 60;
    //if ($type == 'to')  $time_unix  =   $time_unix - 1;

    return $time_unix;
}

/**
 * generate_time_from_date_range()
 * Generate ra integer time tu daterangepicker.
 *
 * @param mixed $date_range
 *
 * @return ['from' => from, 'to' => to]
 */
function generate_time_from_date_range($date_range, $end_day = true)
{
    $time_from  =   0;
    $time_to    =   0;

    $exp    =   explode('-', $date_range);
    if (isset($exp[0]) && isset($exp[1])) {
        $time_from  =   str_totime($exp[0]);
        $time_to    =   str_totime($exp[1]);
    }

    //Nếu thời gian truyền vào ko bao gồm Giờ:Phút mà lấy đến cuối ngày thì phải cộng với 86399
    $time_end   =   0;
    if ($end_day && 0 == intval(date('H', $time_to)) && intval(0 == date('i', $time_to))) {
        $time_end   =   86399;
    }

    return  [
        'from'  => $time_from,
        'to'    => $time_to + $time_end,
    ];
}

/**
 * Ham remove ky tu dac biet.
 */
function replaceFCK($string, $type = 0)
{
    $array_fck    = [
        "&Agrave;", "&Aacute;", "&Acirc;", "&Atilde;", "&Egrave;", "&Eacute;", "&Ecirc;", "&Igrave;", "&Iacute;", "&Icirc;",
        "&Iuml;", "&ETH;", "&Ograve;", "&Oacute;", "&Ocirc;", "&Otilde;", "&Ugrave;", "&Uacute;", "&Yacute;", "&agrave;",
        "&aacute;", "&acirc;", "&atilde;", "&egrave;", "&eacute;", "&ecirc;", "&igrave;", "&iacute;", "&ograve;", "&oacute;",
        "&ocirc;", "&otilde;", "&ugrave;", "&uacute;", "&ucirc;", "&yacute;",
    ];
    $array_text    = [
        "À", "Á", "Â", "Ã", "È", "É", "Ê", "Ì", "Í", "Î",
        "Ï", "Ð", "Ò", "Ó", "Ô", "Õ", "Ù", "Ú", "Ý", "à",
        "á", "â", "ã", "è", "é", "ê", "ì", "í", "ò", "ó",
        "ô", "õ", "ù", "ú", "û", "ý",
    ];
    if (1 == $type) {
        $string = str_replace($array_fck, $array_text, $string);
    } else {
        $string = str_replace($array_text, $array_fck, $string);
    }

    return $string;
}
/**
 * removeAttributeHTML().
 *
 * @param mixed  $html
 * @param string $attribute
 *
 * @return
 */
function removeAttributeHTML($html, $attribute = "style")
{
    $result = preg_replace('/' . $attribute . '\s*=\s*(\'|").+(\'|")/i', '', $html);

    return $result;
}

/**
 * remove_all_attribute_html()
 * Remove tat cac cac attribute cua chuoi html.
 *
 * @param mixed $html
 *
 * @return
 */
function remove_all_attribute_html($html)
{
    return preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i", '<$1$2>', $html);
}

/**
 * replaceJS().
 *
 * @param mixed $text
 *
 * @return
 */
function replaceJS($text)
{
    $arr_str = ["\'", "'", '"', "&#39", "&#39;", chr(10), chr(13), "\n"];
    $arr_rep = [" ", " ", '&quot;', " ", " ", " ", " "];
    $text          = str_replace($arr_str, $arr_rep, $text);
    $text          = str_replace("    ", " ", $text);
    $text          = str_replace("   ", " ", $text);
    $text          = str_replace("  ", " ", $text);

    return $text;
}
/**
 * replaceMQ().
 *
 * @param mixed $text
 *
 * @return
 */
function replaceMQ($text)
{
    $text    = str_replace("\'", "'", $text);
    $text    = str_replace("'", "''", $text);

    return $text;
}
/**
 * removeInjection()
 * Remove cac ki tu injection.
 *
 * @param mixed $text
 *
 * @return string
 */
function removeInjection($text)
{
    $text   =   str_replace("\\", "", $text);
    $text   =   str_replace("\'", "'", $text);
    $text   =   str_replace("'", " ", $text);
    $text   =   str_replace(";", " ", $text);
    $text   =   str_replace("=", " ", $text);
    $text   =   trim($text);

    return $text;
}
/**
 * htmlspecialbo().
 *
 * @param mixed $str
 *
 * @return
 */
function htmlspecialbo($str)
{
    $arrSearch     = ['<', '>', '\"', '"'];
    $arrReplace    = ['&lt;', '&gt;', '&quot;', '&quot;'];
    $str        = str_replace($arrSearch, $arrReplace, $str);

    return $str;
}

/** --- Close or Reload when close thickbox --- **/
function close_tb_window($remove_el = '')
{
    $str    =   '<script type="text/javascript">';

    //Nếu có xóa element của parent
    if ('' != $remove_el) {
        $str .= 'var el_remove = parent.document.getElementById("' . $remove_el . '");
                    el_remove.parentNode.removeChild(el_remove);';
    }

    $str .= 'window.parent.tb_remove();
                </script>';
    echo    $str;
    exit();
}

/**
 * reload_parent_window()
 * Reload parent
 * @param string $el
 * @return void
 */
function reload_parent_window($el = '')
{
    echo '<script type="text/javascript">
            parent.location.href = parent.location.href' . ($el != '' ? ' + "?' . $el . '"' : '') . ';
         </script>';
    exit();
}

function limit_text($text, $limit, $more_link = "")
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...' . $more_link;
    }
    return $text;
}

/**
 * removeAccent()
 * Replace cac ky tu Tieng Viet thanh ko dau.
 *
 * @param mixed $str
 *
 * @return string Chuoi ko dau
 */
function removeAccent($str)
{
    $marSearch    =    [
        "à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ",
        "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ",
        "ì", "í", "ị", "ỉ", "ĩ",
        "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ",
        "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
        "ỳ", "ý", "ỵ", "ỷ", "ỹ",
        "đ",
        "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
        "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
        "Ì", "Í", "Ị", "Ỉ", "Ĩ",
        "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
        "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
        "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
        "Đ",
        "'",
    ];
    $marReplace    =    [
        "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a",
        "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
        "i", "i", "i", "i", "i",
        "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o",
        "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
        "y", "y", "y", "y", "y",
        "d",

        "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A",
        "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
        "I", "I", "I", "I", "I",
        "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O",
        "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U",
        "Y", "Y", "Y", "Y", "Y",
        "D",
        "",
    ];

    return str_replace($marSearch, $marReplace, $str);
}

/**
 * removeTitle()
 * Generate ra chuoi ko dau de phuc vu cho URL.
 *
 * @param mixed  $string
 * @param string $keyReplace
 *
 * @return string noi-dung-cua-chuoi-return
 */
function removeTitle($string)
{
    $string =   removeAccent($string); //CHuyển các ký tự ko dấu
    $string =   trim(preg_replace("/[^A-Za-z0-9]/i", " ", $string));
    $string =   str_replace(" ", "-", $string);
    for ($i = 1; $i < 5; ++$i) {
        $string =   str_replace("--", "-", $string);
    }
    $string =   str_replace("/", "-", $string);

    return strtolower($string);
}

/**
 * removeHTML().
 *
 * @param mixed $string
 * @param bool  $keytab
 *
 * @return
 */
function removeHTML($string, $keytab = true)
{
    $string = preg_replace('/<script.*?\>.*?<\/script>/si', ' ', $string);
    $string = preg_replace('/<style.*?\>.*?<\/style>/si', ' ', $string);
    $string = preg_replace('/<.*?\>/si', ' ', $string);
    $string = str_replace('&nbsp;', ' ', $string);
    $string = mb_convert_encoding($string, "UTF-8", "UTF-8");
    if ($keytab) {
        $string = str_replace([chr(9), chr(10), chr(13)], ' ', $string);
    }
    $string =   trim($string);
    for ($i = 0; $i <= 5; ++$i) {
        $string = str_replace('  ', ' ', $string);
    }

    return $string;
}

/**
 * removeLink().
 *
 * @param mixed $string
 *
 * @return
 */
function removeLink($string)
{
    $string = preg_replace('/<a.*?\>/si', '', $string);
    $string = preg_replace('/<\/a>/si', '', $string);

    return $string;
}

/**
 * Replace dau nhay trong textbox.
 */
function replaceQuot($string)
{
    $string = str_replace('\"', '"', $string);
    $string = str_replace("\'", "'", $string);
    $string = str_replace("\&quot;", "&quot;", $string);
    $string = str_replace("\\\\", "\\", $string);

    $arrSearch     = ['<', '>', '\"', '"'];
    $arrReplace    = ['&lt;', '&gt;', '&quot;', '&quot;'];
    $string     = str_replace($arrSearch, $arrReplace, $string);

    return $string;
}

/**
 * removeScript()
 * Remove cac the script.
 *
 * @param mixed $string
 *
 * @return string
 */
function removeScript($string)
{
    $string = preg_replace('/<script.*?\>.*?<\/script>/si', ' ', $string);
    $string = preg_replace('/on([a-zA-Z]*)=".*?"/si', ' ', $string);
    $string = preg_replace('/On([a-zA-Z]*)=".*?"/si', ' ', $string);
    $string = preg_replace("/on([a-zA-Z]*)='.*?'/si", " ", $string);
    $string = preg_replace("/On([a-zA-Z]*)='.*?'/si", " ", $string);

    return $string;
}

/**
 * Ham remove cac ky hieu <,> cua tag HTML.
 */
function htmlspecialTag($str)
{
    $arrSearch     = ['<', '>', '"'];
    $arrReplace    = ['&lt;', '&gt;', '&quot;'];
    $str        = str_replace($arrSearch, $arrReplace, $str);

    return $str;
}

function get_number($val)
{
    return (float)str_replace(',', '', $val);
}

/**
 * round_number().
 *
 * @param mixed $number
 *
 * @return
 */
function round_number($number)
{
    $value   =  round($number / 1000) * 1000;

    return $value;
}

/**
 * format_number().
 *
 * @param mixed  $number
 * @param int    $num_decimal
 * @param string $split
 *
 * @return
 */
function format_number($number, $num_decimal = 2, $split = ".")
{
    $number = get_number($number);
    $break_thousands    =    $split;
    $break_retail          =    ("." == $split ? "," : ".");
    $return             = number_format($number, $num_decimal, $break_thousands, $break_retail);
    $stt                = -1;
    for ($i = $num_decimal; $i > 0; --$i) {
        ++$stt;
        if (0 == intval(substr($return, -$i, $i))) {
            $return = number_format($number, $stt, $break_thousands, $break_retail);
            break;
        }
    }

    return $return;
}

/**
 * replace_keyword()
 * Xoa cac ky tu nguy hiem cua tu khoa search.
 *
 * @param mixed $keyword
 * @param int   $lower
 *
 * @return string $keyword
 */
function replace_keyword($keyword, $lower = true)
{
    if ($lower) {
        $keyword   =   mb_strtolower($keyword, "UTF-8");
    }

    //Remove các ký tự phá ngoặc SQL
    $keyword   =   replaceMQ($keyword);

    //Các ký tự sẽ bị xóa khỏi keyword
    $arrRep     =   ["'", '"', "-", "+", "=", "*", "?", "/", "!", "~", "#", "@", "%", "$", "^", "&", "(", ")", ";", ":", "\\", ".", ",", "[", "]", "{", "}", "‘", "’", '“', '”'];
    $keyword    =   str_replace($arrRep, " ", $keyword);

    //Xóa các dấu cách đôi thành dấu cách đơn
    for ($i = 1; $i < 5; ++$i) {
        $keyword    =   str_replace("  ", " ", $keyword);
    }

    return trim($keyword);
}

/**
 * generate_array_keyword()
 * Tach keyword ra thanh mang chua cac tu khoa rieng le.
 *
 * @param string $keyword
 *
 * @return $array_keyword = ['tu', 'khoa', 'tim', 'kiem']
 */
function generate_array_keyword($keyword = "", $max_word = 10)
{
    $array_keyword  =   [];

    /** --- Xóa các ký tự ko cho phép --- **/
    //$keyword    =   replace_keyword($keyword);

    //Tìm kiếm cả ko dấu
    $keyword_kodau  =   removeAccent($keyword);

    //Nếu chuỗi ko dấu khác với chuỗi gốc thì mới nối vào
    if ($keyword_kodau != $keyword) {
        $keyword    =   $keyword . " " . $keyword_kodau;
    }

    //Bẻ chuỗi
    $break  =   explode(' ', $keyword);
    $i      =   0;
    foreach ($break as $word) {
        $word   =   trim($word);
        //Chỉ tìm kiếm với các từ có từ 2 chữ cái trở lên
        if (mb_strlen($word, 'UTF-8') > 1) {
            $array_keyword[]    =   $word;
            ++$i;
            //Từ khóa tìm kiếm tối đa là 10 thôi
            if (10 == $i) {
                break;
            }
        }
    }

    return $array_keyword;
}

/**
 * cutstring()
 * Cat mot chuoi theo so luong ky tu.
 *
 * @param mixed  $str
 * @param mixed  $length
 * @param string $char:  Ky tu noi them vao phan bi cat di
 *
 * @return string
 */
function cutstring($str, $length, $char = "...")
{
    $strlen =   mb_strlen($str, "UTF-8");
    if ($strlen <= $length) {
        return $str;
    }

    $substr =   mb_substr($str, 0, $length, "UTF-8");

    //Neu doan vua cat ket thuc bang dau cach thi return luon
    if (" " == mb_substr($str, $length, 1, "UTF-8")) {
        return $substr . $char;
    }

    //Cat dau cach cuoi cung
    $strPoint   =   mb_strrpos($substr, " ", "UTF-8");

    //Return string
    if ($strPoint < $length - 20) {
        return $substr . $char;
    } else {
        return mb_substr($substr, 0, $strPoint, "UTF-8") . $char;
    }
}

/**
 * alert().
 *
 * @param string $str
 *
 * @return void
 */
function alert($str = "")
{
    header('Content-Type: text/html; charset=utf-8');
    echo  '<script> alert("' . $str . '"); </script>';
}

/**
 * get_domain_name()
 * Lay ten mien cua URL (Ten mien chinh).
 *
 * @param mixed $url  (VD https://sub.ten.domain.com)
 * @param bool  $tld: Co lay subdomain hay ko
 *
 * @return string domain.com
 */
function get_domain_name($url, $tld = false)
{
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $m)) {
        return (true === $tld) ? substr($m['domain'], false !== ($pos = strpos($m['domain'], '.')) ? $pos + 1 : 0) : $m['domain'];
    }

    return '';
}

/**
 * get_url_symbol_query()
 * Lay ky tu de noi query cua URL.
 *
 * @param mixed $url
 *
 * @return ? OR & OR ''
 */
function get_url_symbol_query($url)
{
    $symbol =   '';

    if (false !== strpos($url, '?')) {
        if ('?' != substr($url, -1) && '&' != substr($url, -1)) {
            $symbol =   '&';
        }
    } else {
        $symbol =   '?';
    }

    return $symbol;
}

/**
 * get_root_path()
 * Lay thu muc root cua domain ().
 *
 * @return root path: D:/xampp/htdocs/GoBig/BigCRM/...
 */
function get_root_path()
{
    return APP_PATH_ROOT;
}

/**
 * save_log().
 *
 * @param mixed $filename (Bao gom extension)
 * @param mixed $content
 *
 * @return void
 */
function save_log($filename, $content, $info = true)
{
    $log_path   =  $_SERVER["DOCUMENT_ROOT"] . '/log/';
    $file_path  =  $log_path . $filename;

    $handle  =   @fopen($file_path, "a");
    //Nếu ko được thì mở thêm ../
    if (!$handle) {
        $handle = @fopen($_SERVER["DOCUMENT_ROOT"] . '/../log/' . $filename, "a");
    }

    //Nếu 2 lần mà ko mở được thì exit
    if (!$handle) {
        die('Cannot save log!');
    }

    if ($info) {
        $content =  date("d/m/Y H:i:s") . " " . $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"] . "\n" . "IP:" . @$_SERVER['REMOTE_ADDR'] . "\n" . $content;
    }

    fwrite($handle, $content . "\n=======================================================\n");
    fclose($handle);
}

/**
 * create_file()
 * Tao mot file tren he thong.
 *
 * @param mixed $file_name: Bao gom ca extension + [Path]
 * @param mixed $content
 *
 * @return void
 */
function create_file($file_name, $content)
{
    $path       =   $_SERVER["DOCUMENT_ROOT"];
    $path_file  =   $path . $file_name;

    $handle =   fopen($path_file, "w+");
    //Nếu ko được thì mở thêm lần nữa
    if (!$handle) {
        $handle =   fopen($path_file, "w+");
    }

    //Nếu 2 lần mà ko mở được thì exit
    if (!$handle) {
        save_log('error_create_file.cfn', 'File error: ' . $path_file);
    }

    fwrite($handle, $content);
    fclose($handle);
}




/**
 * get_current_page()
 * Lay trang hien tai.
 *
 * @param string $param
 *
 * @return int $current_page
 */
function get_current_page($param = 'page')
{
    $current_page   =   getValue($param);
    if ($current_page < 1) {
        $current_page   =   1;
    }
    if ($current_page > 999999) {
        $current_page   =   999999;
    }

    return $current_page;
}

/**
 * encode_base_json()
 * Encode mot array thanh chuoi Json.
 *
 * @param mixed $array
 *
 * @return string json
 */
function encode_base_json($array = [])
{
    if (!empty($array)) {
        $string  =  base64_encode(json_encode($array));

        return $string;
    }

    return '';
}

/**
 * decodeBaseJson()
 * Decode 1 chuoi json thanh array.
 *
 * @param mixed $string
 *
 * @return array
 */
function decode_base_json($string)
{
    if ('' != $string) {
        $string  =  base64_decode($string);
        $return  =  json_decode($string, true);

        if (is_array($return)) {
            return $return;
        }
    }

    return [];
}

/**
 * convert_type_phone()
 * Convert so DT từ dạng +84 thành 0 và ngược lại.
 *
 * @param mixed $phone
 * @param int $type 0 | 84
 *
 * @return boolean
 */
function convert_type_phone($phone, $type = 0)
{

    $phone      =   clear_phone_number($phone);

    //Phần check này phải đảo nguộc với check ở hàm validate_phone
    $type_validate  =   $type == 84 ? 0 : 84;

    $validate   =   validate_phone($phone, $type_validate);

    if ($validate) {
        if ($type == 84) {
            $phone = '84' . (int)$phone;
        } else {
            $phone = preg_replace('/^84/', '0', $phone);
        }
    }

    return $phone;
}

/**
 * get_microtime()
 * Lay thoi gian hien tai de tinh toan thoi gian load trang.
 *
 * @return
 */
function get_microtime()
{
    list($usec, $sec) =  explode(" ", microtime());

    return (float) $usec + (float) $sec;
}

/**
 * show_time_load()
 * Hiển thị thời gian load trang.
 *
 * @param mixed $time
 *
 * @return
 */
function show_time_load($time)
{
    return '<p class="time_load">Time: ' . $time . '</p>';
}

/**
 * get_extension()
 * Lay duoi file.
 *
 * @param mixed $filename
 *
 * @return string
 */
function get_extension($filename)
{
    $ext =   substr($filename, strrpos($filename, ".") + 1);

    return    strtolower($ext);
}

/**
 * generate_checkbox_icon()
 * Generate ra icon cua truong checkbox.
 *
 * @param mixed $value
 *
 * @return
 */
function generate_checkbox_icon($value)
{
    $icon   =   '<i class="' . (1 == $value ? 'fas fa-check-square' : 'far fa-square') . '"></i>';

    return $icon;
}

/**
 * clear_phone_number()
 * Remove cac ky tu cua so DT.
 *
 * @param mixed $phone
 *
 * @return string phone
 */
function clear_phone_number($phone)
{
    $char_remove    =   ['.', '-', ' '];
    foreach ($char_remove as $char) {
        $phone  =   str_replace($char, '', $phone);
    }

    return $phone;
}

/**
 * get_url()
 * Get URL va loai tru cac param.
 *
 * @param mixed $remove_param
 * @param boo   $domain:      Co lay domain hay ko
 *
 * @return
 */
function get_url($remove_param = ['page'], $domain = false)
{
    //Lấy REQUEST_URI
    $url_full   =   $_SERVER['REQUEST_URI'];

    //Bẻ ký tự ? để lấy URL gốc
    $break      =   explode('?', $url_full);
    $url_return =   $break[0] .'?';
    $param      =   $_GET;

    //Loại bỏ param
    foreach ($remove_param as $p) {
        if (isset($param[$p])) {
            unset($param[$p]);
        }
    }

    //Mảng chứa các param để sinh ra chuỗi URL
    // $arr_string =   [];

    // foreach ($param as $k => $v) {
    //     $arr_string[]   =   $k . '=' . str_replace('&', ' ', $v);
    // }

    if (!empty($param)) $url_return .= http_build_query($param);

    //Nếu có lấy domain
    if ($domain) {
        $url_return    =   substr(base_url(), 0, -1) . $url_return;
    }

    //return URL
    return $url_return;
}

/**
 * show_count_down()
 * Generate ra noi dung countdown.
 *
 * @param mixed  $time
 * @param string $text_now
 *
 * @return
 */
function show_count_down($time, $text_now = '')
{
    $str_return =   '';

    //String được hiển thị ra nếu đã quá thời gian hẹn
    if ('' == $text_now) {
        $text_now   =   'Gọi ngay bây giờ!';
    }

    //Show countdown nếu chưa đến hẹn
    if ($time > time()) {
        $str_return =   '<p class="countdown" data-time="' . date('Y/m/d H:i:s', $time) . '"></p>';
    } elseif ($time > 0) {
        $str_return =   '<p>' . date('d/m/Y H:i', $time) . '</p>';
        $str_return .= '<p><span class="badge bg-red">' . $text_now . '</span></p>';
    }

    return $str_return;
}

if (!function_exists('dd')) {
    function dd($data, $allow_boss = true)
    {
        dump($data, $allow_boss);
        die;
    }
}

if (!function_exists('range_today')) {
    function range_today()
    {
        return [
            'start' => strtotime(date("Y-m-d 00:00:00")),
            'end'   => strtotime(date("Y-m-d 23:59:59")),
        ];
    }
}

if (!function_exists('range_month')) {
    function range_month()
    {
        $firstDate = date("Y-m-01 00:00:01");

        return [
            'start' => strtotime($firstDate),
            'end'   => time(),
        ];
    }
}

if (!function_exists('value_to_key')) {
    function value_to_key($items, $key)
    {
        $data  = [];
        $items = (array) $items;
        foreach ($items as $item) {
            $data[$item[$key]] = $item;
        }

        return $data;
    }
}

if (!function_exists('array_to_value_select')) {
    function array_to_value_select($items, $key, $v)
    {
        $data  = [];
        $items = (array) $items;
        foreach ($items as $item) {
            $data[$item[$key]] = $item[$v];
        }

        return $data;
    }
}

function is_true($val, $return_null = false)
{
    $boolval = (is_string($val) ? filter_var($val, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) : (bool) $val);
    return ($boolval === null && !$return_null ? false : $boolval);
}

/**
 * generate_pagebar()
 * Generate ra doan phan trang
 * @param mixed $total_page
 * @param integer $current_page
 * @return html
 */
function generate_pagebar($total_page, $current_page = 1, $page_name = 'page')
{
    if ($total_page > 1) {

        $page_start =   $current_page - 2;
        if ($page_start < 1)    $page_start =   1;

        //Đoạn html của các page
        $html_page  =   '<ul class="pagination">';
        $url        =   get_url();
        $url        .=  get_url_symbol_query($url);

        //Nếu trang hiện tại > 3 thì mới hiện nút "Đầu"
        if ($current_page > 3) {
            $html_page  .=  '<li class="paginate_button page-item previous">
                                <a class="page-link" href="' . $url . $page_name .'=1' . '">Trang đầu</a>
                            </li>
		                     <li class="paginate_button page-item"><span class="page-link">...</span></li>';
        }

        //2 Trang liền trước của trang hiện tại
        for ($i = $page_start; $i < $current_page; $i++) {
            $html_page  .=  '<li class="paginate_button page-item">
                                <a class="page-link" href="' . $url . $page_name .'=' . $i . '">' . $i . '</a>
                            </li>';
        }

        //Trang hiện tại
        $html_page  .=  '<li class="paginate_button page-item active">
                            <a class="page-link" href="javascript:;">' . $current_page . '</a>
                        </li>';

        //2 Trang liền sau của trang hiện tại
        $next_2_page    =   $current_page + 2;
        if ($next_2_page > $total_page) $next_2_page  =   $total_page;
        for ($i = $current_page + 1; $i <= $next_2_page; $i++) {
            $html_page  .=  '<li class="paginate_button page-item">
                                <a class="page-link" href="' . $url . $page_name .'=' . $i . '">' . $i . '</a>
                            </li>';
        }

        //Nếu trang hiện tại nhỏ hơn tổng số trang tối thiểu là 3 page thì mới hiện nút Trang cuối
        if ($total_page - $current_page > 2) {
            $html_page  .=  '<li class="paginate_button page-item"><span class="page-link">...</span></li>
                            <li class="paginate_button page-item next" id="example2_next">
                				<a class="page-link" href="' . $url . $page_name .'=' . $total_page . '">Trang cuối</a>
                			</li>';
        }

        $html_page  .=  '</ul>';

        //Return HTML
        return $html_page;
    }
}
/**
 * array_get()
 * Lấy value trong array theo key tryền vào
 * @param array $input Mảng chứa dữ liệu
 * @param string $key Tên index cần lấy trong mảng, lấy value trong mảng đa triều index cách nhau bằng dấu . (key.key2)
 * @param mixed $default Giá trị mặc định khi không tìm thấy index chỉ định
 * @return mixed Giá trị của index
 */
if (!function_exists('array_get')) {
    function array_get($input, $key = null, $default = null)
    {

        if (is_null($key)) {
            return $input;
        }

        $arr = explode('.', $key);
        foreach ($arr as $k) {
            $input = isset($input[$k]) ? $input[$k] : null;
        }

        if (is_null($input)) {
            return $default;
        }

        return $input;
    }
}

/**
 * get_sub_domain()
 * Lay sub ten mien cua URL hiện tại.
 *
 * @return string
 */
function get_sub_domain()
{
    // Split string into array 
    $arr = explode('.', $_SERVER["HTTP_HOST"]);

    // Get the first element of array 
    $subdomain = $arr[0];
    return $subdomain;
}

/**
 * Ẩn 1 dãy số trong chuỗi số điện thoại
 *
 * @param [str] $phone
 * @return void
 */
function hide_numbers_phone($phone)
{
    if (empty($phone)) return '';
    $phone = convert_type_phone($phone);
    for ($i = 4; $i < 7; $i++) {
        $phone = substr_replace($phone, "*", $i, 1);
    }
    return $phone;
}

/**
 * show_debug()
 * Show debug hay ko
 * @return bool
 */
function show_debug()
{
    return false;
}

/**
 * get_client_ip()
 * Get Client IP address
 * @return string IP
 */
function get_client_ip()
{
    $ipaddress = 'N/A';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

    $exp    =   explode(',', $ipaddress);

    return trim($exp[0]);
}

// Xóa ký tự " trong json
function remove_ktdb_json($text)
{
    $text = preg_replace('/\{\\"/', '|rmtmp1|', $text);
    $text = preg_replace('/\\":\\"/', '|rmtmp2|', $text);
    $text = preg_replace('/\\",\\"/', '|rmtmp3|', $text);
    $text = preg_replace('/\\"\}/', '|rmtmp4|', $text);

    $text = preg_replace('/\\"/', "'", $text);

    $text = preg_replace('/\|rmtmp1\|/', '{\"', $text);
    $text = preg_replace('/\|rmtmp2\|/', '\":\"', $text);
    $text = preg_replace('/\|rmtmp3\|/', '\",\"', $text);
    $text = preg_replace('/\|rmtmp4\|/', '\"}', $text);

    $text = stripslashes($text);
    return $text;
}



function pushValueToKey($data, $key = "id")
{
    $_item = [];
    foreach ($data as $datum) {
        $_item[$datum[$key]] = $datum;
    }
    return $_item;
}



/**
 * restruct_json_encoded()
 * Remove chuoi json bi loi thanh chuoi dung
 * @param mixed $string_json
 * @return string json
 */
function restruct_json_encoded($string_json)
{
    $string_json    =   str_replace('"[{"id"', '[{"id"', $string_json);
    $string_json    =   str_replace('"}]"', '"}]', $string_json);

    return $string_json;
}

function is_mobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

/** Define IP ở đây để dùng cho các Class và Controller **/
define('CFG_IP_ADDRESS', get_client_ip());  //IP address