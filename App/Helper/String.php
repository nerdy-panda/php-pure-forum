<?php
function str_safe(string $value):string {
    return htmlspecialchars($value);
}
function str_notEmpty(string $value):bool {
    return strlen($value) != 0 ;
}
function str_prepend(string $subject , string $target):string {
    return $target.$subject;
}
function str_wrap(string $subject , string $wrapper):string {
    return $wrapper.$subject.$wrapper;
}
function str_wrap_by_quote(string $subject):string {
    return str_wrap($subject,"'");
}