<?php
session_start();

if(!isset($_SESSION['flash_message'])) {
    $_SESSION['flash_message'] = [];
}