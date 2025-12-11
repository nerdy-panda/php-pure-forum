<?php use App\Enum\IssueStatus ; ?>
<?php
function storeIssueAction(array &$payload, array &$messageBag){
    if(isset($_POST["submitQuestion"])){
        $issueData = issueFormData();
        $issueData = array_safeStrings($issueData);
        list($fullName,$email,$mobile,$issueText) = $issueData ;
        $issueValidationResult = issueFormValidator(
            $fullName,$email,$mobile,$issueText,$messageBag["error"]
        );

        if($issueValidationResult){
            $stored = issue_store($GLOBALS["databaseConnection"],$fullName,$email,$mobile,$issueText);
            if($stored)
                $messageBag["success"][] = "سوال شما با موفقیت در سیستم ثبت شد و پس از تایید نمایش داده میشود !!!";
            else
                $messageBag["error"][] = "خطایی در هنگام ثبت سوال در سیستم رخ داد لطفا مجددا تلاش فرمایید !!!";
        }
        $payload["issueFormValidation"] = $issueValidationResult;
    }
}

function logoutAction():void {
    if(isset($_GET["logout"])){
        logout();
    }
}
function loginAction(array &$messageBag):void {
    if(isset($_POST["login"])){
        list($username , $password)  = array_values($_POST);
        $authenticate = authentication($username,$password);
        if($authenticate){
            login();
            redirectToHome();
        }
        $messageBag["error"][] = "نام کاربری و یا گذرواژه اشتباه میباشد !!!";
    }
}
function storeAnswerAction(array &$bag):void {
    if(isset($_POST["submitAnswer"])){
        $issue = str_safe($_POST["qid"]);
        $answer = str_safe($_POST["text"]);
        /** @var PDO $connection */
        $connection = $GLOBALS["databaseConnection"];

        $connection->beginTransaction();
        answer_store($connection,$issue,$answer);
        issue_change_status_to_answered($connection,$issue);
        $commited = $connection->commit();
        if($commited){
            $bag["success"][] = "پاسخ سوال با موفقیت در سیستم ثبت شد !!!";
            $contactInfo = issue_get_contact_info($connection,$issue);
            notifyIssueOwner($contactInfo["full_name"] , $contactInfo["email"] , $contactInfo["phone"]);
        }else {
            $connection->rollBack();
            $bag["error"][] = "متاسفانه مشکلی در ثبت پاسخ در سیستم به وجود آمد لطفا مجددا تلاش فرمایید !!!";
        }
    }
}
function answer_delete_and_change_issue_status_if_required(PDO $connection , int $id , int $issueId ):bool {
    $connection->beginTransaction();
    $deleted = answer_delete($connection,$id);
    $hasAnswer = issue_has_answers($connection,$issueId);
    if(!$hasAnswer)
        issue_change_status_to_published($connection,$issueId);
    return $connection->commit();
}
function deleteAnswerAction(array &$bag):void {
    if(!has_delete_answer() || !has_issue())
        return ;
    /** @var PDO $connection */
    $connection = $GLOBALS["databaseConnection"];
    $id = (int)$_GET["delete"];
    $issueId = (int)$_GET["issue"];
    $execute = answer_delete_and_change_issue_status_if_required($connection,$id,$issueId);
    if($execute)
        $bag["success"][] = "حذف پاسخ موفقیت آمیز بود";
    else
        $bag["error"][] = "حذف پاسخ موفقیت آمیز نبود لطفا بعدا تلاش کنید !!!";
}