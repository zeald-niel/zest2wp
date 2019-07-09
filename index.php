<?php 
$page = [
    'title' => 'Zest to Wordpress CSV converter',
    'author' => 'neo',
    'version' => '0.1.0'
];
?><!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    
    <title><?php echo $page['title']; ?></title>
  </head>
  <body>
    <div id="app">
        <h1><?php echo $page['title']; ?></h1>
        <form class="form-inline" method="post" id="form">
            <input type="file" name="csv" class="file"/>
            <button class="submit btn btn-lg btn-primary"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Submit</button>
        </form>
        <em id="err"></em>
        <a href="#" id="download" class="btn btn-lg btn-success" >Download</a>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS --><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>