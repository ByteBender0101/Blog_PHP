<?php
require_once __DIR__ . '/../src/function.php';

if (!empty($_POST['search'])) {


	$search = $_POST['search'];
	$search = mb_eregi_replace("[^a-zа-яё0-9 ]", '', $search);
	$search = htmlspecialchars(trim($search));

	$pdo = getPDO();
	$stmt = $pdo->prepare("SELECT * FROM `posts` WHERE `title` LIKE :search ORDER BY `title`");
	$stmt->execute(['search' => $search . '%']);
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if ($results) {
?>
		<div class="search_result my-1 card">
			<table class="table table-hover">
				<?php foreach ($results as $result): ?>
					<tr>
						<td class="search_result-name">
							<a class="ms-2 text-decoration-none text-dark"><?php echo mb_substr(htmlspecialchars($result['title']), 0, 20) . '...'; ?></a>
						</td>
						<td class="search_result-btn d-flex justify-content-end">
							<a class="text-decoration-none" href="/views/post/article.php?id=<?php echo $result['id'] ?>">Перейти</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	<?php
	} else {
	?>
		<div class="alert alert-warning mt-2" role="alert">
			Пост не найден.
		</div>
<?php
	}
}
