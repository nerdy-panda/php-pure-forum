<?php use Morilog\Jalali\Jalalian; ?>
<?php
function date_to_jalalian(string $date):Jalalian {
    return Jalalian::fromDateTime($date);
}
function date_to_str(string $date , string $format = DATE_FORMAT):string {
    return date_to_jalalian($date)->format($format);
}