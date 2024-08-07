<div class="container my-3">
    <?php echo "Привет, " . $user['name'] . "<br>" . "Это админка!" . "<br>" . ""; ?>
    <a href='/' class="btn btn-danger">Назад</a>
    <div class="my-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Подробности постов
        </button>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header float-right">
                <h5>Подробности постов</h5>
                <div class="text-right">
                    <i data-dismiss="modal" aria-label="Close" class="fa fa-close"></i>
                </div>
            </div>
            <div class="modal-body">
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $posts = getPosts();
                            foreach ($posts as $post) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo htmlspecialchars($post['id']); ?></th>
                                    <td><?php echo htmlspecialchars($post['title']); ?></td>
                                    <td><?php echo htmlspecialchars($post['content']); ?></td>
                                    <td><?php echo htmlspecialchars($post['created_at']); ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="../admin/posts/edit.php?id=<?php echo $post['id']; ?>" class="btn btn-primary btn-sm mx-1">Изменить пост</a>
                                            <form method="GET" action="/../../actions/crud_posts/delete_posts.php">
                                                <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm mx-auto">Удалить пост</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <a href="../admin/posts/create.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Добавить пост</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>