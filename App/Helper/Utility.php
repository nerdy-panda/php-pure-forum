<?php
function databaseConnector(string $driver , string $host , string $port , string $database , string $username , string $password , string $charset , ?array $options = null):PDO {
    $dsn = "$driver:host=$host;port=$port;dbname=$database;charset=$charset;";
    return new PDO($dsn,$username,$password,$options);
}
function ltrDump(...$items){
    echo "<div style='direction: ltr ; text-align: left;'>";
    dump(...$items);
    echo "</div>";
}

function issueFormData(): array
{
    return [
        $_POST["uName"],
        $_POST["uMail"],
        $_POST["uMobile"],
        $_POST["uQuestion"]
    ];
}
function fullNameValidator(string $value,array &$bag):bool{
    $result = [];

    $alias = "نام";
    $min = ISSUE_FULL_NAME_MIN_LENGTH;
    $max = ISSUE_FULL_NAME_MAX_LENGTH ;

    $result[] = strNotEmpty($value,$alias,$bag);
    $result[] = strHasMinLength($value,$min,$alias,$bag);
    $result[] = strMaxLength($value,$max,$alias,$bag);
    return !in_array(false,$result);
}

function emailValidator(string $email , array &$bag): bool {
    $result = [];
    $alias = "ایمیل";

    $result[] = strNotEmpty($email,$alias,$bag);
    $result[] = strHasMinLength($email,12,$alias,$bag);
    $result[] = strMaxLength($email,128,$alias,$bag);
    $result[] = isEmail($email,$alias,$bag);
    return !in_array(false,$result);

}

function mobileValidator($mobile , array &$bag):bool {
    $result = [];
    $alias = "موبایل";

    $result[] = strNotEmpty($mobile,$alias,$bag);
    $result[] = isMobile($mobile,$alias,$bag);

    return !in_array(false,$result);
}

function messageValidator(string $value , array &$bag):bool {
    $result = [];
    $alias = "سوال";

    $result[] = strNotEmpty($value,$alias,$bag);
    $result[] = strHasMinLength($value,12,$alias,$bag);

    return !in_array(false,$result);
}

function issueFormValidator(string $fullName , string $email , string $mobile , string $message , array &$bag):bool {
    $result = [];
    $result[] = fullNameValidator($fullName,$bag);
    $result[] = emailValidator($email,$bag);
    $result[] = mobileValidator($mobile,$bag);
    $result[] = messageValidator($message,$bag);
    return !in_array(false,$result);
}
function notifyIssueOwner(string $fullName , string $email , string $phone):void {
    // @todo
    // dump($fullName,$email,$phone);
}
function ggMail(){
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = MAIL_HOST;
    $mail->SMTPAuth = true;
    $mail->Port = MAIL_PORT;
    $mail->Username = MAIL_USERNAME;
    $mail->Password = MAIL_PASSWORD;
    $mail->setFrom("info@ticketsystem.org");
    $mail->addAddress("vadodof499@nab4.com");
    $mail->Subject = "جوابی برای سوال شما در سیستم تیکت و پشتیبانی ارسال شده است !!!";
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";
    $mail->send();
}
function is_valid_status(bool $isAdmin , string $status):bool{
    $statuses = ["answered","publish"];
    if($isAdmin)
        $statuses[] = "pending";
    return in_array($status,$statuses);
}
function json_response_and_exit(mixed $response):never {
    echo json_encode($response);
    exit;
}
function bad_request_json_response(mixed $data):never {
    http_response_code(400);
    json_response_and_exit($data);
}
function unauthorize_json_response(mixed $data):never {
    http_response_code(401);
    json_response_and_exit($data);
}
function bad_request_if_is_invalid_ajax_request():void {
    if(is_valid_ajax_request())
        return ;
    bad_request_json_response([
        "message"=>"application cant accept this request !!! this endpoint only accept ajax request and should have action parameter and action parameter must be a valid action !!!"
    ]);
}
function no_implement_json_response(mixed $data):never {
    http_response_code(501);
    json_response_and_exit($data);
}
function ok_json_response(mixed $data):never {
    http_response_code(200);
    json_response_and_exit($data);
}
function unauthorize_if_is_not_login():void {
    if(!isLogin())
        unauthorize_json_response(["message" => "this request need to authentication !!! "]);
}
function bad_request_if_is_not_qmstr():void {
    if(!has_qmStr())
        bad_request_json_response(["message" => "for issue management you should pass qmstr parameter in post "]);
}
function bad_request_if_qmStr_operation_is_invalid(string $operation):void {
    if(!is_valid_qmStr_operation($operation))
        bad_request_json_response(["message" => "invalid operation for issue management !!!"]);
}
function ajax_issue_management():void {
    unauthorize_if_is_not_login();
    bad_request_if_is_not_qmstr();
    $fullOperations = $_POST["qmStr"];
    $operationSectors = explode("-",$fullOperations);
    $operation = strtolower($operationSectors[0]);
    $id = (int)str_safe($operationSectors[1]);
    bad_request_if_qmStr_operation_is_invalid($operation);
    switch ($operation){
        case "qmd":
            issue_ajax_management_delete_handler($id);
        case "qmpu":
            issue_ajax_management_publish_handler($id);
        case "qmpe" :
            issue_ajax_management_pending_handler($id);
        default :
            no_implement_json_response(["message" => "qmstr operator is valid but is not implement in the server !!!"]);
    }

}
function issue_ajax_management_delete_handler(int $id):never {
    $deleted = issue_delete($GLOBALS["databaseConnection"],$id);
    if($deleted)
        ok_json_response(["message" => "successfully deleted issue !!!"]);
    bad_request_json_response(["message" => "delete is fail !!!"]);
}
function issue_ajax_management_publish_handler(int $id):never {
    $connection = $GLOBALS["databaseConnection"];
    $hasAnswer = issue_has_answers($connection,$id);
    $updated = $hasAnswer ? issue_change_status_to_answered($connection,$id) : issue_change_status_to_published($connection,$id) ;
    if($updated)
        ok_json_response(["message" => "successfully published issue !!!"]);
    bad_request_json_response(["message" => "cant updated status to publish please check your request !!!"]);
}
function issue_ajax_management_pending_handler(int $id):never {
    $updated = issue_change_status_to_pending($GLOBALS["databaseConnection"],$id);
    if($updated)
        ok_json_response(["message" => "now issue status is pending !!!"]);
    bad_request_json_response(["message" => "cant change issue status to pending !!!! please check your request !!!"]);
}
function ajax_answer_management():never {
    unauthorize_if_is_not_login();
    bad_request_if_am_str_is_not_exists();
    $amStr = $_POST["amStr"];
    $amStrSectors = explode("-",$amStr);
    $operator = $amStrSectors[0];
    $issue = (int)$amStrSectors[1];
    $answer = (int)$amStrSectors[2];
    bad_request_if_am_operator_is_invalid($operator);
    switch ($operator){
        case "amd" :
            answer_ajax_management_delete_handler($answer,$issue);
        default :
            no_implement_json_response(["message" => "amStr operator is valid but server is not implement that !!!"]);
    }

}
function bad_request_if_am_str_is_not_exists():void {
    if(has_am_str() && am_str_has_valid_format())
        return;
    bad_request_json_response(["message" => "for answer management you should pass amStr in post data !!!"]);
}
function bad_request_if_am_operator_is_invalid(string $operator):void {
    $operators = ["amd"];
    if(in_array($operator,$operators))
        return;
    bad_request_json_response(["message" => "cant process this request because amStr operator is invalid !!!"]);
}
function answer_ajax_management_delete_handler(int $id ,int $issue):never {
    $connection = $GLOBALS["databaseConnection"];
    $deleted = answer_delete_and_change_issue_status_if_required($connection,$id,$issue);
    if($deleted)
        ok_json_response(["message" => "answer successfully removed in application !!!"]);
    bad_request_json_response(["message" => "remove process for answer is fail please check your request !!!"]);
}
