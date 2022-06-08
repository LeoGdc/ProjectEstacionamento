<?php
/**************************************************************************
 * Objetivo: responsavel de manipular os dados dentro   BD 
 *              (insert,update,select e delete)
 * 
 * Autor: Leonardo
 * Data:01/06/2022
 * Versão: 1.0
 * 
 *************************************************************************/

//import
require_once('conexaoMySql.php');
require_once('veiculos.php');

//função para fazer o insert no BD
function insertCliente($dadosCliente){

    
    //Abre as conexão com o BD
    $conexao = conexaoMysql();

    $veiculoId = pullingId()["id"];

    

    $sql = "insert into tblcliente
            (nome,
            idVeiculo
            )
        values
        ('".$dadosCliente['nome']."',
        '".$veiculoId."');";

    //executa o script no BD
    //Validação para verificar  se o script sql esta correto
    if(mysqli_query($conexao, $sql))
    {
        //validação para ver se al inha for gravada no bd 
        if(mysqli_affected_rows($conexao))
        {
        
            $statusResposta = true;
            }
            else{
        
                $statusResposta = false;
            }
        }else{
  
            $statusResposta = false;
        }

        fecharConexaoMySql($conexao);
        return $statusResposta;
}
function updateCliente ($dadosCliente){
    $statusResposta =(boolean) false;
    //abre a conexão com o BD
    $conexao = conexaoMysql();
    $sql = "update tblCliente set
           nome      =   '".$dadosCliente['nome']."'
       where id = ".$dadosCliente['id'];
        
  
    //executa o script no BD
        //Validação para verificar  se o script sql esta correto
    if(mysqli_query($conexao, $sql))
    {
        //validação para ver se alinha for gravada no bd 
        if(mysqli_affected_rows($conexao))
        {
            fecharConexaoMySql($conexao);
            $statusResposta = true;
            }
            else{
                fecharConexaoMySql($conexao);
                $statusResposta = false;
            }
        }else{
            fecharConexaoMySql($conexao);
            $statusResposta = false;
        }

        fecharConexaoMySql($conexao);
        return $statusResposta;
}
function deleteCliente ($id){
     //abre a conexão com o BD
     $conexao = conexaoMysql();
    
     //Script para deletar um resgistro no bd 
     $sql = "delete from tblClient where id=".$id;
 
     //valida se o script esta correto, sem erro de sixtaxe e executa o BD
     if(mysqli_query($conexao, $sql)){
 
         //valida se o BD teve sucesso na execução do script
         if(mysqli_affected_rows($conexao))
         $statusResposta =true;
     }
 
     //fecha a conexão com o BD mySql
     fecharConexaoMySql($conexao);
 
     return $statusResposta;
}
function selectAllCliente(){
        //Abre as conexão com o BD
        $conexao = conexaoMysql();
        //Script para listar todos os dados no BD
        $sql = "select * from tblcliente order by id desc";
        //Executa o script sql no BD e guarda o retorno dos dados, se houver 
        $result = mysqli_query($conexao, $sql);
        //valida se o BD retornou os registro
        if($result){
            $cont = 0;
            while($rsDados = mysqli_fetch_assoc($result)){
                //Criar um array com os dados BD
                    $arrayDados{$cont} = array(
                        "id"        => $rsDados['id'],
                        "nome"      => $rsDados['nome']
                    
                    );
                $cont++;
             }
                //solicita o fechamento da conexão com o BD
                fecharConexaoMySql($conexao);
                if(isset($arrayDados))
                    return $arrayDados;
                else 
                    return false;
        }
}
function selectByIdCliente($id){
         //Abre as conexão com o BD
         $conexao = conexaoMysql();
         //Script para listar todos os dados no BD
         $sql = "select * from tblCliente where id =".$id;
         //Executa o script sql no BD e guarda o retorno dos dados, se houver 
         $result = mysqli_query($conexao, $sql);
         //valida se o BD retornou os registro
         if($result){
             //mysqli_fetch_assoc() - permite converter os dados do BD em array de manipulação no PHP
             //Nesta, repetição estamos, convertendo os dados do BD em um Array ($rsDados) , além de
             // o proprio while conseguir gerenciar a quantidade de vezes que deverá ser feita a repetição
             
             if($rsDados = mysqli_fetch_assoc($result)){
                 //Criar um array com os dados BD
                     $arrayDados = array(
                         "id"       => $rsDados['id'],
                         "nome"     => $rsDados['nome']
                       
                     );
              }
                 //solicita o fechamento da conexão com o BD
                 fecharConexaoMySql($conexao);
     
                 return $arrayDados;
         }
}

?>