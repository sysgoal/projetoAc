<?php
  use yii\helpers\Html;
  ?>
 <a href="javascript:;" onclick="location:javascript:history.go(-1)">
            <?= Html::buttonInput('Voltar', ['class' => 'btn btn-success', 'id' => 'myButton',  ]) ?>           
        </a><br/><br/>
  <?= Html::img(Yii::getAlias('@web') . '/imagesavaliacao/' .$filename , ['alt' => 'My image', 'width' => '900', 'height' => '800']) ?>




