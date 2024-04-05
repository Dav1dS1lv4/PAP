<?php
session_start();

$status = "";
if (isset($_POST['remove'])) {
  if (!empty($_SESSION["shopping_cart"])) {
    foreach ($_SESSION["shopping_cart"] as $key => $value) {
      if ($_POST["id_produto"] == $value["id_produto"]) {
        unset($_SESSION["shopping_cart"][$key]);
        $status = "<div class='box' style='color:red;'>Produto foi removido do teu carrinho!</div>";
      }
      if (empty($_SESSION["shopping_cart"])) {
        unset($_SESSION["shopping_cart"]);
      }
    }
  }
}

$servername = "localhost:3307";
$username = "root";
$passwordBD = "";
$dbname = "pap_david";

$conn = new mysqli($servername, $username, $passwordBD, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['encomendar'])) {
  if (isset($_SESSION['id'])) {
    $total = $_POST["total"];
    $sql = "INSERT INTO compras (Dataa, Total, id_ut) VALUES ('" . date("d-m-Y") . "'," . $total . ", '" . $_SESSION['id'] . "');";

    if (mysqli_query($conn, $sql) == true) {
      $sql2 = "SELECT MAX(id_compra) as id_compra FROM compras ";
      $result = $conn->query($sql2);

      // output data of each row
      while ($row = $result->fetch_assoc()) {
        $id = $row['id_compra'];

        foreach ($_SESSION["shopping_cart"] as $produto) {
          $sql3 = "INSERT INTO linhas_compra (id_compra, id_produto, quantidade) VALUES (" . $id . ", " . $produto["id_produto"] . ", 1);";
          if (mysqli_query($conn, $sql3) == true) {
            unset($_SESSION["shopping_cart"]);
			echo "<script>alert('Compra efetuada com sucesso!!!'); </script>";
            echo '<script>window.location="index.php"</script>';
          }
        }
      }
    }
  } else  {
    echo "<script>alert('Faça primeiro o login');</script>";
  }
}
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
   <script src="cart.js"></script>

   <style>

.cart_div {
	float:right;
	font-weight:bold;
	position:relative;
	}
.cart_div a {
	color:#000;
	}	
.cart_div span {
	font-size: 12px;
	line-height: 14px;
	background: #F68B1E;
	padding: 2px;
	border: 2px solid #fff;
	border-radius: 50%;
	position: absolute;
	top: -1px;
	left: 13px;
	color: #fff;
	width: 20px;
	height: 20px;
	text-align: center;
	}
.cart .remove {
	background: none;
	border: none;
	color: #0067ab;
	cursor: pointer;
	padding: 0px;
	}
.cart .remove:hover {
	text-decoration:underline;
	}
</style>

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
                     <a href="perifericos.php">Periféricos</a>
                     <a href="pecas.php">Peças</a>
                  </div>
                  <span class="toggle_icon" onclick="openNav()"><img src="images/toggle-icon.png"></span>
                  
                  <div class="main">
                     <!-- Another variation with a button -->
                     <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search this blog">
                        <div class="input-group-append">
                           <button class="btn btn-secondary" type="button" style="background-color: #2f2f2f; border-color:#2f2f2f ">
                           <i class="fa fa-search"></i>
                           </button>
                        </div>
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
                          	<!-- Cart -->
								<div class="dropdown">
								<?php
									if(!empty($_SESSION["shopping_cart"])) {
									$cart_count = count(array_keys($_SESSION["shopping_cart"]));
									?>
									<div class="cart_div">
									<li><a href="carrinho.php"><img width="40px" heigth="40px" src="images/cart.png" alt=""></li><span style="margin-top: 30px">
									<?php echo $cart_count; ?></span></a>
									</div>
									<?php
									}
									else{
										echo '<li><a href="carrinho.php"><img width="50px" heigth="50px" src="image/cart.png"/></li>'; 
									}
									?>
								</div>
								<!-- /Cart -->
                        <?php 
                        if(isset($_SESSION['id'])){
                           echo '<li><a href="logout.php">
                           <i class="fa fa-user" aria-hidden="true"></i>
                           <span class="padding_10">Logout</span></a>
                        </li>'; 
                        }else{
                        ?>
                           <li><a href="login.php">
                              <i class="fa fa-user" aria-hidden="true"></i>
                              <span class="padding_10">Login</span></a>
                           </li>
                           <?php }?>
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
                              <h1 class="banner_taital">Comece <br>Sua Melhor Compra!</h1>
                               
                           </div>
                        </div>
                     </div>
                     <div class="carousel-item">
                        <div class="row">
                           <div class="col-sm-12">
                              <h1 class="banner_taital">Melhores <br>Preços!</h1>
                              
                           </div>
                        </div>
                     </div>
                     <div class="carousel-item">
                        <div class="row">
                           <div class="col-sm-12">
                              <h1 class="banner_taital">Últimos <br> Lançamentos!</h1>
                              
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



   <!-- SECTION -->
		<div STYLE="MARGIN-BOTTOM: 20PX; " class="section">
			<!-- container -->
			<div class="container">
			<div class="row">
					<!-- Order Details -->
					<div class="col-md-12 order-details">
						<div class="section-title text-center">
							<h3 class="title">Seu Pedido</h3>
						</div>
                        <?php
                        if(isset($_SESSION["shopping_cart"])){
                            $total_compra = 0;
                        ?>
						<table width="100%" class="order-summary">
							<tr class="order-col">
								<td style="display:none; "><strong>ID PRODUTO</strong></td>
								<td><strong>PRODUTO</strong></td>
                                <td><strong>PREÇO</strong></td>
								<td><strong>REMOVER PRODUTO</strong></td>
                             </tr>
							<tr class="order-products">
                    <form method="POST">
                    <?php
foreach ($_SESSION["shopping_cart"] as $produto) {
   echo '<tr>';
   echo '<td style="display:none;"><input type="text" name="id_produto" readonly value="' . $produto["id_produto"] . '"></td>';
   echo '<td>';
   echo '<h4 class="product-name">' . $produto['nome'] . '</h4>';

   // Verificar o caminho da pasta da imagem
   $caminho_imagem = '';

   if (file_exists('images/Perifericos/' . $produto['img'])) {
      $caminho_imagem = 'images/Perifericos/';
   } elseif (file_exists('images/Pecas/' . $produto['img'])) {
      $caminho_imagem = 'images/Pecas/';
   }

   // Exibir a imagem
   if (!empty($caminho_imagem)) {
      echo '<img src="' . $caminho_imagem . $produto['img'] . '" alt="Imagem do Produto" width="80" height="80">';
   } else {
      echo 'Imagem não encontrada';
   }

   echo '</td>';
   echo '<td>Preço: ' . $produto['preco'] . '€</td>';
   echo '<td><button type="submit" name="remove" class="remove">Remover</button></td>';
   echo '</tr>';

   $total_compra += $produto["preco"];
}
?>



<style>
    .product-name {
        padding-bottom: 10px;
    }
</style>

                    <tr class="order-col">
                        <td align="rigth" style="margin-rigth: 20px; font-size:18px; color: black;"><strong>TOTAL</strong></td>
                        <td ><input type='hidden' name='total' value="<?php echo $total_compra; ?>" /></td>
                        <td style="font-size:18px; color: black;"><strong class="order-total"><?php echo $total_compra?>€</strong></td>
                    </tr>
                    <tr class="order-col">
                        <td style="font-size:22px;" align="center" colspan="2">
                        <button type='submit' name="encomendar" class='encomendar' style='background-color: black; color: #ffffff; font-size: 16px; border-radius:10px; padding: 10px 20px;  '><b>Encomendar</b></button>
                        </td>        
                        </tr>
                    </div>
					</form>
               
					<!-- /Order Details -->
                    <?php
                        }else{
                            echo "<div style='margin-bottom: 50px;'><h3>Seu carrinho está vazio!</h3></div> ";
                            }
                        ?>

				</div>
                      
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
   
   </body>
   
</html>