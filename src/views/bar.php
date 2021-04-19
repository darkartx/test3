<div class="container bar">
  <div class="row">
    <div class="col">
      <nav>
        <?php if ($is_admin): ?>
          <a href="<?= $base_url ?>/logout" class="btn btn-primary">
            Выйти
          </a>     
        <?php else: ?>  
          <a href="<?= $base_url ?>/login" class="btn btn-primary">
            Войти
          </a>   
        <?php endif; ?>
      </nav>
    </div>
  </div>
</div>