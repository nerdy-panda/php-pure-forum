<?php require_once dirname(__DIR__)."/Include/Bootstrap.php"; ?>
<?php redirectToHomeIfIsLogin(); ?>
<?php
    $payload = [];
    $messageBag = ["success" => [] , "error" => []];
    storeIssueAction($payload,$messageBag);
    loginAction($messageBag);
    $payload["messageBag"] = $messageBag;
?>
<?php view("Page.Login",$payload); ?>
