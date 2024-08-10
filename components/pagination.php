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
<nav aria-label="Pagination">
    <hr class="my-0" />
    <ul class="pagination justify-content-center my-4">
        <!-- Ссылка "Newer" -->
        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= ($page > 1) ? '?page=' . ($page - 1) : '#' ?>" tabindex="-1" aria-disabled="<?= ($page <= 1) ? 'true' : 'false' ?>">
                Назад
            </a>
        </li>

        <!-- Генерация ссылок на страницы -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>" aria-current="<?= ($i == $page) ? 'page' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>">
                    <?= $i ?>
                </a>
            </li>
        <?php endfor; ?>

        <!-- Ссылка "Older" -->
        <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
            <a class="page-link" href="<?= ($page < $totalPages) ? '?page=' . ($page + 1) : '#' ?>">
                Далее
            </a>
        </li>
    </ul>
</nav>