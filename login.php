<?php 

session_start();
  
  $servername = "localhost:3307";
  $username = "root";
  $passwordBD = "";
  $dbname = "pap_david";
  
 $conn = new mysqli($servername, $username, $passwordBD, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['btnRegistar'])){
	$nome = $_POST['nome'];
	$morada = $_POST['morada'];
	$pass = MD5($_POST['pass']);//encripta a pass
	$email = $_POST['email'];
	$cod_postal = $_POST['codigo_postal'];

	$sql2 = "INSERT into utilizador (nome, email, pass, morada, codigo_postal, id_tipo) 
	values ('". $nome ."','".$email."','" .$pass. "', '".$morada."','".$cod_postal."', 2);";
	
	$result2 = $conn->query($sql2);

	//echo "<script>alert('".$result2."'); </script>"; 

	if ($result2 == 1) {
	
		echo "<script>alert('Utilizador registado com sucesso!!!'); </script>"; 
	
	}else {
		echo "<script>alert('Utilizador Não registado . ERRO!!!'); </script>"; 
	}
}

if(isset($_POST['btnLogin'])){
	$emaill = $_POST['email_login'];
	$pwdl= MD5($_POST['pass_login']);
	
$sql = "SELECT * FROM utilizador where email='".$emaill."' and pass='".$pwdl."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
	echo "<script>alert('Utilizador encontrado'); </script>"; 
	
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  $_SESSION['email']= $row["email"];
	  $_SESSION['nome']= $row["nome"];
	  $_SESSION['id']= $row["id"]; 
  	
	echo '<script>window.location="index.php"</script>';
  }
}else {
	echo "<script>alert('Utilizador Não encontrado!!!'); </script>"; 
}
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
<html>
<head>
	<title>SilTech</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>


  </div>
	
        <body>
           
			<div class="main">  	
				<input type="checkbox" id="chk" aria-hidden="true">
		
					<div class="signup">
						<form method="POST">
							<label for="chk" aria-hidden="true">Registar-se</label>
							<input type="text" name="nome" placeholder="Nome de Utilizador" required="">
							<input type="email" name="email" placeholder="Email" required="">
							<input type="text" id="morada" name="morada" placeholder="Morada" required="">
							<input type="text" id="codigo_postal" name="codigo_postal" placeholder="Código Postal" required="">
							<input type="password" name="pass" placeholder="Senha" required="">
							<input type="submit" name="btnRegistar" value="Registar">
							<button><a href="index.php" style="text-decoration: none; color: #fff;">VOLTAR</a></button>
						</form>
					</div>
			<div class="login">
				<form method="POST">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email_login" placeholder="Email" required="">
					<input type="password" name="pass_login" placeholder="Password" required="">
					<input type="submit" name="btnLogin" value="Entrar">
					
				</form>
			</div>
	</div>
</body>
</html>