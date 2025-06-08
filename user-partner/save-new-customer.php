<!doctype html>
<html>

<head>
    <?php
    require("../inc/connect.inc");
    session_start();
    if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header("Location: ../index.php");
    }

    $logado = $_SESSION['login'];

    $conn = connect_db() or die("Não é possível conectar-se ao servidor.");

//busca o cliente e parceiro do ente
    $sql = "Select cliente, parceiro from tb_usuarios_cliente where email_usuario_cliente = '$logado'";
    $resultado = mysqli_query($conn, $sql);
    while ($linha = mysqli_fetch_array($resultado)) {

        $cliente = $linha["cliente"];
        $parceiro = $linha["parceiro"];
    }


//obtém os dados do ente do formulário preenchido
    $id = $_POST['id'];
    $nome = $_POST['name'];
    $dt_nascimento = $_POST['dateBirth'];
    $dt_falecimento = $_POST['dateDeath'];
    $cidade_nascimento = $_POST['cityBirth'];
    $cidade_falecimento = $_POST['cityDeath'];
    $nome_mae = $_POST['nameMother'];
    $nome_pai = $_POST['nameFather'];
    $casado_com = $_POST['married'];
    $religiao = $_POST['religion'];
    $local_tumulo = $_POST['location'];
    $epitafio = $_POST['epitaph'];


//verifica se é um cadastro de um ente novo ou atualização de um existente
if (isset($id) && $id > 0){
    mysqli_query($conn, "update tb_entes set nome_ente='$nome', dt_nascimento_ente='$dt_nascimento', dt_falecimento_ente='$dt_falecimento', cidade_nascimento_ente='$cidade_nascimento', cidade_falecimento_ente='$cidade_falecimento', nome_pai_ente='$nome_pai', nome_mae_ente='$nome_mae', casado_com='$casado_com', confissao_ente='$religiao', localizacao_ente='$local_tumulo', epitafio='$epitafio' where id_ente='$id'");
}
else{
    ///se não existe cria um novo ente
    mysqli_query($conn, "insert into tb_entes (cliente, parceiro, nome_ente, dt_nascimento_ente, dt_falecimento_ente, cidade_nascimento_ente, cidade_falecimento_ente, nome_pai_ente, nome_mae_ente, casado_com, confissao_ente, localizacao_ente, epitafio) values ('$cliente', '$parceiro', '$nome', '$dt_nascimento', '$dt_falecimento', '$cidade_nascimento', '$cidade_falecimento', '$nome_pai', '$nome_mae', '$casado_com', '$religiao', '$local_tumulo', '$epitafio')") or die("Não foi possível cadastrar planilha!");
}


    session_start();

    $_SESSION['mensagem'] = 'Alterações realizadas com sucesso';
    header("Location: list-entes.php");
    ?>
</head>

<body>
</body>

</html>