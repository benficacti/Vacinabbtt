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
class Update {
    //put your code here
    

    public static function usuario_url_vacina($tmpString, $id_anexo) {
        
        try {
            $up = 'UPDATE `usuario` SET `ID_ANEXO` = "'.$id_anexo.'" '
                    . 'WHERE `CPF_USUARIO` = "' . $tmpString . '"';
            $upd = Conexao::getInstance()->prepare($up);
            if($upd->execute()){
                return '001';
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            echo'Falha ao atualizar usuario';
        }
    }

}
