<?php 

session_start();
  
  $servername = "localhost:3307";
  $username = "root";
  $passwordBD = "";
  $dbname = "pap";
  
 $conn = new mysqli($servername, $username, $passwordBD, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


//HN Carrinho 

$status="";
//if (isset($_POST['id_produto']) && $_POST['id_produto']!=""){
//if(isset($_POST['comprar'])){
	if(isset($_GET['id_prod'])){
	$code = $_GET['id_prod'];
	//echo '<script> alert("'.$code.'"); </script>'; 
	$result = mysqli_query($conn, "SELECT * FROM produto WHERE id_produto=$code");
	$row = mysqli_fetch_assoc($result);
	$nome = $row['nome'];
	$id_produto = $row['id_produto'];
	$preco = $row['preco'];
	$image = $row['img'];
	
	$cartArray = array(
		$id_produto=>array(
		'nome'=>$nome,
		'preco'=>$preco,
		'id_produto'=>$id_produto, 
		'quantity'=>1,
		'img'=>$image)
	);
	
	if(empty($_SESSION["shopping_cart"])) {
		$_SESSION["shopping_cart"] = $cartArray;
		echo '<script> alert("O Produto foi adicionado ao carrinho!") </SCRIPT>';
	}else{
		$array_keys = array_keys($_SESSION["shopping_cart"]);
		if(in_array($code,$array_keys)) {
			echo '<script> alert("O Produto foi adicionado ao carrinho!") </SCRIPT>';
		} else {
		$_SESSION["shopping_cart"] = array_merge(
		$_SESSION["shopping_cart"],
		$cartArray
		);
			echo '<script> alert("O Produto foi adicionado ao carrinho!") </SCRIPT>';
		}
		}
	}

//HN Fim Carrinho 


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>SilTech</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
      <!-- font awesome -->
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <!--  -->
      <!-- owl stylesheets -->
      <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesoeet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   </head>
   <body>
      <!-- banner bg main start -->
      <div class="banner_bg_main">
         <!-- header top section start -->
         <div class="container">
            <div class="header_section_top">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="custom_menu">
                        <ul>
                           <li><a href="index.php">Principal</a></li>
                           <li><a href="pecas.php">Peças</a></li>
                           <li><a href="perifericos.php">Periféricos</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- header top section start -->
         <!-- logo section start -->
         <div class="logo_section">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="logo"><a href="index.php"><img src="images/logoreal.png"></a></div>
                  </div>
               </div>
            </div>
         </div>
         <!-- logo section end -->
         <!-- header section start -->
         <div class="header_section">
            <div class="container">
               <div class="containt_main">
                  <div id="mySidenav" class="sidenav">
                     <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                     <a href="index.php">Inicio</a>
                     <a href="pecas.php">Peças</a>
                     <a href="perifericos.php">Periféricos</a>
                  </div>
                  <span class="toggle_icon" onclick="openNav()"><img src="images/toggle-icon.png"></span>
                  <div class="dropdown">

                     </button>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        
                     </div>
                  </div>
                  
                  <div class="header_box">
                     <div class="lang_box ">
                        <a href="#" title="Language" class="nav-link" data-toggle="dropdown" aria-expanded="true">
                        <img src="images/flag-uk.png" alt="flag" class="mr-2 " title="United Kingdom"> English <i class="fa fa-angle-down ml-2" aria-hidden="true"></i></a>
                        <div class="dropdown-menu ">
                           <a href="#" class="dropdown-item"><img src="images/flag-france.png" class="mr-2" alt="flag">French</a>
                        </div>
                     </div>

                     <div class="login_menu">
                        <ul>
                           <li><a href="#">
                              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                              <span class="padding_10">Cart</span></a>
                           </li>
                           <li><a href="#">
                              <i class="fa fa-user" aria-hidden="true"></i>
                              <span class="padding_10">Login</span></a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- header section end -->
         <!-- banner section start -->
         <div class="banner_section layout_padding">
            <div class="container">
               
               <div class="buynow_bt"><a href="perifericos.php">Periféricos</a></div>  

               </div>
            </div>
         </div>
         <!-- banner section end -->
      </div>
      <!-- banner bg main end -->
      <!-- fashion section start -->
      <div class="fashion_section">
         <div id="main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container">
                        <div class="box_kraken">
                        <div class="row">
                           <div class="col-md-4">
                                 <h4 class="shirt_text">Deathadder V2</h4>
                                 <p class="price_text">Price  <span style="color: #262626;">€60,00</span></p>
                                 <div class="tshirt_img_solo"><img src="images/Perifericos/deatheadderelite.png" width="360" height="531.92">
                                 </div>
                           </div>
                           <div style="padding-top: 50px" class="col-md-8">
                              <div class="text-center">
                                  <h2 class="section-heading text-uppercase">Sobre</h2>
                                  <h3 style="color:black; text-align:left; font-size: 16px;"><b>Rato Gaming RAZER Deathadder V2 (20000 dpi - Preto)</b><br>
                                    <b> ERGONOMIA SEM IGUAL:</b>O Razer DeathAdder V2, um rato ergonómico projetado com curvas mortais e linhas agressivas, uma arma que se manuseia como nenhuma outra. Com sensor e switches de última geração dentro de um formato mais leve, ele dá forma a uma nova era alto desempenho nos jogos. O Razer DeathAdder V2 dá continuidade ao seu legado, mantendo o seu formato característico, mas, ao mesmo tempo, perdendo peso, para um manuseio mais rápido que melhora o seu jogo. Indo além da ergonomia convencional de escritório, o design otimizado também oferece um maior conforto durante o jogo, importante para longas raids ou para quando está a subir no ranking, divisão por divisão.
                                     <br>
                                    <b> SWITCH ÓPTICO DE MOUSE RAZER:</b>
                                     Com um feixe de luz infravermelha para registar cada clique, os switches deste rato ergonómico fazem o acionamento com um tempo de resposta líder do setor: apenas 0,2 milésimos de segundo. Como ele não exige mais o contato físico tradicional, esta forma de acionamento elimina a necessidade de deslocamento e nunca dispara cliques não intencionais, dando um controle mais exato e uma execução sem falhas.
 <br>
                                     <b>ENSOR ÓPTICO RAZER FOCUS:</b>Novo e melhorado sensor conta com uma definição de 20 mil DPI líder do setor, com 99,6% de precisão de resolução para assegurar que mesmo o movimento mais delicado seja rastreado com consistência. Equipado com funções inteligentes, o sensor se torna ainda mais exato, permitindo um alto nível de precisão para tiros vitoriosos.
 <br>
                                     <b>CABO RAZER SPEEDFLEX:</b>O cabo do Razer DeathAdder V2 conta com uma maior flexibilidade e foi projetado para produzir um arrasto mínimo, para que possa realizar movimentos mais rápidos e mais fluidos com um maior grau de controlo.
                              </div>
                              </div>

                              <div class="row text-center">
                                  <div class="col-md-4">
                                    
                                    <h4 class="my-3">Referências</h4>
                                    <p style="color:black;" >Referência | 7117500 <br>
                                     EAN | 8886419332855 <br>
                                     Marca | RAZER <br>
                                     Modelo | Deathadder V2</p>
                                       
                                  </div>
                                  <div class="col-md-4">
                                      
                                      <h4 class="my-3">Características Específicas</h4>
                                      <p style="color:black">Tecnologia do Rato | Ótico <br>
                                       Rato Ergonómico | Sim <br>
                                       DPI | 20000 <br>
                                       Wireless | Não <br>
                                      Alcance| 2.1m <br>
                                    </p>
                                    
                                    </p>                                    <p style="color:black;" >

                                    </p>
                                  </div>
                                  <div class="col-md-4">
                                      
                                    <h4 class="my-3">Mais Informações</h4>
                                    <p style="color:black">Resolução ajustável | Sim <br>
                                     Função Ambidestra | Não <br>
                                     Botões Programaveis | 8 <br>
                                     Led | Sim
                                  </div>     
                              
                          </div>
                             
                                 
                              </div>
                      </div>
                 </div>
               </div>
          </div>
      </div>
   </div>
      <!-- jewellery  section end -->
      <!-- footer section start -->
      <div class="footer_section layout_padding">
         <div class="container">
            <div class="footer_logo"><a href="index.php"><img src="images/logoreal.png"></a></div>
            
            <div class="footer_menu">
               <ul>
                  <li><a href="index.php">Inicio</a></li>
                           <li><a href="pecas.php">Peças</a></li>
                           <li><a href="perifericos.php">Periféricos</a></li>
               </ul>
            </div>
            <div class="location_main">Help Line  Number : <a href="#">+351 932 150 473 <br>
               <a href="https://www.instagram.com/daviid_rsilva/" target="_blank">
                  <img src="images/icons/instagram.png" height="50px" width="50px">
                  <a href="https://www.linkedin.com/in/david-silva-170621235/" target="_blank">
                     <img src="images/icons/linkedin-logo.png" height="50px" width="50px">

            </a></div>
            
           
          
         </div>
      </div>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text">© 2020 All Rights Reserved. Design by <a href="https://html.design">Free html  Templates</a></p>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <script>
         function openNav() {
           document.getElementById("mySidenav").style.width = "250px";
         }
         
         function closeNav() {
           document.getElementById("mySidenav").style.width = "0";
         }
      </script>
   </body>
</html>