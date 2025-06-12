<?php
 function connect_db(){
    $host="localhost";
    $user="root";
    $pass="";
    $mydb = "bancodedados";

    $conn=mysqli_connect($host, $user, $pass, $mydb);
    if ($conn){
        if(!mysqli_query($conn,"select * from tb_perfil_gestao limit 0")){createtables($conn);}
        return($conn);
        }else{
        return(false);
    }
   // createtables($conn);
}
function createtables($conn){

   // mysqli_query($conn,"DROP TABLE tb_perfil_gestao;");
   // mysqli_query($conn,"DROP TABLE tb_usuarios_gestao;");
   // mysqli_query($conn,"DROP TABLE tb_parceiros;");
   // mysqli_query($conn,"DROP TABLE tb_planos;");
   // mysqli_query($conn,"DROP TABLE tb_logs;");
   // mysqli_query($conn,"DROP TABLE tb_perfil_parceiro;");
   // mysqli_query($conn,"DROP TABLE tb_usuarios_parceiro;");
   // mysqli_query($conn,"DROP TABLE tb_clientes;");
   // mysqli_query($conn,"DROP TABLE tb_usuarios_cliente;");
   // mysqli_query($conn,"DROP TABLE tb_entes;");
   // mysqli_query($conn,"DROP TABLE tb_midias;");
   // mysqli_query($conn,"DROP TABLE tb_configuracoes;");
   // mysqli_query($conn,"DROP TABLE tb_conta_cliente;");
   // mysqli_query($conn,"DROP TABLE tb_depoimentos_ente;");
    
 
    $sql = "
        CREATE TABLE tb_perfil_gestao (
            id_perfil_gestao INT(6) AUTO_INCREMENT PRIMARY KEY, 
            nome_perfil_gestao VARCHAR(50) NOT NULL,
            per_cria_perfil_gestao INT(1) NOT NULL,
            per_edita_perfil_gestao INT(1) NOT NULL,
            per_visualiza_perfil_gestao INT(1) NOT NULL,
            per_exclui_perfil_gestao INT(1) NOT NULL,
            per_cria_usuario_gestao INT(1) NOT NULL,
            per_edita_usuario_gestao INT(1) NOT NULL,
            per_visualiza_usuario_gestao INT(1) NOT NULL,
            per_exclui_usuario_gestao INT(1) NOT NULL,
            per_cria_parceiro_gestao INT(1) NOT NULL,
            per_edita_parceiro_gestao INT(1) NOT NULL,
            per_visualiza_parceiro_gestao INT(1) NOT NULL,
            per_exclui_parceiro_gestao INT(1) NOT NULL,
            per_cria_plano_gestao INT(1) NOT NULL,
            per_edita_plano_gestao INT(1) NOT NULL,
            per_visualiza_plano_gestao INT(1) NOT NULL,
            per_exclui_plano_gestao INT(1) NOT NULL,
            per_cria_usuariomaster_parceiro INT(1) NOT NULL,
            per_logs_gestao INT(1) NOT NULL,
            per_relatorios_gestao INT(1) NOT NULL
            );
    ";
    if (!mysqli_query($conn,$sql)) { 
                echo("Erro na criacao da tabela tb_perfil_gestao". mysqli_error($conn));
                return false;
            }

    $sql = "
        CREATE TABLE tb_usuarios_gestao (
            id_usuario_gestao INT(6) AUTO_INCREMENT PRIMARY KEY, 
            nome_usuario_gestao VARCHAR(100) NOT NULL,
            email_usuario_gestao VARCHAR(100) NOT NULL UNIQUE,
            senha_usuario_gestao VARCHAR(100) NOT NULL,
            perfil_usuario_gestao INT(6) NOT NULL
            );
    ";
    if (!mysqli_query($conn,$sql)) { 
                echo("Erro na criacao da tabela tb_usuarios_gestao". mysqli_error($conn));
                return false;
            }

    $sql = "
        CREATE TABLE tb_parceiros (
            id_parceiro INT(6) AUTO_INCREMENT PRIMARY KEY, 
            nome_parceiro VARCHAR(100) NOT NULL UNIQUE,
            razaosocial_parceiro VARCHAR(100) NOT NULL,
            cnpj_parceiro VARCHAR(20) NOT NULL,
            inscricaoestadual_parceiro VARCHAR(50) NOT NULL,
            inscricaomunicipal_parceiro VARCHAR(50) NOT NULL,
            telefone_parceiro VARCHAR(100) NOT NULL,
            email_parceiro VARCHAR(100) NOT NULL,
            responsavelfinanceiro_parceiro VARCHAR(100) NOT NULL,
            responsavelcliente_parceiro VARCHAR(100) NOT NULL,
            status_parceiro VARCHAR(10) NOT NULL
            );
    ";
    if (!mysqli_query($conn,$sql)) { 
                echo("Erro na criacao da tabela tb_parceiros". mysqli_error($conn));
                return false;
            }

    $sql = "
        CREATE TABLE tb_planos (
            id_plano INT(6) AUTO_INCREMENT PRIMARY KEY, 
            nome_plano VARCHAR(50) NOT NULL UNIQUE,
            valor_plano DECIMAL( 30, 2 ) NOT NULL,
            duracao_mes_plano INT(2) NOT NULL,
            quantidade_entes INT(3) NOT NULL,
            descricao_plano VARCHAR(200) NOT NULL
            );
    ";
    if (!mysqli_query($conn,$sql)) { 
                echo("Erro na criacao da tabela tb_planos". mysqli_error($conn));
                return false;
            }
    
    $sql = "
        CREATE TABLE tb_logs (
            id_log INT(6) AUTO_INCREMENT PRIMARY KEY, 
            dt_log DATETIME NOT NULL,
            descricao_log VARCHAR(500) NOT NULL,
            tipo_log VARCHAR(20) NOT NULL
            );
    ";
    if (!mysqli_query($conn,$sql)) { 
                echo("Erro na criacao da tabela tb_logs". mysqli_error($conn));
                return false;
            }

    $sql = "
        CREATE TABLE tb_perfil_parceiro (
            id_perfil_parceiro INT(6) AUTO_INCREMENT PRIMARY KEY, 
            nome_perfil_parceiro VARCHAR(50) NOT NULL UNIQUE,
            per_cria_perfil_parceiro INT(1) NOT NULL,
            per_edita_perfil_parceiro INT(1) NOT NULL,
            per_visualiza_perfil_parceiro INT(1) NOT NULL,
            per_exclui_perfil_parceiro INT(1) NOT NULL,
            per_cria_usuario_parceiro INT(1) NOT NULL,
            per_edita_usuario_parceiro INT(1) NOT NULL,
            per_visualiza_usuario_parceiro INT(1) NOT NULL,
            per_exclui_usuario_parceiro INT(1) NOT NULL,
            per_cria_cliente_parceiro INT(1) NOT NULL,
            per_edita_cliente_parceiro INT(1) NOT NULL,
            per_visualiza_cliente_parceiro INT(1) NOT NULL,
            per_exclui_cliente_parceiro INT(1) NOT NULL,
            per_relatorios_parceiro INT(1) NOT NULL
            );
    ";
    if (!mysqli_query($conn,$sql)) { 
                echo("Erro na criacao da tabela tb_perfil_parceiro". mysqli_error($conn));
                return false;
            }

    $sql = "
        CREATE TABLE tb_usuarios_parceiro (
            id_usuario_parceiro INT(6) AUTO_INCREMENT PRIMARY KEY, 
            nome_usuario_parceiro VARCHAR(100) NOT NULL,
            email_usuario_parceiro VARCHAR(100) NOT NULL UNIQUE,
            senha_usuario_parceiro VARCHAR(100) NOT NULL,
            perfil_usuario_parceiro VARCHAR(100) NOT NULL,
            parceiro INT(6)
            );
    ";
    if (!mysqli_query($conn,$sql)) { 
                echo("Erro na criacao da tabela tb_usuarios_parceiro". mysqli_error($conn));
                return false;
            }

    $sql = "
        CREATE TABLE tb_clientes (
            id_cliente INT(6) AUTO_INCREMENT PRIMARY KEY, 
            parceiro INT(6) NOT NULL,
            nome_cliente VARCHAR(100) NOT NULL,
            endereco_cliente VARCHAR(100) NOT NULL,
            cpf_cliente VARCHAR(11) NOT NULL UNIQUE,
            telefone_cliente VARCHAR(100) NOT NULL,
            email_cliente VARCHAR(100) NOT NULL,
            plano_cliente INT(6) NOT NULL,
            nome_vendedor VARCHAR(100) NOT NULL,
            status_cliente VARCHAR(10) NOT NULL
            );
    ";
    if (!mysqli_query($conn,$sql)) { 
                echo("Erro na criacao da tabela tb_clientes". mysqli_error($conn));
                return false;
            }

    $sql = "
        CREATE TABLE tb_usuarios_cliente (
            id_usuario_cliente INT(6) AUTO_INCREMENT PRIMARY KEY, 
            nome_usuario_cliente VARCHAR(100) NOT NULL,
            email_usuario_cliente VARCHAR(100) NOT NULL UNIQUE,
            senha_usuario_cliente VARCHAR(100) NOT NULL,
            cliente INT(6) NOT NULL,
            parceiro INT(6) NOT NULL
            );
    ";
    if (!mysqli_query($conn,$sql)) { 
                echo("Erro na criacao da tabela tb_usuarios_cliente". mysqli_error($conn));
                return false;
            }

    $sql = "
        CREATE TABLE tb_entes (
            id_ente INT(6) AUTO_INCREMENT PRIMARY KEY, 
            cliente INT(6) NOT NULL,
            parceiro INT(6) NOT NULL,
            nome_ente VARCHAR(100) NOT NULL,
            dt_nascimento_ente DATE NOT NULL,
            dt_falecimento_ente DATE NOT NULL,
            cidade_nascimento_ente VARCHAR(100),
            cidade_falecimento_ente VARCHAR(100),
            nome_pai_ente VARCHAR(100),
            nome_mae_ente VARCHAR(100),
            casado_com VARCHAR(100),
            confissao_ente VARCHAR(50),
            localizacao_ente VARCHAR(200) NOT NULL,
            epitafio VARCHAR(1000) NOT NULL
            );
    ";
    if (!mysqli_query($conn,$sql)) { 
                echo("Erro na criacao da tabela tb_ente". mysqli_error($conn));
                return false;
            }

    $sql = "
        CREATE TABLE tb_midias (
            id_midia INT(6) AUTO_INCREMENT PRIMARY KEY, 
            cliente INT(6) NOT NULL,
            parceiro INT(6) NOT NULL,
            localizacao_midia VARCHAR(200) NOT NULL,
            perfil INT(1) NOT NULL
            );
    ";
    if (!mysqli_query($conn,$sql)) { 
                echo("Erro na criacao da tabela tb_midias". mysqli_error($conn));
                return false;
            }

    $sql = "
        CREATE TABLE tb_configuracoes (
            id_configuracao INT(6) AUTO_INCREMENT PRIMARY KEY, 
            cliente INT(6) NOT NULL,
            parceiro INT(6) NOT NULL,
            ente INT(6) NOT NULL,
            qrcode_ente VARCHAR(300) NOT NULL,
            permite_curtir INT(1) NOT NULL,
            permite_depoimentos INT(1) NOT NULL,
            ativo INT(1) NOT NULL
            );
    ";
    if (!mysqli_query($conn,$sql)) { 
                echo("Erro na criacao da tabela tb_configuracoes". mysqli_error($conn));
                return false;
            }

    $sql = "
        CREATE TABLE tb_conta_cliente (
            id_conta INT(6) AUTO_INCREMENT PRIMARY KEY, 
            cliente INT(6) NOT NULL,
            parceiro INT(6) NOT NULL,
            ente INT(6) NOT NULL,
            numero_cartao INT(100) NOT NULL,
            codigo_cartao INT(50) NOT NULL,
            validade_cartao VARCHAR(10) NOT NULL
            );
    ";
    if (!mysqli_query($conn,$sql)) { 
                echo("Erro na criacao da tabela tb_conta_cliente". mysqli_error($conn));
                return false;
            }

    $sql = "
        CREATE TABLE tb_depoimentos_ente (
            id_depoimento INT(6) AUTO_INCREMENT PRIMARY KEY, 
            cliente INT(6) NOT NULL,
            parceiro INT(6) NOT NULL,
            ente INT(6) NOT NULL,
            depoimento VARCHAR(1000) NOT NULL,
            escreveu VARCHAR (100) NOT NULL,
            aprovado INT(1) NOT NULL
            );
    ";
    if (!mysqli_query($conn,$sql)) { 
                echo("Erro na criacao da tabela tb_depoimentos_ente". mysqli_error($conn));
                return false;
            }

}

?>
