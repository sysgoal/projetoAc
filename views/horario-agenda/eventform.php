
<?php

use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;

$script = <<< JS
$('#al01').val('');
$('#agenda').val('');
$('#data1').val('');
$('#hora1').val('');
$('#hora2').val('');
$('#nome1').val('');
$('#tel1').val('');
$('#aluno1').hide();
$(document).on('click', '#alunoAcademia', function() {
    if ($(this).is(":checked")) {
      $('#aluno1').show();
      $('#nome').hide();
      $('#tel').hide();
      $('#nome').val('');
      $('#tel').val('');
    } else {
      $('#aluno1').hide();
      $('#al01').val('');
      $('#nome').show();
      $('#tel').show();
    }
  });
$('#cad').click(function() {
  let a = $('#al01').val();
  let b = $('#hora1').val();
  let c = $('#hora2').val();
  let d = $('#agenda').val();
  let e = $('#data1').val()
  let f = $('#nome1').val();;
  let g = $('#tel1').val();
  if ((a == null || a == '') && (f == null || f == '')) {
    alert('Aluno/Paciente deve ser selecionado!');
    return false;
  }
  if (f != null && f != '') {
    if (g == null || g == '') {
      alert('Telefone deve ser informado!');
    }
  }
  if (b == null || b == '') {
    alert('Horário é obrigatório');
    return false;
  }
  if (c == null || c == '') {
    alert('Horário é obrigatório');
    return false;
  }
  if (d == null || d == '') {
    alert('Tipo de agendamento é obrigatório!');
    return false;
  }
  if (e == null || e == '') {
    alert('A Data é obrigatória!');
    return false;
  }
  if (b == c) {
    alert('Horário de início não pode ser igual ao horário de término');
    return false;
  }
  if (b > c) {
    alert('Horário de término não pode ser menor que o horário de início');
    return false;
  }
  var datas = $('#data1').val();
  var dataAux = datas.split(",");
    let aluno = $('#al01').val();
    let profissional = $('#prof').val();
    let agendamento = $('#agenda').val();
    let inicio = $('#hora1').val();
    let fim = $('#hora2').val();
    let telefone = $('#tel1').val();
    $.get("index.php?r=horario-agenda/recuperar-tamanho-lista", {
              profissional: profissional,
              dataAlt: datas,
              horaIni: inicio
            }, function(data) {
              if(data < 7){
                $.get('index.php?r=horario-agenda/insere-datas', {
                        aluno: aluno,
                        profissional: profissional,
                        agendamento: agendamento,
                        inicio: inicio,
                        fim: fim,
                        datas: datas,
                        nome: f,
                        telefone: telefone
                      }, function(data) {
                        location.reload();
                  });
                }else{
                  alert("Não é possível adicionar mais de 6 marcações pro mesmo horário");
                }
                return false;
             // location.reload();
        });
        
  
  
});
JS;

$this->registerJs($script);
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b>Cadastro de horário</b></h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->

    <div class="box-body">
        <div class="form-group">                
            <?php $form = ActiveForm::begin(); ?>
            <input type="hidden" name="userId" value=""  id="userId"/>

            <?php
            $alunos = $model->getDataListAluno();
            $profissional = $model->getDataListProfissional();
            ?>
            <input type="checkbox" name="alunoAcademia" value="ON" id="alunoAcademia"/> <b>Aluno da academia?</b>
            <?=
            $form->field($model, 'id_aluno', ['options' => ['id' => 'aluno1']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id_aluno',
                'data' => $alunos,
                'options' => ['placeholder' => ' --Selecione -- ', 'id' => 'al01'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>    
            <?= $form->field($model, 'nome', ['options' => ['id' => 'nome']])->textInput(['id' => 'nome1']) ?>
            <?= $form->field($model, 'telefone', ['options' => ['id' => 'tel']])->textInput(['id' => 'tel1']) ?>
            <?= $form->field($model, 'id_profissional')->hiddenInput(['value' => $id, 'id' => 'prof'])->label(false) ?>                  
        </div>
        <div class="form-group">

            <?php
            $itens = ['consulta' => 'Atendimento',
                'academia' => 'Avaliação da Academia',  
                'hipopressivo' => 'Avaliação Hipopressivo',
                'fisioterapia' => 'Avaliação Fisioterapia',
                'outros' => 'Fisioterapia']
            ?>
            <?= $form->field($model, 'tp_agendamento')->dropDownList($itens, ['id' => 'agenda']) ?>

        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-12">
                    <?= $form->field($model, 'dt_inicio')->widget(\kartik\date\DatePicker::className(), ['pluginOptions' => ['format' => 'dd/mm/yyyy', 'multidate' => true], 'language' => 'pt-BR', 'options' => ['id' => 'data1']]) ?>

                </div>
                <div class="col-xs-12">
                    <?=
                    $form->field($model, 'hr_inicio')->widget(\kartik\time\TimePicker::className(), ['name' => 'start_time',
                        'value' => '11:24 AM',
                        'options' => ['id' => 'hora1'],
                        'pluginOptions' => [
                            'showSeconds' => false,
                            'showMeridian' => false,
                            'minuteStep' => 30,
                        // 'secondStep' => 5,
                        ]
                    ])
                    ?>

                </div>
                <div class="col-xs-12">                      
                    <?=
                    $form->field($model, 'hr_fim')->widget(\kartik\time\TimePicker::className(), ['name' => 'end_time',
                        'value' => '11:24 AM',
                        'options' => ['id' => 'hora2'],
                        'pluginOptions' => [
                            'showSeconds' => false,
                            'showMeridian' => false,
                            'minuteStep' => 30,
                        // 'secondStep' => 5,
                        // 'defaultTime' => date('H:i', strtotime('+20 min')),
                        ]
                    ])
                    ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?= Html::Button('Agendar', ['class' => 'btn btn-success', 'id' => 'cad']) ?>
        </div>
        <?php ActiveForm::end(); ?>
        <!-- /.box-body -->
    </div>
</div>
<!-- /.box -->


