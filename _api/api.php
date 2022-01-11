<?php

session_start();
/*
include '../_class/Search.php';
include '../_class/Insert.php';
include '../_class/Update.php';
include '../persistencia/Conexao.php';
*/
include '../persistencia/Conexao.php';
include '../_class/Insert.php';

//error_reporting(E_ALL);
//ini_set("display_errors", true);

$request = (isset($_POST['request'])) ? $_POST['request'] : null;



if ($request != null && $request == "search_doc") {
    $doc = (null != (filter_input(INPUT_POST, 'doc'))) ? filter_input(INPUT_POST, 'doc') : null;
    $chapa = (null != (filter_input(INPUT_POST, 'chapa'))) ? filter_input(INPUT_POST, 'chapa') : null;

    
    //ESTOU UTILIZANDO GET NO 9.3
    $file = file_get_contents("http://192.168.9.3/comunicacao_funcionario/api.php?request=verificar_dados_funcionario&cpf=" . $doc . ""
            . "&chapa=" . $chapa);
    echo $file;
}

if ($request != null && $request == "cadastra_formulario") {
    $doc = (null != (filter_input(INPUT_POST, 'doc'))) ? filter_input(INPUT_POST, 'doc') : null;
    $chapa = (null != (filter_input(INPUT_POST, 'chapa'))) ? filter_input(INPUT_POST, 'chapa') : null;
    $nome = (null != (filter_input(INPUT_POST, 'nome'))) ? filter_input(INPUT_POST, 'nome') : null;
    $setor = (null != (filter_input(INPUT_POST, 'setor'))) ? filter_input(INPUT_POST, 'setor') : null;
    $situacao_vacina = (null != (filter_input(INPUT_POST, 'situacao_vacina'))) ? filter_input(INPUT_POST, 'situacao_vacina') : null;
    $qtd_dose = (null != (filter_input(INPUT_POST, 'qtd_dose'))) ? filter_input(INPUT_POST, 'qtd_dose') : null;

    
   echo $return = Insert::cadastra_vacina($doc, $chapa, $nome, $setor, $situacao_vacina, $qtd_dose);
}








