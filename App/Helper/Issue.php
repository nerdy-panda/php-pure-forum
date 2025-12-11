<?php use App\Enum\IssueStatus; ?>
<?php
function issue_is_answered(array $issue):bool {
    return $issue["status"] == IssueStatus::answered->name;
}
function issue_only_answered(array $issues):array {
    $result = [];
    foreach ($issues as $issue)
        if(issue_is_answered($issue))
           $result[] = $issue ;
    return $result;
}
function issue_except_pendings_where_condition():string {
    return "`status` != ".str_wrap_by_quote(IssueStatus::pending->name);
}
function issue_status_where_condition(string $status):string {
    return "`status` = ".str_wrap_by_quote($status);
}
function issue_body_where_like_condition(string $search):string {
    $search = str_wrap_by_quote($search);
    return "`body` like $search";
}
function issue_getAll_where(bool $isAdmin , ?string $status , ?string $search):string {
    $wheres = [];
    if(!$isAdmin)
        $wheres[] = issue_except_pendings_where_condition();
    if(!is_null($status))
        $wheres[] = issue_status_where_condition($status);
    if(!is_null($search))
        $wheres[] = issue_body_where_like_condition($search) ;

    $where = implode(" AND ",$wheres);
    if(str_notEmpty($where))
        $where = str_prepend($where,"where ");

    return $where;
}
function issue_searchable_if_is_set(?string $search):null|string {
    if(is_null($search))
        return null;
    $search = str_replace(" ","%",$search);
    return str_wrap($search,"%");
}