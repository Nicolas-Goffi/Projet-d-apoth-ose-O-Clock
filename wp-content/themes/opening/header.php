<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./src/sass/main.scss"> -->
    <title>Document</title>
    <?php wp_head(); ?>
</head>
<body>

<header class="header">

    <div class="top-header">
        <div class="top-header__logo">
        <a href="<?php echo home_url(); ?>">
            <img src="<?= get_theme_file_uri() ?>/images/OPENING.png" alt="">
        </a>
        </div>
        <div class="top-header__buttons">
            <img src="<?= get_theme_file_uri() ?>/images/Ellipse_4.png" alt=""><img src="<?= get_theme_file_uri() ?>/images/Ellipse_4.png" alt=""><img src="<?= get_theme_file_uri() ?>/images/Ellipse_4.png" alt="">
        </div>
    </div>

    <div class="bottom-header">
        <div class="bottom-header__left"></div>
        <div class="bottom-header__right"><a href="<?= home_url( '/login/' ) ?>">Connexion</a></div>

    </div>

</header>