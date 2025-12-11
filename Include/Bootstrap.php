<?php declare(strict_types=1); ?>
<?php require_once dirname(__DIR__,1)."/vendor/autoload.php"; ?>
<?php session_start() ?>
<?php require_once __DIR__."/Constant.php"; ?>
<?php require_once __DIR__."/Config.php"; ?>
<?php require_once __DIR__."/Ini.php"; ?>
<?php require_once __DIR__."/Helper.php"; ?>
<?php require_once __DIR__."/Model.php"; ?>

<?php
    $databaseConnection = databaseConnector(
        DATABASE_DRIVER , DATABASE_HOST ,DATABASE_PORT ,DATABASE_NAME ,
        DATABASE_USERNAME ,DATABASE_PASSWORD , DATABASE_CHARSET , DATABASE_OPTIONS
    );

?>
