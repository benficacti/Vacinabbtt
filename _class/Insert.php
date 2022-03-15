<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Insert
 *
 * @author USUARIO
 */
class Insert {

    //put your code here

    public static function cadastra_vacina($doc, $chapa, $nome, $setor, $situacao_vacina, $qtd_dose) {
        $id_detalhe = '';
        $id_setor = '';
        $garagem = 1;

        try {

            $sqll = 'SELECT id_detalhe FROM detalhe WHERE identificacao = "' . $doc . '" ';
            $p_sqll = Conexao::getInstance()->prepare($sqll);
            $p_sqll->execute();
            $count = $p_sqll->rowCount();
            if ($count > 0) {
                echo '03';
            } else {
                
                
                $sqll = 'SELECT id_setor FROM setor WHERE nome_setor = "' . $setor . '" ';
                    $p_sqll = Conexao::getInstance()->prepare($sqll);
                    $p_sqll->execute();
                    $count = $p_sqll->rowCount();
                    if ($count > 0) {
                        foreach ($p_sqll->fetchAll(PDO::FETCH_OBJ) as $dados) {
                            $id_setor = $dados->id_setor;
                        }
                    }
                
                

                $ins1 = 'INSERT INTO `detalhe`(`QTD_DOSE`,`IDENTIFICACAO`) VALUES (:QTD_DOSE, :IDENTIFICACAO)';
                $sni1 = Conexao::getInstance()->prepare($ins1);
                $sni1->bindParam(":QTD_DOSE", $qtd_dose);
                $sni1->bindParam(":IDENTIFICACAO", $doc);

                if ($sni1->execute()) {
                    $sqll = 'SELECT id_detalhe FROM detalhe WHERE identificacao = "' . $doc . '" ';
                    $p_sqll = Conexao::getInstance()->prepare($sqll);
                    $p_sqll->execute();
                    $count = $p_sqll->rowCount();
                    if ($count > 0) {
                        foreach ($p_sqll->fetchAll(PDO::FETCH_OBJ) as $dados) {
                            $id_detalhe = $dados->id_detalhe;
                        }
                    }


                    $ins = 'INSERT INTO `usuario`(`NOME_USUARIO`,`CPF_USUARIO`,`CHAPA`,`ID_SETOR`,`ID_DETALHE`,`GARAGEM`) VALUES (:NOME_USUARIO, :CPF_USUARIO, :CHAPA, :ID_SETOR, :ID_DETALHE, :GARAGEM)';
                    $sni = Conexao::getInstance()->prepare($ins);
                    $sni->bindParam(":NOME_USUARIO", $nome);
                    $sni->bindParam(":CPF_USUARIO", $doc);
                    $sni->bindParam(":CHAPA", $chapa);
                    $sni->bindParam(":ID_SETOR", $id_setor);
                    $sni->bindParam(":ID_DETALHE", $id_detalhe);
                    $sni->bindParam(":GARAGEM", $garagem);

                    if ($sni->execute()) {
                        echo '01';
                    }
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function cadastrar_url($url, $tmpString) {

        $ins = 'INSERT INTO `anexo`(`URL`,`IDENTIFICACAO`) VALUES (:URL, :IDENTIFICACAO)';
        $sni = Conexao::getInstance()->prepare($ins);
        $sni->bindParam(":URL", $url);
        $sni->bindParam(":IDENTIFICACAO", $tmpString);

        if ($sni->execute()) {

            $sqll = 'SELECT id_anexo FROM anexo WHERE identificacao = "' . $tmpString . '" ';
            $p_sqll = Conexao::getInstance()->prepare($sqll);
            $p_sqll->execute();
            $count = $p_sqll->rowCount();
            if ($count > 0) {
                foreach ($p_sqll->fetchAll(PDO::FETCH_OBJ) as $dados) {
                    return $dados->id_anexo;
                }
            }
        }
    }

}
