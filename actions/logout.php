<?php
require_once '../src/function.php';
    
    unset($_SESSION['user']['id']);
    redirect('/');