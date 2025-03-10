<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Loves Memory - Account Management</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.svg" rel="icon">
  <link href="../assets/img/apple-touch-icon.svg" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/main.css" rel="stylesheet">

</head>
<?php  
require("../inc/connect.inc");
// esse bloco de código em php verifica se existe a sessão, pois o usuário pode simplesmente não fazer o login e digitar na barra de endereço do seu navegador o caminho para a página principal do site (sistema), burlando assim a obrigação de fazer um login, com isso se ele não estiver feito o login não será criado a session, então ao verificar que a session não existe a página redireciona o mesmo para a index.php.
session_start();
if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
{
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header("Location: ../index.php");
	}

$logado = $_SESSION['login'];


$conn = connect_db() or die("Não é possível conectar-se ao servidor.");

$sql = "Select nome_usuario_cliente, cliente from tb_usuarios_cliente where email_usuario_cliente = '$logado'";
// setando as linhas de exibição na tela;
$resultado = mysqli_query($conn, $sql);

	
while ($linha = mysqli_fetch_array($resultado)) {			
  $nome 	= $linha["nome_usuario_cliente"];
  $cliente 	= $linha["cliente"];
}

// busca dados do ente
$sql2 = "Select nome_ente from tb_entes where cliente = '$cliente'";
$resultado2 = mysqli_query($conn, $sql2);
while ($linha2 = mysqli_fetch_array($resultado2)) {
  $nomeente = $linha2["nome_ente"];
}

// busca dados da conta do cliente
$sql3 = "Select * from tb_conta_cliente where cliente = '$cliente'";
$resultado3 = mysqli_query($conn, $sql3);
while ($linha3 = mysqli_fetch_array($resultado3)) {
  $plano = $linha3["plano"];
}

// busca dados do plano
$sql4 = "Select nome_plano from tb_planos where id_plano = '$plano'";
$resultado4 = mysqli_query($conn, $sql4);
while ($linha4 = mysqli_fetch_array($resultado4)) {
  $nomeplano = $linha4["nome_plano"];
}

?>


<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="home.php" class="logo d-flex align-items-center me-auto me-lg-0">
        <i class="bi bi-camera"></i>
        <h1>Loves Memory</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a>Olá, <?php echo $nome ?></a></li>
          <li><a href="logout.php">Sair</a></li>
        </ul>
      </nav><!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  <main id="main" data-aos="fade" data-aos-delay="1500">

    <!-- ======= End Page Header ======= -->
    <div class="page-header d-flex align-items-center">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center">
            <h2>Gerenciar conta</h2>
          </div>
        </div>
      </div>
    </div><!-- End Page Header -->

    <section id="account-management" class="contact">
      <div class="container">

        <div class="row justify-content-center mt-4">
          <div class="col-lg-9">

            <!-- Tabela de Gestão de Conta -->
            <div class="table-responsive">
              <table class="table table-bordered text-center">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Nome do ente</th>
                    <th scope="col">Plano</th>
                    <th scope="col">Pagamento</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php if (!empty($nomeente)) {echo $nomeente;} ?></td>
                    <td><?php if (!empty($nomeplano)) {echo $nomeplano;} ?> <a href="#" class="ms-2">-alterar plano-</a></td>
                    <td>Mastercard <a href="#" class="ms-2">-alterar forma de pagamento-</a></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Botão de Exclusão de Conta -->
            <div class="text-center mt-4">
              <button class="btn btn-danger" type="button">Excluir Conta</button>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End Account Management Section -->

  </main><!-- End #main -->

  <footer id="footer" class="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Loves Memory</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader">
    <div class="line"></div>
  </div>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>
