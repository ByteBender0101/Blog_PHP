<?php
require_once __DIR__ . '/../../../src/function.php';
require_once __DIR__ . '/../../../components/header.php';
$postId = $_GET['id'];
$post = getPostById($postId);
?>
<title>Blog:: Dashboard</title>
<link href="/assets/css/styles.css" rel="stylesheet" />
<div class="container my-3">
    <h2>Изменить пост</h2>
    <form action="/actions/crud_posts/edit_posts.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="mb-3">
            <label for="editTitle" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="editTitle" value="<?php echo htmlspecialchars($post['title']); ?>">
        </div>
        <div class="mb-3">
            <label for="editContent" class="form-label">Content</label>
            <textarea class="form-control" name="content" id="editContent"><?php echo htmlspecialchars($post['content']); ?></textarea>
        </div>
        <div class="d-flex justify-content-end"> 
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href='/views/admin/dashboard.php' class="btn btn-danger mx-2">Назад</a>
        </div>

    </form>
</div>