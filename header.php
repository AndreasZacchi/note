<?php
  session_start();
  if(!isset($_SESSION['path64'])) {
    $_SESSION['path64'] = "Lw==";
  }
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="style/navbar.css">

  <link href='https://fonts.googleapis.com/css?family=Source Sans Pro' rel='stylesheet'>

  <script type="text/javascript">
    var path = "<?php echo $_SESSION['path64'];?>";
    if(path === "") {
      path = "Lw==";
    }
  </script>
  <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="style/animations.js"></script>
  <script src="https://kit.fontawesome.com/c1a3fe2a52.js" crossorigin="anonymous"></script>
</head>

<body>

    <header>
        
    </header>