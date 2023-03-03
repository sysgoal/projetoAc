<?php

use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

Yii::$app->request->setBodyParams(null);
if(!isset($_POST['verTodosRegistros'])){
    $_POST['verTodosRegistros'] = 'false';
}
$script = <<< JS
$('#delete').click(function(event) {
  var id = event.id;
  $.get('index.php?r=horario-agenda/delete', {
    id: id
  }, function(data) {
    alert("Horario excluído!");
    $('#modalHistoricoPaciente').hide();
  });
});

JS;
$this->registerJs($script);
?>
<?php
$JsEventDrop = 
'function(event, delta, revertFunc) {
    
    /*var event_data = {
        id: event.id,
        titulo: event.title,
        descripcion: event.description,
        fecha_inicio: $.fullCalendar.formatDate(event.start, "YYYY-MM-DD"),
        hora_inicio: $.fullCalendar.formatDate(event.start, "HH:mm"),
        hora_termino: $.fullCalendar.formatDate(event.end, "HH:mm"),
        fecha_termino: $.fullCalendar.formatDate(event.end, "YYYY-MM-DD"),
        color: event.color,
    };*/
    $.get("index.php?r=horario-agenda/update-data-horario", {
                  id: event.id,
                  dataAlt: $.fullCalendar.formatDate(event.start, "YYYY-MM-DD"),
                  horaIni: $.fullCalendar.formatDate(event.start, "HH:mm"),
                  horaFim: $.fullCalendar.formatDate(event.end, "HH:mm")
                }, function(data) {
                  alert("Atualizado com sucesso!");
                 // location.reload();
            });
}';

$JsEventClick = '
    function(event, jsEvent, view) {  
            var globalHistorico = 0;
            $("#modalAlteracao").modal("hide");
            $("#zap").show();
            $("#combo").show();
            $("#cadastraAluno").hide();
            $("#modalHistoricoPaciente .modal-title").html(" ");
            $("#modalHistoricoPaciente .modal-nome").html(" ");
            $("#modalHistoricoPaciente .modal-prof").html(" ");
            $("#modalHistoricoPaciente .modal-agend").html(" ");
            $("#modalHistoricoPaciente .modal-horario").html(" ");
            $("#modalHistoricoPaciente .modal-just").html(" ");
            $("#modalHistoricoPaciente .modal-usu").html(" ");
            $("#modalHistoricoPaciente .modal-data").html(" ");
            $("#visualiza").hide();
            $("#botaoReagendar").hide();
            $("#historico").hide();
            $("#tipoAvaliacao").hide();

            let number = "";
            let msg = "";
            let link = "";
            let agendamento = "";
            let permissao = $("#idUsuario").val();            
            if (permissao == "Administrador"){
                $("#tabelaHistoricoAvaliacaoSemVisualizar").hide();     
                if(event.idAluno != null) {                    
                    $("#visualiza").show();
                } else{
                 $("#cadastraAluno").show();
                } 
            }else {
                if(event.idAluno != null) {                    
                    $("#historico").show();
                } else{
                    $("#cadastraAluno").show();
                } 
               $("#tabelaHistoricoAvaliacao").hide();  
            }
            if(event.justificativa == null && event.status == 0){
              $("#botaoReagendar").show();
              $("#combo").show();
              $("#usuarioModificacao").hide();
              $("#dataModificacao").hide();
            }else{
              $("#combo").hide();
              $("#botaoReagendar").hide();
              $("#usuarioModificacao").show();
              $("#dataModificacao").show();

            }
           
        $("#modalHistoricoPaciente").modal("show");
        $("#modalHistoricoPaciente .modal-title").html("Visualizar Compromisso");
        $("#modalHistoricoPaciente .modal-nome").html("Aluno: <b>" + event.title + "</b>");
        $("#modalHistoricoPaciente .modal-prof").html("Profissional: <b>" + event.profissional + "</b>");

        if (event.description == "academia") {
          agendamento = "Avaliação da academia";
        }else if (event.description == "consulta") {
          agendamento = "Atendimento";
        }else if(event.description == "outros") {
          agendamento = "Fisioterapia";
        }else if(event.description == "hipopressivo") {
          agendamento = "Avaliação Hipopressivo";
        }else if (event.description == "fisioterapia") {
          agendamento = "Avaliação Fisioterapia";
        }else if(event.description == "outros" || event.description == "consulta" || event.description == "fisioterapia") {
          $("#avaliacao").hide();
          $("#tipoAvaliacao").hide();
        }
        $("#modalHistoricoPaciente .modal-agend").html("Tipo de agendamento: <b>" + agendamento + "</b>");

        if (event.justificativa != null) {
          $("#modalHistoricoPaciente .modal-just").html("Justificativa: <b>" + event.justificativa + "</b>");
          if(event.status == 1){
            $("#modalHistoricoPaciente .modal-usu").html("Usuário que realizou o Reagendamento: <b>" + event.usuarioModificacao + "</b>");
            $("#modalHistoricoPaciente .modal-data").html("Data que foi efetuado o Reagendamento: <b>" + event.dataModificacao + "</b>");
          }
          $("#combo").hide();
          $("#submenu3").hide();
          $("#avaliacao").hide();
          $("#botaoExcluir").hide(); 
        } else {
          $("#botaoExcluir").show();
        }

        $("#modalHistoricoPaciente .modal-horario").html("Data: <b>" + $.fullCalendar.formatDate(event.start, "DD/MM/YYYY") + 
        "</b> Horário: <b> " + $.fullCalendar.formatDate(event.start, "HH:mm") + 
        "</b> às <b>" + $.fullCalendar.formatDate(event.end, "HH:mm") + " </b>");
     
        //FORMATAR NUMERO WHATSAPP FORMATO PADRAO
        number = event.numero;
        number = number.replace("(", "");
        number = number.replace(")", "");
        number = number.replace("-", "");
        number = "55" + number;
        msg = "Prezado(a) *" + event.title + "* podemos confirmar seu horário para: *" +
        $.fullCalendar.formatDate(event.start, "DD/MM/YYYY") + "* às *" +
        $.fullCalendar.formatDate(event.start, "HH:mm") + "* ?";
        
        if (event.numero == null || event.numero == "" || event.justificativa != null) {
            $("#zap").hide();
        } else {
            $("#zap").show();
        }
        msg = window.encodeURIComponent(msg);
        // montar o link (número e texto) (web)
            link = "https://web.whatsapp.com/send?phone=" + number + "&text=" + msg;
        $("#zap").click(function() {
            window.open(link, "_blank");
            location.reload();
        });

        $("#salvar").click(function() {
            let justificativa = $("#statusAgendamentoSecretaria").val();

            if (justificativa == "selecione") {
                alert("Escolha uma opção");
                return false;
            }
                let id = event.id;
                let cor = "#DAA520";
                let nome = event.title;
                let status = 0;

            if (justificativa == "Finalizado") {
                cor = "#008000";
            } else if (justificativa == "Não Compareceu") {
              cor = "#8B0000";
            } else if(justificativa == "Falta Justificada"){
              status = 1;
            }
            
            $.get("index.php?r=horario-agenda/update-horario", {
              id: id,
              just: justificativa,
              cor: cor,
              status: status
            }, function(data) {
              alert("Atualizado com sucesso!");
              location.reload();
            });
            $("#modalHistoricoPaciente").modal("hide");
            updateEvent
        }); //FIM SALVAR

        $("#botaoReagendar").click(function(){
          $("#modalAlteracao").modal("show");

        });
        
        $("#avaliacao").click(function() {
          let aluno = event.idAluno;
          if (aluno != null) {
            let tpAgendamento = $("#tipoAvaliacao").val();
            let urlAvaliacao = "/web/index.php?r=";
            if(tpAgendamento == "academia") {
              urlAvaliacao = urlAvaliacao + "avaliacao/create&idAluno=" + aluno;
            }else if(tpAgendamento == "hipopressivo") {
              urlAvaliacao = urlAvaliacao + "avaliacao-hipopressivo/create&idAluno=" + aluno;
            }else if(tpAgendamento == "coluna") {
              urlAvaliacao = urlAvaliacao + "avaliacaocoluna/create&idAluno=" + aluno;
            }else if(tpAgendamento == "inferior") {
              urlAvaliacao = urlAvaliacao + "avaliacaoinferior/create&idAluno=" + aluno;
            }else if(tpAgendamento == "superior") {
              urlAvaliacao = urlAvaliacao + "avaliacaosuperior/create&idAluno=" + aluno;
            }else if(tpAgendamento == "vestibular") {
              urlAvaliacao = urlAvaliacao + "avaliacaovestibular/create&idAluno=" + aluno;
            }else if(tpAgendamento == "facial") {
              urlAvaliacao = urlAvaliacao + "avaliacaofacial/create&idAluno=" + aluno;
            }else if(tpAgendamento == "selecionarAvaliacao") {
              alert("Selecione uma avaliação");
              return;
            }
            window.open(urlAvaliacao, "_blank");
            $("#modalHistoricoPaciente").modal("hide");
            $("#modalDadosPaciente").modal("hide");
            updateEvent
          }
        });//FIM AVALIACAO

        $("#btSalvarHorario").click(function(){
            if ( $("#dataAlt").val() == null ||  $("#dataAlt").val() == "") {
               alert("A Data é obrigatória!");
               return false;
             }
            if ($("#horaIni").val() == null || $("#horaIni").val() == "") {
                alert("Horário é obrigatório");
                return false;
            }
            if ($("#horaIni").val() == $("#horaFim").val()) {
              alert("Horário de início não pode ser igual ao horário de término");
              return false;
            }
            if ($("#horaIni").val() > $("#horaFim").val()) {
                alert("Horário de término não pode ser menor que o horário de início");
                return false;
            }
            $.get("index.php?r=horario-agenda/recuperar-tamanho-lista", {
              profissional: event.profissional,
              dataAlt: $("#dataAlt").val(),
              horaIni: $("#horaIni").val(),
              horaFim: $("#horaFim").val()
            }, function(data) {
             
                if(data < 6){
                  $.get("index.php?r=horario-agenda/insere-datas-reagendamento", {
                          id: event.id,
                          inicio: $("#horaIni").val(),
                          fim: $("#horaFim").val(),
                          data: $("#dataAlt").val(),
                        }, function(data) { 
                         location.reload();
                    });
                  }else{
                    if( permissao == "Administrador" ){
                      $.get("index.php?r=horario-agenda/insere-datas-reagendamento", {
                        id: event.id,
                        inicio: $("#horaIni").val(),
                        fim: $("#horaFim").val(),
                        data: $("#dataAlt").val(),
                      }, function(data) { 
                       location.reload();
                      });
                    }else{
                      alert("Não é possível adicionar mais de 6 marcações pro mesmo horário");
                    }
                  }
            return false;
         // location.reload();
    });


        /*    $.get("index.php?r=horario-agenda/update-data-horario", {
                  id: event.id,
                  dataAlt: $("#dataAlt").val(),
                  horaIni: $("#horaIni").val(),
                  horaFim: $("#horaFim").val()
                }, function(data) {
                  alert("Reagendado com sucesso!");
                  location.reload();
            }); */
            
        }); 

        $("#salvaObs").click(function() {
          let justificativa = $("#statusAgendamentoProfissional").val();
          if (justificativa == "selecione") {
            alert("Obrigatório informar o status");
            return false;
          }else {
            let observacao = $("#observacao").val();
            let descricao = $("#descricao").val();
            let id = event.id;
            let cor = "#DAA520";
            
            if (justificativa == "Finalizado") {
              cor = "#008000";
            }else if (justificativa == "Não Compareceu") {
              cor = "#8B0000";
            }
            $.get("index.php?r=horario-agenda/update-horario", {
              id: id,
              just: justificativa,
              cor: cor,
              observacao: observacao,
              descricao: descricao
            }, function(data) {
              alert("Atualizado com sucesso!");
              location.reload();
            });
            $("#modalHistoricoPaciente").modal("hide");            
          }
        });//FECHA SALVAR OBS PACIENTE
        
        $("#botaoExcluir").click(function() {
          let name = confirm("Tem certeza que deseja excluir?")
          if (name == false) {
            return;
          } else {
            let id = event.id;
            $.get("index.php?r=horario-agenda/delete-horario", {
              id: id
            }, function() {
              alert("Removido com sucesso!");
            });
            $("#modalHistoricoPaciente").modal("hide");
            updateEvent
          }
        });//FECHA BOTAO EXCLUIR

        $("#fechaExcluir").click(function(){
            location.reload();
         });

        $("#modalDadosPaciente .modal-title").html(" ");
        $("#modalDadosPaciente .modal-nome").html(" ");
        $("#modalDadosPaciente .modal-idade").html(" ");
        $("#modalDadosPaciente .modal-sexo").html(" ");
        $("#modalDadosPaciente .modal-profissional").html(" ");
        $("#modalDadosPaciente .modal-dt").html(" ");
        $("#modalDadosPaciente .modal-agend").html(" ");
        $("#pof").html(" ");
        $("#dt").html(" ");
        $("#ind").html(" ");
        
        $("#cadastraAluno").click(function() {
          var link = "/web/index.php?r=aluno/create";
          // link = window.encodeURIComponent(link);
          window.open(link, "_blank");
        });
        
        $("#visualiza").click(function() {  
         limpaLinhaModais();

          $("#modalDadosPaciente").modal("show");
          $("#modalDadosPaciente .modal-title").html("Detalhes do agendamento");
          $("#modalDadosPaciente .modal-nome").html("Aluno/Paciente: <b>" + event.title + "</b>&nbsp;&nbsp;&nbsp;");
          $("#modalDadosPaciente .modal-profissional").html("Profissional: <b>" + event.profissional + "</b>&nbsp;&nbsp;&nbsp;");
          $("#modalDadosPaciente .modal-agend").html("Tipo de agendamento: <b>" + agendamento + "</b>&nbsp;&nbsp;&nbsp;");                   
          $("#pof").html(event.profissional);
          $("#dt").html($.fullCalendar.formatDate(event.start, "DD/MM/YYYY"));
          let id = event.id;
          $.get("index.php?r=horario-agenda/dados-aluno", {
            idAluno: event.idAluno
          }, function(data) {
            let dtnasc = data.dt_nascimento;
            let hoje = new Date;
            let arrDataExclusao = dtnasc.split("/");
            let stringFormatada = arrDataExclusao[1] + "-" + arrDataExclusao[0] + "-" + arrDataExclusao[2];
            let dataFormatada1 = new Date(stringFormatada);
            let idade = Math.floor(Math.ceil(Math.abs(dataFormatada1.getTime() - hoje.getTime()) / (1000 * 3600 * 24)) / 365.25);
            $("#modalDadosPaciente .modal-dt").html("Data de Nascimento: <b>" + formataDate(dtnasc, "pt-br") + "</b>&nbsp;&nbsp;&nbsp;");
            $("#modalDadosPaciente .modal-idade").html("Idade<b>: " + idade + " anos</b>&nbsp;&nbsp;&nbsp;");
            $("#modalDadosPaciente .modal-sexo").html("Sexo: <b>" + data.ds_sexo + "</b>&nbsp;&nbsp;&nbsp;");
            
            $.get("index.php?r=horario-agenda/dados-convenio", {
              id: data.id_convenio
            }, function(data2) {
              if (data2 != null && data2.ds_nome != null) {
                $("#modalDadosPaciente .modal-just").html("Convênio: <b>" + data2.ds_nome + "</b>&nbsp;&nbsp;&nbsp;");
              }
            });
          });
          $.get("index.php?r=horario-agenda/dados-agenda", {
            idAluno: event.idAluno
          }, function(result) {
            result.forEach(historicoAtendimento);
          });
          $.get("index.php?r=horario-agenda/dados-avaliacao", {
            id: event.idAluno
          }, function(data) {
            data.forEach(historicoAvaliacaoDetalhe);
          });
        }); // FECHA VISUALIZA
        
        $("#historico").click(function() {
          
            limpaLinhaModais();
            $("#relatorioatual").remove();
            $("#avaliacao").hide();
            $("#modalDadosPaciente").modal("show");
            $("#modalDadosPaciente .modal-title").html("Histórico do Atendimento");
            $("#modalDadosPaciente .modal-nome").html("Aluno/Paciente: <b>" + event.title + "</b>&nbsp;&nbsp;&nbsp;");
            var id = event.id;
            $.get("index.php?r=horario-agenda/dados-aluno", {
              idAluno: event.idAluno
            }, function(data) {
              var dtnasc = data.dt_nascimento;
              var hoje = new Date;
              var arrDataExclusao = dtnasc.split("/");
              var stringFormatada = arrDataExclusao[1] + "-" + arrDataExclusao[0] + "-" + arrDataExclusao[2];
              var dataFormatada1 = new Date(stringFormatada);
              var idade = Math.floor(Math.ceil(Math.abs(dataFormatada1.getTime() - hoje.getTime()) / (1000 * 3600 * 24)) / 365.25);
              $("#modalDadosPaciente .modal-dt").html("Data de Nascimento: <b>" + formataDate(dtnasc, "pt-br") + "</b>&nbsp;&nbsp;&nbsp;");
              $("#modalDadosPaciente .modal-idade").html("Idade<b>: " + idade + " anos</b>&nbsp;&nbsp;&nbsp;");
              $("#modalDadosPaciente .modal-sexo").html("Sexo: <b>" + data.ds_sexo + "</b>&nbsp;&nbsp;&nbsp;");
              $.get("index.php?r=horario-agenda/dados-convenio", {
                id: data.id_convenio
              }, function(data2) {
                if (data2 != null && data2.ds_nome != null) {
                  $("#modalDadosPaciente .modal-just").html("Convênio: <b>" + data2.ds_nome + "</b>&nbsp;&nbsp;&nbsp;");
                }
              });
            });
          if(globalHistorico == 0){
            globalHistorico = 1;
            $.get("index.php?r=horario-agenda/dados-agenda", {
              idAluno: event.idAluno
            }, function(result) {
              result.forEach(historicoAtendimento);
            });
            $.get("index.php?r=horario-agenda/dados-avaliacao", {
              id: event.idAluno
            }, function(data) {
              data.forEach(historicoAvaliacaoSemVisualizar);
            });
          }
        });//FIM HISTORICO
        
    $("#fecha").click(function() {
        globalHistorico = 0;
    });

    function historicoAtendimento(item, indice) {
          if (item.ds_objetivo == null) {
            item.ds_objetivo = "";
          }
          if (item.ds_descricao == null) {
            item.ds_descricao = "";
          }
          if (item.ds_agendamento != null) {
            indice = parseInt(indice) + 1;
          }
            $("#tabelaHistoricoAtendimento").append("<tr class=trAppend><th rowspan=2 style=text-align:center;>" + formataDate(item.dt_inicio, "pt-br") + 
            "</th><th rowspan=2 style=text-align:center;>" + indice +
            "</th><th style=text-align:center;>" + item.ds_descricao + 
            "</th><th rowspan=2 style=text-align:center;>" + item.nome + 
            "</th><th rowspan=2 style=text-align:center;>" + item.ds_agendamento + 
            "</th></tr><tr class=trAppend><th style=text-align:center;>" + item.ds_objetivo + "</th></tr>");
    }

    function historicoAvaliacaoDetalhe(item) {
        if(item.dataAvaliacao != null && item.tpAvaliacao != null){
                $("#tabelaHistoricoAvaliacao").append("<tr class=trAppend><th style=text-align:center;>" + formataDate(item.dataAvaliacao, "pt-br") +
                "</th><th style=text-align:center;>" + item.tpAvaliacao + 
                "</th><th style=text-align:center;>" + item.profissional + 
                "</th><th style=text-align:center;><a href=" + item.url + 
                " target=_blank>Visualizar</a></th></tr>");
            }
    }

    function historicoAvaliacaoSemVisualizar(item) {
      if(item.dataAvaliacao != null && item.tpAvaliacao != null){
         $("#tabelaHistoricoAvaliacaoSemVisualizar").append("<tr class=trAppend><th style=text-align:center;>" + formataDate(item.dataAvaliacao, "pt-br")+ 
         "</th><th style=text-align:center;>" + item.tpAvaliacao + 
         "</th><th style=text-align:center;>" + item.profissional + "</th></tr>");

       }
    }
    
    function limpaLinhaModais(){               
        $("#tabelaHistoricoAvaliacao .trAppend").remove();       
        $("#historicoAvaliacaoDetalhe .trAppend").remove();
        $("#tabelaRelatorioAtual .trAppend").remove();        
        $("#tabelaHistoricoAvaliacaoSemVisualizar .trAppend").remove();
    }

        function formataDate(data, formato) {
          if(data != null && data != ""){ 
            if (formato == "pt-br") {
                return (data.substr(0, 10).split("-").reverse().join("/"));
              } else {
                return (data.substr(0, 10).split("/").reverse().join("-"));
              }
          }
        }
}
';
?>
<html>
    <head>
        <?=
        $this->render('head')
        ?>
    </head>
    <body class="skin-blue sidebar-mini">        
        <aside class="main-sidebar">
            <?=
            $this->render('sidebar', ['model' => $model])
            ?>

        </aside>
        <div class="content-wrapper">            
            <section class="content-header">
                <?php
                $profissionalDados = $model->getProfissionalId($id);
                echo '<h1><b>' . $profissionalDados->nm_profissional . '</b></h1><br/>';                        
                ?>
                <?= Html::hiddenInput('', Yii::$app->user->identity->permissao, ['id' => 'idUsuario'])/* $usuario->permissao]) */ ?>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-9">

                        <?=
                        \yii2fullcalendar\yii2fullcalendar::widget(array(
                            'ajaxEvents' => Url::to(Yii::$app->homeUrl . '?r=horario-agenda/jsoncalendar&id=' . $id.'&exibe='.$_POST['verTodosRegistros']),
                            'clientOptions' => [                               
                                'selectable' => false,
                                'editable' => true,
                                'droppable' => true,
                                'minTime' => '07:00',
                                'maxTime' => '22:00',
                                'height' => 'auto',
                                'snapDuration' => '00:30:00',
                                'eventClick' => new JsExpression($JsEventClick),
                              //  'eventDrop' => new JsExpression($JsEventDrop),
                            ],
                            'header' => [
                                'left' => 'prev,next',
                                'center' => 'title',
                                'right' => 'agendaDay, agendaWeek, month',
                            ],
                            'options' => [
                                'style' => 'width:650px;margin: 0 auto;',
                            ],
                        ));
                        ?>
                    </div>

                    <div class="col-md-3">
                        <?=
                        $this->render('eventform', ['searchModel' => $searchModel,
                            'dataProvider' => $dataProvider, 'model' => $model, 'id' => $id])
                        ?>
                    </div>
                </div>
                <div class="modal fade" id="modalHistoricoPaciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static" >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                <h5 class="modal-nome">Nome </h5> 
                                <button type="button" class="btn btn-success" id="historico">Histórico</button>
                                <button type="button" class="btn btn-success" id="visualiza">Visualizar</button>
                                <button type="button" class="btn btn-warning" id="botaoReagendar">Reagendar</button>
                                <button type="button" class="btn btn-primary" id="cadastraAluno">Cadastrar Aluno</button>
                                <h5 class="modal-prof">Prof</h5>
                                <h5 class="modal-agend">Agenda</h5>
                                <h5 class="modal-horario">horario</h5> 
                                <h5 class="modal-just">jutificativa</h5>
                                <h5 class="modal-usu"></h5>
                                <h5 class="modal-data"></h5>
                                <a href="#" target="_blank" id="zap">
                                    <svg enable-background="new 0 0 512 512" width="20" height="20" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><path d="M256.064,0h-0.128l0,0C114.784,0,0,114.816,0,256c0,56,18.048,107.904,48.736,150.048l-31.904,95.104  l98.4-31.456C155.712,496.512,204,512,256.064,512C397.216,512,512,397.152,512,256S397.216,0,256.064,0z" fill="#4CAF50"/><path d="m405.02 361.5c-6.176 17.44-30.688 31.904-50.24 36.128-13.376 2.848-30.848 5.12-89.664-19.264-75.232-31.168-123.68-107.62-127.46-112.58-3.616-4.96-30.4-40.48-30.4-77.216s18.656-54.624 26.176-62.304c6.176-6.304 16.384-9.184 26.176-9.184 3.168 0 6.016 0.16 8.576 0.288 7.52 0.32 11.296 0.768 16.256 12.64 6.176 14.88 21.216 51.616 23.008 55.392 1.824 3.776 3.648 8.896 1.088 13.856-2.4 5.12-4.512 7.392-8.288 11.744s-7.36 7.68-11.136 12.352c-3.456 4.064-7.36 8.416-3.008 15.936 4.352 7.36 19.392 31.904 41.536 51.616 28.576 25.44 51.744 33.568 60.032 37.024 6.176 2.56 13.536 1.952 18.048-2.848 5.728-6.176 12.8-16.416 20-26.496 5.12-7.232 11.584-8.128 18.368-5.568 6.912 2.4 43.488 20.48 51.008 24.224 7.52 3.776 12.48 5.568 14.304 8.736 1.792 3.168 1.792 18.048-4.384 35.52z" fill="#FAFAFA"/></svg>
                                </a>
                                <br><br>
                                <div class="row" id="combo">
                                    <div class="col-md-4">
                                        <select class="form-control" style="width:180px" id="statusAgendamentoSecretaria">
                                            <option value="selecione" selected>Selecione</option>
                                            <option value="Finalizado">Finalizado</option>
                                            <option value="Não Compareceu" >Não Compareceu</option>
                                            <option value="Falta Justificada">Falta Justificada</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success" id="salvar">&nbsp;&nbsp; Salvar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" id="botaoExcluir">Excluir</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal" id="fechaExcluir">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalAlteracao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static" >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalAlteracaoTitulo">Alterar Horário</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <?php $form = ActiveForm::begin(); ?>
                                        <?= $form->field($model, 'dt_inicio')->widget(\kartik\date\DatePicker::className(), ['pluginOptions' => ['format' => 'dd/mm/yyyy', 'multidate' => false,  'autoclose' => true], 'language' => 'pt-BR', 'options' => ['id' => 'dataAlt']]) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <?=
                                        $form->field($model, 'hr_inicio')->widget(\kartik\time\TimePicker::className(), ['name' => 'start_time',
                                            'value' => '11:24 AM',
                                            'options' => ['id' => 'horaIni'],
                                            'pluginOptions' => [
                                                'showSeconds' => false,
                                                'showMeridian' => false,
                                                'minuteStep' => 30,                                          
                                            ]
                                        ])
                                        ?>
                                    </div>
                                 </div>
                                <div class="row">
                                    <div class="col-xs-6">                      
                                        <?=
                                        $form->field($model, 'hr_fim')->widget(\kartik\time\TimePicker::className(), ['name' => 'end_time',
                                            'value' => '11:24 AM',
                                            'options' => ['id' => 'horaFim'],
                                            'pluginOptions' => [
                                                'showSeconds' => false,
                                                'showMeridian' => false,
                                                'minuteStep' => 30,
                                            ]
                                        ])
                                        ?>
                                         <?php ActiveForm::end(); ?>
                                    </div>
                                </div>
                              </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" id="btSalvarHorario">Salvar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal" id="fecha">Fechar</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modalDadosPaciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">                                
                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                <table>
                                    <tr>
                                        <th><h5 class="modal-nome">Nome </h5> </th> 
                                        <th><h5 class="modal-sexo">Sexo </h5> </th> 
                                        <th><h5 class="modal-dt">Data de Nascimento </h5> </th> 
                                        <th><h5 class="modal-idade">Idade</h5> </th>
                                    </tr>
                                    <br/>
                                    <tr>        
                                        <th> <h5 class="modal-agend">Tipo de agendamento: Não há</h5> </th>
                                        <th> <h5 class="modal-profissional">Profissional: Não há</h5> </th>
                                        <th> <h5 class="modal-just">Convênio: Não há</h5></th> 
                                    </tr>
                                    <tr>
                                        <th>
                                        </th>
                                    </tr>
                                </table>
                                <br/><br/>
                                <div class="list-group panel">
                                    <a href="#submenu1" class="list-group-item sub-item collapsed" data-toggle="collapse" data-parent="#submenu1">Histórico de atendimento <span class=" menu-ico-collapse"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
                                    <div class="list-group-submenu collapse" id="submenu1" style="height: 0px;">                                                       
                                        <table id="tabelaHistoricoAtendimento" border="1px"  width="850">                                                              
                                            <tr><th rowspan="2" style="text-align: center; background-color: gray">Data </th>
                                                <th rowspan="2" style="text-align: center; background-color: gray">Sessão </th>
                                                <th style="text-align: center; background-color: gray">Descrição </th>
                                                <th rowspan="2" style="text-align: center; background-color: gray">Profissional </th>
                                                <th rowspan="2" style="text-align: center; background-color: gray">Status </th>
                                            </tr> 
                                            <tr>                                                                 
                                                <th style="text-align: center; background-color: gray">Observação </th>
                                            </tr> 
                                        </table>
                                    </div>                                          

                                    <a href="#submenu2" class="list-group-item sub-item collapsed" data-toggle="collapse" data-parent="#submenu1">Histórico de Avaliações <span class=" menu-ico-collapse"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
                                    <div class="list-group-submenu collapse" id="submenu2" style="height: 0px;">                                                       
                                        <table id="tabelaHistoricoAvaliacao" border="1px"  width="850">                                                              
                                            <tr><th style="text-align: center; background-color: gray">Data </th>
                                                <th  style="text-align: center; background-color: gray">Tipo de Avaliação </th>                                                                  
                                                <th  style="text-align: center; background-color: gray">Profissional </th>
                                                <th  style="text-align: center; background-color: gray">Visualizar </th>
                                            </tr> 
                                        </table>
                                        <table id="tabelaHistoricoAvaliacaoSemVisualizar" border="1px"  width="850">                                                              
                                            <tr><th style="text-align: center; background-color: gray">Data </th>
                                                <th  style="text-align: center; background-color: gray">Tipo de Avaliação </th>                                                                  
                                                <th  style="text-align: center; background-color: gray">Profissional </th>
                                            </tr> 
                                        </table>

                                    </div>   
                                    <a href="#submenu3" class="list-group-item sub-item collapsed" data-toggle="collapse" data-parent="#submenu1" id="relatorioatual">Relatório Atual <span class=" menu-ico-collapse"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
                                    <div class="list-group-submenu collapse" id="submenu3" style="height: 0px;">                                                       
                                        <table id="tabelaRelatorioAtual" border="1px"  width="850">                                                              
                                            <tr><th rowspan="2" style="text-align: center; background-color: gray">Data </th>

                                                <th style="text-align: center; background-color: gray"> </th>
                                                <th rowspan="2" style="text-align: center; background-color: gray">Profissional </th>
                                                <th rowspan="2" style="text-align: center; background-color: gray">Status </th>

                                            </tr> 
                                            <tr>                                                                 
                                                <th style="text-align: center; background-color: gray"> </th>
                                            </tr>
                                            <tr>                                                                                                                                  
                                                <th rowspan = 2 style="text-align: center;" id="dt">data</th>                                                                   
                                                <th style="text-align: center;">Descrição: <br><textarea id="descricao"></textarea></th>
                                                <th rowspan = 2 style="text-align: center;" id="pof">profissional</th>
                                                <th rowspan = 2 style="text-align: center;">
                                                    <div class="col-md-4">
                                                        <select class="form-control" style="width:180px" id="statusAgendamentoProfissional">
                                                            <option value="selecione" selected>Selecione</option>
                                                            <option value="Finalizado">Finalizado</option>
                                                            <option value="Não Compareceu" >Não Compareceu</option>
                                                            <option value="Falta Justificada">Falta Justificada</option>
                                                        </select>
                                                    </div>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <button type="button" class="btn btn-success" id="salvaObs">Salvar</button>
                                                </th>
                                            </tr> 
                                            <tr>
                                                <th style="text-align: center;">Observação: <br> <textarea id="observacao"></textarea></th>
                                            </tr>
                                        </table>
                                    </div>  
                                    <br/><br/>

                                    <select class="form-control" style="width:250px" name="tpavaliacao" id="tipoAvaliacao">
                                        <option value="selecionarAvaliacao">Selecione uma avaliação</option>
                                        <option value="academia">Avaliação da Academia</option>
                                        <option value="hipopressivo">Avaliação Hipopressivo</option>
                                        <option value="vestibular">Avaliação Vestibular</option>
                                        <option value="coluna">Avaliação de Coluna</option>
                                        <option value="facial">Avaliação Facial</option>
                                        <option value="inferior">Avaliação de Membro Inferior</option>
                                        <option value="superior">Avaliação de Membro Superior</option>
                                    </select>
                                    <br/>
                                    <button type="button" class="btn btn-success" id="avaliacao">Realizar Avaliação</button>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>