<?php
ini_set('session.save_path', $_SERVER['DOCUMENT_ROOT'] . '/sessions');
session_start();

function require_role($role) {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== $role) {
        header("Location: login.php");
        exit;
    }
}
?>
