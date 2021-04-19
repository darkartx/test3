<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Test</title>    

    <!-- Bootstrap core CSS -->
    <link href="<?= $base_url ?>/css/bootstrap/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <!-- Custom styles for this template -->
    <link href="<?= $base_url ?>/css/test.css" rel="stylesheet">
  </head>
  <body>    
    <div class="container">     
      <?php if (is_array($messages)): foreach($messages as $message): ?>
        <div class="alert alert-<?= $message[0] ?>" role="alert">
          <?= $message[1] ?>
        </div>   
      <?php endforeach; endif; ?>
    </div>
