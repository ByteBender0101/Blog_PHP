<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Изменить пост</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/actions/crud_posts/edit_posts.php?id=<?php echo htmlspecialchars($post['id']); ?>" method="POST">
                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Название</label>
                        <input type="text" class="form-control" id="editTitle" name="title" value="<?php echo htmlspecialchars($post['title']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editContent" class="form-label">Контент</label>
                        <textarea class="form-control" id="editContent" name="content" rows="5"><?php echo htmlspecialchars($post['content']); ?></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Изменить пост</button>
                        <a href='/views/admin/dashboard.php' class="btn btn-danger">Назад</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
