<?php

/** @var yii\web\View $this */
/** @var string $content */

use application\site\assets\MainAssets;
use application\site\assets\BootstrapAssets;

BootstrapAssets::register($this);
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

    <footer class="fixed-bottom">
<?= $this->render('footer')?>
    </footer>

<?php $this->endBody() ?>

</body>

<?php $this->endPage() ?>

</html>
