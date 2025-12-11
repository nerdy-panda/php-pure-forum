<?php
function authentication(string $username , string $password):bool {
    return $username==ADMIN_USERNAME && $password == ADMIN_PASSWORD ;
}
function login():void {
    $_SESSION["login"] = true ;
}
function isLogin():bool {
    return isset($_SESSION["login"]);
}
function logout():void {
    unset($_SESSION["login"]);
}