<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/css/build-full-no-icons.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="col">
            <div class="col width-2of10">
                <div class="menu cell">
                    <ul class="left nav">
                        <li class="disabled"><?= $site_name ?></li>
                        <?php foreach($nav as $item): ?>
                            <li><a href="<?= $item['url'] ?>"><?= $item['title'] ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <div class="col width-fill content">
                <?= content() ?>
            </div>
        </div>
    </div>
</body>
</html>

