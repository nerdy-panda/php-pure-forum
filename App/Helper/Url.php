<?php
function url():string {
    return URL;
}
function getAsset(string $asset):string {
    return url().$asset;
}
function asset(string $asset):void {
    echo getAsset($asset);
}
function current_page(string $key = "page"):int {
    if(!isset($_GET[$key]))
        return 1;
    return $_GET[$key];
}
function page_query_string(int $page , string $key = "page"):string {
    $queryString = $_SERVER["QUERY_STRING"];
    $pageQueryString = "$key=$page";
    if(str_notEmpty($queryString)){
        $pattern = "/$key=\d+/i";
        $has = preg_match($pattern,$queryString);
        if(!$has)
            return $queryString."&$pageQueryString";
        return preg_replace($pattern,$pageQueryString,$queryString);
    }
    return "$pageQueryString";
}
function has_status():bool {
    return isset($_GET["status"]);
}
function has_search():bool {
    return isset($_GET["search"]) && str_notEmpty($_GET["search"]);
}

