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
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap"
    rel="stylesheet">

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
if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
  unset($_SESSION['login']);
  unset($_SESSION['senha']);
  header("Location: ../index.php");
}

$logado = $_SESSION['login'];


$conn = connect_db() or die("Não é possível conectar-se ao servidor.");

$sql = "Select nome_usuario_cliente from tb_usuarios_cliente where email_usuario_cliente = '$logado'";
// setando as linhas de exibição na tela;
$resultado = mysqli_query($conn, $sql);


while ($linha = mysqli_fetch_array($resultado)) {
  $nome   = $linha["nome_usuario_cliente"];
}

if (isset($_POST['id'])) {
  $idEnte = $_POST['id'];
  echo "ID recebido: " . $id;
} else {
  echo "Nenhum ID recebido via POST.";
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

    <style>
      /* Estilo para o input de arquivo */
      .custom-file-input {
        display: none;
      }

      .custom-file-label {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: 500;
        color: white;
        background-color: #6c757d;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }

      .custom-file-label:hover {
        background-color: #5a6268;
      }

      /* Adicionando estilos quando o arquivo é selecionado */
      input[type="file"]:valid+.custom-file-label {
        background-color: #28a745;
      }
    </style>

    <!-- ======= End Page Header ======= -->
    <div class="page-header d-flex align-items-center">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center">
            <h2>Mídias</h2>

          </div>
        </div>
      </div>
    </div><!-- End Page Header -->

    <section id="contact" class="contact">
      <div class="container"></div>
      <div class="row gy-4 justify-content-center">

        <div class="col-lg-3">
          <div class="info-item d-flex">
            <i class="bi bi-geo-alt flex-shrink-0"></i>
            <div>
              <h4>Editar foto de perfil</h4>
              <form action="upload-profile-image.php" method="post" enctype="multipart/form-data">
                <div class="d-flex align-items-center gap-2">
                  <input type='hidden' name="idEnteProfile" value="<?php echo $idEnte ?>">
                  <label for="profilePhoto" id="fileLabel" class="btn btn-success mb-0">Escolher foto</label>
                  <input type="file" id="profilePhoto" name="profilePhoto" accept=".png, .jpg, .jpeg" class="custom-file-input" hidden />
                  <button type="submit" class="btn btn-primary">Salvar imagem</button>
                </div>
              </form>

              <script>
                // Seleciona os elementos
                const fileInput = document.getElementById('profilePhoto');
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
        <div class="section-header">
          <h2>Foto de perfil</h2>
        </div>

        <?php
        $repositorioUsuario = "../assets/img/gallery/profile/$logado/$idEnte/";

        // Busca todos os arquivos de imagem no diretório do usuário
        $filesProfile = glob($repositorioUsuario . '*.{png,jpg,jpeg}', GLOB_BRACE);

        // Verifica se há arquivos na pasta
        if (!empty($filesProfile)) {
          // Ordena os arquivos pelo tempo de modificação (mais recente primeiro)
          usort($filesProfile, function ($a, $b) {
            return filemtime($b) - filemtime($a); // Ordena do mais recente para o mais antigo
          });

          // Pega o arquivo mais recente
          $mediaProfile = $filesProfile[0];
          $nameFile = basename($mediaProfile);
          $pathFile = $repositorioUsuario . $nameFile;
        } else {
          // Caminho padrão caso nenhum arquivo seja encontrado
          $mediaProfile = '../assets/img/gallery/icon/empty.png';
          $pathFile = "../assets/img/gallery/icon/empty.png";
        }
        ?>


        <div class="row gy-4 justify-content-center">
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100">
              <img src="<?php echo $mediaProfile; ?>" class="img-fluid" alt="">
              <div class="gallery-links d-flex align-items-center justify-content-center">
                <a href="<?php echo $pathFile; ?>" title="Foto de perfil" class="glightbox preview-link"><i
                    class="bi bi-arrows-angle-expand"></i></a>

              </div>
            </div>
          </div><!-- End Gallery Item -->

        </div>

      </div>
    </section><!-- End Gallery Section -->
    <br><br><br>
    <section id="contact" class="contact">
      <div class="container"></div>
      <div class="row gy-4 justify-content-center">

        <div class="col-lg-3">
          <div class="info-item d-flex">
            <i class="bi bi-envelope flex-shrink-0"></i>
            <div>
              <h4>Adicionar mídia</h4>

              <form action="upload-gallery-image.php" method="post" enctype="multipart/form-data">
                <div class="d-flex align-items-center gap-2">
                  <input type='hidden' name="id" value="<?php echo $idEnte ?>">
                  <label for="galleryPhoto" id="fileLabelGallery" class="btn btn-success mb-0">Escolher foto</label>
                  <input type="file" id="galleryPhoto" name="galleryPhoto" accept=".png, .jpg, .jpeg" class="custom-file-input" hidden />
                  <button type="submit" class="btn btn-primary">Salvar imagem</button>
                </div>
              </form>

              <script>
                // Seleciona os elementos
                const fileInputGallery = document.getElementById('galleryPhoto');
                const fileLabelGallery = document.getElementById('fileLabelGallery');

                // Adiciona um evento para detectar quando um arquivo for selecionado
                fileInputGallery.addEventListener('change', () => {
                  if (fileInputGallery.files.length > 0) {
                    // Adiciona a classe "btn-success" para deixar o botão verde
                    fileLabelGallery.classList.remove('btn-success');
                    fileLabelGallery.classList.add('btn-primary');
                  } else {
                    // Retorna ao estado original caso nenhum arquivo esteja selecionado
                    fileLabelGallery.classList.remove('btn-primary');
                    fileLabelGallery.classList.add('btn-success');
                  }
                });
              </script>

            </div>
          </div>
        </div><!-- End Info Item -->
      </div>
    </section>


    <section id="gallery" class="gallery">
      <div class="container-fluid">
        <div class="section-header">
          <h2>Mídias adicionadas</h2>
        </div>

        <div class="row gy-4 justify-content-center">
          <?php
          // Diretório da galeria
          $diretorio = "../assets/img/gallery/users/$logado/$idEnte";

          // Padrão de arquivos permitidos (imagens)
          $arquivos = glob($diretorio . "/*.{jpg,jpeg,png,gif}", GLOB_BRACE);

          // Verifica se existem imagens na pasta
          if (!empty($arquivos)) {
            foreach ($arquivos as $arquivo) {
              // Extrai o nome da imagem para título
              $nomeImagem = basename($arquivo);
              $tituloImagem = pathinfo($nomeImagem, PATHINFO_FILENAME);

              echo "
          <div class='col-xl-3 col-lg-4 col-md-6'>
              <div class='gallery-item h-100'>
                  <img src='$arquivo' class='img-fluid' alt='$tituloImagem'>
                  <div class='gallery-links d-flex align-items-center justify-content-center'>
                      <a href='$arquivo' title='$tituloImagem' class='glightbox preview-link'>
                          <i class='bi bi-arrows-angle-expand'></i>
                      </a>
                       <button class='btn p-0 border-0 bg-transparent' data-bs-toggle='modal' data-bs-target='#deleteModal' data-image='$nomeImagem'>
                          <i class='bi bi-trash text-danger fs-5'></i> <!-- Ícone da lixeira em vermelho -->
                      </button>
                  </div>
              </div>
          </div>
          ";
            }
          } else {
            echo "<p>Nenhuma imagem adicionada na galeria.</p>";
          }
          ?>
        </div>
      </div>
    </section>
    <!-- End Gallery Section -->
    <!-- Modal de Confirmação -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel"><font color="black">Atenção!</font></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
          <h6><font color="black">Tem certeza que deseja excluir esta imagem?</font></h6>
          </div>
          <div class="modal-footer">
            <form action="delete-gallery-image.php" method="post">
              <input type='hidden' name="idEnte" value="<?php echo $idEnte ?>">
              <input type="hidden" name="imageName" id="imageName">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-danger">Excluir</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      var deleteModal = document.getElementById('deleteModal');
      deleteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Botão que acionou a modal
        var imageName = button.getAttribute('data-image'); // Obtém o nome da imagem
        var inputImage = deleteModal.querySelector('#imageName'); // Campo hidden no form
        inputImage.value = imageName; // Define o valor no campo
      });
    </script>



  </main><!-- End #main -->

  <footer id="footer" class="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Loves Memory</span></strong>. All Rights Reserved
      </div>

    </div>
  </footer><!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

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