<?php
function replaceViewSeparator(string $view):string {
    return str_replace(VIEW_DIRECTORY_SEPARATOR,DIRECTORY_SEPARATOR,$view);
}
function view(string $view,array $data = []):void {
    extract($data);
    require VIEW_DESTINATION.'/'.replaceViewSeparator($view).'.php';
}
function partial(string $partial , array $data=[]):void {
    view(PARTIAL_DIRECTORY.".".$partial,$data);
}
function component(string $component,array $data=[]):void {
    view(COMPONENT_DIRECTORY.".".$component,$data);
}
function componentByCondition(bool $condition , string $component,array $data=[]):void {
    if($condition)
        component($component,$data);
}
function componentIfLogin(string $component,array $data=[]):void {
    componentByCondition(isLogin(),$component,$data);
}
function selected_by_status(string $target):string {
    if(!has_status())
        return "";
    $status = $_GET["status"];
    return $status==$target ? "selected" : "";
}