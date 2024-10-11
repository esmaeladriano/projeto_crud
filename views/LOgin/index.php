<?php 
if(isset($_GET['error'])){
	$erro = 'abc';
	$mostra = 'd-block';
}
else{
	$mostra = 'd-none';
}
$nome_pagina ='Login';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<link rel="stylesheet" href="./login.css">

 <?php
include_once ('../header.php');
?>
<style>
  
body {
    font-weight: bold;
    background-color: #f5f5f5;
}
.login-box {
    background-color: #fff;
    padding: 5px;
    border-radius: 2px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}
fieldset{
background-color: white;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
border-radius: 10px;
width: 400px;
height: 270px;
}
a{
color: white;
text-decoration: none;
}
.invalid-feedback {
  width: 100%;
  margin-top: 0.25rem;
  font-size: 0.875em;
  color: #dc3545;
}
.abc{
	color: #dc3545;
}
</style>
</head>
<body>

 <!-- Aqui vem o meu menu, o cabeçalho -->

  <!-- Aqui vem o carroussel preincipla -->
  <div class="p-3"></div>
<div class="container">
<div class="row justify-content-center row-cols-1">
<div class="col"> <h1 style="text-align: center; margin-top: 100px;">Benvindo(a) ao IMPAR</h1>
</div>
<div class=" col col-12 mt-2">
<fieldset class="align-items-center container w-50">
<h1 class="text-center mt-3">Log in</h1>


<form action="login.php" method="post">
<div class="col mx-3">
<div class="input-group mt-3" id="linha-usuario">
<label for="codigo" class="input-group-text"><img src="../Imagem/icone-login.png" width="20px" height="20px" alt=""></label>
<input type="text" class="form-control" id="codigo" name="codigo" required placeholder="Seu código de acesso">
</div>
</div>
<div class="col mx-3">
<div class="input-group mt-3" id="linha-senha">
    <label for="senha" class="input-group-text"><img src="../Imagem/key.png" width="20px" height="20px" alt=""></label>
    <input type="text" class="form-control" id="senha" name="senha"  required placeholder="Sua senha">
</div>
</div>
<span class="offset-4 <?php echo $mostra;?> <?php echo $erro;?>">Verifica o código ou a senha</span> 
<button type="submit" class="btn btn-primary offset-5 mt-2" name="submit">Entrar</button>
<br>

<a href="#" class="link-dark offset-5">Esqueci a senha</a>

</form>
</fieldset>
</div>
</div>
</div>
</div>
<!-- <div class="container">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="box">
			<div class="div-title-box">
				<span class="title-box-main d-flex justify-content-center">Falha ao acessar página solicitada</span>
			</div>
			<div class="container py-2">
				<div class="msg msg-warn w-100">
					Erro de permissão: Você não tem permissão para acessar esta página.
				</div>
				 <a class="btn btn-sm btn-warn" href="http://localhost/sistema/painel/inicio"> 
					Voltar ao inicio
				</a>
			</div>
		</div>
	</div>
</div> -->
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {

// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.querySelectorAll('.needs-validation')

// Loop over them and prevent submission
Array.prototype.slice.call(forms)
.forEach(function (form) {
form.addEventListener('submit', function (event) {
if (!form.checkValidity()) {
event.preventDefault()
event.stopPropagation()
}

form.classList.add('was-validated')
}, false)
})
})()
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"     crossorigin="anonymous"></script> 
</body>
</html>