<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Search
 *
 * @author USUARIO
 */
class Search {

//put your code here

    public static function buscar_setor() {
        try {
            $sqll = 'SELECT id_setor, nome_setor FROM setor ORDER BY nome_setor';
            $p_sqll = Conexao::getInstance()->prepare($sqll);
            $p_sqll->execute();
            $count = $p_sqll->rowCount();
            if ($count > 0) {
                foreach ($p_sqll->fetchAll(PDO::FETCH_OBJ) as $dados) {
                    echo' <option value' . $dados->id_setor . '>' . $dados->nome_setor . '</option> ';
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function buscar_chapa() {
        try {
            $sqll = 'SELECT chapa, id_usuario FROM usuario ORDER BY chapa';
            $p_sqll = Conexao::getInstance()->prepare($sqll);
            $p_sqll->execute();
            $count = $p_sqll->rowCount();
            if ($count > 0) {
                foreach ($p_sqll->fetchAll(PDO::FETCH_OBJ) as $dados) {
                    echo' <option value' . $dados->id_usuario . '>' . $dados->chapa . '</option> ';
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function painel() {

        try {
            $sqll = 'SELECT 
                        DISTINCT
                        (
                         SELECT COUNT(bs.id_usuario) TOT_B FROM usuario bs WHERE bs.garagem = 1
                        )TOTAL_VACINADOS_B,
                        (
                            SELECT COUNT(DB.id_detalhe) FROM usuario pb 
                            INNER JOIN detalhe db ON db.id_detalhe = pb.id_detalhe
                            WHERE db.qtd_dose = 1 and pb.garagem = 1
                        ) PRIMEIRA_DOSE_B,
                        (
                            SELECT COUNT(DB.id_detalhe) FROM usuario pb 
                            INNER JOIN detalhe db ON db.id_detalhe = pb.id_detalhe
                            WHERE db.qtd_dose = 2 and pb.garagem = 1
                        ) SEGUNDA_DOSE_B,
                        (
                            SELECT COUNT(DB.id_detalhe) FROM usuario pb 
                            INNER JOIN detalhe db ON db.id_detalhe = pb.id_detalhe
                            WHERE db.qtd_dose = 3 and pb.garagem = 1
                        ) DOSE_REFORCO_B,
                        (
                            SELECT COUNT(DB.id_detalhe) FROM usuario pb 
                            INNER JOIN detalhe db ON db.id_detalhe = pb.id_detalhe
                            WHERE db.qtd_dose = 0 and pb.garagem = 1
                        ) NAO_TOMOU_B,
                        
                        ##RALIP
                        
                        (
                         SELECT COUNT(bs.id_usuario) TOT_B FROM usuario bs WHERE bs.garagem = 2
                        )TOTAL_VACINADOS_R,
                        (
                            SELECT COUNT(DB.id_detalhe) FROM usuario pb 
                            INNER JOIN detalhe db ON db.id_detalhe = pb.id_detalhe
                            WHERE db.qtd_dose = 1 and pb.garagem = 2
                        ) PRIMEIRA_DOSE_R,
                        (
                            SELECT COUNT(DB.id_detalhe) FROM usuario pb 
                            INNER JOIN detalhe db ON db.id_detalhe = pb.id_detalhe
                            WHERE db.qtd_dose = 2 and pb.garagem = 2
                        ) SEGUNDA_DOSE_R,
                        (
                            SELECT COUNT(DB.id_detalhe) FROM usuario pb 
                            INNER JOIN detalhe db ON db.id_detalhe = pb.id_detalhe
                            WHERE db.qtd_dose = 3 and pb.garagem = 2
                        ) DOSE_REFORCO_R,
                        (
                            SELECT COUNT(DB.id_detalhe) FROM usuario pb 
                            INNER JOIN detalhe db ON db.id_detalhe = pb.id_detalhe
                            WHERE db.qtd_dose = 0 and pb.garagem = 2
                        ) NAO_TOMOU_R
                        FROM usuario  ';
            $p_sqll = Conexao::getInstance()->prepare($sqll);
            $p_sqll->execute();
            $count = $p_sqll->rowCount();
            if ($count > 0) {
                foreach ($p_sqll->fetchAll(PDO::FETCH_OBJ) as $dados) {

                    $inf [] = array
                        (
                        "TOTAL_VACINADOS_B" => $dados->TOTAL_VACINADOS_B,
                        "PRIMEIRA_DOSE_B" => $dados->PRIMEIRA_DOSE_B,
                        "SEGUNDA_DOSE_B" => $dados->SEGUNDA_DOSE_B,
                        "DOSE_REFORCO_B" => $dados->DOSE_REFORCO_B,
                        "NAO_TOMOU_B" => $dados->NAO_TOMOU_B,
                        "TOTAL_VACINADOS_R" => $dados->TOTAL_VACINADOS_R,
                        "PRIMEIRA_DOSE_R" => $dados->PRIMEIRA_DOSE_R,
                        "SEGUNDA_DOSE_R" => $dados->SEGUNDA_DOSE_R,
                        "DOSE_REFORCO_R" => $dados->DOSE_REFORCO_R,
                        "NAO_TOMOU_R" => $dados->NAO_TOMOU_R
                    );
                }

                echo $json = json_encode($inf);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public static function buscar_funcionario($chapa) {

        try {
            $sqll = '';

            if (strlen($chapa) > 2) {

                $sqll = 'SELECT 
            u.nome_usuario FUNCIONARIO,
            u.chapa CHAPA,
            s.nome_setor SETOR,
            u.garagem EMPRESA,
            (IF (d.qtd_dose > 0, "SIM", "NAO")) VACINOU,
            d.qtd_dose DOSES,
            a.url IMG
            FROM usuario u 
            INNER JOIN setor s   ON s.id_setor   = u.id_setor
            INNER JOIN detalhe d ON d.id_detalhe = u.id_detalhe
            INNER JOIN anexo a   ON a.id_anexo   = u.id_anexo
            WHERE u.chapa LIKE  "%'.$chapa.'%"
            ORDER BY u.garagem, s.nome_setor';
                
            } else {
                $sqll = 'SELECT 
            u.nome_usuario FUNCIONARIO,
            u.chapa CHAPA,
            s.nome_setor SETOR,
            u.garagem EMPRESA,
            (IF (d.qtd_dose > 0, "SIM", "NAO")) VACINOU,
            d.qtd_dose DOSES,
            a.url IMG
            FROM usuario u 
            INNER JOIN setor s   ON s.id_setor   = u.id_setor
            INNER JOIN detalhe d ON d.id_detalhe = u.id_detalhe
            INNER JOIN anexo a   ON a.id_anexo   = u.id_anexo
            ORDER BY u.garagem, s.nome_setor';
            }

            $p_sqll = Conexao::getInstance()->prepare($sqll);
            $p_sqll->execute();
            $count = $p_sqll->rowCount();
            if ($count > 0) {
                foreach ($p_sqll->fetchAll(PDO::FETCH_OBJ) as $dados) {
                    $inf [] = array
                        (
                        "FUNCIONARIO" => $dados->FUNCIONARIO,
                        "CHAPA" => $dados->CHAPA,
                        "SETOR" => $dados->SETOR,
                        "EMPRESA" => $dados->EMPRESA,
                        "VACINOU" => $dados->VACINOU,
                        "DOSES" => $dados->DOSES,
                        "IMG" => $dados->IMG
                    );
                }

                echo $json = json_encode($inf);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
     public static function buscar_anexo($chapa) {

        try {
            

                $sqll = 'SELECT 
            u.nome_usuario FUNCIONARIO,
            u.chapa CHAPA,
            a.url IMG
            FROM usuario u 
            INNER JOIN anexo a   ON a.id_anexo   = u.id_anexo
            WHERE u.chapa =  "'.$chapa.'"';
                
            

            $p_sqll = Conexao::getInstance()->prepare($sqll);
            $p_sqll->execute();
            $count = $p_sqll->rowCount();
            if ($count > 0) {
                foreach ($p_sqll->fetchAll(PDO::FETCH_OBJ) as $dados) {
                    $inf [] = array
                        (
                        "FUNCIONARIO" => $dados->FUNCIONARIO,
                        "CHAPA" => $dados->CHAPA,
                        "IMG" => $dados->IMG
                    );
                }

                echo $json = json_encode($inf);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
