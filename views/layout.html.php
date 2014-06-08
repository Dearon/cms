<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title ?></title>

    <link rel="stylesheet" href="<?= $base_url ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>/assets/css/style.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3" id="nav">
                <h4><?= $site_name ?></h4>
                <ul class="nav nav-pills nav-stacked">
                    <?php foreach($nav as $item): ?>
                        <li><a href="<?= $base_url ?><?= $item['url'] ?>"><?= $item['title'] ?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>
            <div class="col-sm-9" id="article">
                <?= content() ?>
            </div>
        </div>
    </div>
</body>
</html>

