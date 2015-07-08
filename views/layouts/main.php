<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        
        <?php
 
            NavBar::begin([
                
                'brandLabel' => 'CRM',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            
            $navItems=[
                ['label' => 'Home', 'url' => ['/site/index']],
                [
                    'label' => 'Clients', 
                    'items' => [
                        ['label' => 'Create', 'url' => ['/client/create'],
                            'linkOptions' => ['id' => 'create-client']],
                        ['label' => 'Show all', 'url' => ['/client/index'],
                            'linkOptions' => ['id' => 'show-clients']],
                    ],
                ],
                [
                    'label' => 'Products', 
                    'items' => [
                        ['label' => 'Create', 'url' => ['/product/create'],
                            'linkOptions' => ['id' => 'create-product']],
                        ['label' => 'Show all', 'url' => ['/product/index'],
                            'linkOptions' => ['id' => 'show-products']],
                    ],
                ],       
                ['label' => 'Quotes', 'url' => ['/quotes']],
                ['label' => 'Items', 'url' => ['/items']]
            ];
            if (Yii::$app->user->can('admin')) {
                array_push($navItems, 
                            ['label' => 'Admin', 'url' => ['/user/admin']]
                        );
            }
            if (Yii::$app->user->isGuest) {
                array_push($navItems, 
                            ['label' => 'Sign In', 'url' => ['/user/login'],
                            'linkOptions' => ['id' => 'sign-in']],
                            ['label' => 'Sign Up', 'url' => ['/user/register'],
                            'linkOptions' => ['id' => 'sign-in']]
                        );
            } else {
                array_push($navItems,
                            ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post', 'id' => 'log-out']]);
            } 
            
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $navItems,
            ]);
            
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; CRM <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
