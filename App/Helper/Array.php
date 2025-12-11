<?php
function array_safeStrings(array $items):array {
    $result = [];
    foreach ($items as $key => $item )
        $result[$key] = str_safe($item);
    return $result;
}
function array_extract_rows_ids(array $rows):array{
    return array_column($rows,"id");
}

function array_join_by_comma(array $items):string {
    return implode(",",$items);
}
function array_set_issue_answers(array $issues , array $answers):array {
    foreach ($issues as &$issue){
        $issueId = $issue["id"];
        $issueAnswers = [];
        foreach ($answers as $key => $answer) {
            $belongsTo = $answer["issue_id"];
            if($issueId != $belongsTo)
                continue;
            $issueAnswers[] = $answer ;
            unset($answers[$key]);
        }
        $issue["answers"] = $issueAnswers ;
    }
    return $issues;
}
function array_is_empty(array $items):bool {
    return count($items) == 0 ;
}
