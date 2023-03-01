<!-- sidebar: style can be found in sidebar.less -->
<?php

use yii\helpers\Url;
use yii\helpers\Html;
               
$script = <<< JS
    
      $('#verTudo').click(function(event) {
            var valorUrl = $('#dadosUrl').val();
          const xhttp = new XMLHttpRequest(); 
           // faz a requisição AJAX - método POST
          xhttp.open("POST", valorUrl);
          // adiciona um header para a requisição HTTP
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          // especifica os dados que deseja enviar   
          xhttp.send("tudo="+'true');
        
});
JS;
$this->registerJs($script);

?>


<section class="sidebar">
    <ul class="sidebar-menu">
        <li class="header"><h4>Profissionais</h4></li>
 <?php /*Html::hiddenInput('', Yii::$app->homeUrl . '?r=horario-agenda%2Findex', ['id' => 'dadosUrl']) */ ?>

           <?php
            $listaProfissionais = $model->getDataListProfissional();
            foreach ($listaProfissionais as $prof) {
                echo '<li class="treeview">';
                echo '<a href=' . Url::to(Yii::$app->homeUrl . '?r=horario-agenda/index&id=' . $prof->id_profissional) . ' ><i class="fa fa-calendar"></i><span>' . $prof->nm_profissional . '</span></a>';
                echo '</li>';
            }
            ?>
        <?php /*Html::button('Visualizar Todos', ['id' => 'verTudo']) */?>
        
    </ul>
</section>
<!-- /.sidebar -->