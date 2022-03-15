<?php
session_start();


include './persistencia/Conexao.php';
include './_class/Search.php';
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="assets/img/favicon_vacina.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>PV - Painel de vacinados</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <!--
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        -->
        <!--
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
        -->
        <link href="css/font_awesome.css" rel="stylesheet"/>
        <!-- CSS Files -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.1" rel="stylesheet" />
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="assets/css/demo.css" rel="stylesheet" />
        <link href="assets/css/fontawesome/css/all.css" rel="stylesheet" />

        <!--
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        -->
        <script type="text/javascript" src="js/lottiefiles.js"></script>


        <!-- Script para funcionamento da camera -->
        <script src="script.js"></script>


        <script type="text/javascript" src="js/jquery.min.js"></script>
        <style>
            .largura_label{
                width: 150px
            }
            #titulo_tabela{
                text-align: center;
                color: #FFF; 
                font-size: 12px

            }
            #corpo_tabela{
                text-align: center;
            }

            .class_bbtt{
                background-color: #05AE0E;
            }
            .class_ralip{
                background-color: #007bff;
            }
            .class_title_painel{
                color: #000;
                text-align: center
            }



        </style>
    </head>

    <body class='sidebar-mini' style="width: 100%">
        <div class="wrapper">
            <div class="sidebar" data-color="" data-image="" style="background-color:#2d4373;  width: 10px">
            </div>
            <div class="main-panel" style=" width: 100%">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg " style="background-color: #2d4373">
                    <div style="margin: 0 auto; font-weight: bold; font-size: 22px; color: #FFF">
                        <span>PAINEL DE VACINADOS</span>
                    </div>

                </nav>
                <!-- End Navbar -->
                <div class="content">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 col-sm-10" style=" margin-top:2px;">
                                <div class="card cad_card">
                                    <div class="card-header class_funcionario_painel">
                                        CONSULTA: <label>chapa</label>
                                        <input type="text" list="list_chapa" class="form-control" placeholder="CHAPA"  onkeyup="search_funcionario()" id="id_chapa" autofocus="" autocomplete="off" style=" width: 200px"> 
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!--
                                            <div class="col-md-2 class_chapa_painel">
                                                <div class="form-group">
                                                    <label>setor</label>
                                                    <select class="form-control" id="id_setor">
                                                        <option value="0">SELECIONE</option>
                                            <?php
                                            Search::buscar_setor();
                                            ?>
                                                    </select>
                                                </div>
                                            </div>
                                            -->
                                            <!--
                                            <div class="col-md-2 class_chapa_painel">
                                                <div class="form-group">
                                                    <label>chapa</label>
                                                    <input type="text" list="list_chapa" class="form-control" placeholder="CHAPA"  onkeyup="search_funcionario()" id="id_chapa" autofocus="" autocomplete="off"> 
                                                </div>
                                            </div>
                                            -->
                                            <!--
                                            <div class="col-md-2 class_chapa_painel">
                                                <div class="form-group">
                                                    <label>local</label>
                                                    <select class="form-control" id="id_empresa">
                                                        <option value="0">GERAL</option>
                                                        <option value="1">BENFICA</option>
                                                        <option value="2">RALIP</option>
                                                        <option value="3">BENFACIL</option>
                                                    </select>
                                                </div>
                                            </div>
                                            -->
                                            <!--
                                            <div class="col-md-2 class_chapa_painel">
                                                <div class="form-group">
                                                    <i class="fas fa-search"></i>
                                                    <button class="form-control" id="id_buscar" onclick="search_funcionario()"><i class="fas fa-search"></i>  Buscar</button>                                                    
                                                </div>
                                            </div>
                                            -->

                                        </div>   
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" style=" margin-top:-25px;">
                                <div class="card cad_card">
                                    <div class="card-header">
                                        <table class="table table-bordered table-with-links">
                                            <thead>
                                            <td  scope="col"  class="class_title_painel">RALIP</td>
                                            <td  scope="col"  class="class_title_painel">BENFICA</td>
                                            </thead>
                                        </table>



                                        <table class="table table-bordered table-with-links">
                                            <thead style="background-color: #2d4373">
                                            <td  scope="col" id="titulo_tabela" class="class_bbtt">Total Vacinados: </td>
                                            <td  scope="col" id="titulo_tabela" class="class_bbtt">Primeira Dose: </td>
                                            <td  scope="col" id="titulo_tabela" class="class_bbtt">Segunda Dose: </td>
                                            <td  scope="col" id="titulo_tabela" class="class_bbtt">Dose Reforço: </td>
                                            <td  scope="col" id="titulo_tabela" class="class_bbtt">Não Vacinados Declarado:</td>
                                            <td  scope="col" id="titulo_tabela" class="class_ralip">Total Vacinados: </td>
                                            <td  scope="col" id="titulo_tabela" class="class_ralip">Primeira Dose: </td>
                                            <td  scope="col" id="titulo_tabela" class="class_ralip">Segunda Dose: </td>
                                            <td  scope="col" id="titulo_tabela" class="class_ralip">Dose Reforço: </td>
                                            <td  scope="col" id="titulo_tabela" class="class_ralip">Não Vacinados Declarado:</td>
                                            </thead>

                                            <tbody id="id_painel_resultado">

                                            </tbody>


                                        </table>
                                    </div>
                                </div>


                            </div>


                            <div class="col-md-12" style=" margin-top:-25px;">
                                <div class="card cad_card">
                                    <div class="card-header">
                                        FUNCIONÁRIOS
                                    </div>
                                    <div class="card-body row" style=" margin-left: -14px">

                                        <table class="table table-bordered table-with-links">
                                            <thead style="background-color: #2d4373">
                                            <td  scope="col" id="titulo_tabela">Funcionario</td>
                                            <td  scope="col" id="titulo_tabela">Chapa</td>
                                            <td  scope="col" id="titulo_tabela">Setor</td>
                                            <td  scope="col" id="titulo_tabela">Empresa</td>
                                            <td  scope="col" id="titulo_tabela">Vacinado</td>
                                            <td  scope="col" id="titulo_tabela">Doses</td>
                                            <td  scope="col" id="titulo_tabela">Anexo</td>
                                            </thead>

                                            <tbody id="id_funcionario_resultado">

                                            </tbody>


                                        </table>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <?php
            /*
              include 'includes/footer.php';
             */
            ?>

        </div>
    </body>
    <div>
        <!--   Core JS Files   -->
        <script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
        <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
        <script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
        <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
        <script src="assets/js/plugins/bootstrap-switch.js"></script>
        <!--  Google Maps Plugin    -->
        <!--
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?YOUR_KEY_HERE"></script>
        -->
        <!--  Chartist Plugin  -->
        <script src="assets/js/plugins/chartist.min.js"></script>
        <!--  Notifications Plugin    -->
        <script src="assets/js/plugins/bootstrap-notify.js"></script>
        <!--  jVector Map  -->
        <script src="assets/js/plugins/jquery-jvectormap.js" type="text/javascript"></script>
        <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
        <script src="assets/js/plugins/moment.min.js"></script>
        <!--  DatetimePicker   -->
        <script src="assets/js/plugins/bootstrap-datetimepicker.js"></script>
        <!--  Sweet Alert  -->
        <script src="assets/js/plugins/sweetalert2.min.js" type="text/javascript"></script>
        <!--  Tags Input  -->
        <script src="assets/js/plugins/bootstrap-tagsinput.js" type="text/javascript"></script>
        <!--  Sliders  -->
        <script src="assets/js/plugins/nouislider.js" type="text/javascript"></script>
        <!--  Bootstrap Select  -->
        <script src="assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
        <!--  jQueryValidate  -->
        <script src="assets/js/plugins/jquery.validate.min.js" type="text/javascript"></script>
        <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
        <script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
        <!--  Bootstrap Table Plugin -->
        <script src="assets/js/plugins/bootstrap-table.js"></script>
        <!--  DataTable Plugin -->
        <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
        <!--  Full Calendar   -->
        <script src="assets/js/plugins/fullcalendar.min.js"></script>
        <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="assets/js/light-bootstrap-dashboard.js?v=2.0.1" type="text/javascript"></script>
        <!-- Light Dashboard DEMO methods, don't include it in your project! -->
        <script src="assets/js/demo.js"></script>
    </div>

    <script type="text/javascript">
                                            var verifica = false;
                                            acesso();
                                            function acesso() {
                                                var acesso = prompt('Por favor informe a senha de acesso, ou entre em contato com o CTI!');

                                                if (acesso !== 'Acesso22#%') {
                                                    alert('Acesso Negado!');
                                                    return acesso();
                                                } else {
                                                    verifica = true;
                                                }
                                            }


                                            if (verifica == true) {
                                                search_painel();
                                            }

                                            function search_painel() {
                                                $.ajax({

                                                    url: "_api/api.php",
                                                    method: "post",
                                                    data: {request: 'search_painel',

                                                    },
                                                    success: function (data) {
                                                        var res = '';


                                                        var obj = JSON.parse(data);
                                                        obj.forEach(function (name, value) {


                                                            res +=
                                                                    '<tr >\n\
                                 <td id="corpo_tabela">' + name.TOTAL_VACINADOS_R + '</td>\n\
                                 <td id="corpo_tabela">' + name.PRIMEIRA_DOSE_R + '</td>\n\
                                <td id="corpo_tabela">' + name.SEGUNDA_DOSE_R + '</td>\n\
                                <td id="corpo_tabela">' + name.DOSE_REFORCO_R + '</td>\n\
                                <td id="corpo_tabela">' + name.NAO_TOMOU_R + '</td>\n\
                                <td id="corpo_tabela">' + name.TOTAL_VACINADOS_B + '</td>\n\
                                <td id="corpo_tabela">' + name.PRIMEIRA_DOSE_B + '</td>\n\
                                <td id="corpo_tabela">' + name.SEGUNDA_DOSE_B + '</td>\n\
                                <td id="corpo_tabela">' + name.DOSE_REFORCO_B + '</td>\n\
                                <th id="corpo_tabela">' + name.NAO_TOMOU_B + '</th></tr>';
                                                        });

                                                        document.getElementById('id_painel_resultado').innerHTML = res;
                                                    }

                                                });

                                            }



                                            search_funcionario();
                                            function search_funcionario() {

                                                var chapa = document.getElementById('id_chapa').value;

                                                if (verifica) {
                                                    $.ajax({

                                                        url: "_api/api.php",
                                                        method: "post",
                                                        data: {request: 'search_funcionario',
                                                            chapa: chapa

                                                        },
                                                        success: function (data) {
                                                            var res = '';
                                                            var empresa = '';
                                                            var URL = '';


                                                            var obj = JSON.parse(data);
                                                            obj.forEach(function (name, value) {

                                                                if (name.EMPRESA === '1') {
                                                                    empresa = 'BBTT';
                                                                } else {
                                                                    empresa = 'RALIP';
                                                                }

                                                                if (name.EMPRESA === '1') {

                                                                    if (name.DOSES != '0') {
                                                                        URL = '<img src="img/anexos.png" onClick="retorno(' + "'" + name.CHAPA + "'" + ')" width="25" height="25" style="margin-left: 2%; border-radius: 30px"/>';
                                                                    } else {
                                                                        URL = '<img src="img/antivacina.png" style: width="25" height="25" />';
                                                                    }
                                                                } else {

                                                                    if (name.DOSES != '0') {
                                                                        URL = '<img src="img/anexos.png" onClick="retorno_ralip(' + "'" + name.CHAPA + "'" + ')" width="25" height="25" style="margin-left: 2%; border-radius: 30px"/>';
                                                                    } else {
                                                                        URL = '<img src="img/antivacina.png" style: width="25" height="25" />';
                                                                    }

                                                                }


                                                                res +=
                                                                        '<tr >\n\
                                                                                    <td id="corpo_tabela">' + name.FUNCIONARIO + '</td>\n\
                                                                                    <td id="corpo_tabela">' + name.CHAPA + '</td>\n\
                                                                                   <td id="corpo_tabela">' + name.SETOR + '</td>\n\
                                                                                   <td id="corpo_tabela">' + empresa + '</td>\n\
                                                                                   <td id="corpo_tabela">' + name.VACINOU + '</td>\n\
                                                                                   <td id="corpo_tabela">' + name.DOSES + '</td>\n\
                                                                                   <th id="corpo_tabela">' + URL + '</th></tr>';
                                                            });

                                                            document.getElementById('id_funcionario_resultado').innerHTML = res;
                                                        }

                                                    });
                                                }



                                            }


                                            function retorno(COD) {

                                                location.href = 'view_anexo.php?cod=' + COD;
                                            }

                                            function retorno_ralip(COD) {

                                                location.href = 'http://192.168.0.185:8080/vacinaralip/view_anexo_ralip.php?cod=' + COD;
                                            }




    </script>








</html>