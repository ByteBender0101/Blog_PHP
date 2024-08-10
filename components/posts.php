<?php
require_once __DIR__ . '/../src/function.php';

// Определяем текущую страницу и количество записей на страницу
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$postsPerPage = 4;

// Получаем записи и общее количество постов
$posts = getPostsPagination($page, $postsPerPage);
$totalPosts = getTotalPosts();

// Рассчитываем общее количество страниц
$totalPages = ceil($totalPosts / $postsPerPage);


$posts = getPostsPagination($page, $postsPerPage);
$formattedDate = date("F j, Y");

?>
<?php if (!empty($posts)): ?>
    <div class="col-lg-8">
        <div class="row">
            <?php foreach ($posts as $post) { ?>
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted"><?php echo $formattedDate ?></div>
                            <h2 class="card-title h4"><?php echo htmlspecialchars($post['title']) ?></h2>
                            <p class="card-text"><?php echo mb_substr(htmlspecialchars($post['content']), 0, 150) . '...';?></p>
                            <a class="btn btn-primary" href="/views/post/article.php?id=<?php echo $post['id']; ?>">Read more →</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php else: ?>
    <p>No posts found.</p>
<?php endif; ?>