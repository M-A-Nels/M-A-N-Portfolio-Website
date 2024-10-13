<?php
    session_start();
    unset($_SESSION['UserID']);
    unset($_SESSION['Role']);
    session_destroy();
    header("Location:".$_SERVER['HTTP_REFERER']);
?>