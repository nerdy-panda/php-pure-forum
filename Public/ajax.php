<?php require_once dirname(__DIR__)."/Include/Bootstrap.php"; ?>
<?php bad_request_if_is_invalid_ajax_request(); ?>
<?php
    $action = $_GET["action"];
    switch ($action){
        case "qm":
            ajax_issue_management();
        break;
        case "am" :
            ajax_answer_management();
        break;
        default :
            no_implement_json_response(["message" => "your action is valid but server is no implement this action !!!"]);
    }

?>


