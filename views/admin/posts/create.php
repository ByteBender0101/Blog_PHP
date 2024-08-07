<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Create a New Post</h2>
            <form method="POST" action="/actions/crud_posts/create_posts.php">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>
        </div>
    </div>
</div>
