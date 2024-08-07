<?php
require_once __DIR__ . '/../../src/function.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $postId = $_GET['id'];
    $post = fetchPostById($postId);

    if (!$post) {
        $_SESSION['error'] = 'Post not found.';
        header('Location: /../../views/admin/dashboard.php');
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $postId = $_GET['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (updatePost($postId, $title, $content)) {
        $_SESSION['success'] = 'Post updated successfully.';
        header('Location: /../../views/admin/dashboard.php');
        exit();
    } else {
        $_SESSION['error'] = 'Failed to update post.';
        header('Location: edit_post.php?id=' . $postId);
        exit();
    }
} else {
    $_SESSION['error'] = 'Invalid request.';
    header('Location: /../../views/admin/dashboard.php');
    exit();
}

function fetchPostById($postId)
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
    $stmt->execute(['id' => $postId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updatePost($postId, $title, $content)
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    $stmt->bindParam(':id', $postId, PDO::PARAM_INT);

    return $stmt->execute();
}


