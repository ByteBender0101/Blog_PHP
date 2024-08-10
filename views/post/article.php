<?php
require_once __DIR__ . '/../../src/function.php';
require_once __DIR__ . '/../../components/header.php';
$postId = $_GET['id'];
$post = getPostById($postId);

$formattedDate = date("F j, Y");
?>
<link href="/assets/css/styles.css" rel="stylesheet" />
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <article>
                <header class="mb-4">
                    <h1 class="fw-bolder mb-1"><?php echo htmlspecialchars($post['title']); ?></h1>
                    <div class="text-muted fst-italic mb-2">Posted on <?php echo htmlspecialchars($formattedDate)?> by <?php echo htmlspecialchars($user['name']) ?></div>
                </header>
                <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." /></figure>
                <section class="mb-5">
                    <p class="fs-5 mb-4"><?php echo htmlspecialchars($post['content']); ?></p>
                </section>
            </article>
        </div>
        