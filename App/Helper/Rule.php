<?php
function strNotEmpty(string $value , string $field , array &$bag):bool {
    if(strlen($value) >= 1)
        return true ;
    $bag[] = "فیلد $field نمیتواند خالی باشد !!!";
    return false;
}
function strHasMinLength(string $value , int $min , string $field , array &$bag):bool {
    if(strlen($value) >= $min)
        return true ;
    $bag[]= "فیلد ".$field." حداقل باید دارای ".$min." کاراکتر باشد !!!";
    return false;
}
function strMaxLength(string $value , int $max , string $field , array &$bag):bool {
    if(strlen($value) <= $max )
        return true ;
    $bag[] = "حداکثر تعداد کاراکتر مجاز برای فیلد $field $max کاراکتر میباشد !!!";
    return false ;
}
function isEmail(string $value, string $field ,array &$bag):bool {
    $isEmail = filter_var($value,FILTER_VALIDATE_EMAIL);
    if($isEmail)
        return true;
    $bag[] = "ساختار فیلد $field باید شبیه به ساختار ایمیل باشد !!!";
    return false;
}
function isMobile(string $value , string $field , array &$bag){
    $pattern = "/\d{11}|\+98\d{10}/m";
    $isMobile = preg_match($pattern,$value);
    if($isMobile)
        return true;
    $bag[] = "ساختار فیلد $field باید شبیه به ساختار موبایل باشد !!!";
    return false;
}


