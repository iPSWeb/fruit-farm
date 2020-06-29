<?php
$dsn = "mysql:host=$config->HostDB;dbname=$config->BaseDB;charset=$config->CharsetDB";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $config->UserDB, $config->PassDB, $opt);