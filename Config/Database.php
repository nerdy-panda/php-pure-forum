<?php
const DATABASE_DRIVER = "mysql";
const DATABASE_HOST = "localhost";
const DATABASE_PORT = "3306";
const DATABASE_NAME = "forum";
const DATABASE_USERNAME = "root";
const DATABASE_PASSWORD = "root";
const DATABASE_CHARSET = "utf8mb4";
const DATABASE_OPTIONS = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ,
];
