<?php


/**************** Variáveis e constantes globais do projeto **************/




define('SRC', $_SERVER['DOCUMENT_ROOT'].'/leonardo/Projeto_Estacioanamento/api/veiculos');


/********* Funções globais para p projeto **************/

// função para converter o array em JSON

function createJSON ($arrayDados)
{
    // Validação de array vazio
    if (!empty($arrayDados))
    {
        // Configura o padrão da conversao para formato json
        header('Content-Type: application/json');
        $dadosJSON = json_encode($arrayDados); // converte um array para json, e o json_decode faz o processo contrario
        
        return $dadosJSON;

    } else 
    {
        return false;
    }

}

?>