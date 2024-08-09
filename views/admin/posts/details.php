<?php
require_once __DIR__ . '/../../../src/function.php';
$users = getUsers();
?>
<div class="container my-3">
    <?php
    echo "Привет, " . htmlspecialchars($user['name']) . "<br>" . "Это админка!" . "<br>";
    ?>

    <div class="container my-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home">
                    Посты
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile">
                    Профиль
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings">
                    Настройки
                </button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h2 class="my-2">Список постов</h2>
                <table class="table table-bordered my-3">
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
                                    <div class="d-flex justify-content-center">
                                        <a href="../admin/posts/edit.php?id=<?php echo $post['id']; ?>" class="btn btn-primary btn-sm mx-1">Изменить</a>

                                        <form method="GET" action="/../../actions/crud_posts/delete_posts.php">
                                            <button type="submit" class="btn btn-danger btn-sm mx-1">Удалить</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalCreate">
                    Создать пост
                </button>
            </div>
            <div class="tab-panel fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <h2 class="my-2">Список пользователей</h2>
                <table class="table table-bordered my-3">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Banned</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <th scope="row"><?php echo htmlspecialchars($user['id']); ?></th>
                                <td><?php echo htmlspecialchars($user['name']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['role']); ?></td>
                                <td><?php echo $user['banned'] ? 'Да' : 'Нет'; ?></td>
                                <td>
                                    <form method="POST" action="/views/admin/settings/access/admin_ban.php">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <?php if ($user['banned']) : ?>
                                            <button type="submit" class="btn btn-success btn-sm" name="unban">Разбанить</button>
                                        <?php else : ?>
                                            <div class="mb-3">
                                                <input type="text" name="reason" class="form-control" placeholder="Причина бана">
                                            </div>
                                            <button type="submit" class="btn btn-danger btn-sm" name="ban">Забанить</button>
                                        <?php endif; ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require_once 'create.php'; ?>