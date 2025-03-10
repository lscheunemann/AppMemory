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
if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
{
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header("Location: ../index.php");
	}

$logado = $_SESSION['login'];


$conn = connect_db() or die("Não é possível conectar-se ao servidor.");

$sql = "Select nome_usuario_cliente, cliente, parceiro from tb_usuarios_cliente where email_usuario_cliente = '$logado'";

$resultado = mysqli_query($conn, $sql);

	
while ($linha = mysqli_fetch_array($resultado)) {			
  $nome 	= $linha["nome_usuario_cliente"];
  $cliente 	= $linha["cliente"];
  $parceiro 	= $linha["parceiro"];
}

// busca dados do ente
$sql2 = "Select * from tb_entes where cliente = '$cliente'";
$resultado2 = mysqli_query($conn, $sql2);
while ($linha2 = mysqli_fetch_array($resultado2)) {
  $nomeente = $linha2["nome_ente"];
  $dtnasc = $linha2["dt_nascimento_ente"];
  $dtfal = $linha2["dt_falecimento_ente"];
  $cidnasc = $linha2["cidade_nascimento_ente"];
  $cidfal = $linha2["cidade_falecimento_ente"];
  $nomepai = $linha2["nome_pai_ente"];
  $nomemae = $linha2["nome_mae_ente"];
  $conjuge = $linha2["casado_com"];
  $localizacao = $linha2["localizacao_ente"];
  $confissao = $linha2["confissao_ente"];
  $epitafio = $linha2["epitafio"];
}

if( isset( $_SESSION['mensagem'] ) )
    {
        $mensagem = $_SESSION['mensagem'];
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
            <h2>Gerenciar página</h2>
          </div>
        </div>
      </div>
    </div><!-- End Page Header -->
    <div class="section-header">
          <h2>Informações do ente</h2> 
    </div>
  
    <section id="pageManager" class="contact">
      <div class="container">

        

        <div class="row justify-content-center mt-4">

          <div class="col-lg-9">
          <form action="save-page-manager.php" method="post" role="form" class="php-email-form">
          <div class="form-group mt-3">
            <label for="name">Nome</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="nome completo do ente" value="<?php if (!empty($nomeente)) {echo $nomeente;} ?>" required>
          </div>
          <div class="row">
            <div class="col-md-6 form-group">
              <label for="dateBirth">Data de nascimento</label>
              <input type="date" name="dateBirth" class="form-control" id="dateBirth" placeholder="data de nascimento do ente" value="<?php if (!empty($dtnasc)) {echo $dtnasc;} ?>" required>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <label for="dateDeath">Data de falecimento</label>
              <input type="date" class="form-control" name="dateDeath" id="dateDeath" placeholder="data de falecimento do ente" value="<?php if (!empty($dtfal)) {echo $dtfal;} ?>" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 form-group">
              <label for="cityBirth">Cidade de nascimento</label>
              <input type="text" name="cityBirth" class="form-control" id="cityBirth" placeholder="cidade de nascimento do ente" value="<?php if (!empty($cidnasc)) {echo $cidnasc;} ?>" required>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <label for="cityDeath">Cidade de falecimento</label>
              <input type="text" class="form-control" name="cityDeath" id="cityDeath" placeholder="cidade de falecimento do ente" value="<?php if (!empty($cidfal)) {echo $cidfal;} ?>" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 form-group">
              <label for="nameMother">Nome da mãe</label>
              <input type="text" name="nameMother" class="form-control" id="nameMother" placeholder="nome da mãe do ente" value="<?php if (!empty($nomemae)) {echo $nomemae;} ?>" required>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <label for="nameFather">Nome do pai</label>
              <input type="text" class="form-control" name="nameFather" id="nameFather" placeholder="nome do pai do ente" value="<?php if (!empty($nomepai)) {echo $nomepai;} ?>" required>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 form-group">
              <label for="married">Casado com</label>
              <input type="text" name="married" class="form-control" id="married" placeholder="conjuge do ente" value="<?php if (!empty($conjuge)) {echo $conjuge;} ?>" required>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <label for="religion">Confissão religiosa</label>
              <input type="text" class="form-control" name="religion" id="religion" placeholder="confissão religiosa do ente" value="<?php if (!empty($confissao)) {echo $confissao;} ?>" required>
            </div>
          </div>
          <div class="form-group mt-3">
            <label for="location">Localização do túmulo</label>
            <input type="text" class="form-control" name="location" id="location" placeholder="localização do túmulo" value="<?php if (!empty($localizacao)) {echo $localizacao;} ?>" required>
          </div>
          <div class="form-group mt-3">
            <label for="epitaph">Epitáfio</label>
            <textarea class="form-control" name="epitaph" id="epitaph" maxlength="1000" rows="5" placeholder="digite o epitáfio" required><?php if (!empty($epitafio)) {echo $epitafio;} ?></textarea>
          </div>
          <div class="my-3">
            <div class="loading">Loading</div>
            <div class="error-message">errado</div>
            <div class="sent-message">feitoo</div>
          </div>
          <div class="text-center"><button type="submit">Salvar</button></div>
        </form>

          </div><!-- End Contact Form -->

        </div>

      </div>
    </section><!-- End Contact Section -->

    <div class="section-header">
          <h2>Depoimentos</h2> 
    </div>
    <div class="d-flex justify-content-center">
    <a href="page-testimonials.php">
        <button class="btn btn-primary" type="button">Aprovar depoimentos</button>
    </a>
    </div>
    <br>
    <h5 align="center">Depoimentos aprovados</h5>
    <section class="container mt-4">
                <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">Autor</th>
                        <th scope="col">Depoimento</th>
                        <th scope="col">Ações</th>
                    </tr>
                    </thead>
                    <tbody>

    <?php
        $sql2 = "SELECT * FROM tb_depoimentos_ente WHERE cliente = '$cliente' AND parceiro = '$parceiro' AND aprovado = 1";
        $resultado2 = mysqli_query($conn, $sql2);
        
        while ($linha2 = mysqli_fetch_array($resultado2)){
            $autor      = $linha2["escreveu"];
            $depoimento = $linha2["depoimento"];
            $id_depoimento   = $linha2["id_depoimento"];

            
            echo ("
                
                    
                    <tr>
                        <td>$autor</td>
                        <td>$depoimento</td>
                        <td>
                        <button class='btn btn-danger btn-sm' type='button' data-bs-toggle='modal' data-bs-target='#deleteTestimonials'>Excluir</button>
                        </td>
                    </tr>
                    
              

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
  <!-- Modal excluir depoimento-->
<div class="modal fade" id="deleteTestimonials" tabindex="-1" aria-labelledby="deleteTestimonials" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteTestimonials"><font color="black">Atenção!</font></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <h6><font color="black">Tem certeza que deseja excluir este depoimento?</font></h6>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
        <a href="delete-testimonials.php?id=<?php echo $id_depoimento; ?>"><button type="button" class="btn btn-success">Sim</button></a>
      </div>
    </div>
  </div>
</div>

</body>

</html>