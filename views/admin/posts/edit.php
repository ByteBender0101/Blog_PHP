<?php 
require_once __DIR__ . '/../../../src/function.php';


$postId = $_GET['id'];
$post = getPostById($postId);
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Edit Post</h2>
            <form method="POST" action="/actions/crud_posts/edit_posts.php?id=<?php echo $_GET['id']; ?>">

            <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($post['title']);?>">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required><?php echo htmlspecialchars($post['content']); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Post</button>

            </form>
        </div>
    </div>
</div>

<a href='../dashboard.php'>Назад</a>