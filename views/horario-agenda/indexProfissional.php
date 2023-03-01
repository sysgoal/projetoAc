<?php

use yii\helpers\Url;
use yii\web\JsExpression;
use yii\helpers\Html;
Yii::$app->request->setBodyParams(null);

$script = <<< JS
        
function eventDialog(url,act){
	var action = '';
	var form = $('#modal .modal-body form');
	if(url == false){
		action = '&action=' + act;
		url = form.attr('action');
	}
	jQuery.ajax({
		type:'POST',
		url: url,
		data: form.serialize() + action,
		cache: false,
		dataType: 'json',
		success:function(data){
			if(data.status == 'fail'){
				$('#modal .modal-body').html(data.content);
				$('#modal .modal-footer #save').off().on('click', function(event){
					event.preventDefault();
					eventDialog(false,$(this).attr('name'));
				});
			} else {
				$('#modal .modal-body').html(data.content);
				if(data.status == 'success'){
					$('#calendar').fullCalendar('refetchEvents');
					$('#modal').modal('hide');
					$('#modal .modal-body').html('<div class=\"progress progress-striped active m-n text-center\"><div class=\"progress-bar progress-bar-success\" style=\"width:100%;\"></div></div>');
				}
			}
    	}
    });

}
JS;
$this->registerJs($script);
?>
<?php
$JsEventRender = 'function(event, element) {
                element.addClass(event.title);
                element.addClass(event.backgroundColor);
            }';
$JsEventDrop = 'function(event, delta, revertFunc) {
   
                    var event_data = {
                        id: event.id,
                        titulo: event.title,
                        descripcion: event.description,
                        fecha_inicio: $.fullCalendar.formatDate(event.start, "YYYY-MM-DD"),
                        hora_inicio: $.fullCalendar.formatDate(event.start, "HH:mm"),
                        hora_termino: $.fullCalendar.formatDate(event.end, "HH:mm"),
                        fecha_termino: $.fullCalendar.formatDate(event.end, "YYYY-MM-DD"),
                        color: event.color,
                    };
                 
                   
                }';

$JsEventClick = 'function(event, jsEvent, view) {
     let agendamento = "";
     let permissao = $("#idUsuario").val();     
  
    if(permissao == "Profissional" && event.idAluno == null){
        alert("Paciente não possui cadastro!");       
     }
     
    if (event.description == "academia") {
        agendamento = "Avaliação da academia";
    }else if(event.description == "consulta") {
        agendamento = "Atendimento";
    }else if(event.description == "hipopressivo") {
        agendamento = "Avaliação Hipopressivo";
    }else if(event.description == "outros") {
        agendamento = "Fisioterapia";
    }else if (event.description == "fisioterapia") {
      agendamento = "Avaliação Fisioterapia";
    }else if(event.description == "outros" || event.description == "consulta") {
        $("#btRealizarAvaliacao").hide();
    }
    $("#btRealizarAvaliacao").click(function() {
        var aluno = event.idAluno;
        if (aluno != null) {
            let tpAgendamento = $("#tipoAvaliacao").val();
            var urlAvaliacao = "/web/index.php?r=";
            if (tpAgendamento == "academia") {
                urlAvaliacao = urlAvaliacao + "avaliacao/create&idAluno=" + aluno;
            }else if (tpAgendamento == "hipopressivo") {
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
            }
            if(tpAgendamento == "selecionarAvaliacao"){
                alert("Selecione uma avaliação");
                return;
            }
            window.open(urlAvaliacao, "_blank");
          
            $("#cabecalhoInicial").modal("hide");
            updateEvent
        }
    });
    if (event.justificativa != null && (event.justificativa == "Não Compareceu" || event.justificativa == "Finalizado" || event.justificativa == "Reagendado") ) {        
        $("#menuRelatorioAtual").hide();
        $("#btRealizarAvaliacao").hide(); 
        $("#tipoAvaliacao").hide();
    } else {
    
        $("#btRealizarAvaliacao").show(); 
        $("#tipoAvaliacao").show();    
    }
    
    $("#salvaObs").click(function() {
        var justificativa = $("#statusAgendamento").val();
        if (justificativa == "selecione") {
            alert("Obrigatório informar o status");
            return false;
        } else {
            var observacao = $("#observacao").val();
            var descricao = $("#descricao").val();

            var id = event.id;

            var cor = "#DAA520";
            if (justificativa == "Finalizado") {
                cor = "#008000";
            } else if (justificativa == "Não Compareceu") {
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
            updateEvent
        }
    });

    $("#cabecalhoInicial .modal-title").html(" ");
    $("#cabecalhoInicial .modal-nome").html(" ");
    $("#cabecalhoInicial .modal-idade").html(" ");
    $("#cabecalhoInicial .modal-sexo").html(" ");

    $("#cabecalhoInicial .modal-profissional").html(" ");
    $("#cabecalhoInicial .modal-dt").html(" ");

    $("#cabecalhoInicial .modal-agend").html(" ");
    $("#nomeProfissional").html(" ");
    $("#dt").html(" ");
    $("#ind").html(" ");

    if ((permissao == "Profissional" || permissao == "Administrador") && event.idAluno != null) {
        $("#historicoAvaliacao .trAppend").remove()
        $("#menuHistoricoAtendimento .trAppend").remove();
        $("#cabecalhoInicial").modal("show");
        $("#cabecalhoInicial .modal-title").html("Detalhes do agendamento");
        $("#cabecalhoInicial .modal-nome").html("Aluno/Paciente: <b>" + event.title + "</b>&nbsp;&nbsp;&nbsp;");

        $("#cabecalhoInicial .modal-profissional").html("Profissional: <b>" + event.profissional + "</b>&nbsp;&nbsp;&nbsp;");
        $("#cabecalhoInicial .modal-agend").html("Tipo de agendamento: <b>" + agendamento + "</b>&nbsp;&nbsp;&nbsp;");
        
        $("#nomeProfissional").html(event.profissional);
        $("#dt").html($.fullCalendar.formatDate(event.start, "DD/MM/YYYY"));

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
        $("#cabecalhoInicial .modal-dt").html("Data de Nascimento: <b>" + formataDate(dtnasc, "pt-br") + "</b>&nbsp;&nbsp;&nbsp;");
        
        $("#cabecalhoInicial .modal-idade").html("Idade<b>: " + idade + " anos</b>&nbsp;&nbsp;&nbsp;");
        $("#cabecalhoInicial .modal-sexo").html("Sexo: <b>" + data.ds_sexo + "</b>&nbsp;&nbsp;&nbsp;");

        $.get("index.php?r=horario-agenda/dados-convenio", {
            id: data.id_convenio
        }, function(data2) {
            if (data2 != null && data2.ds_nome != null) {
                $("#cabecalhoInicial .modal-just").html("Convênio: <b>" + data2.ds_nome + "</b>&nbsp;&nbsp;&nbsp;");
            }
        });

    });

    $.get("index.php?r=horario-agenda/dados-agenda", {
        idAluno: event.idAluno
    }, function(data) {
        data.forEach(historicoAtendimento);
    });

    $.get("index.php?r=horario-agenda/dados-avaliacao", {
        id: event.idAluno
    }, function(data) {
        data.forEach(historicoAvaliacoes);
    });
    } else {
        $("#cabecalhoInicial").modal("hide");            
    }

    if (event.idAluno != null) {
        $("#cadastraAluno").hide();
    } else {
        $("#cadastraAluno").show();
    }

    function historicoAtendimento(item, indice) {
            if (item.ds_objetivo == null) {
                item.ds_objetivo = "";
            }
            if (item.ds_descricao == null) {
                item.ds_descricao = "";
            }
            if (item.ds_agendamento != null) {
                indice = parseInt(indice) + 1;
                $("#menuHistoricoAtendimento").append("<tr class=trAppend><th rowspan=2 style=text-align:center;>" + formataDate(item.dt_inicio, "pt-br") +
                "</th><th rowspan=2 style=text-align:center;>" + indice + 
                "</th><th style=text-align:center;>" + item.ds_descricao + 
                "</th><th rowspan=2 style=text-align:center;>" + item.nome + 
                "</th><th rowspan=2 style=text-align:center;>" + item.ds_agendamento + 
                "</th></tr><tr class=trAppend><th style=text-align:center;>" + item.ds_objetivo + "</th></tr>");
            }
    }
    $("#fechaMenuRelatorioAtual").click(function(){
        location.reload();
    });
    function formataDate(data, formato) {
        if (formato == "pt-br") {
            return (data.substr(0, 10).split("-").reverse().join("/"));
        } else {
            return (data.substr(0, 10).split("/").reverse().join("-"));
        }
    }

    function historicoAvaliacoes(item) {
        $("#historicoAvaliacao").append("<tr class=trAppend><th style=text-align:center;>" + formataDate(item.dataAvaliacao, "pt-br") + "</th><th style=text-align:center;>" + item.tpAvaliacao + "</th><th style=text-align:center;>" + item.profissional + "</th><th style=text-align:center;><a href=" + item.url + " target=_blank>Visualizar</a></th></tr>");

    }
}';
?>
<html>
    <head>
        <?=
        $this->render('head')
        ?>
    </head>
    <body class="skin-blue sidebar-mini">
            <section class="content-header">
                <?php
                $profissionalDados = $model->getProfissionalId($id);
                echo '<h1><b>' . $profissionalDados->nm_profissional . '</b></h1>'
                ?>
                <?= Html::hiddenInput('', Yii::$app->user->identity->permissao , ['id' => 'idUsuario'])/* $usuario->permissao]) */ ?>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <?=
                        \yii2fullcalendar\yii2fullcalendar::widget(array(
                            'ajaxEvents' => Url::to(Yii::$app->homeUrl . '?r=horario-agenda/jsoncalendar&id=' . $id),
                            'clientOptions' => [
                                'selectable' => false,
                                'editable' => true,
                                'droppable' => true,
                                'minTime' => '07:00',
                                'maxTime' => '22:00',
                                'height' => 'auto',
                                'snapDuration' => '00:30:00',
                                'eventRender' => new JsExpression($JsEventRender),
                                'eventClick' => new JsExpression($JsEventClick),
                                'eventDrop' => new JsExpression($JsEventDrop),                          
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
                </div>
                <div class="modal fade" id="cabecalhoInicial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
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
                                        <table id="menuHistoricoAtendimento" border="1px"  width="850">                                                              
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
                                        <table id="historicoAvaliacao" border="1px"  width="850">                                                              
                                            <tr><th style="text-align: center; background-color: gray">Data </th>
                                                <th  style="text-align: center; background-color: gray">Tipo de Avaliação </th>                                                                  
                                                <th  style="text-align: center; background-color: gray">Profissional </th>
                                                <th  style="text-align: center; background-color: gray">Visualizar </th>

                                            </tr> 


                                        </table>

                                    </div>   
                                    <a href="#menuRelatorioAtual" class="list-group-item sub-item collapsed" data-toggle="collapse" data-parent="#submenu1">Relatório Atual <span class=" menu-ico-collapse"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
                                    <div class="list-group-submenu collapse" id="menuRelatorioAtual" style="height: 0px;">                                                       
                                        <table id="menuHistoricoAtendimentoRelatorioAtual" border="1px"  width="850">                                                              
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
                                                <th rowspan = 2 style="text-align: center;" id="nomeProfissional">profissional</th>
                                                <th rowspan = 2 style="text-align: center;">
                                                    <div class="col-md-4">
                                                        <select class="form-control" style="width:180px" id="statusAgendamento">
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
                                     <select class="form-control" style="width:250px" name="tipoAvaliacao" id="tipoAvaliacao">
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
                                    <button type="button" class="btn btn-success" id="btRealizarAvaliacao">Realizar Avaliação</button>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" id="fechaMenuRelatorioAtual">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </body>
</html>