<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use bsadnu\googlecharts\ComboChart;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
?>
<style>
@media print {
    #noprint {
        display: none;
    }

    body {
        background: #fff;
    }
}
</style>
<div id="noprint">
    <p align="center">


    </p>
</div>
<?php //Html::a('zap', 'https://web.whatsapp.com/send?phone=5531992381871&text=Ol%C3%A1%20Jose%20Natal%20Campolino,%20seu%20atendimento%20est%C3%A1%20agendado%20para%20o%20dia%2011/01/2021%20%C3%A0s%2008:00h,%20podemos%20confirmar%20sua%20presen%C3%A7a?', ['class' => 'btn btn-primary']) 
?>


<br>

<?php
$script = <<< JS

     
$('#btnHofi').click(function() {         
 
    $("#modalHofi").modal("show");     
 
});    

     
$('#btnPilates').click(function() {         
 
 $("#modalPilates").modal("show");     

});    
    
JS;
$this->registerJs($script);




$css = "
        
table.quotation {
  border: 3px solid #037547;
  border-collapse: collapse;
  margin: 0 auto;
}

.quotation thead,tfoot {
  border-width: 2px;
  border-style: solid;
}

.quotation th,.quotation td{
  border: 1px solid #037547;
  color: #037547;
  padding: 4px 25px;
}

.quotation thead th,
.quotation tfoot th{
  background-color: #E0EBE3;
}

.quotation tbody td {
  background-color: #FFFBFE;
}
.alinha table{
 margin: auto;
}
";
$this->registerCss($css);

use app\models\BoletimAluno;
use app\models\TesteHofi;
use app\models\TestePilates;

$boletim = new BoletimAluno();


$dados = $boletim->getBoletim($id);
$imc = $boletim->getDadosImc($id);
$avaliacaos = $boletim->getDadosAvaliacao($id);
$modelHofi = new TesteHofi(); 
$modelPilates = new TestePilates();
$aluno = $boletim->getAlunoPorId($id);
?>

<div class="alinha" id="print">
    <table>
        <tbody>
            <tr>
                <th>
                    <?php
                    if ($imc != null) {
                        echo ComboChart::widget([
                            'id' => 'graficoImc',
                            'data' => $imc,
                            'options' => [
                                'chartArea' => [
                                    'left' => '15%',
                                    'width' => '60%',
                                    'height' => 350
                                ],
                                // 'MaxValue' => 50,
                                'width' => 900,
                                'height' => 500,
                               
                                'isStacked' => true,
                                'legend' => 'bottom',
                                'seriesType' => 'area',
                                'areaOpacity' => 0.4,
                                'series' => [
                                    0 => [
                                        'lineWidth' => 0,
                                        'visibleInLegend' => false,
                                        'enableInteractivity' => false,
                                    ],
                                    1 => [
                                        'lineWidth' => 0,
                                        'visibleInLegend' => false,
                                        'enableInteractivity' => false,
                                    ],
                                    2 => [
                                        'lineWidth' => 0,
                                        'visibleInLegend' => false,
                                        'enableInteractivity' => false,
                                    ],
                                    3 => [
                                        'lineWidth' => 0,
                                        'visibleInLegend' => false,
                                        'enableInteractivity' => false,
                                    ],
                                    4 => ['type' => 'line',
                                        'color' => 'yellow',
                                        'pointSize' => 4,
                                        'lineWidth' => 1,
                                        'pointShape' => 'square',
                                        'visibleInLegend' => true,
                                    ],
                                    5 => ['type' => 'line',
                                        'color' => 'green',
                                        'pointSize' => 4,
                                        'lineWidth' => 1,
                                        'pointShape' => 'square',
                                        'visibleInLegend' => true,
                                    ],
                                    6 => ['type' => 'line',
                                        'color' => '#FF6633',
                                        'pointSize' => 4,
                                        'lineWidth' => 1,
                                        'pointShape' => 'square',
                                        'visibleInLegend' => true,
                                    ],
                                    7 => ['type' => 'line',
                                        'color' => 'red',
                                        'pointSize' => 4,
                                        'pointShape' => 'square',
                                        'visibleInLegend' => true,
                                        'lineWidth' => 1,
                                    ],
                                    8 => ['type' => 'line',
                                        'color' => 'black',
                                        'pointSize' => 10,
                                        'pointShape' => 'square',
                                    ]
                                ],
                                'colors' => ['yellow', 'green', '#FF6633', 'red'],
                                'pointSize' => 4,
                                'vAxis' => [
                                    'title' => 'Valor do IMC',
                                    'titleTextStyle' => [
                                        'fontSize' => 13,
                                        'italic' => false
                                    ],
                                    'viewWindow' => ['min' => 0,
                                        'max' => 40]
                                ],
                                
                                'legend' => [
                                    'position' => 'top',
                                    'alignment' => 'end',
                                    'textStyle' => [
                                        'fontSize' => 12
                                    ]
                                ],
                            ]
                        ]);
                    } 
                    ?>
                </th>
                <!--  <th> <?php
                    if ($imc != null) {
                        echo '<table><tr><td>Data</td><td>Imc</td></tr>';
                        foreach ($avaliacaos as $aval) {
                            echo '<tr><td>' . $aval->dt_avaliacao . '</td><td>' . $aval->ds_imc . '</td></tr>';
                        }
                        echo '</table>';
                    }
                    ?></th>-->
            </tr>
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalHofi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false"
    data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Teste HOFI </h4>
            </div>
            <div class="modal-body">
                <div class="boletim-infantil-form">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="avaliacao-form">
                        <div class="row">
                            <div class="col-md-6">
                                <?php $aluno = $boletim->getAlunoPorId($id);
                                    echo '<b> Nome do paciente  </b><br><br>' ; 
                                    echo $aluno->nm_aluno ;?>
                                    <?= $form->field($modelHofi, 'id_aluno')->hiddenInput(['value' => $aluno->id])->label(false) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($modelHofi, 'dt_teste', ['options' => ['style' => 'width: 250px']])->widget(\kartik\date\DatePicker::className(), ['pluginOptions' => ['format' => 'dd/mm/yyyy', 'autoclose'=>true], 'language' => 'pt-BR']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($modelHofi, 'ds_tempo')->textInput(['style' => 'width:200px']) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($modelHofi, 'tp_nado')->textInput(['style' => 'width:200px']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($modelHofi, 'ds_observacao')->textarea(['rows' => 6]) ?>
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
</div>         
    <div class="modal fade" id="modalPilates" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false"
    data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel2">Teste HOFI </h4>
                </div>
                <div class="modal-body">
                    <div class="boletim-infantil-form">
                        <?php $form = ActiveForm::begin(); ?>
                        <div class="avaliacao-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php $aluno = $boletim->getAlunoPorId($id);
                                        echo '<b> Nome do paciente  </b><br><br>' ; 
                                        echo $aluno->nm_aluno ;?>
                                        <?= $form->field($modelPilates, 'id_aluno')->hiddenInput(['value' => $aluno->id])->label(false) ?>
                                </div>
                                <div class="col-md-2">
                                    <?= $form->field($modelPilates, 'dt_teste', ['options' => ['style' => 'width: 250px']])->widget(\kartik\date\DatePicker::className(), ['pluginOptions' => ['format' => 'dd/mm/yyyy', 'autoclose'=>true], 'language' => 'pt-BR']) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($modelPilates, 'ds_001')->textInput(['style' => 'width:200px']) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($modelPilates, 'ds_002')->textInput(['style' => 'width:200px']) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($modelPilates, 'ds_003')->textInput(['style' => 'width:200px']) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($modelPilates, 'ds_004')->textInput(['style' => 'width:200px']) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($modelPilates, 'ds_005')->textInput(['style' => 'width:200px']) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($modelPilates, 'ds_observacao')->textarea(['rows' => 6]) ?>
                                </div>

                            </div>
                            <div class="form-group">
                                <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="fecha2">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        