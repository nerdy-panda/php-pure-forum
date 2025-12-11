<?php
function is_ajax_request():bool {
    return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) &&
           strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest";
}
function isset_action():bool {
    return isset($_GET["action"]);
}
function has_action():bool {
    return isset_action() && str_notEmpty($_GET["action"]);
}
function is_valid_action():bool {
    $actions = ["qm","am"];
    return in_array($_GET["action"] , $actions);
}
function is_valid_ajax_request():bool {
    return is_ajax_request() && has_action() && is_valid_action() ;
}
function isset_qmStr():bool {
    return isset($_POST["qmStr"]);
}
function has_qmStr():bool {
    return isset_qmStr() && str_notEmpty($_POST["qmStr"]);
}
function is_valid_qmStr_operation(string $operation):bool {
    $operations = ["qmd","qmpu","qmpe"];
    return in_array($operation , $operations );
}
function isset_delete_answer():bool {
    return isset($_GET["delete"]);
}
function has_delete_answer():bool {
    return isset_delete_answer() && str_notEmpty($_GET["delete"]) && is_numeric($_GET["delete"]);
}
function isset_issue():bool {
    return isset($_GET["issue"]);
}
function has_issue():bool {
    return isset_issue() && str_notEmpty($_GET["issue"]) && is_numeric($_GET["delete"]);
}
function isset_am_str():bool {
    return isset($_POST["amStr"]);
}
function has_am_str():bool {
    return isset_am_str() && str_notEmpty($_POST["amStr"]);
}
function am_str_has_valid_format():bool {
    $pattern = "/^[a-z]+(-\d+){2}$/im";
    $amStr = $_POST["amStr"];
    return preg_match($pattern,$amStr);
}