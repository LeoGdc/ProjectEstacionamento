<?php
/******************************************
 * Objetivos Arquivo reponsavel pela manipulção de dados contaveis
 *  Obs (Este arquivo fara a ponte entre a view e a Model)
 * Autor:Nathalia
 * Data:01/06/2022
 * Versão: 1.0
 * 
 *********************************************/

require_once(SRC.'./modulo/config.php');

function inserirCliente ($dadosVeiculo, $dadosCliente){

    require_once 'model/bd/cliente.php';
    require_once 'model/bd/veiculos.php';
    //verifica se esta vazio
    

        $arrayD = array (
            "nome"  => $dadosCliente['txtNome']
        );
        $arrayDados = array (
            
            "marca" => $dadosVeiculo['txtMarca'],
            "placa" => $dadosVeiculo['txtPlaca']
        );

        require_once(SRC.'model/bd/veiculos.php');
   
        //verificando se esta vindo o ID
        if(insertVeiculo($arrayDados)){
          

                if(pullingId()){
                 
                   
                    if(insertCliente($arrayD)){
                       
                        

                        return true;
                    

                    }return array('idErro' => 5,
                    'message' => 'Não foi possivel inserir o cliente');
                }return array('idErro' => 4,
                'message' => 'Veiculo não encontrado');
  

        }
        
        return array('idErro' => 2,
        'message' => 'dados do veiculo inválido');
        


    
}
function atualizarVeiculo ($dadosVeiculo, $arrayDados){
    //recebe o id enviado pelo arrayDados
    $id = $arrayDados['id'];
     //validação para verificar se o objeto está vazio
     if (!empty($dadosVeiculo)){
    
        if (!empty($dadosVeiculo['txtVeiculo']) && !empty($dadosVeiculo['txtPlaca'])){
            //validação para garantir que o id seja valido
            if(!empty($id) && $id !=0 && is_numeric($id)){
          
            $arrayDados = array (
                "id"        => $id,
                "veiculo"  => $dadosVeiculo['txtVeiculo'],
                "placa"   => $dadosVeiculo['txtPlaca'],
        
            );
            //import arquivo de modelagem para manipular o BD
            require_once('model/bd/veiculos.php');
            //chama a função que fara o insert no BD (está função está na model)
                if (updateVeiculo($arrayDados)){
                    return true;
                }else{
                    return array('idErro' => 1,
                        'message' => 'Não foi possivel atualizar os dados no banco de dados');
                } 
            }else
            return array('idErro' => 4, 'message' => 'não é possivel atualizar um registro sem informar um id válido');
        }
  
        else{
            return array('idErro' => 2,
            'message' => 'Existem campos obrigatorios que não foram preenchdidos');
        }
    }
    
}
function excluirVeiculo ($arrayDados){
     //recebe o id do registro que será excluido
    $id = $arrayDados['id'];
    //validação para verificar se o id contem um numero valido
    if($id != 0 && !empty($id) && is_numeric($id)){
        //chama a função da model e valida se o retorno foi verdadeiro ou falso
        if(deleteVeiculo($id)){
                    
            return true;
                    
        }else {
            return array('idErro' => 3, 'message' => 'o banco de dados não pode excluir o registro.');
        }        
    }else{
        return array('idErro' => 4, 'message' => 'não é possivel excluir um registro sem informar um id válido');
    }
}
function listarVeiculo (){
    //import do arquivo que vai buscar os dados no BD
    require_once('./model/bd/cliente.php');
    //chama a função que vai buscar os dados no BD
    $dados = selectAllCliente();
    
    if(!empty($dados))
        return $dados;
    else
         return false;
}   
function buscarVeiculo($id){
    //validação para verificar se o id contem um numero valido
    if($id != 0 && !empty($id) && is_numeric($id)){
        //import do arquivo de contato
       require_once('SRC./model/bd/veiculos.php');

       //chama a função na model que vai buscar o BD
       $dados = selectByIdVeiculo($id);

       //valida se existem dados para serem desvolvidos
       if(!empty($dados))
           return $dados;
       else
           return false;

    }else {
       return array('idErro' => 4, 'message' => 'não é possivel buscar um registro sem informar um id válido');
   }
}

?>