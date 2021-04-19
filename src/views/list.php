<?php include("header.php") ?>

<?php include("bar.php") ?>

<div class="container" id="list">
  <div class="row">
    <div class="col">
      <nav>
        <a href="<?= $base_url ?>/new" class="btn btn-primary">
          Добавить задачу
        </a>
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <table class="table ">
        <tr>
          <?php 
            $params = [
              'page' => $current_page,
            ];
          ?>
          <th scope="col">
            <?php 
              $params['order_by'] = 'username';
              $params['order_dir'] = ($order_by !== 'username' || $order_dir === 'asc' ) ? 'desc' : 'asc';
            ?>
            <a href="<?= $base_url ?>?<?= http_build_query($params) ?>">
              Имя пользователя
            </a>
          </th>
          <th scope="col">          
            <?php 
              $params['order_by'] = 'email';
              $params['order_dir'] = ($order_by !== 'email' || $order_dir === 'asc' ) ? 'desc' : 'asc';
            ?>
            <a href="<?= $base_url ?>?<?= http_build_query($params) ?>">
              Email
            </a>
          </th>
          <th scope="col">Текст задачи</th>
          <th scope="col">                   
            <?php 
              $params['order_by'] = 'status';
              $params['order_dir'] = ($order_by !== 'status' || $order_dir === 'asc' ) ? 'desc' : 'asc';
            ?>
            <a href="<?= $base_url ?>?<?= http_build_query($params) ?>">
              Статус
            </a>            
          </th>
          <?php if ($is_admin): ?>
            <th scope="col">&nbsp</th>
          <?php endif; ?>
        </tr>
        <?php foreach($list as $item): ?>
          <tr>
            <td><?= $item->username ?></td>
            <td><?= $item->email ?></td>
            <td><?= $item->content ?></td>
            <td>
              <?php if($item->status): ?>
                Выполнено
              <?php else: ?>
                Не выполнено
              <?php endif; ?>
              <?php if($item->is_changed): ?>
                <br />
                Отредактировано администратором
              <?php endif; ?>
            </td>
            <?php if ($is_admin): ?>
              <td>
                <a href="<?= $base_url ?>/edit/<?= $item->id ?>" class="btn btn-sm btn-primary">Редактировать</a>                
              </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <nav>
        <?php if ($page_total > 1): ?>
          <?php 
            $params = [];
            if (!is_null($order_by) && !is_null($order_dir)) {
              $params['order_by'] = $order_by;
              $params['order_dir'] = $order_dir;
            }
          ?>
          <?php include('pagination.php') ?>
        <?php endif; ?>
      </nav>
    </div>
  </div>
</div>

<?php include("footer.php") ?>