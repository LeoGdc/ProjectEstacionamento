<?php
/******************************************************** 
*Objetivo: Arquivo para criar a conexão com o bd MySql
*autor:Leonardo
*data: 31/05/2022
*versão: 1.0
*********************************************************/

//contantes para estabelecer a conexão com o BD(local do BD, Senha e database)
const SERVER = 'localhost';
const USER = 'root';
const PASSWORD = 'bcd127';
const DATABASE = 'dbestacionamento';
//abre a conexao com o banco de dados mysql
function conexaoMysql(){
    $conexao = array();

    //se a conexao for estabelecida com o BD, iremos ter um array de dados sobre a conexao
    $conexao = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    //Validação para verificar se a conexão foi realizada com sucesso
    if($conexao){

        return $conexao;

        var_dump($conexao);
        die;
    }else{
        return false;
    }
}
//fecha a conexão do BD no MySql
function fecharConexaoMySql($conexao){

    mysqli_close($conexao);
}

?>
