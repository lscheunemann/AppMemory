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
if (isset($_POST['id'])) {
  $idEnte = $_POST['id'];
  echo "ID recebido: " . $id;
} else {
  echo "Nenhum ID recebido via POST.";
}

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

$sql = "Select * from tb_usuarios_cliente where email_usuario_cliente = '$logado'";
// setando as linhas de exibição na tela;
$resultado = mysqli_query($conn, $sql);

	
while ($linha = mysqli_fetch_array($resultado)) {			
  $nome 	= $linha["nome_usuario_cliente"];
  $cliente = $linha["cliente"];
  $parceiro = $linha["parceiro"];
}

$sql2 = "Select permite_curtir, permite_depoimentos, qrcode_ente, ativo from tb_configuracoes where cliente = '$cliente' AND ente = '$idEnte'";
$resultado2 = mysqli_query($conn, $sql2);

while ($linha2 = mysqli_fetch_array($resultado2)) {
  $curtir = $linha2["permite_curtir"];
  $depoimento = $linha2["permite_depoimentos"];
  $qrcode = $linha2["qrcode_ente"];
  $ativo = $linha2["ativo"];
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
            <h2>Gerenciar configurações</h2>
          </div>
        </div>
      </div>
    </div><!-- End Page Header -->
  
    <section id="pageConfig" class="contact">
      <div class="container">
        <div class="row justify-content-center mt-4">
          <div class="col-lg-9">
  
            <!-- Formulário para a configuração de curtir fotos e vídeos -->
            <form action="save-config-manager.php" method="post" role="form" class="php-email-form">
              <!-- Alinhamento à esquerda e centralização na tela -->
              <div class="form-group d-flex justify-content-center">
                <div class="d-flex align-items-center" style="width: 100%; max-width: 400px; text-align: left;">
                  <label for="activeLike" class="form-check-label mb-0" style="padding-right: 10px;">Permite curtir fotos e vídeos</label>
                  <label class="switch" style="margin-left: auto;">
                    <input type="checkbox" class="form-check-input" name="activeLike" id="activeLike" <?php if ($curtir == 1) {echo "checked";} ?>>
                    <span class="slider"></span>
                  </label>
                </div>
              </div>
              <div class="form-group d-flex justify-content-center">
                <div class="d-flex align-items-center" style="width: 100%; max-width: 400px; text-align: left;">
                  <label for="activeTestimonials" class="form-check-label mb-0" style="padding-right: 10px;">Permite escrever depoimentos</label>
                  <label class="switch" style="margin-left: auto;">
                    <input type="checkbox" class="form-check-input" name="activeTestimonials" id="activeTestimonials" <?php if ($depoimento == 1) {echo "checked";} ?>>
                    <span class="slider"></span>
                  </label>
                </div>
              </div>
              <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message">errado</div>
             <div class="sent-message">feitoo</div>
          </div>
              <div class="text-center mt-3">
                <input type="hidden" name="id" value="<?php if (!empty($idEnte)){echo $idEnte;}?>">
                <button class="btn btn-success" type="submit">Salvar</button>
              </div>
            </form>
           
  
            <!-- Linha de botões fora do formulário -->
            <div class="text-center mt-4 d-flex justify-content-center">
              <button class="btn btn-secondary mx-2" type="button" data-bs-toggle="modal" data-bs-target="#qrcodeModal">Ver QRCode</button>
              <?php if($ativo==1){
                echo "<button class='btn btn-danger mx-2' type='button' data-bs-toggle='modal' data-bs-target='#disableModal'>Desativar página</button>";
              }
              else{
                echo "<button class='btn btn-primary mx-2' type='button' data-bs-toggle='modal' data-bs-target='#enableModal'>Ativar página</button>";
              }; ?> 
            </div>
            
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->
  
  </main><!-- End #main -->
  
  
  
  <!-- CSS para o switch -->
  <style>
  /* Estilização da chave liga/desliga */
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }
  
  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }
  
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: 0.4s;
    border-radius: 34px;
  }
  
  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: 0.4s;
    border-radius: 50%;
  }
  
  input:checked + .slider {
    background-color: #4CAF50;
  }
  
  input:checked + .slider:before {
    transform: translateX(26px);
  }
  
  /* Para efeito visual quando o checkbox está desabilitado */
  .slider:disabled {
    background-color: #b5b5b5;
  }
  </style>
  
  
  
  
  

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
  <!-- <script src="../assets/vendor/php-email-form/validate.js"></script> -->

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

  <!-- Modal qrcode-->
<div class="modal fade" id="qrcodeModal" tabindex="-1" aria-labelledby="qrcodeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <!-- Insira aqui a imagem ou o código para gerar o QRCode -->
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=<?php echo "$qrcode" ?>" alt="QRCode" class="img-fluid">
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal desativar pagina-->
<div class="modal fade" id="disableModal" tabindex="-1" aria-labelledby="disableModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="disableModalLabel"><font color="black">Atenção!</font></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <h6><font color="black">Tem certeza que deseja desativar a página?</font></h6>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
        <a href="disable-page.php"><button type="button" class="btn btn-success">Sim</button></a>
      </div>
    </div>
  </div>
</div>
<!-- Modal ativar pagina-->
<div class="modal fade" id="enableModal" tabindex="-1" aria-labelledby="enableModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="enableModalLabel"><font color="black">Atenção!</font></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <h6><font color="black">Tem certeza que deseja ativar a página?</font></h6>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
        <a href="enable-page.php"><button type="button" class="btn btn-success">Sim</button></a>
      </div>
    </div>
  </div>
</div>



</body>

</html>