<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Pop it MVC</title>
</head>
<body>
<header>
    <nav class="header-nav">
        <?php
        if (!app()->auth::check()): ?>

            <a href="<?= app()->route->getUrl('/login') ?>" class="header-item" >Вход</a>
            <a href="<?= app()->route->getUrl('/signup') ?>" class="header-item" >Регистрация</a>
        <?php
        else:?>

        <?php if (app()->auth::user()->isAdmin()): ?>
            <p class="admin">Администратор</p>
        <?php endif; ?>

        <a href="<?= app()->route->getUrl('/') ?>" class="header-item" >Главная</a>
        <a href="<?= app()->route->getUrl('/abonent') ?>" class="header-item" >Абоненты</a>
        <a href="<?= app()->route->getUrl('/division') ?>" class="header-item" >Подразделения</a>
        <a href="<?= app()->route->getUrl('/room') ?>" class="header-item" >Помещения</a>

        <a href="<?= app()->route->getUrl('/logout') ?>" class="button-exit">Выход</a>

        <?php
        endif;?>

    </nav>
</header>
<main>
    <?= $content ?? '' ?>
</main>
</body>
</html>

