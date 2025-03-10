<?php ob_start(); ?>
<?php 
require("../inc/connect.inc");

// session_start inicia a sess�o
session_start();
// as vari�veis login e senha recebem os dados digitados na p�gina anterior
$login = $_POST['email'];
$senha = $_POST['password'];
$login_scape = addslashes($login);
$senha_scape = addslashes($senha);

// as pr�ximas 3 linhas s�o respons�veis em se conectar com o bando de dados.
$con = connect_db() or die("N�o � poss�vel conectar-se ao servidor.");


// A vriavel $result pega as varias $login e $senha, faz uma pesquisa na tabela de usuarios de cliente
$resultCustomer = mysqli_query($con,"SELECT * FROM tb_usuarios_cliente WHERE email_usuario_cliente = '$login_scape' AND senha_usuario_cliente= '$senha_scape'");

/* Logo abaixo temos um bloco com if e else, verificando se a vari�vel $result foi bem sucedida, ou seja se ela estiver encontrado algum registro id�ntico o seu valor ser� igual a 1, se n�o, se n�o tiver registros seu valor ser� 0. Dependendo do resultado ele redirecionar� para a pagina site.php ou retornara  para a pagina do formul�rio inicial para que se possa tentar novamente realizar o login */
$totalCustomer = mysqli_num_rows($resultCustomer);
if ($totalCustomer > 0 )
{
	$_SESSION['login'] = $login;
	$_SESSION['senha'] = $senha;
	header('Location: ../user-customer/home.php');
}
elseif ($totalCustomer == 0){
	$resultPartner = mysqli_query($con,"SELECT * FROM tb_usuarios_parceiro WHERE email_usuario_parceiro = '$login_scape' AND senha_usuario_parceiro= '$senha_scape'");
	$totalPartner = mysqli_num_rows($resultPartner);
	if ($totalPartner > 0) {
		$_SESSION['loginPartner'] = $login;
		$_SESSION['senhaPartner'] = $senha;
		header('Location: ../user-partner/home.php');
	}
}
else {

	unset ($_SESSION['login']);
	unset ($_SESSION['senha']);
	header('location: acessoinvalido.html');
	
	
	}
?>