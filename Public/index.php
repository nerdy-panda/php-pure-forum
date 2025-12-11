<?php use App\Enum\IssueStatus; ?>
<?php require_once dirname(__DIR__)."/Include/Bootstrap.php"; ?>
<?php
    $data = [];
    $messageBag = ["success" => [] , "error" => []];
    $status = null ;
    $search = null ;

    storeIssueAction($data,$messageBag);
    logoutAction();

    $isLogin = isLogin();
    if($isLogin){
        storeAnswerAction($messageBag);
        deleteAnswerAction($messageBag);
    }

    if(has_status() && $status != IssueStatus::all->name && is_valid_status($isLogin,$_GET["status"]))
        $status = str_safe($_GET["status"]);
    if(has_search())
        $search = str_safe($_GET["search"]);

    $issuesCount = issue_getAllCount($databaseConnection,$isLogin,$status,$search) ;
    $pageCount = ceil($issuesCount / ISSUE_PER_PAGE) ;
    $currentPage = current_page();
    $offset = ($currentPage - 1) * ISSUE_PER_PAGE;
    $issues = issue_getAll($databaseConnection ,$isLogin,$status,$search,ISSUE_PER_PAGE,$offset);

    $data["messageBag"] = $messageBag;
    $data["issuesCount"] = $issuesCount;
    $data["pageCount"] = $pageCount; 
    $data["currentPage"] = $currentPage; 
    $data["issues"] = $issues;
    $data["isLogin"] = $isLogin;
?>
<?php view("Page.Index",$data); ?>