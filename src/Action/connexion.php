<?php

session_start();

use DB\DataBaseManager;

$id = $_GET['id'] ?? null;

$manager = new DataBaseManager();



if (isset($_SESSION[$id])) {
    header("Location : home.php");
}

?>