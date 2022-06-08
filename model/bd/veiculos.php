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
require_once('conexaoMySql.php');
require_once('cliente.php');

//função para fazer o insert no BD
function insertVeiculo($dadosVeiculo){
      //abre a conexão com o BD
      $conexao = conexaoMysql();
      $sql = "insert into tblveiculo
          (placa,
          marca
        )
      values
      ('".$dadosVeiculo['placa']."',
      '".$dadosVeiculo['marca']."');";
    
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
function updateVeiculo ($dadosVeiculo){
    $statusResposta =(boolean) false;
    //abre a conexão com o BD
    $conexao = conexaoMysql();
    $sql = "update tblveiculo set
           placa       =   '".$dadosVeiculo['placa']."',
           marca   =   '".$dadosVeiculo['marca']."' , 
       where id = ".$dadosVeiculo['id'];
        
  
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
function deleteVeiculo ($id){
     //abre a conexão com o BD
     $conexao = conexaoMysql();
    
     //Script para deletar um resgistro no bd 
     $sql = "delete from tblveiculo where id=".$id;
 
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
function selectAllVeiculo(){
        
        //Abre as conexão com o BD
        $conexao = conexaoMysql();
        //Script para listar todos os dados no BD
        $sql = "select * from tblveiculo order by id desc";
        //Executa o script sql no BD e guarda o retorno dos dados, se houver 
        $result = mysqli_query($conexao, $sql);
        //valida se o BD retornou os registro
        if($result){
            $cont = 0;
            while($rsDados = mysqli_fetch_assoc($result)){
                //Criar um array com os dados BD
                    $arrayDados{$cont} = array(
                        "id"        => $rsDados['id'],
                        "placa"      => $rsDados['placa'],
                        "marca"  => $rsDados['marca']
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
function selectByIdVeiculo($id){
         //Abre as conexão com o BD
         $conexao = conexaoMysql();
         //Script para listar todos os dados no BD
         $sql = "select * from tblveiculo where id =".$id;
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
                         "placa"     => $rsDados['placa'],
                         "marca" => $rsDados['marca']
                     );
              }
                 //solicita o fechamento da conexão com o BD
                 fecharConexaoMySql($conexao);
     
                 return $arrayDados;
         }
}
function pullingId(){

    //Abre as conexão com o BD
    $conexao = conexaoMysql();

    $selectId= "select id from tblVeiculo order by id desc limit 1";

    //Executa o script sql no BD e guarda o retorno dos dados, se houver 
    $result = mysqli_query($conexao, $selectId);

    if($result){
        //mysqli_fetch_assoc() - permite converter os dados do BD em array de manipulação no PHP
        //Nesta, repetição estamos, convertendo os dados do BD em um Array ($rsDados) , além de
        // o proprio while conseguir gerenciar a quantidade de vezes que deverá ser feita a repetição
        
        if($rsDados = mysqli_fetch_assoc($result)){
            //Criar um array com os dados BD
                $arrayDados = array(
                    "id"       => $rsDados['id']
                );
         }
            //solicita o fechamento da conexão com o BD
            fecharConexaoMySql($conexao);

            return $arrayDados;
    }
}
?>