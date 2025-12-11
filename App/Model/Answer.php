<?php
function answers_of_issues(PDO $connection ,array $ids):array {
    $table = ANSWER_TABLE ;
    $ids = array_join_by_comma($ids);
    $sql = "select `id`,`issue_id`,`body` , `created_at` from `$table` where `issue_id` in ($ids) order by `issue_id` asc ,`created_at` asc ;";
    $statement = $connection->query($sql);
    return $statement->fetchAll();
}
function answer_store(PDO $connection, int $issueId , string $answer):bool {
    $table = ANSWER_TABLE ;
    $sql = "insert into `$table`(`issue_id`,`body`) value(?,?)";
    $statement = $connection->prepare($sql);
    $binds = [$issueId,$answer];
    $executed = $statement->execute($binds);
    return $statement->rowCount() == 1 ;
}
function answer_count_by_issue(PDO $connection,int $issue):int {
    $table = ANSWER_TABLE ;
    $sql = "select count(`id`) as 'count' from `answers` where `issue_id` = ? ;";
    $statement = $connection->prepare($sql);
    $execute = $statement->execute([$issue]);
    return $statement->fetch()["count"];
}
function answer_delete(PDO $connection , int $id):bool {
    $table = ANSWER_TABLE ;
    $sql = "delete from `answers` where `id` = ?;";
    $statement = $connection->prepare($sql);
    $executed = $statement->execute([$id]);
    return $statement->rowCount() == 1 ;
}