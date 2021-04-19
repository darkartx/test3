<?php include("header.php") ?>

<?php include("bar.php") ?>

<?php if ($is_admin): ?>
  <div class="container" id="edit">
    <form action="<?= $base_url ?>/edit/<?= $model->id ?>" method="post">
      <div class="row">
        <div class="col-6">    
          <label for="username">Имя пользователя:</label>
        </div>
        <div class="col-6">
          <?= $model->username ?>
        </div>
      </div>
      <div class="row">
        <div class="col-6">    
          <label for="email">Email:</label>
        </div>
        <div class="col-6">
          <?= $model->email ?>
        </div>
      </div>
      <div class="row">
        <div class="col-6">    
          <label for="content">Текст:</label>
        </div>
        <div class="col-6">
          <textarea name="content" class="form-control" id="content"><?= $model->content ?></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-6">    
          <label for="status">Выполнено:</label>
        </div>
        <div class="col-6">
          <input name="status" type="checkbox" id="status" <?php if ($model->status) : ?>checked="checked"<?php endif; ?>>
        </div>
      </div>
      <div class="row">
        <div class="col-12">    
          <button class="btn btn-primary">Отправить</button>
        </div>
      </div>
    </form>
  </div>
<?php endif; ?>

<?php include("footer.php") ?>