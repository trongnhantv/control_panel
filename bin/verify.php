<?php
session_start();
if (!isset($_SESSION['user']))
{
    header("Location: login.php");
    die;
}
require_once "user.php";
$user = unserialize($_SESSION['user']);
