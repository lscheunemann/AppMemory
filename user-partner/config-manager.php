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


// busca dados do parceiro
$sql2 = "Select * from tb_parceiros where id_parceiro = '$parceiro'";
$resultado2 = mysqli_query($conn, $sql2);
while ($linha2 = mysqli_fetch_array($resultado2)) {
  $id_parceiro = $linha2["id_parceiro"];
  $nomeparceiro = $linha2["nome_parceiro"];
  $razaosocial = $linha2["razaosocial_parceiro"];
  $cnpjparceiro = $linha2["cnpj_parceiro"];
  $inscricaoestadual = $linha2["inscricaoestadual_parceiro"];
  $inscricaomunicipal = $linha2["inscricaomunicipal_parceiro"];
  $telefoneparceiro = $linha2["telefone_parceiro"];
  $emailparceiro = $linha2["email_parceiro"];
  $responsavelfin = $linha2["responsavelfinanceiro_parceiro"];
  $endereco_parceiro = $linha2["endereco_parceiro"];
  $statusparceiro = $linha2["status_parceiro"];
}

if (isset($_SESSION['mensagem'])) {
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
            <h2>Gerenciar parceiro</h2>
          </div>
        </div>
      </div>
    </div><!-- End Page Header -->
    <div class="section-header">
      <h2>Informações do parceiro</h2>
    </div>

    <section id="pageManager" class="contact">
      <div class="container">



        <div class="row justify-content-center mt-4">

          <div class="col-lg-9">
            <form action="save-customer-manager-edit.php" method="post" role="form" class="php-email-form">
              <div class="form-group mt-3">
                <label for="name">Nome parceiro</label>
                <input type="text" class="form-control" name="namePartner" id="namePartner" placeholder="nome do parceiro" value="<?php if (!empty($nomeparceiro)) {
                                                                                                                                    echo $nomeparceiro;
                                                                                                                                  } ?>" required>
                <input type="hidden" name="id" value="<?php if (!empty($id_parceiro)) {
                                                        echo $id_parceiro;
                                                      } ?>">
              </div>
              <div class="form-group mt-3">
                <label for="name">Razão social</label>
                <input type="text" class="form-control" name="razaoSocial" id="razaoSocial" placeholder="razão social" value="<?php if (!empty($razaosocial)) {
                                                                                                                                echo $razaosocial;
                                                                                                                              } ?>" required>

              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="code">CNPJ</label>
                  <input type="text" name="cnpj" class="form-control" id="cnpj" placeholder="cnpj" value="<?php if (!empty($cnpjparceiro)) {
                                                                                                            echo $cnpjparceiro;
                                                                                                          } ?>" readonly required>

                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <label for="status">Inscrição estadual</label>
                  <input type="text" class="form-control" name="ie" id="ie" placeholder="status" value="<?php if (!empty($inscricaoestadual)) {
                                                                                                          echo $inscricaoestadual;
                                                                                                        } ?>" readonly required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="cpf">Inscrição municipal</label>
                  <input type="text" name="im" class="form-control" id="im" placeholder="cpf do parceiro" value="<?php if (!empty($inscricaomunicipal)) {
                                                                                                                    echo $inscricaomunicipal;
                                                                                                                  } ?>" readonly required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <label for="phone">Telefone</label>
                  <input type="text" class="form-control" name="phone" id="phone" placeholder="e-mail do parceiro" value="<?php if (!empty($telefoneparceiro)) {
                                                                                                                            echo $telefoneparceiro;
                                                                                                                          } ?>" required>
                </div>
              </div>

              <div class="form-group mt-3">
                <label for="email">E-mail</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="e-mail do parceiro" value="<?php if (!empty($emailparceiro)) {
                                                                                                                          echo $emailparceiro;
                                                                                                                        } ?>" readonly required>
              </div>
              <div class="form-group mt-3">
                <label for="address">Endereço</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="endereco do parceiro" value="<?php if (!empty($endereco_parceiro)) {
                                                                                                                                echo $endereco_parceiro;
                                                                                                                              } ?>" required>
              </div>
              <div class="form-group mt-3">
                <label for="address">Responsável financeiro</label>
                <input type="text" class="form-control" name="responsible" id="responsible" placeholder="responsável pelo parceiro" value="<?php if (!empty($responsavelfin)) {
                                                                                                                                              echo $responsavelfin;
                                                                                                                                            } ?>" required>
              </div>

              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message">errado</div>
                <div class="sent-message">feitoo</div>
              </div>
              <div class="text-center d-flex justify-content-center gap-2">
                <a href="home.php" class="btn btn-primary btn-sm d-inline-flex align-items-center">Voltar</a>
                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
              </div>

            </form>

          </div><!-- End Contact Form -->

        </div>

      </div>
    </section><!-- End Contact Section -->
    <br><br><br><br>
    <section id="contact" class="contact">
      <div class="container"></div>
      <div class="row gy-4 justify-content-center">
        <div class="section-header">
          <h2>Logotipo</h2>
        </div>
        <div class="col-lg-3">
          <div class="info-item d-flex">
            <i class="bi bi-geo-alt flex-shrink-0"></i>
            <div>
              <h4>Editar logotipo</h4>
              <form action="upload-logo-image.php" method="post" enctype="multipart/form-data">
                <div class="d-flex align-items-center gap-2">
                  <input type='hidden' name="idPartner" value="<?php echo $id_parceiro ?>">
                  <label for="logoPhoto" id="fileLabel" class="btn btn-success mb-0">Escolher foto</label>
                  <input type="file" id="logoPhoto" name="logoPhoto" accept=".png, .jpg, .jpeg" class="custom-file-input" hidden />
                  <button type="submit" class="btn btn-primary">Salvar imagem</button>
                </div>
              </form>

              <script>
                // Seleciona os elementos
                const fileInput = document.getElementById('logoPhoto');
                const fileLabel = document.getElementById('fileLabel');

                // Adiciona um evento para detectar quando um arquivo for selecionado
                fileInput.addEventListener('change', () => {
                  if (fileInput.files.length > 0) {
                    // Adiciona a classe "btn-success" para deixar o botão verde
                    fileLabel.classList.remove('btn-success');
                    fileLabel.classList.add('btn-primary');
                  } else {
                    // Retorna ao estado original caso nenhum arquivo esteja selecionado
                    fileLabel.classList.remove('btn-primary');
                    fileLabel.classList.add('btn-success');
                  }
                });
              </script>

            </div>
          </div>
        </div>
        <!-- End Info Item -->
      </div>
    </section>


    <section id="gallery" class="gallery">
      <div class="container-fluid">


        <?php
        $repositorioUsuario = "../assets/img/gallery/logo-partner/$id_parceiro/";

        // Busca todos os arquivos de imagem no diretório do usuário
        $filesLogo = glob($repositorioUsuario . '*.{png,jpg,jpeg}', GLOB_BRACE);

        // Verifica se há arquivos na pasta
        if (!empty($filesLogo)) {
          // Ordena os arquivos pelo tempo de modificação (mais recente primeiro)
          usort($filesLogo, function ($a, $b) {
            return filemtime($b) - filemtime($a); // Ordena do mais recente para o mais antigo
          });

          // Pega o arquivo mais recente
          $mediaLogo = $filesLogo[0];
          $nameFile = basename($mediaLogo);
          $pathFile = $repositorioUsuario . $nameFile;
        } else {
          // Caminho padrão caso nenhum arquivo seja encontrado
          $mediaLogo = '../assets/img/gallery/icon/empty.png';
          $pathFile = "../assets/img/gallery/icon/empty.png";
        }
        ?>


        <div class="row gy-4 justify-content-center">
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="<?php echo $mediaLogo; ?>" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="<?php echo $pathFile; ?>" title="Foto de perfil" class="glightbox preview-link"><i
                    class="bi bi-arrows-angle-expand"></i></a>

              </div>
            </div>
          </div><!-- End Gallery Item -->

        </div>

      </div>
    </section><!-- End Gallery Section -->

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


</body>

</html>