<ul class="pagination">
  <?php
    $query_string = http_build_query($params, '&', '&');
  ?>
  <?php if ($current_page > 1): ?>
    <li class="page-item"><a href="<?= $base_url ?>?page=<?= $current_page - 1 ?>&<?= $query_string ?>" class="page-link"><</a></li>
  <?php endif; ?>
  <?php for($page = 1; $page <= $page_total; $page++): ?>
    <li class="page-item <?= $page == $current_page ? 'active' : '' ?>">
      <a href="<?= $base_url ?>?page=<?= $page ?>&<?= $query_string ?>" class="page-link"><?= $page ?></a>
    </li>
  <?php endfor; ?>
  <?php if ($current_page < $page_total): ?>
    <li class="page-item"><a href="<?= $base_url ?>?page=<?= $current_page + 1 ?>&<?= $query_string ?>" class="page-link">></a></li>
  <?php endif; ?>
</ul>