<?php namespace App\Enum ; ?>
<?php
enum IssueStatus
{
    case pending;
    case publish;
    case answered;
    case all ;
}