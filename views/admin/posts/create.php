<div class="modal fade" id="exampleModalCreate" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Создать новый пост</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/actions/crud_posts/create_posts.php" method="POST">
                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Название</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="editContent" class="form-label">Контент</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Создать пост</button>
                        <a href='/views/admin/dashboard.php' class="btn btn-danger">Назад</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>