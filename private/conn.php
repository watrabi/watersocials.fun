<?php

$pdo = new PDO("mysql:host=localhost; user=test; dbname=test; password=test; charset=utf8mb4");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);