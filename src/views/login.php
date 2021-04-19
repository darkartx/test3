<?php include("header.php") ?>

<div class="container" id="login">
  <form action="<?= $base_url ?>/login" method="post">
    <div class="row">
      <div class="col-lg-4 col-md-3 col-sm-2"></div>
      <div class="col-lg-1 col-md-2 col-sm-3">    
        <label for="username">Username:</label>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-5">
        <input type="text" name="username" class="form-control" id="username">
      </div>
      <div class="col-lg-4 col-md-3 col-sm-2"></div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-3 col-sm-2"></div>
      <div class="col-lg-1 col-md-2 col-sm-3">    
        <label for="password">Password:</label>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-5">
        <input type="text" name="password" class="form-control" id="password">
      </div>
      <div class="col-lg-4 col-md-3 col-sm-2"></div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-3 col-sm-2"></div>
      <div class="col-lg-4 col-md-6 col-sm-8">    
        <button class="btn btn-primary">Sign in</button>
      </div>
      <div class="col-lg-4 col-md-3 col-sm-2"></div>
    </div>
  </form>
</div>

<?php include("footer.php") ?>