<!DOCTYPE html>
<html lang="tr">
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style/w3.css">
    <link rel="stylesheet" href="public/style/style.css">
    <link rel="stylesheet" href="public/style/<?php echo $style?>.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fork-awesome@1.1.7/css/fork-awesome.min.css" integrity="sha256-gsmEoJAws/Kd3CjuOQzLie5Q3yshhvmo7YNtBG7aaEY=" crossorigin="anonymous">
</head>
<body>
    <?php include $body ?>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script> 
    <script src="public/script/script.js"></script>
    <script src="public/script/<?php echo $script ?>.js"></script>
</body>
</html>
