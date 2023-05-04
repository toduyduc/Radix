<?php
if(!defined("_INCODE")) die("unauthorized access...");
if(isLogin()){
    $token = getSession('loginToken');
    delete('login_token',"token='$token'");
    removeSession('loginToken');
    redirect("admin/?module=auth&action=login");
}