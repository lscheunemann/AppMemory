<!doctype html>
<html>

<head>
    <?php
    require("../inc/connect.inc");
    session_start();
    if ((!isset($_SESSION['loginPartner']) == true) and (!isset($_SESSION['senhaPartner']) == true)) {
        unset($_SESSION['loginPartner']);
        unset($_SESSION['senhaPartner']);
        header("Location: ../index.php");
    }

    $logado = $_SESSION['loginPartner'];

    $conn = connect_db() or die("Não é possível conectar-se ao servidor.");

    //busca o parceiro em questão
    $sql = "Select id_usuario_parceiro from tb_usuarios_parceiro where email_usuario_parceiro = '$logado'";
    $resultado = mysqli_query($conn, $sql);
    while ($linha = mysqli_fetch_array($resultado)) {
        $parceiro = $linha["id_usuario_parceiro"];
    }


    //obtém os dados do usuario do formulário preenchido
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $senha1 = $_POST['password'];
    $senha2 = $_POST['passwordConfirm'];
    $idCliente = $_POST['id'];

    //verifica se senha 1 e senha 2 são iguais
    if ($senha1 == $senha2) {
        //verifica se usuário já existe em cliente
        $sqlConf1 = "Select email_usuario_cliente from tb_usuarios_cliente where email_usuario_cliente = '$email'";
        $resultadoConf1 = mysqli_query($conn, $sqlConf1);
        while ($linhaConf1 = mysqli_fetch_array($resultadoConf1)) {
            $qtd1 = $linhaConf1["email_usuario_cliente"];
        }
        if (isset($qtd1) && $qtd1 > 0) {
            header("Location: error-new-customer-user.html");
        } else {
            //verifica se usuário já existe em parceiro
            $sqlConf2 = "Select email_usuario_parceiro from tb_usuarios_parceiro where email_usuario_parceiro = '$email'";
            $resultadoConf2 = mysqli_query($conn, $sqlConf2);
            while ($linhaConf2 = mysqli_fetch_array($resultadoConf2)) {
                $qtd2 = $linhaConf2["email_usuario_parceiro"];
            }
            if (isset($qtd2) && $qtd2 > 0) {
                header("Location: error-new-customer-user.html");
            } else {
                //verifica se usuário já existe em gestao
                $sqlConf3 = "Select email_usuario_gestao from tb_usuarios_gestao where email_usuario_gestao = '$email'";
                $resultadoConf3 = mysqli_query($conn, $sqlConf3);
                while ($linhaConf3 = mysqli_fetch_array($resultadoConf3)) {
                    $qtd3 = $linhaConf3["email_usuario_gestao"];
                }
                if (isset($qtd3) && $qtd3 > 0) {
                    header("Location: error-new-customer-user.html");
                } else {
                    //cria novo usuario
                    mysqli_query($conn, "insert into tb_usuarios_cliente (nome_usuario_cliente,email_usuario_cliente,senha_usuario_cliente,cliente,parceiro,ativo) values ('$nome', '$email', '$senha1', '$idCliente', '$parceiro', 0)") or die("Não foi possível cadastrar o usuário do cliente!");
                    $_SESSION['mensagem'] = 'Alterações realizadas com sucesso';
                    header("Location: user-customer-create");
                }
            }
        }
    } else {
        header("Location: error-new-customer-user.html");
    }

    ?>
</head>

<body>
</body>

</html>