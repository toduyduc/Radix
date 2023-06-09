<?php
if(!defined("_INCODE")) die("unauthorized access...");
if(!isLogin()){
    redirect('?module=auth&action=login');
}else{
    $userId = isLogin()['userId'];
    $userFullname = firstRow("SELECT fullname FROM users WHERE id=$userId");
    if(!empty($userFullname)){
        $userFullname = $userFullname['fullname'];
        
    }
    
}
saveActivity(); // lưu lại hoạt động cuối cùng của user
autoRemoveTokenLogin();

?>
<html>
<head>
    <title><?php echo !empty($data["pageTitle"])?$data["pageTitle"]:"unicode"; ?></title>
    <meta charset="utf-8"/>
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES; ?>/css/style.css?ver=<?php echo rand(); ?>">
</head>
<body>
<header>
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
                </li>

                </li>
                <li class="nav-item dropdown profile">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Hi, <?php echo $userFullname; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?php echo _WEB_HOST_ROOT.'?module=auth&action=logout'; ?>">Đăng xuất</a></li>
                </ul>
                </li>
            </ul>
            
            </div>
        </div>
        </nav>
    </div>
</header>
