<?php
function redirectTo(string $url):void {
    header("Location:".$url);
}
function redirectAndExit(string $url):void {
    redirectTo($url);
    exit();
}
function redirectToHome():void {
    redirectAndExit(url());
}
function redirectToHomeIfIsLogin():void {
    if(isLogin())
        redirectToHome();
}