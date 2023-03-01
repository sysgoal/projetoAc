<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoFacial */
/* @var $form yii\widgets\ActiveForm */


$script = <<< JS
$('#outros2').hide();
$('#al01').change(function() {
    $('#botao').empty();
    var id = $(this).val();  
    $.get('index.php?r=avaliacaocoluna/get-dados-aluno', { id: id}, function(data){
    var data = $.parseJSON(data); 
     var url = "/web/index.php?r=aluno/view&id="+data.id;
     $("#botao").append("<a href="+url+" target=_blank>Visualizar</a>").addClass("far fa-address-card");
     if(data.id_convenio == null || data.id_convenio == ""){        
            document.getElementById("conv").innerHTML="Não há";
     }else{    
        $.get('index.php?r=avaliacaocoluna/get-dados-aluno-convenio', { id: data.id_convenio}, function(data2){
        var data2 = $.parseJSON(data2);                   
        document.getElementById("conv").innerHTML=data2.ds_nome;
        });  
    }
    var dtnasc = data.dt_nascimento;
    var hoje = new Date;
    var arrDataExclusao = dtnasc.split('/');
    var stringFormatada = arrDataExclusao[1] + '-' + arrDataExclusao[0] + '-' +
     arrDataExclusao[2];
    var dataFormatada1 = new Date(stringFormatada);    
   var idade = Math.floor(Math.ceil(Math.abs(dataFormatada1.getTime() - hoje.getTime()) / (1000 * 3600 * 24)) / 365.25);
     document.getElementById("txt").innerHTML=idade + " anos ";  
   });    
  
   });
                
$('#mimicas').hide();
$('#faciais').click(function() {    
   var result = $('#faciais input:checked').map(function () {                    
                    return this.value+": \\n";
                    }).get(); 
                        let arrayString = (result.toString()).replace(/,/g, '');
       
        
        if(result != null && result != ''){
            $('#mimicas').show();                
            $('#mimicas').val(arrayString);                     
        }else{
            $('#mimicas').hide();                
        }
        
  });
        
  
   $('#hphf').click(function() {    
   var names = $('#hphf input:checked').map(function () {                    
                    return " "+this.value;
                    }).get();
       if(names == 'Outras atividades'){
        $('#outros2').show();
        $('#outros2').val('');               
        } else {
        // $('#outros2').hide();
            $('#outros2').val(names);               
        }
  });
        
        $('#hphf').click(function() {    
   var names = $('#hphf input:checked').map(function () {                    
                    return " "+this.value;
                    }).get();
       if(names == " Outras atividades"){
        $('#outros2').show();
        $('#outros2').val('');               
        } else {
            $('#outros2').val(names);               
        }
  });
        
        
        validaTextArea('diagnostico');
        validaTextArea('objetivos');
        validaTextArea('queixa');
        validaTextArea('inspecao');
        validaTextArea('medicacao');
        validaTextArea('disfuncao');
        validaTextArea('molestia');
 
        function validaTextArea(nomeId){
          
            let contador = 0;
            $('#'+nomeId+'').keyup(function(e){             
            if (e.keyCode != 13){
                contador++;            
            }
            if(contador >= 43 && e.keyCode == 32){
           $('#'+nomeId+'').val($('#'+nomeId+'').val()+'\\n');
             contador = 0;
            }
        });
        }
        

        
        
JS;
$this->registerJs($script);

?>


<div class="avaliacao-facial-form">

    <?php $form = ActiveForm::begin(); ?>

    
     <br>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'dt_avaliacao')->textInput(['style' => 'width:120px', 'value' => date('d/m/Y'), 'readonly'=> true]) ?>            
        </div>                
        <div class="col-md-4">
             <?php 
                if($idAluno != null){
                    $alunos = $model->getDadoUmAluno($idAluno);
                }else{
                   $alunos = $model->getDataListAluno();
                }
            ?>
            <?=
            $form->field($model, 'id_aluno', ['options' => ['style' => 'width: 350px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $alunos,
                'options' => ['placeholder' => ' --Selecione um paciente-- ', 'id' => 'al01'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>     
        </div>
        <div class="col-md-2">
             <div id="botao"></div>            
 	
        </div> 
        <div class="col-md-2">            
             <?php echo '<b>Idade: </b><br><br>'; ?>             
            <div id ="txt"></div>
        </div>   
        <div class="col-md-2">            
            <?php echo '<b>Convênio: </b><br><br>'; ?>  
             <div id ="conv"></div>
        </div>   
    </div>
     <br><br>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_medico_responsavel')->textInput() ?>        
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_objetivo')->textarea(['rows' => 5,'id'=>'objetivos']) ?>           
        </div>        
    </div>
    
    <div class="row">
        <div class="col-md-6">
             <?= $form->field($model, 'ds_diagnostico')->textarea(['rows'=>5, 'id'=>'diagnostico']) ?>            
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_queixa')->textarea(['rows'=> 5, 'id' => 'queixa']) ?>
        </div>
    </div>
     <div class="row">
      <div class="col-md-6">
                  <?= $form->field($model, 'ds_disfuncoes')->textarea(['rows'=> 5, 'id'=>'disfuncao']) ?>
          </div>
         <div class="col-md-6">
                <?php $pat = array('tabagista' => 'tabagista', 'etilista' => 'etilista', 
            'sedentário' => 'sedentário', 'Outras atividades'=> 'Outras atividades') ?>
          <?= $form->field($model, 'ds_hp_hf_hs')->checkboxList($pat, ['id' => 'hphf']) ?>	
        <?= $form->field($model, 'ds_hp_hf_hs')->textInput(['style' => 'width:500px', 'id'=> 'outros2'])->label(false) ?>
     </div>
    
     </div>
     
     <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_hma')->textInput() ?>
        </div>
         <div class="col-md-6">
              <?php $accs = array('Diabetes Mellitus' => 'Diabetes Mellitus', 'HAS' => 'HAS', 'Hipercolesterolemia' => 'Hipercolesterolemia') ?>
            <?= $form->field($model, 'ds_hp')->radioList($accs) ?>	                         
         </div>
     </div>
     <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'ds_medicacao_uso')->textarea(['rows'=> 5, 'id'=>'medicacao']) ?>
        </div>
         <div class="col-md-6">
             <?= $form->field($model, 'ds_inspecao')->textarea(['rows' => 5, 'id'=>'inspecao']) ?>
         </div>
     </div>
    
      <div class="row">
          <div class="col-md-6">
                <?php $acc = array('Hemiface direita' => 'Hemiface direita', 'Hemiface esquerda' => 'Hemiface esquerda', 
                    'Apenas quadrante inferior da hemiface' => 'Apenas quadrante inferior da hemiface direita',
                    'Apenas quadrante inferior da hemiface esquerda' => 'Apenas quadrante inferior da hemiface esquerda') ?>
            <?= $form->field($model, 'ds_face_comprometida')->radioList($acc, ['inline'=>false]) ?>	                         
          </div>
          <div class="col-md-6">
                <?php $acc1 = array('Cara de bravo' => 'Cara de bravo', 'Cheiro ruim' => 'Cheiro ruim', 
                    'Enrugar a testa/Levantar as sobrancelhas' => 'Enrugar a testa/Levantar as sobrancelhas',
                    'Fechar os olhos forte' => 'Fechar os olhos forte', 'Sorriso amarelo' => 'Sorriso amarelo', 'Sorrisão' => 'Sorrisão',
                    'Beijo/Biquinho' => 'Beijo/Biquinho', 'Boca cheia de ar' => 'Boca cheia de ar', 'Biquinho de choro' => 'Biquinho de choro') ?>
            <?= $form->field($model, 'ds_mimicas_faciais', ['options' => ['id'=>'faciais']])->checkboxList($acc1) ?>	                         
          </div>
      </div>
<div class="row">
       <div class="col-md-6">
            <?php $items = ['Em andamento' => 'Em andamento', 'Concluída' => 'Concluída']; ?>
            <?= $form->field($model, 'situacao')->dropDownList($items, ['style' => 'width:300px']) ?>  
        </div>  
    <div class="col-md-6">
        <?= $form->field($model, 'ds_observacao_mimicas')->textarea(['id' => 'mimicas', 'rows' => 11 ])->label(false) ?>
    </div>
     
        
     <?= $form->field($model, 'id_profissional')->hiddenInput(['value' => $model->getAvaliador($idProf)->id_profissional])->label(false) ?>
</div>    
     <div class="row">
       <div class="col-md-6">
     
       <?= $form->field($model, 'ds_historia_molestia')->textarea(['id' => 'molestia', 'rows' => 5 ]) ?>
       </div>
     </div>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success', 'id'=>'btnSalvar']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!-- Implementar pra pegar o id do usuario logado -->
    
