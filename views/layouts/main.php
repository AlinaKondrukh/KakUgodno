<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="/css/syles.css" rel="stylesheet" type="text/css">
</head>
<style>
    .bg-dark {
        background-color: #425576 !important;
    }
    .bg-light {
        background-color: #72809966 !important;
    }
    @media screen and (min-width: 900px) {
        body{
            font-size: 20px !important;
        }
    }
    @media screen and (max-width: 478px) {
    body {
position: absolute;
}
}
@media screen and (max-width: 740px) {
header {
    position: absolute;
}
}
    li {
            list-style: none;
        }
    .btn-success {
        background-color: #425576 !important;
        border: none !important;
        border-radius: 10px;
    }
    .btn-success:active, .btn-success:focus, .btn-success:hover {
        background-color: #728099 !important;
        color: #425576;
        border: none !important;
        border-radius: 10px;
        text-shadow: 0 0 5px #425576;
    }
    a {
        color:#425576;
    }
    body {
        background-color: #b9c3d54a;
    }
</style>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => 'Правонарушений.Нет',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin()
                ? ['label' => 'Добавить заявление', 'url' => ['/report/create']]
                : '',
            Yii::$app->user->isGuest
                ? ['label' => 'Регистрация', 'url' => ['/site/register']]
                : ['label' => 'Заявления', 'url' => ['/report/index']],
            Yii::$app->user->isGuest
                ? ['label' => 'Вход', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Выход (' . Yii::$app->user->identity->login . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">
                <p><b>Контактные данные: </b></p>
                <ul>
                    <li>Телефон: +7 (999) 888 33-22</li>
                    <li>Почта: support@narusheniyam.net</li>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <?php if (Yii::$app->user->isGuest) : ?>
                    <ul>
                        <li><a class="nav-link" href="/site/index">Главная</a></li>
                        <li><a class="nav-link" href="/site/login">Вход</a></li>
                        <li><a class="nav-link" href="/site/register">Регистрация</a></li>
                    </ul>
                <?php elseif (Yii::$app->user->identity->isAdmin()) : ?>
                    <ul>
                        <li><a class="nav-link" href="/site/index">Главная</a></li>
                        <li><a class="nav-link" href="/report/index">Заявления</a></li>
                    </ul>
                <?php else : ?>
                    <ul>
                        <li><a class="nav-link" href="/site/index">Главная</a></li>
                        <li><a class="nav-link" href="/report/index">Мои заявления</a></li>
                        <li><a class="nav-link" href="/report/create">Добавить заявление</a></li>
                    </ul>
                <?php endif ?>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
