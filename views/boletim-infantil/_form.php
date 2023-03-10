<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\BoletimInfantil */
/* @var $form yii\widgets\ActiveForm */


$script = <<< JS
           $('#p1').hide();
           $('#p2').hide();
           $('#p3').hide();
           $('#p4').hide();
           $('#p5').hide();
           $('#c1').hide();
           $('#c2').hide();
           $('#c3').hide();
           $('#c4').hide();
           $('#c5').hide();

   var controle = 0;
   $('#touca').change(function (){
        let cor = $(this).val();
        if(cor == 'Azul'){
           $('#atv1').html('Passar na ducha sozinho');           
           $('#atv2').html('Entra na piscina alegre');
           $('#atv3').html('Pula de bóia com ajuda');
           $('#atv4').html('Molha o rosto');
           $('#atv5').html('Cata bichos com bóia');
           $('#datv1').val('Passar na ducha sozinho');           
           $('#datv2').val('Entra na piscina alegre');
           $('#datv3').val('Pula de bóia com ajuda');
           $('#datv4').val('Molha o rosto');
           $('#datv5').val('Cata bichos com bóia');
           $('#p1').show();
           $('#p2').show();
           $('#p3').show();
           $('#p4').show();
           $('#p5').show();
           $('#c1').hide();
           $('#c2').hide();
           $('#c3').hide();
           $('#c4').hide();
           $('#c5').hide();
        }else if(cor == 'Amarela'){       
           $('#atv1').html('Pula sem ajuda');
           $('#atv2').html('Pega objetos no fundo da piscina');
           $('#atv3').html('Faz borbolhas');
           $('#atv4').html('Flutuação horizontal');
           $('#atv5').html('Pernada com prancha 25m');
           $('#datv1').val('Pula sem ajuda');
           $('#datv2').val('Pega objetos no fundo da piscina');
           $('#datv3').val('Faz borbolhas');
           $('#datv4').val('Flutuação horizontal');
           $('#datv5').val('Pernada com prancha 25m');
           $('#p1').show();
           $('#p2').show();
           $('#p3').show();
           $('#p4').show();
           $('#p5').show();
           $('#c1').hide();
           $('#c2').hide();
           $('#c3').hide();
           $('#c4').hide();
           $('#c5').hide();
        }else if(cor == 'Verde'){
           $('#atv1').html('Nado livre 25m');
           $('#atv2').html('Desliza sobre a água');
           $('#atv3').html('Nada cahorrinho 25m');
           $('#atv4').html('Passa debaixo da perna');
           $('#atv5').html('Braçada e pernada com prancha');
           $('#datv1').val('Nado livre 25m');
           $('#datv2').val('Desliza sobre a água');
           $('#datv3').val('Nada cahorrinho 25m');
           $('#datv4').val('Passa debaixo da perna');
           $('#datv5').val('Braçada e pernada com prancha');
           $('#p1').show();
           $('#p2').show();
           $('#p3').show();
           $('#p4').show();
           $('#p5').show();
           $('#c1').hide();
           $('#c2').hide();
           $('#c3').hide();
           $('#c4').hide();
           $('#c5').hide();
        }else if(cor == 'Branca'){
           $('#atv1').html('Mergulho com deslocamento 10m');
           $('#atv2').html('Crawl com prancha 50m');
           $('#atv3').html('Flutuação dorsal');
           $('#atv4').html('Crawl completo 25m');
           $('#atv5').html('Saída de ponta');
           $('#datv1').val('Mergulho com deslocamento 10m');
           $('#datv2').val('Crawl com prancha 50m');
           $('#datv3').val('Flutuação dorsal');
           $('#datv4').val('Crawl completo 25m');
           $('#datv5').val('Saída de ponta');
           $('#p1').show();
           $('#p2').show();
           $('#p3').show();
           $('#p4').show();
           $('#p5').show();
           $('#c1').hide();
           $('#c2').hide();
           $('#c3').hide();
           $('#c4').hide();
           $('#c5').hide();
        }else if(cor == 'Cinza'){
           $('#atv1').html('Mergulho profundo 15m');
           $('#atv2').html('Rolamento à frente/trás');
           $('#atv3').html('Saída e 50m de Crawl');
           $('#atv4').html('Saída e 50m de Costas');
           $('#atv5').html('Virada simples Crawl/Costas');
           $('#datv1').val('Mergulho profundo 15m');
           $('#datv2').val('Rolamento à frente/trás');
           $('#datv3').val('Saída e 50m de Crawl');
           $('#datv4').val('Saída e 50m de Costas');
           $('#datv5').val('Virada simples Crawl/Costas');
           $('#p1').show();
           $('#p2').show();
           $('#p3').show();
           $('#p4').show();
           $('#p5').show();
           $('#c1').hide();
           $('#c2').hide();
           $('#c3').hide();
           $('#c4').hide();
           $('#c5').hide();
        }else if(cor == 'Preta'){
           $('#atv1').html('Mergulho profundo 20m');
           $('#atv2').html('Saída e 50m Borboleta');
           $('#atv3').html('Saída/Filipina e 50m Peito');
           $('#atv4').html('50m Costas com virada');
           $('#atv5').html('50m de Crawl com Virada Olímpica');
           $('#datv1').val('Mergulho profundo 20m');
           $('#datv2').val('Saída e 50m Borboleta');
           $('#datv3').val('Saída/Filipina e 50m Peito');
           $('#datv4').val('50m Costas com virada');
           $('#datv5').val('50m de Crawl com Virada Olímpica');
           $('#p1').show();
           $('#p2').show();
           $('#p3').show();
           $('#p4').show();
           $('#p5').show();
           $('#c1').hide();
           $('#c2').hide();
           $('#c3').hide();
           $('#c4').hide();
           $('#c5').hide();

        }else if(cor == 'Polimento'){
           $('#atv1').html('Mergulho 25m');
           $('#atv2').html('Borboleta 3" ');
           $('#atv3').html('Costas 3" ');
           $('#atv4').html('Peito 3"');
           $('#atv5').html('Crawl 3" ');
           $('#datv1').val('Mergulho 25m');
           $('#datv2').val('Borboleta 3" ');
           $('#datv3').val('Costas 3" ');
           $('#datv4').val('Peito 3"');
           $('#datv5').val('Crawl 3" ');
           $('#p1').hide();
           $('#p2').hide();
           $('#p3').hide();
           $('#p4').hide();
           $('#p5').hide();
           $('#c1').show();
           $('#c2').show();
           $('#c3').show();
           $('#c4').show();
           $('#c5').show();


        }
        
    }); 
        $(document).on('click', '#naoFez', function () {
                if($(this).is(":checked") == true) {
                    controle = 1;
                    $('#atv1').hide();
                    $('#atv2').hide();
                    $('#atv3').hide();
                    $('#atv4').hide();
                    $('#atv5').hide();
                    $('#datv1').hide();
                    $('#datv2').hide();
                    $('#datv3').hide();
                    $('#datv4').hide();
                    $('#datv5').hide();
                    $('#p1').val('Não Fez');
                    $('#p2').val('Não Fez');
                    $('#p3').val('Não Fez');
                    $('#p4').val('Não Fez');
                    $('#p5').val('Não Fez');
                    $('#p1').hide();
                    $('#p2').hide();
                    $('#p3').hide();
                    $('#p4').hide();
                    $('#p5').hide();
                    $('#c1').hide();
                    $('#c2').hide();
                    $('#c3').hide();
                    $('#c4').hide();
                    $('#c5').hide();
                } 
          });
        
        $('#salvar').click(function (){
        let aux = 0;
        
            if($('#touca').val() != 'Selecione' && controle == 0){
               
               if($('#touca').val() != 'Polimento'){
                    if($('#p1 :checked').val() == null){
                        $('#tp1').html('Cor do peixinho não pode ficar em branco.').css({ 'color': 'red'});
                        aux = 1;
                    }
                    if($('#p2 :checked').val() == null){
                        $('#tp2').html('Cor do peixinho não pode ficar em branco.').css({ 'color': 'red'});
                        aux = 1;
                    }
                    if($('#p3 :checked').val() == null){
                        $('#tp3').html('Cor do peixinho não pode ficar em branco.').css({ 'color': 'red'});
                        aux = 1;
                    }
                    if($('#p4 :checked').val() == null){
                        $('#tp4').html('Cor do peixinho não pode ficar em branco.').css({ 'color': 'red'});
                        aux = 1;
                    }
                    if($('#p5 :checked').val() == null){
                        $('#tp5').html('Cor do peixinho não pode ficar em branco.').css({ 'color': 'red'});
                        aux = 1;
                    }
                }else{
                    if($('#c1').val() == null || $('#c1').trim() == ' '){
                        $('#tp1').html('Campo não pode ficar em branco.').css({ 'color': 'red'});
                        aux = 1;
                    }
                    if($('#c2').val() == null || $('#c2').trim() == ''){
                        $('#tp2').html('Campo não pode ficar em branco.').css({ 'color': 'red'});
                        aux = 1;
                    }
                    if($('#c3').val() == null || $('#c3').trim() == ''){
                        $('#tp3').html('Campo não pode ficar em branco.').css({ 'color': 'red'});
                        aux = 1;
                    }
                    if($('#c4').val() == null || $('#c4').trim() == ''){
                        $('#tp4').html('Campo não pode ficar em branco.').css({ 'color': 'red'});
                        aux = 1;
                    }
                    if($('#c5').val() == null || $('#c5').trim() == ''){
                        $('#tp5').html('Campo não pode ficar em branco.').css({ 'color': 'red'});
                        aux = 1;
                    }
                }
            }    
            if($('#touca').val() == 'Selecione'){
                $('#sel1').html('Deve ser selecionada uma touca.').css({ 'color': 'red'});
                aux = 1;
            }
            if(aux != 0){
                return false;
            }                
        });
        
        $('#historicoAval').hide();
        $('#outros2').hide();
            $('#al01').change(function() {
               removeHistoricoAvaliacao();
                var id = $(this).val();  
                $.get('index.php?r=avaliacaocoluna/get-dados-aluno', { id: id}, function(data){
                var data = $.parseJSON(data); 
                 var url = "/web/index.php?r=aluno/view&id="+data.id;                 
                //$("#botao").append("<a href="+url+" target=_blank>Visualizar</a>").addClass("far fa-address-card");
                var dtnasc = data.dt_nascimento;
                var hoje = new Date;
                var arrDataExclusao = dtnasc.split('/');
                var stringFormatada = arrDataExclusao[1] + '-' + arrDataExclusao[0] + '-' +
                 arrDataExclusao[2];
                var dataFormatada1 = new Date(stringFormatada);    
                var idade = Math.floor(Math.ceil(Math.abs(dataFormatada1.getTime() - hoje.getTime()) / (1000 * 3600 * 24)) / 365.25);
                 $('#idade').val(idade);  
               });
        
                $.get('index.php?r=avaliacao-infantil/dados-avaliacao', { id: id}, function(dados){
                    var dados = $.parseJSON(dados);      
                    $('#historicoAval').show();
                    dados.forEach(historicoAvaliacao);
                });

          });
        
        function historicoAvaliacao(item) {
            $("#tabelaA").append("<tr class=trAppend><th style=text-align:center;>" + item.dataAvaliacao 
                + "</th><th style=text-align:center;>" + item.idade + "</th><th style=text-align:center;>" + 
                    item.peso + "</th><th style=text-align:center;>" + item.altura + "</th><th style=text-align:center;>" + 
                    item.abdomen + "</th><th style=text-align:center;>" + item.flexao + "</th><th style=text-align:center;>" + item.postura+"</th></tr>");
        }
        
        function removeHistoricoAvaliacao() {
        
          $('#tabelaA').empty();
            $("#tabelaA").append("<tr><th style=text-align:center;background-color:gray>Data </th>"+
                            "<th  style=text-align:center;background-color:gray>Idade</th>"+                                                                  
                            "<th  style=text-align:center;background-color:gray>Peso </th>"+
                            "<th  style=text-align:center;background-color:gray>Altura </th>"+
                            "<th  style=text-align:center;background-color:gray>Abdomen </th>"+
                            "<th  style=text-align:center;background-color:gray>Flexão </th>"+
                            "<th  style=text-align:center;background-color:gray>Postura </th></tr>") ;
        }
        
               
        $('#festaToucasModal').modal('hide');
        $('#avaliacaoInfantil').modal('hide');
        
        $('#btnFesta').click(function(){
            $('#festaToucasModal').modal('show');   
        });
        
        $('#btnAvaliacao').click(function(){
            $('#avaliacaoInfantil').modal('show');   
        });
        
        
         
JS;
$this->registerJs($script);
?>
<?php
if ($situacao == 'cadastradoT') {
    echo '<script> alert("Touca cadastrada com sucesso!")</script>';
}

if ($situacao == 'cadastradoA') {
    echo '<script> alert("Avaliação cadastrada com sucesso!")</script>';
}
?>

<br/>
<div align="center">
    <div class="row">
        <button type="button" class="btn btn-success" id="btnFesta">Cadastro de Touca</button>
        <button type="button" class="btn btn-primary" id="btnAvaliacao">Avaliação Infantil</button>
    </div>
</div>
<div class="modal fade" id="festaToucasModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Festa das Toucas </h4>
            </div>
            <div class="modal-body">
                <div class="boletim-infantil-form">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="avaliacao-form">
                        <div class="row">
                            <div class="col-md-3">
                                <?= $form->field($model, 'data', ['options' => ['style' => 'width: 200px']])->widget(\kartik\date\DatePicker::className(), ['pluginOptions' => ['format' => 'dd/mm/yyyy', 'autoclose' => true], 'language' => 'pt-BR']) ?>
                            </div>
                            <div class="col-md-5">
                                <?php
                                $alunos = $model->getDataListAluno();
                                ?>
                                <?=
                                $form->field($model, 'id_aluno')->widget(Select2::className(['style' => 'width:150px']), [
                                    'model' => $model,
                                    'attribute' => 'id',
                                    'data' => $alunos,
                                    'options' => ['placeholder' => ' --Selecione um aluno-- ', 'id' => 'al00'],
                                    'language' => 'pt_BR',
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'dropdownParent' => '#festaToucasModal'
                                    ],
                                ])
                                ?> 
                            </div>
                            <div class="col-md-4">
                                <?php $itemsProfissional = $model->getDataListProfissional(); ?>
                                <?=
                                $form->field($model, 'id_profissional')->widget(Select2::classname(['style' => 'width:150px']), [
                                    'data' => $itemsProfissional, // the select option data items.The array keys are option values, and the array values are the corresponding option labels
                                    'options' => ['placeholder' => 'Selecione um professor', 'id' => 'profissional'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'dropdownParent' => '#festaToucasModal'
                                    ],]);
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">                      
                                <?= $form->field($model, 'ds_cor_touca')->dropDownList($model->getCorTouca(), ['style' => 'width:150px', 'id' => 'touca']) ?>
                                <label id="sel1"></label>
                            </div>
                            <div class="col-md-9">
                                <br/>
                                <input type="checkbox" id="naoFez" name="naoFez">
                                <label for="naoFez">Não Fez</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label id="atv1">Atividade 1</label>
                                <?= $form->field($model, 'ds_atv1')->hiddenInput(['maxlength' => true, 'id' => 'datv1'])->label(false) ?>
                                <?php $accountStatus = array('Ouro' => 'Ouro', 'Prata' => 'Prata') ?>
                                <?= $form->field($model, 'peixe1')->radioList($accountStatus, ['id' => 'p1'])->label(false) ?>
                                <?= $form->field($model, 'caixa1')->textInput(['id' => 'c1'])->label(false) ?>
                                
                                <label id="tp1"></label>
                            </div>
                            <div class="col-md-2">
                                <label id="atv2">Atividade 2</label>
                                <?= $form->field($model, 'ds_atv2')->hiddenInput(['maxlength' => true, 'id' => 'datv2'])->label(false) ?>
                                <?= $form->field($model, 'peixe2')->radioList($accountStatus, ['id' => 'p2'])->label(false) ?>
                                <?= $form->field($model, 'caixa2')->textInput(['id' => 'c2'])->label(false) ?>
                                <label id="tp2"></label>
                            </div>
                            <div class="col-md-2">
                                <label id="atv3">Atividade 3</label>
                                <?= $form->field($model, 'ds_atv3')->hiddenInput(['maxlength' => true, 'id' => 'datv3'])->label(false) ?>
                                <?= $form->field($model, 'peixe3')->radioList($accountStatus, ['id' => 'p3'])->label(false) ?>
                                <?= $form->field($model, 'caixa3')->textInput(['id' => 'c3'])->label(false) ?>
                                <label id="tp3"></label>
                            </div>
                            <div class="col-md-2">
                                <label id="atv4">Atividade 4</label>
                                <?= $form->field($model, 'ds_atv4')->hiddenInput(['maxlength' => true, 'id' => 'datv4'])->label(false) ?>
                                <?= $form->field($model, 'peixe4')->radioList($accountStatus, ['id' => 'p4'])->label(false) ?>
                                <?= $form->field($model, 'caixa4')->textInput(['id' => 'c4'])->label(false) ?>
                                <label id="tp4"></label>
                            </div>
                            <div class="col-md-2">
                                <label id="atv5">Atividade 5</label>
                                <?= $form->field($model, 'ds_atv5')->hiddenInput(['maxlength' => true, 'id' => 'datv5'])->label(false) ?>
                                <?= $form->field($model, 'peixe5')->radioList($accountStatus, ['id' => 'p5'])->label(false) ?>
                                <?= $form->field($model, 'caixa5')->textInput(['id' => 'c5'])->label(false) ?>
                                <label id="tp5"></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success', 'id' => 'salvar']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="fecha">Fechar</button>            
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="avaliacaoInfantil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Avaliação Infantil </h4>
            </div>
            <div class="list-group panel" id="historicoAval">

                <a href="#submenu2" class="list-group-item sub-item collapsed" data-toggle="collapse" data-parent="#submenu1">Histórico de Avaliações <span class=" menu-ico-collapse"><i class="glyphicon glyphicon-chevron-down"></i></span></a>                
                <div class="list-group-submenu collapse" id="submenu2" style="height: 0px;">                                                       
                    <table id="tabelaA" border="1px"  width="850">                                                              
                        <tr><th style="text-align: center; background-color: gray">Data </th>
                            <th  style="text-align: center; background-color: gray">Idade</th>                                                                  
                            <th  style="text-align: center; background-color: gray">Peso </th>
                            <th  style="text-align: center; background-color: gray">Altura </th>
                            <th  style="text-align: center; background-color: gray">Abdomen </th>
                            <th  style="text-align: center; background-color: gray">Flexão </th>
                            <th  style="text-align: center; background-color: gray">Postura </th>
                        </tr> 
                    </table>
                </div>
            </div>
            <div class="modal-body">
                <div class="avaliacao-infantil-form">

                    <?php $form2 = ActiveForm::begin(); ?>
                    <?php $aluno2 = $model2->getDataListAluno(); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model2, 'data', ['options' => ['style' => 'width: 250px']])->widget(\kartik\date\DatePicker::className(), ['pluginOptions' => ['format' => 'dd/mm/yyyy', 'autoclose' => true], 'language' => 'pt-BR']) ?>
                        </div>
                        <div class="col-md-6">
                            <?=
                            $form->field($model2, 'id_aluno', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                                'model' => $model2,
                                'attribute' => 'id',
                                'data' => $aluno2,
                                'options' => ['placeholder' => ' --Selecione um aluno-- ', 'id' => 'al01'],
                                'language' => 'pt_BR',
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'dropdownParent' => '#avaliacaoInfantil'
                                ],
                            ])
                            ?>   
                        </div>
                        <div class="col-md-2">
                            <div id="botao"></div>            
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model2, 'idade')->textInput(['id' => 'idade', 'readonly' => false]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model2, 'peso')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model2, 'altura')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model2, 'abdomem')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model2, 'flexao')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model2, 'postura')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model2, 'observacao')->textarea(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="fecha">Fechar</button>            
                </div>
            </div>
        </div>
    </div>
</div>



