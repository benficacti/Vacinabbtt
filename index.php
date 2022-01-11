<?php
session_start();

$sessao = (isset($_SESSION['id_login'])) ? $_SESSION['id_login'] : null;

if ($sessao == null) {
    header('Location: index.php');
}

$user = $_SESSION['usuario'];
?>

<!doctype html>
<html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="bootstrap/css.css"  integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <link href="css/fontawesome/css/all.css" rel="stylesheet" />
        <link href="css/font_awesome.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/jquery.min.js"></script>

        <title>painel</title>
        <style>
            .espaco_div_lateral{
                padding-top: 2px;
                padding: 1px;

            }
            .class_input{
                border-radius: 10px
            }
            .registration_panel_title{
                font-family: Garamond,Baskerville,Baskerville Old Face,Hoefler Text,Times New Roman,serif;
                color: #002752;
                font-size: 14px;
                text-transform: uppercase

            }
            .registration_panel_main{
                font-family: Garamond,Baskerville,Baskerville Old Face,Hoefler Text,Times New Roman,serif;
                color: #002752;
                font-size: 20px
            }

            .principal{
                margin: auto 10%;

            }

            body{
                background-color: #ececf6;
                background-image: url(img/benfica.png);
                background-repeat: no-repeat;
                background-size: 7%;
                background-position-x: 1%;
                background-position-y: 1%

            }

            .class_title_panel{
                background-color: #86cfda;
                font-family: Garamond,Baskerville,Baskerville Old Face,Hoefler Text,Times New Roman,serif;

            }



        </style>
    </head>
    <body>

        <div class="principal">




            <div class="container-fluid" style="padding-top: 1%; margin-left: 1%">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="background-color: #007bff; border-radius: 30px; width: 85%; height: 65%;  margin-left: 7%">
                            <div class="card-body">
                                <div class="row" style="margin: auto; text-align: center">
                                    <div class="col-md-12">
                                        <h1 class="registration_panel_main" style="color: #FFF">VACINA BENFICA</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<span style="position: absolute; margin-left: 99%; margin-top: -7%; font-weight: bold; color: #ff253a" onclick="logout()"><i class="far fa-sign-out-alt fa-2x"></i>Sair</span>-->
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card" style="background-color: #ececf6; border-radius: 30px">
                            <div class="card-body">
                                <div class="row" style="margin: auto; text-align: center">
                                    <div class="col-md-12">
                                        <h1 class="registration_panel_title"><i class="fas fa-user-tie"></i> FUNCIONÁRIO</h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 espaco_div_lateral">
                                        <div class="form-group">
                                            <input type="text"   class="form-control class_input" placeholder="CPF"  id="id_doc"/>
                                        </div>
                                    </div>

                                    <div class="col-6 espaco_div_lateral_dir">
                                        <div class="form-group">
                                            <input type="text"   class="form-control class_input" placeholder="Chapa" onkeyup="search_user()" id="id_chapa"/>
                                        </div>
                                    </div>


                                </div>


                                <div class="row">

                                    <div class="col-6 espaco_div_lateral">
                                        <div class="form-group">
                                            <input type="text"   class="form-control class_input" placeholder="Nome" id="id_nome"/>
                                        </div>
                                    </div>

                                    <div class="col-6 espaco_div_lateral_dir">
                                        <div class="form-group">
                                            <select class="form-control class_input" id="id_setor">
                                                <option value="0">Setor</option>
                                                <option value="3">CTI</option>
                                                <option value="4">RECEITA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card" style="background-color: #ececf6; border-radius: 30px">
                            <div class="card-body">
                                <div class="row" style="margin: auto; text-align: center">
                                    <div class="col-md-12">
                                        <h1 class="registration_panel_title"><i class="fas fa-file-signature"></i> COMPROVANTE</h1>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-6 espaco_div_lateral">
                                        <div class="form-group">
                                            <select class="form-control class_input" onchange="situacao_vacina()" id="id_situacao_vacina">
                                                <option value="0">Você foi vacinado ?</option>
                                                <option value="1">SIM</option>
                                                <option value="2">NÃO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 espaco_div_lateral_dir">
                                        <div class="form-group">
                                            <select class="form-control class_input"  id="id_qtd_doses">
                                                <option value="0">Quantas doses ?</option>
                                                <option value="1">1 - UMA</option>
                                                <option value="2">2 - DUAS</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6 espaco_div_lateral">
                                        <div class="form-group">

                                            <p>

                                                <label class="form-control btn btn-primary" for="fileToUpload" style="font-weight: bold"><i class="fal fa-paperclip"></i> Anexar</label></p>
                                            <!--<img  id="output" width="220" height="165" style="margin-left: 10%; border-radius: 30px"/>-->
                                            <!--<iframe class="box-anexo" name="anexo" id="output" src="uploads/.pdf" scrolling="no">-->
                                            <form action="uploads.php" method="post" enctype="multipart/form-data" id="id_form_geral">
                                                <input class="form-control" type="file"
                                                       name="fileToUpload" id="fileToUpload" 
                                                       onchange="loadFile(event)" 
                                                       style="display: none">
                                                <input type="hidden" id="id_idenficao_usuario_anexo" name="tmpCod"/>

                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-6 espaco_div_lateral">
                                        <div class="form-group">
                                            <button class="form-control" id="id_send_pesquisa" style="background-color: #34ce57; color: #FFF; font-weight: bold "><i class="fad fa-share-square"></i> ENVIAR PESQUISA</button>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>




            </div>


        </div>


        <script>

            var input_name = document.querySelector("#id_nome");
            var input_setor = document.querySelector("#id_setor");
            input_name.disabled = true;
            input_setor.disabled = true;


            function search_user() {
                var doc, chapa;
                doc = document.getElementById('id_doc').value;
                chapa = document.getElementById('id_chapa').value;
                document.getElementById('id_idenficao_usuario_anexo').value = doc;



                if (doc.length === 11 && chapa.length === 6) {


                    $.ajax({

                        url: '_api/api.php',
                        method: 'post',
                        data: {
                            request: 'search_doc',
                            doc: doc,
                            chapa: chapa

                        },
                        success: function (data) {

                            if (data === '1') {
                                input_name.disabled = false;
                                input_setor.disabled = false;
                            }

                        }

                    });
                }



            }

            function situacao_vacina() {
                var input_qtd_doses = document.querySelector("#id_qtd_doses");
                var situacao_vacina = document.getElementById('id_situacao_vacina').value;
                if (situacao_vacina === '2') {
                    input_qtd_doses.value = '0';
                    input_qtd_doses.disabled = true;
                } else {
                    input_qtd_doses.disabled = false;
                }
            }



            var form = document.getElementById("id_form_geral");

            document.getElementById("id_send_pesquisa").addEventListener("click", function () {

                var doc, chapa, nome, setor, situacao_vacina, qtd_dose;
                doc = document.getElementById('id_doc').value;
                chapa = document.getElementById('id_chapa').value;
                nome = document.getElementById('id_nome').value;
                setor = document.getElementById('id_setor').value;
                situacao_vacina = document.getElementById('id_situacao_vacina').value;
                qtd_dose = document.getElementById('id_qtd_doses').value;

                
                if(doc.length < 10 && chapa.length < 5 && nome.length < 4 && setor.length < 1 && situacao_vacina == '0'){
                    alert('VERIFIQUE OS CAMPOS !');
                    return false;
                }
                
                $.ajax({
                    url: "_api/api.php",
                    method: "post",
                    data: {request: 'cadastra_formulario',
                        doc: doc,
                        chapa: chapa,
                        nome: nome,
                        setor: setor,
                        situacao_vacina: situacao_vacina,
                        qtd_dose: qtd_dose
                    }, success: function (data) {

                        if (data == '01') {
                            form.submit();
                        }else{
                            alert('Você já tem um registro!');
                        }
                    }
                });

            });





        </script>

        <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        -->
    </body>
</html>