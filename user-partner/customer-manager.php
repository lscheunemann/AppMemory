<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Loves Memory</title>
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

  <!-- =======================================================
  * Template Name: PhotoFolio
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<?php
require("../inc/connect.inc");
// esse bloco de código em php verifica se existe a sessão, pois o usuário pode simplesmente não fazer o login e digitar na barra de endereço do seu navegador o caminho para a página principal do site (sistema), burlando assim a obrigação de fazer um login, com isso se ele não estiver feito o login não será criado a session, então ao verificar que a session não existe a página redireciona o mesmo para a index.php.
session_start();
if ((!isset($_SESSION['loginPartner']) == true) and (!isset($_SESSION['senhaPartner']) == true)) {
  unset($_SESSION['loginPartner']);
  unset($_SESSION['senhaPartner']);
  header("Location: ../index.php");
}

$logado = $_SESSION['loginPartner'];


$conn = connect_db() or die("Não é possível conectar-se ao servidor.");

$sql = "Select nome_usuario_parceiro, parceiro from tb_usuarios_parceiro where email_usuario_parceiro = '$logado'";
// setando as linhas de exibição na tela;
$resultado = mysqli_query($conn, $sql);


while ($linha = mysqli_fetch_array($resultado)) {
  $nome     = $linha["nome_usuario_parceiro"];
  $parceiro = $linha["parceiro"];
}


?>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="home.php" class="logo d-flex align-items-center  me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
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
            <h2>Gerenciar clientes</h2>
          </div>
        </div>
      </div>
    </div><!-- End Page Header -->


    <div class="section-header">
      <h2>Cadastro de clientes</h2>
    </div>
    <div class="d-flex justify-content-center">
      <a href="new-customer.php">
        <button class="btn btn-primary" type="button">Adicionar novo cliente</button>
      </a>
    </div>
    <br>
    <h5 align="center">Clientes cadastrados</h5>
    <section class="container mt-4">
      <div class="table-responsive">
        <table class="table table-bordered text-center">
          <thead class="table-dark">
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Plano</th>
              <th scope="col">Status</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $sqlCli = "SELECT * FROM tb_clientes WHERE parceiro = '$parceiro'";
            $resultadoCli = mysqli_query($conn, $sqlCli);

            while ($linhaCli = mysqli_fetch_array($resultadoCli)) {
              $idCli      = $linhaCli["id_cliente"];
              $nomeCli    = $linhaCli["nome_cliente"];
              $planoId   = $linhaCli["plano_cliente"];
              $statusCli  = $linhaCli["status_cliente"];

              $sqlPlano = "SELECT nome_plano FROM tb_planos WHERE id_plano = '$planoId'";
              $resultadoPlano = mysqli_query($conn, $sqlPlano);
              $linhaPlano = mysqli_fetch_assoc($resultadoPlano);
              $plano = $linhaPlano['nome_plano'];


              echo ("
                    <tr>
                      <td>$nomeCli</td>
                      <td>$plano</td>
                      <td>$statusCli</td>
                      <td>
                        <form action='customer-manager-edit.php' method='post' style='display: inline;'>
                          <input type='hidden' name='id' value='$idCli'>
                          <button type='submit' class='btn btn-primary btn-sm'>Gerenciar</button>
                        </form>  
                        <button class='btn btn-danger btn-sm' type='button' data-bs-toggle='modal' data-bs-target='#deleteCustomer$idCli'>Excluir</button>
                      </td>
                    </tr>

                    <!-- Modal exclusiva do cliente -->
                    <div class='modal fade' id='deleteCustomer$idCli' tabindex='-1' aria-labelledby='deleteCustomerLabel$idCli' aria-hidden='true'>
                      <div class='modal-dialog modal-dialog-centered'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='deleteCustomerLabel$idCli'>
                              <font color='black'>Atenção!</font>
                            </h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                          </div>
                          <div class='modal-body text-center'>
                            <h6><font color='black'>Tem certeza que deseja excluir o cliente <strong>$nomeCli</strong>?</font></h6>
                          </div>
                          <div class='modal-footer justify-content-center'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Não</button>
                            <a href='delete-customer.php?id=$idCli' class='btn btn-success'>Sim</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    ");
            }


            ?>
          </tbody>
        </table>
      </div>
    </section>

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
  <!-- <script src="../assets/vendor/php-email-form/validate.js"></script>-->

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>


</body>

</html>