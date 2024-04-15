<?php

/** @var yii\web\View $this */
/** @var string $content */

use site\assets\MainAssets;

MainAssets::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= $this->title ?></title>
    <?php $this->head() ?>

</head>
<body>

<?php $this->beginBody() ?>

<header>

    <?= $this->render('header')?>

</header>

<?= $content ?>

<?php $this->endBody() ?>

</body>

<?php $this->endPage() ?>

</html>