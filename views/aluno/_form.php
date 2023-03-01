<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
// teste
/* @var $model app\models\Aluno */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$script = <<< JS
    $("#abrirModal").click(function(){ 
        $("#myModalAluno").modal("show");        
        });
                     
      $(document).ready(function() {
        if($('#nome').val() == '' || $('#nome').val() == null){
            $('#ativar1').hide();
            }
         $(document).on('click', '#ativar', function () {
                if($(this).is(":checked") == false) {
                     var name=confirm("Caso o paciente tenha avaliações com fotos/video, as mesmas serão excluídas! Tem certeza que deseja desativar o paciente?")
                    if (name==false){
                        return false;
                     }
                } 
          });
      
        
        
  function limpa_formulario_cep() {
                // Limpa valores do formulário de cep.
                $('#rua').val('');               
                $('#cidade').val('');
                $('#bairro').val('');
                $('#uf').val('');
               
            }
            
            //Quando o campo cep perde o foco. tst
            $('#cep').blur(function() {                  
                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $('#bairro').val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
        

$('#botao').click(function(){ 
   var nome = document.getElementById('nome').value;
   now = new Date();       
   var month = new Array();
month[0] = "Janeiro";
month[1] = "Fevereiro";
month[2] = "Março";
month[3] = "Abril";
month[4] = "Maio";
month[5] = "Junho";
month[6] = "Julho";
month[7] = "Agosto";
month[8] = "Setembro";
month[9] = "Outubro";
month[10] = "Novembro";
month[11] = "Dezembro";    
   ("janeiro", "fevereiro", "março", "abril", "Maio", "junho", "agosto", "outubro", "novembro", "dezembro");
   var rg = document.getElementById('rg').value;         
   var doc = new jsPDF();
doc.setFontSize(14);
doc.setFont("times", "bold");
doc.text("Termos de uso", 105, 18, null, null, "center");
doc.setFontSize(12);
doc.setFont("times", "normal");
doc.text("      Eu "+nome+" , portador do RG nº "+rg,  90, 27, null, null, "center");
doc.text("DECLARO que estou de acordo com as norma descritas abaixo:", 22, 32);
doc.setFont("times", "bold");
doc.text("NORMAS BÁSICAS:", 22, 38);
doc.setFont("times", "normal");
doc.text("Ao matricular-se na Harmonia você adquire direitos e deveres para uma convivência agradável.", 22, 44);
doc.setFont("times", "bold");
doc.text("HIGIENE E SAÚDE:", 22, 50);
doc.setFont("times", "normal");
doc.text("- Você tem direito à Avaliação Fisioterápica inicial, quando se matricula e deve reavaliar-se,", 22, 56);
doc.text("periodicamente (a cada 4 meses) com a fisioterapeuta (Turmas Adulto e Juvenil).", 22, 61);
doc.text("- Crianças fazem avaliações periódicas (no horário de aula), nas mesmas datas do teste de natação ", 22, 66);
doc.text("ou FESTA DAS TOUCAS, conforme calendário afixado na secretaria.", 22, 71);
doc.text("- Nas piscinas é obrigatório o uso de touca da Harmonia, mesmo que sobre outra.", 22, 76);
doc.text("- Usar as piscinas com roupa apropriada (sunga, maiô ou suquíni - se possível do uniforme)", 22, 81);
doc.text("Não é autorizado maiô de perninha, short ou sunga de perninha.", 22, 86);
doc.text("- Não é permitido o uso de cigarros e chicletes, bem como de bronzeadores ou creme.", 22, 91);
doc.text("- Tomar uma ducha (morna ou fria) antes de entrar na piscina, retirando os resíduos de suor.", 22, 96);
doc.text("- É proibido fazer atividades nos salões só de maiô, sunquíni ou sunga.", 22, 101);
doc.setFont("times", "bold");
doc.text("HORÁRIO:", 22, 107);
doc.setFont("times", "normal");
doc.text("- Faça um bom uso das dependências da Harmonia, nos horários combinados na secretaria.", 22, 113);
doc.text("- Aguarde nas salas de espera o horário de suas atividades.", 22, 118);
doc.text("- Permaneça nos vestiários só o tempo necessário para a higiene e troca de roupa.", 22, 123);
doc.text("- Não fazemos reposição de aulas perdidas.", 22, 128);
doc.setFont("times", "bold");
doc.text("SEGURANÇA:", 22, 134);
doc.setFont("times", "normal");
doc.text("- Acompanhantes só poderão ultrapassar a sala de espera quando solicitados.", 22, 140);
doc.text("- Quando houver necessidade de conversar com o professor ou com o fisioterapeuta comunique-se", 22, 145);
doc.text("com a recepção, ou procure a coordenação.", 22, 150);
doc.text("- Ficam disponíveis armários nos banheiros. Traga seu cadeado para trancar seus pertences enquanto ", 22, 155);
doc.text("faz suas atividades.", 22, 160)
doc.text("- Crianças, bebês e pessoas com necessidades especiais devem ser trocados no local apropriado.", 22, 165);
doc.text("- PEGUE SUA FICHA DE BANHO NA SECRETARIA.", 22, 170);
doc.setFont("times", "bold");
doc.text("PAGAMENTO:", 22, 176);
doc.setFont("times", "normal");
doc.text("- Os pagamentos serão efetuados na secretaria de 07:30 as 21:00hs (no sábado até as 11:30hs).", 22, 182);
doc.text("- Há descontos para pessoas da mesma família.", 22, 187);
doc.text("- Para fazer jus aos descontos combinados e evitar multas, é necessário absoluta pontualidade.", 22, 192);
doc.text("- O mês é sempre pago adiantado, vencendo no dia 1º, podendo ser quitado até dia 15.", 22, 197);
doc.text("Há desconto para pagamento até o 5º dia útil.", 22, 202);
doc.text("- Ao parar de fazer aula por um mês inteiro, o aluno deverá pagar a mensalidade mínima,", 22, 207);
doc.text("correspondente a duas aulas. (Só garantimos o mesmo horário com o pagamento integral).", 22, 212);
doc.text("- Falta sem aviso (24h de antecedência) será computada como aula dada, sem direito a ", 22, 217);
doc.text("restituição financeira.", 22, 222);

doc.setFont("times", "bold");
doc.text("AUTORIZAÇÃO DE USO DE IMAGEM:", 22, 228);
doc.setFont("times", "normal");
doc.text("[ ] Desde já, autoriza a Harmonia, com anuência de seu representante legal, caso for,", 22, 233);
doc.text("a utilizar sua imagem, quando dentro de suas dependências ou em aulas e eventos externos,", 22, 238);
doc.text("para fins de divulgação nos diversos meios de comunicação, sem qualquer tipo de contraprestação.", 22, 243);

doc.setFont("times", "italic");
doc.text("Sugestões serão consideradas sempre; atendidas, quando possível.  ", 105, 255, null, null, "center");
 
doc.setFont("times", "normal");
doc.text("Contagem, "+ now.getDate()+" de "+month[now.getMonth()]+" de "+now.getFullYear()+"__________________________________________________", 105, 275, null, null, "center");
doc.text("                              "+nome, 105, 280, null, null, "center");
 doc.save('Declaracao.pdf');
   });
    
   $(function() {       
        $('#profissional').hide();    
})
              
$('#paciente').change(function() {
    var ccexists = $("#paciente").prop("checked") ? true : false;
    if (ccexists == true) {   
        $('#profissional').show();  
    } else {       
        $('#profissional').hide();
    };
});

JS;
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js');
$this->registerJs($script);
?>

<div class="aluno-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'nm_aluno')->textInput(['maxlength' => true, 'style' => 'width:550px', 'id' => 'nome']) ?>
        </div>

        <div class="col-md-4">

            <?= $form->field($model, 'dt_nascimento', ['options' => ['style' => 'width: 250px']])->widget(\kartik\date\DatePicker::className(), ['pluginOptions' => ['format' => 'dd/mm/yyyy', 'autoclose'=>true], 'language' => 'pt-BR']) ?>
        </div>
        <div class="col-md-2">

            <?= $form->field($model, 'ds_ativo', ['options' => ['id' => 'ativar1']])->checkbox(['id' => 'ativar']) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'ds_cpf', ['options' => ['style' => 'width: 150px', 'id' => 'cpf']])->widget(\yii\widgets\MaskedInput::className(), ['mask' => '99999999999']) ?>
        </div>
        <div class="col-md-3">

            <?php $accountStatus = array('Masculino' => 'Masculino', 'Feminino' => 'Feminino') ?>
            <?= $form->field($model, 'ds_sexo')->radioList($accountStatus) ?>	
        </div>
        
        <div class="col-md-6">
            <?= $form->field($model, 'dt_registro', ['options' => ['style' => 'width: 250px']])->widget(\kartik\date\DatePicker::className(), ['pluginOptions' => ['format' => 'dd/mm/yyyy', 'autoclose'=>true], 'language' => 'pt-BR']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_identidade')->textInput(['maxlength' => true, 'style' => 'width:200px', 'id' => 'rg']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_responsaveis')->textInput(['maxlength' => true, 'style' => 'width:270px']) ?>
        </div> 
        <div class="col-md-3">
            <?php $parentescos = $model->getParentescos(); ?>
            <?= $form->field($model, 'ds_parentesco')->dropDownList($parentescos, ['style' => 'width:125px']) ?>   
        </div> 
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_cep')->textInput(['maxlength' => 8, 'style' => 'width: 150px', 'id' => 'cep']) ?>            
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'ds_endereco')->textInput(['maxlength' => true, 'style' => 'width:250px', 'id' => 'rua']) ?>            
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_complemento')->textInput(['maxlength' => true, 'style' => 'width:100px', 'id' => 'complemento']) ?>                       
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_bairro')->textInput(['maxlength' => true, 'style' => 'width:300px', 'id' => 'bairro']) ?>               
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'ds_cidade')->textInput(['maxlength' => true, 'style' => 'width:250px', 'id' => 'cidade']) ?> 
        </div>
        <div class="col-md-2">       
            <?= $form->field($model, 'ds_estado')->textInput(['style' => 'width:80px', 'id' => 'uf']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'ds_email')->textInput(['maxlength' => true, 'style' => 'width:250px']) ?>
        </div>


        <div class="col-md-3">
            <?= $form->field($model, 'ds_profissao')->textInput(['maxlength' => true, 'style' => 'width:200px']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_telefone1', ['options' => ['style' => 'width: 250px']])->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)9999-9999']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_telefone2', ['options' => ['style' => 'width: 250px']])->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)99999-9999']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_whatsapp', ['options' => ['style' => 'width: 250px']])->widget(\yii\widgets\MaskedInput::className(), ['mask' => '(99)99999-9999']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php $items = $model->getDataListConvenio(); ?>
            <?= $form->field($model, 'id_convenio')->dropDownList($items, ['style' => 'width:300px']) ?>               

        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'nr_matricula_conv')->textInput(['style' => 'width:150px']) ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'dt_validade', ['options' => ['style' => 'width: 250px']])->widget(\kartik\date\DatePicker::className(), ['pluginOptions' => ['format' => 'dd/mm/yyyy', 'autoclose'=>true], 'language' => 'pt-BR']) ?>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'ds_observacao')->textarea(['style' => 'width:400px']) ?>
        </div>
        <div class="col-md-2">           
            <?=
            $form->field($model, 'fl_paciente')->checkbox(['value' => '1',
                'id' => 'paciente'])
            ?>

            <?= Html::button('Gerar Declaração', ['class' => 'btn btn-primary', 'id' => 'botao']) ?>
        </div>       

        <div class="col-md-2">     
            <?php $items = $model->getDataListProfissional(); ?>
            <?= $form->field($model, 'id_profissional', ['options' => ['id' => 'profissional', 'style' => 'width:300px']])->dropDownList($items) ?>               
        </div>

    </div>

    <div class="row">

        <div class="col-md-6">
            <?=
            $form->field($model, 'image')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg']]]);
            ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'pdfDeclaracao')->fileInput(); ?> 
                     
            <?= Html::button('Anexar arquivos', ['class' => 'btn btn-primary', 'id' => 'abrirModal']) ?>            
    
        </div>

    </div>

    <div class="row"> 

        <div class="col-md-3">
            <div class="form-group">                                
                <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
            </div>

        </div> 


    </div>
   


</div>

<div class="modal fade" id="myModalAluno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Anexos</h4>
            </div>
            <div class="modal-body">
                <div class="row">                  
                    <div class="col-md-3">                       
                        <?= $form->field($model, 'arquivo1')->fileInput(); ?>                        
                    </div>                   
                </div>
                <div class="row">                                     
                    <div class="col-md-3">
                        <?= $form->field($model, 'arquivo2')->fileInput(); ?>                        
                    </div>
                </div>
                <div class="row">                                      
                    <div class="col-md-3">
                        <?= $form->field($model, 'arquivo3')->fileInput(); ?>                        
                    </div>
                </div>
                <div class="row">                                      
                    <div class="col-md-3">
                        <?= $form->field($model, 'arquivo4')->fileInput(); ?>                        
                    </div>
                </div>
                <div class="row">                                     
                    <div class="col-md-3">
                        <?= $form->field($model, 'arquivo5')->fileInput(); ?>                        
                    </div>
                </div>
                <div class="row">                                     
                    <div class="col-md-3">
                        <?= $form->field($model, 'arquivo6')->fileInput(); ?>                        
                    </div>
                </div>
                <div class="row">                                      
                    <div class="col-md-3">
                        <?= $form->field($model, 'arquivo7')->fileInput(); ?>                        
                    </div>
                </div>
                <div class="row">                                     
                    <div class="col-md-3">
                        <?= $form->field($model, 'arquivo8')->fileInput(); ?>                        
                    </div>
                </div>
                <div class="row">                                    
                    <div class="col-md-3">
                        <?= $form->field($model, 'arquivo9')->fileInput(); ?>                        
                    </div>
                </div>
                <div class="row">                                     
                    <div class="col-md-3">
                        <?= $form->field($model, 'arquivo10')->fileInput(); ?>                        
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal" id="fecha">Fechar</button>
        </div>
    </div>
</div>
 <?php ActiveForm::end(); ?>
