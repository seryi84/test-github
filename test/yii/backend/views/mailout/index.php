<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Почта отправленная';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="mailout-index">
    
    <div class = "row">
        <div class = "col-xs-2"></div>
        <div class = "col-xs-10">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <!--<p>
                <?//= Html::a('Create Mailout', ['create'], ['class' => 'btn btn-success']) ?>
            </p>-->  

            <p>
                <?= Html::a('Написать письмо', ['create'], ['class' => 'btn btn-primary']) ?>
                <?= Html::button('Удалить выбранные письма', ['class' => 'btn btn-primary', 'id' => 'button']) ?>
            </p>
        </div>   
    </div>
    
    <div class = "row">
        <div id="left" class = "col-xs-2 panel panel-default" style="height: 200px">
            <h3>Почта</h3>
            <br />
            <?= Html::a('Входящие', ['']); ?>
            <?= Html::a('Отправленные', ['']); ?>
        </div>
        
        <div class = "col-xs-10">     
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //'class' => 'yii\grid\SerialColumn'],

            //'id',
            ['class' => 'yii\grid\CheckboxColumn'],  
            //'check',
            ['attribute' => 'email', 'value' => function ($model) {
            return Html::a($model->email, ['view', 'id' => $model->id]);
            },
            'format' => 'raw'],
            ['attribute' => 'theme', 'value' => function ($model) {
            return Html::a($model->theme, ['view', 'id' => $model->id]);
            },
            'format' => 'raw'],
            //'text:ntext',
            'date:datetime',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        <?php Pjax::end(); ?>
        </div>  
    </div>  
</div>

<?php $this->registerJs("
    $('#button').click(function() {  
       var keys = $('#w0').yiiGridView('getSelectedRows');
       //alert(keys);
       $.post({ 
          url: '/mailout/deletemailout', // your controller action
          dataType: 'json',
          data: {keylist: keys},
          
          /*success: function(data) {
              alert('Yes');
          },
          error:function(request,textStatus,error){
            alert(error);
          }*/
       });
   });
"); ?>
