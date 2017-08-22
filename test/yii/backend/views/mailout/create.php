<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Mailout */

$this->title = 'Написать письмо';
$this->params['breadcrumbs'][] = ['label' => 'Mailouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailout-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
