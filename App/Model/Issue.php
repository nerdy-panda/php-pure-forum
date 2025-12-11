<?php use App\Enum\IssueStatus ; ?>
<?php
function issue_store(PDO $connection,string $fullName , string $email , string $mobile , string $text):bool {
    $table = ISSUE_TABLE ;
    $sql = "insert into `$table`(`full_name`,`email`,`phone`,`body`) values(?,?,?,?);";
    $statement = $connection->prepare($sql);
    $bindData = array_values(compact("fullName","email","mobile","text"));
    $executed = $statement->execute($bindData);
    return $statement->rowCount() == 1 ;
}
function issue_getAllCount(PDO $connection , bool $isAdmin = false , ?string $status = null , ?string $search = null ):int {
    $table = ISSUE_TABLE ;
    $search = issue_searchable_if_is_set($search);
    $where = issue_getAll_where($isAdmin , $status , $search);
    $sql = "select count(`id`) as 'length' from `$table` $where";
    $statement = $connection->query($sql);
    $resultSet = $statement->fetch();
    return $resultSet["length"];
}
function issue_getAll(PDO $connection , bool $isAdmin = false , ?string $status = null ,?string $search = null ,?int $limit = null , ?int $offset = null ):array {
    $table = ISSUE_TABLE ;
    $search = issue_searchable_if_is_set($search);
    $where = issue_getAll_where($isAdmin, $status , $search);
    $limitSector = "";

    if(is_int($limit)){
        $limitSector = "limit $limit";
        if(is_int($offset))
            $limitSector .=" offset $offset";
    }

    $sql = "select  `id`, `body` , `status` , `created_at` from `$table` $where order by `created_at` desc $limitSector;";
    $statement = $connection->query($sql);
    $issues = $statement->fetchAll();
    if(array_is_empty($issues))
        return $issues;
    $answeredIssues = issue_only_answered($issues);
    if(array_is_empty($answeredIssues))
        return $issues; 
    $ids = array_extract_rows_ids($answeredIssues);
    $answers = answers_of_issues($connection,$ids);
    return array_set_issue_answers($issues,$answers);
}

function issue_change_status(PDO $connection , int $issue , IssueStatus $status):bool {
    $table = ISSUE_TABLE ;
    $strStatus = $status->name ;
    $sql = "update `$table` set `status` = ? where `id` = ?";
    $statement = $connection->prepare($sql);
    $executed = $statement->execute([$strStatus,$issue]);
    return $statement->rowCount() == 1 ;
}
function issue_change_status_to_answered(PDO $connection , int $issue):bool {
    return issue_change_status($connection,$issue,IssueStatus::answered);
}
function issue_change_status_to_published(PDO $connection , int $issue):bool {
    return issue_change_status($connection,$issue,IssueStatus::publish);
}
function issue_change_status_to_pending(PDO $connection , int $issue):bool {
    return issue_change_status($connection,$issue,IssueStatus::pending);
}
function issue_get_contact_info(PDO $connection , int $issueId):array|false {
    $table = ISSUE_TABLE ;
    $sql = "select `full_name` , `email` , `phone` from `$table` where `id` = ?";
    $statement = $connection->prepare($sql);
    $statement->execute([$issueId]);
    return $statement->fetch();
}
function issue_delete(PDO $connection , int $id):bool {
    $table = ISSUE_TABLE ;
    $sql = "delete from `$table` where `id` = ? ;";
    $statement = $connection->prepare($sql);
    $executed = $statement->execute([$id]);
    return $statement->rowCount() == 1 ;
}
function issue_answers_count(PDO $connection ,int $issue):int{
    return answer_count_by_issue($connection,$issue);
}
function issue_has_answers(PDO $connection , int $issue):bool {
    $answers = issue_answers_count($connection,$issue);
    return $answers > 0 ;
}