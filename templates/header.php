<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title ?? 'Футбольный блог' ?></title>
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/clean-blog.css" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
          rel='stylesheet' type='text/css'>
</head>
<body>

<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Учебный проект</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/">Главная</a>
                </li>
                <?php if (!empty($user)): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#">Привет, <?= $user->getNickname() ?? 'Войдите в систему' ?></a>
                        <div class="dropdown-content">
                            <a class="dropdown-item" href="">Мой профиль</a>
                            <a class="dropdown-item" href="/users/logout">Выйти</a>
                        </div>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="/users/login">Вход</a>
                    </li>
                    <li>
                        <a href="/users/register">Регистрация</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<header class="intro-header" style="background-image: url('/img/home-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <?php if (empty($pageName) && empty($article)): ?>
                    <div class="site-heading">
                        <div class="text-background">
                            <h1>Футбольный блог</h1>
                            <hr class="small">
                            <span class="subheading">С новостями, аналитикой и увлекательными историями!</span>
                        </div>
                    </div>
                <?php elseif (!empty($pageName)): ?>
                    <div class="site-heading">
                        <div class="text-background">
                            <h1><?= $pageName ?></h1>
                        </div>
                    </div>
                <?php elseif (!empty($article)): ?>
                    <div class="site-heading">
                        <div class="text-background">
                            <h1><?= $article->getName() ?></h1>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
