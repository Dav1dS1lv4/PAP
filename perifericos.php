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
                           <li><a href="index.php">Inicio</a></li>
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

                  </div>
                  
                  <div class="header_box">
                     <div class="lang_box ">
                        <a href="#" title="Language" class="nav-link" data-toggle="dropdown" aria-expanded="true">
                        <img src="images/flag-uk.png" alt="flag" class="mr-2 " title="United Kingdom"> English <i class="fa fa-angle-down ml-2" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu ">
                           <a href="#" class="dropdown-item">
                           <img src="images/flag-france.png" class="mr-2" alt="flag">
                           French
                           </a>
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
               <div id="my_slider" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                     <div class="carousel-item active">
                        <div class="row">
                           <div class="col-sm-12">
                              <h1 class="banner_taital">Melhores <br>Periféricos!</h1>
                              <div class="buynow_bt"><a href="index.php">Principal</a></div>
                           </div>
                        </div>
                     </div>
                     <div class="carousel-item">
                        <div class="row">
                           <div class="col-sm-12">
                              <h1 class="banner_taital">Melhores <br>Preços!</h1>
                              <div class="buynow_bt"><a href="index.php">Principal</a></div>
                           </div>
                        </div>
                     </div>
                     <div class="carousel-item">
                        <div class="row">
                           <div class="col-sm-12">
                              <h1 class="banner_taital">Ofertas <br>Sempres!</h1>
                              <div class="buynow_bt"><a href="index.php">Principal</a></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
                  <i class="fa fa-angle-left"></i>
                  </a>
                  <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
                  <i class="fa fa-angle-right"></i>
                  </a>
               </div>
            </div>
         </div>
         <!-- banner section end -->
      </div>
      <!-- banner bg main end -->
      <!-- fashion section start -->
      <div class="fashion_section">
                  <div class="container">
                     <h1 class="fashion_taital">Periféricos</h1>
                     <div class="fashion_section_2">
                     <div class="row">
                     <?php 
                           $servername = "localhost:3307";
                           $username = "root";
                           $passwordBD = "";
                           $dbname = "pap_david";
                           
                           $conn = new mysqli($servername, $username, $passwordBD, $dbname);
                           // Check connection
                           if ($conn->connect_error) {
                           die("Connection failed: " . $conn->connect_error);
                           }
                              $sql = "SELECT * FROM produto where id_tipo=1 ";
                              $result = $conn->query($sql);
                            
                              // output data of each row
                              while($row = $result->fetch_assoc()) {
                                 $id= $row['id_produto'];
                     ?>

                     <!-- Produto-->
                        <div class="col-lg-4 col-sm-4">
                           <a href="<?php echo $row['pagina']; ?>"> 
                              <div class="box_main">
                                 <h4 class="shirt_text"><?php echo $row['nome']; ?>  </h4>
                                 <p class="price_text">Preço  <span style="color: #262626;"><?php echo $row['preco']; ?>€</span></p>
                                 <div class="tshirt_img">
                                    <img src="images/Perifericos/<?php echo $row['img']; ?>" width="300" height="531.92" class="cart-product-image"></img>
                                    </div>
                              </a>
                                 <div class="btn_main">
                                    <button onclick="location.href='index.php?id_prod=<?php echo $row['id_produto'];?>'" class="add-to-cart-btn" type="button"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                 </div>
                              </div>
                              
                        </div>
                        <?php 
                        }
                        ?>
                        <!-- Fim produto-->           
                        </div>
                        </div>
                     </div>
      <!-- fashion section end -->
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