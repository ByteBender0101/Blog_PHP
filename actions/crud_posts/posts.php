<?php
require_once __DIR__ . '/../../src/function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $userId = currentUser()['id'];  

    if (createPost($title, $content, $userId)) {
        setMessage('success', 'Post created successfully');
        redirect('/'); 
    } else {
        setMessage('error', 'Failed to create post');
        redirect('/');
    }
}