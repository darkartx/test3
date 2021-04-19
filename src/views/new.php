<?php include("header.php") ?>

<?php include("bar.php") ?>

<div class="container" id="new">
  <form action="<?= $base_url ?>/new" method="post">
    <div class="row">
      <div class="col-6">    
        <label for="username">Имя пользователя:</label>
      </div>
      <div class="col-6">
        <input type="text" name="username" class="form-control" id="username" value="<?= $model->username ?>">
      </div>
    </div>
    <div class="row">
      <div class="col-6">    
        <label for="email">Email:</label>
      </div>
      <div class="col-6">
        <input type="text" name="email" class="form-control" id="email" value="<?= $model->email ?>">
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
      <div class="col-12">    
        <button class="btn btn-primary">Отправить</button>
      </div>
    </div>
  </form>
</div>

<?php include("footer.php") ?>