<?php
if(!defined("_INCODE")) die("unauthorized access...");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function layout($layoutName="header",$dir='',$data=[]){
    if(!empty($dir)){
        $dir = '/'.$dir;
    }
    if(file_exists(_WEB_PATH_TEMPLATES.$dir."/layouts/".$layoutName.".php")){
        require_once _WEB_PATH_TEMPLATES.$dir."/layouts/".$layoutName.".php";
    }
}


// function gửi email
function sendMail($to,$subject,$content){
    //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                             //Send using SMTP                   
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'toduyduc0@gmail.com';                 //SMTP username
    $mail->Password   = 'bqlzscdnbvvkqlyx';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('toduyduc0@gmail.com', 'NgheAn');
    $mail->addAddress($to);     //Add a recipient
    
    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->charSet = 'UTF-8';                            
    $mail->Subject = $subject;
    $mail->Body    = $content;

    return $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

//hàm kiểm tra phương thức post
function isPost(){
    if($_SERVER["REQUEST_METHOD"]=="POST"){
       return true;
    }
    return false;
   }
   // hàm kiểm tra phương thức get
   
   function isGet(){
       if($_SERVER["REQUEST_METHOD"]=="GET"){
           return true;
       
        }
        return false;
   }
   
   // lấy giá trị của phương thức POST, GET
  
   function getBody($method=''){
    $bodyArr = [];
       if(empty($method)){
            if(isGet()){
                // xử lý chuổi trước khi hiển thị ra 
                if(!empty($_GET)){
                    foreach($_GET as $key=>$value){
                        $key=strip_tags($key);  //hàm loại bỏ thẻ html
                        if(is_array($value)){  // trường hợp value là 1 mảng
                                $bodyArr[$key] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY); // lọc biến thẻ html thành các ký tự dùng cho mảng
                        }else{   // ngược lại : value không phải là 1 mảng
                                $bodyArr[$key] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS);// lọc biến thẻ html thành các ký tự dùng khi không có mảng
                        }
                    }
                    
                }
            }
        
            if(isPost()){
                // xử lý chuổi trước khi hiển thị ra 
                if(!empty($_POST)){
                    foreach($_POST as $key=>$value){
                        $key=strip_tags($key);  //hàm loại bỏ thẻ html
                        if(is_array($value)){  // trường hợp value là 1 mảng
                                $bodyArr[$key] = filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
                        }else{   // ngược lại : value không phải là 1 mảng
                                $bodyArr[$key] = filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS);
                        }
                    }
                    
                }
            }
       }else{
            if($method=='get'){
                if(!empty($_GET)){
                    foreach($_GET as $key=>$value){
                        $key=strip_tags($key);  //hàm loại bỏ thẻ html
                        if(is_array($value)){  // trường hợp value là 1 mảng
                                $bodyArr[$key] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY); // lọc biến thẻ html thành các ký tự dùng cho mảng
                        }else{   // ngược lại : value không phải là 1 mảng
                                $bodyArr[$key] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS);// lọc biến thẻ html thành các ký tự dùng khi không có mảng
                        }
                    }
                    
                }
            }else{
                if($method=='post'){
                    if(!empty($_POST)){
                        foreach($_POST as $key=>$value){
                            $key=strip_tags($key);  //hàm loại bỏ thẻ html
                            if(is_array($value)){  // trường hợp value là 1 mảng
                                    $bodyArr[$key] = filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
                            }else{   // ngược lại : value không phải là 1 mảng
                                    $bodyArr[$key] = filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS);
                            }
                        }
                        
                    }
                }
            }
       }
       
       return $bodyArr;
   }
   
   // hàm kiểm tra email
   function isEmail($email){
       $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
       return $checkEmail;
   }
   
   // hàm kiểm tra số
   function isNumberInt($number, $range = []){
       // $range = [min_range=>1, max_range=20]
       if(!empty($range)){
           $options = ["options"=>$range];
           $checkNumber = filter_var($number,FILTER_VALIDATE_INT,$options);
   
       }else{
           $checkNumber = filter_var($number,FILTER_VALIDATE_INT);
       }
       return $checkNumber;
   }
   
   // hàm kiểm tra số thực
   function isNumberFloat($number, $range = []){
       // $range = [min_range=>1, max_range=20]
       if(!empty($range)){
           $options = ["options"=>$range];
           $checkNumber = filter_var($number,FILTER_VALIDATE_FLOAT,$options);
   
       }else{
           $checkNumber = filter_var($number,FILTER_VALIDATE_FLOAT);
       }
       return $checkNumber;
   }

   // kiểm tra số điện thoại bắt đầu bằng số 0 và nối tiếp là 9 số
function isPhone($phone){
    $checkFirstZero=false;
    if($phone[0]=="0"){
        $checkFirstZero=true;
        $phone = substr($phone,1);
    }

    $checkNumberLast = false;
    if(isNumberInt($phone) && strlen($phone)==9){
        $checkNumberLast = true;
    }
    if($checkFirstZero && $checkNumberLast){
        return true;
    }
    return false;
}

// tạo hàm thông báo
function getMsg($msg,$type="success"){
    if(!empty($msg)){
        echo '<div class="alert alert-'.$type.'">';
        echo $msg;
        echo '</div>';
    }
}

//hàm chuyển hướng
function redirect($path='index.php'){
    $url = _WEB_HOST_ROOT.'/'.$path;
    header("Location: $url");
    exit;
}

//hàm thông báo lỗi
function form_errors($fieldName,$errors,$firtsHtml='',$lastHtml='',$default=null){
    return (!empty($errors[$fieldName]))?$firtsHtml.reset($errors[$fieldName]).$lastHtml:$default;
    //hàm reset dùng để lấy phần tử lỗi đầu tiên của mảng
}

// hàm hiện thị dữ liệu cũ
function old($fieldName,$oldData,$default=null){
    return (!empty($oldData[$fieldName]))?$oldData[$fieldName]:$default;
}

// hàm kiểm tra trạng thái đăng nhập
function isLogin(){
    $checkLogin = false;
    if(getSession('loginToken')){
        $tokenSession = getSession('loginToken');
        $queryToken = firstRow("SELECT user_id FROM login_token WHERE token='$tokenSession'");
        if(!empty($queryToken)){
            // $checkLogin = true;
            $checkLogin = $queryToken;
        }else{
            removeSession('loginToken');
        }
    }
    
    return $checkLogin;
}

//tự động xóa token login nếu đăng xuất
function autoRemoveTokenLogin(){
    $allUsers = getData("SELECT * FROM users WHERE status='1'");
    if(!empty($allUsers)){
        foreach($allUsers as $user){
            $now = date('Y-m-d H:i:s');
            $before = $user['last_activity'];
            $diff = strtotime($now) - strtotime( $before);
            
            $diff = floor($diff/60);
            
            if($diff>=1){
                delete('login_token','user_id='.$user['id']);
            }
        }
    }
    
    // echo '<pre>';
    //     print_r($allUsers);
    // echo '</pre>';
}

// lưu lại thời gian cuối cùng hoạt động
function saveActivity(){
    $user_id = isLogin()['user_id'];
    update('users',['last_activity'=>date('Y-m-d H:i:s')],"id=$user_id");
}

//action menu sidebar
function activeMenuSidebar($module){
    if(!empty(getBody()['module']) && getBody()['module']==$module){
        return true;
    }
    return false;
    
}

// get link
function getLinkAdmin($module, $action = '',$params=[]){
    $url = _WEB_HOST_ROOT_ADMIN;
    $url = $url.'/?module='.$module;
    if(!empty($action)){
        $url.='&action='.$action;
    }
    if(!empty($params)){
        $paramsString = http_build_query($params);
        $url.='&'.$paramsString;
    }
    return $url;
}

//Format date
function getDateFormat($strDate,$format){
    $dateObject = date_create($strDate);
    if(!empty($dateObject)){
        return date_format($dateObject,$format);
    }
    return false;
}

// check font-awesome icon
function isFontIcon($input){
    $input = html_entity_decode($input);
    if(strpos($input,'<i class="')!==false){
        return true;
    }
    return false;
}


function getLinkQueryString($key,$value){
    $queryString = $_SERVER['QUERY_STRING'];
    $queryAll = explode('&',$queryString);
    $queryAll = array_filter($queryAll);
    $queryFinal = '';
    $check = false;
    if(!empty($queryAll)){
        foreach($queryAll as $item){
            $itemArr = explode('=',$item);
            if(!empty($itemArr)){
                if($itemArr[0] == $key){
                    $itemArr[1] = $value;
                    $check = true;
                }
            }
            $item=implode('=',$itemArr);
            $queryFinal.=$item.'&';
            
        }
    }
    if(!$check){
        $queryFinal.=$key.'='.$value;
    }
    
    if(!empty($queryFinal)){
        $queryFinal = rtrim($queryFinal,'&');
    }else{
        $queryFinal = $queryString;
    }
    return $queryFinal;
}

function setException($exception) {
    $debugError = getFlashData('debug_error');
    if(_DEBUG){
        setFlashData('debug_error',[
            'error_code' => $exception->getCode(),
            'error_message' =>$exception->getMessage(),
            'error_file' =>$exception->getFile(),
            'error_line' => $exception->getLine() 
        ]);

        $reload = getFlashData('reload');
        if(!$reload){
            setFlashData('reload',1);
            if(isAdmin()){
                redirect(getPathAdmin());
            }else{
                redirect(getPath());
            }
        }
    }else{
        //removeSession('reload');
        //removeSession('debug_error');
        require_once _WEB_PATH_ROOT."/modules/errors/500.php";
    }
    
}

function setErrorHandler($errno, $errstr, $errfile, $errline) {
    if(!_DEBUG){
        require_once _WEB_PATH_ROOT."/modules/errors/500.php";
        // removeSession('reload');
        // removeSession('debug_error');
    }
    setFlashData('debug_error',[
        'error_code' => $errno,
        'error_message' =>$errstr,
        'error_file' =>$errfile,
        'error_line' => $errline 
    ]);

    $reload = getFlashData('reload');
    if(!$reload){
        setFlashData('reload',1);
        if(isAdmin()){
            redirect(getPathAdmin());
        }else{
            redirect(getPath());
        }
    }
    //throw new ErrorException($errstr,$errno,1,$errfile,$errline);
}
function loadExceptionError(){
    $debugError = getFlashData('debug_error');
        if(!empty($debugError)){
            if(_DEBUG){
                require_once _WEB_PATH_ROOT."/modules/errors/exception.php";
            }else{
                require_once _WEB_PATH_ROOT."/modules/errors/500.php";
            }
        }
}

function getPathAdmin(){
    $path = 'admin';
    if(!empty($_SERVER['QUERY_STRING'])){
        $path.='?'.trim($_SERVER['QUERY_STRING']);
    }
    return $path;
}

function getPath(){
    $path='';
    if(!empty($_SERVER['QUERY_STRING'])){
        $path.='?'.trim($_SERVER['QUERY_STRING']);
    }
    return $path;
}
//hàm về kiểm tra trang hiện tại có phải là trang admin không
function isAdmin(){
    if(!empty($_SERVER['PHP_SELF'])){
        $currentFile = $_SERVER['PHP_SELF'];
        $dirFile = dirname($currentFile);
        $baseNameDir = basename($dirFile);
        if(trim($baseNameDir)=='admin'){
            return true;
        }
    }
    return false;
} 

function getOption($key,$type=''){
    $sql = "SELECT * FROM options WHERE opt_key='$key'";
    $option = firstRow($sql);
    if(!empty($option)){
        if($type=='label'){
            return $option['name'];
        }
        return $option['opt_value'];
    }
    return false;
}


//lấy số lượng liên hệ chưa được xử lý(status=0)
function getCountContacts(){
    $sql = "SELECT id FROM contacts WHERE status=0";
    $count = getRows($sql);
    return $count;
}

function head(){
    ?>
    <link rel="stylesheet" href="<?php echo _WEB_HOST_ROOT;?>/templates/core/css/style.css">
    <?php
}

function foot(){

}

function updateOption($data=[]){
    if(isPost()){
        $allFields = getBody();
        if(!empty($data)){
            $keyDataArr = array_keys($data);
            $valueDataArr = array_values($data);
            foreach($keyDataArr as $key=>$value){
                $allFields[$value] = $valueDataArr[$key];
            }
        }
       
        $countUpdate = 0;
        if(!empty($allFields)){
            foreach($allFields as $field=>$value){
                $condition = "opt_key = '$field'";
                $dataUpdate = [
                    'opt_value'=>trim($value)
                ];
                $updateStatus=update('options',$dataUpdate,$condition);
                if($updateStatus){
                    $countUpdate++;
                }
            }
        }
        if($countUpdate>0){
            setFlashData("msg",'Đã cập nhật thành công '.$countUpdate.' bản ghi');
            setFlashData("msg_type","success");
        }else{
            setFlashData("msg","Cập nhật không thành công !");
            setFlashData("msg_type","danger");
        }
        redirect(getPathAdmin());
    }
}

function loadError($name='404'){
    $pathError = _WEB_PATH_ROOT.'/modules/errors/'.$name.'.php';
    require_once $pathError;
    die();
}

function getYoutubeId($url){
    $result = [];
    $urlStr = parse_url($url,PHP_URL_QUERY);
    parse_str($urlStr,$result);
    if(!empty($result['v'])){
        return $result['v'];
    }
    return false;
}

//hàm cắt theo chữ
function getLimitText($content,$limit=10){
    $content = strip_tags($content);
    $content = trim($content);
    $contentArr = explode(' ',$content);
    $contentArr = array_filter($contentArr);
    $wordsNumber = count($contentArr); // tra ve sl phan tu mang
    if($wordsNumber>$limit){
        $contentArrLimit = explode(' ',$content,$limit+1);
        array_pop($contentArrLimit);
        $limitText = implode(' ',$contentArrLimit).'...';
        return $limitText;
    }
    return $content;
}

function setView($id){
    $blogCount = firstRow("SELECT view_count FROM blog WHERE id=$id");
    $check = false;
    if(!empty($blogCount)){
        $view = $blogCount['view_count'];
        $view++;
        $check = true;
    }else{
        if(is_array($blogCount)){
            $view = 1;
            $check = true;
        }
    }
    if($check){
        //echo $view;
        update('blog',['view_count'=>$view],"id=$id");
    }
}