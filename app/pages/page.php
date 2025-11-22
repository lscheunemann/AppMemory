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
</head>

<?php
$id = $_GET['id'];
$idEnte = $id;

require("../../inc/connect.inc");

$conn = connect_db() or die("Não é possível conectar-se ao servidor.");

$sql = "Select * from tb_entes where id_ente = '$id'";
$resultado = mysqli_query($conn, $sql);	
while ($linha = mysqli_fetch_array($resultado)) {			
  $nomeEnte 	= $linha["nome_ente"];
  $epitafio 	= $linha["epitafio"];
  $dtNascimento 	= $linha["dt_nascimento_ente"];
  $dtFalecimento 	= $linha["dt_falecimento_ente"];
  $nomeMae 	= $linha["nome_mae_ente"];
  $nomePai 	= $linha["nome_pai_ente"];
  $conjuge 	= $linha["casado_com"];
  $confissao 	= $linha["confissao_ente"];
  $biografia 	= $linha["biografia"];
}


$repoPhotoProfile = "../../assets/img/gallery/profile/$idEnte/";

// Busca todos os arquivos de imagem no diretório do usuário
$filesProfile = glob($repoPhotoProfile . '*.{png,jpg,jpeg}', GLOB_BRACE);

// Verifica se há arquivos na pasta
if (!empty($filesProfile)) {
  // Ordena os arquivos pelo tempo de modificação (mais recente primeiro)
  usort($filesProfile, function ($a, $b) {
    return filemtime($b) - filemtime($a); // Ordena do mais recente para o mais antigo
  });

  // Pega o arquivo mais recente
  $mediaProfile = $filesProfile[0];
  $nameFile = basename($mediaProfile);
  $pathFile = $repoPhotoProfile . $nameFile;
} else {
  // Caminho padrão caso nenhum arquivo seja encontrado
  $mediaProfile = '../../assets/img/gallery/icon/empty.png';
  $pathFile = "../../assets/img/gallery/icon/empty.png";
}
?>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center  me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <i class="bi bi-camera"></i>
        <h1>Loves Memory</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="about.html" class="active">About</a></li>
          <li class="dropdown"><a href="#"><span>Gallery</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="gallery.html">Nature</a></li>
              <li><a href="gallery.html">People</a></li>
              <li><a href="gallery.html">Architecture</a></li>
              <li><a href="gallery.html">Animals</a></li>
              <li><a href="gallery.html">Sports</a></li>
              <li><a href="gallery.html">Travel</a></li>
              <li class="dropdown"><a href="#"><span>Sub Menu</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="#">Sub Menu 1</a></li>
                  <li><a href="#">Sub Menu 2</a></li>
                  <li><a href="#">Sub Menu 3</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="services.html">Services</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
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
            <h2><?php echo($nomeEnte) ?></h2>
            <p><?php echo nl2br($epitafio) ?></p>

            <!--        <a class="cta-btn" href="contact.html">Available for hire</a>-->

          </div>
        </div>
      </div>
    </div><!-- End Page Header -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row gy-4 justify-content-center">
          <div class="col-lg-4">
            <img src="<?php echo $mediaProfile; ?>" class="img-fluid" alt="">
          </div>
          <div class="col-lg-5 content">
            <h2>Informações</h2>
            <div class="row">
              <div class="col-lg-10">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>Data de nascimento:</strong> <span><?php echo($dtNascimento) ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Data de falecimento:</strong> <span><?php echo($dtFalecimento) ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Nome da mãe:</strong> <span><?php echo($nomeMae) ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Nome do pai:</strong> <span><?php echo($nomePai) ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Casado com:</strong> <span><?php echo($conjuge) ?></span></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Confissão religiosa:</strong> <span><?php echo($confissao) ?></span></li>
                </ul>
              </div>
            </div>
            <br>
            <h2>Biografia</h2>
            <p class="py-3">
              <?php echo nl2br($biografia) ?>
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container">

        <div class="section-header">
          <h2>Depoimentos</h2>
        </div>

        <div class="slides-3 swiper">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                </p>
                <div class="profile mt-auto">
                  <h3>João da Silva</h3>
                  <h4>Cunhado</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                </p>
                <div class="profile mt-auto">
                  <h3>Maria de Albuquerque</h3>
                  <h4>Filha</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                </p>
                <div class="profile mt-auto">
                  <h3>Carlos Moreno</h3>
                  <h4>Amigo</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                </p>
                <div class="profile mt-auto">
                  <h3>Matheus Oliveira</h3>
                  <h4>Amigo</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                </p>
                <div class="profile mt-auto">
                  <h3>Ana Paula</h3>
                  <h4>Irmã</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <section id="gallery" class="gallery">
      <div class="container-fluid">
        <div class="section-header">
          <h2>Mídias adicionadas</h2>
        </div>

        <div class="row gy-4 justify-content-center">
          <?php
          // Diretório da galeria
          $diretorio = "../../assets/img/gallery/users/$idEnte";

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
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="container">

      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/ -->

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