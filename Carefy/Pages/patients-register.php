<?php
	require_once dirname(__FILE__) . "/../POJO/Patient.php";
	require_once dirname(__FILE__) . "/../DAO/PatientsDAO.php";
	require_once dirname(__FILE__) . "/../config/Database.php";

	$db = new Database();

	$patientsDao = new PatientsDAO($db);

    if (!empty($_POST)) {
      $patient = new Patient();
      $patient->setName($_POST["name"]);
      $patient->setHospital($_POST["hosp"]);
      $patient->setEnabled(true);
      $patientsDao->insert($patient);
      header('Location: patients-list.php');
    }
?>	

<!DOCTYPE html>
<html>
<head>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<title>Cadastro</title>
</head>
<body>

<div class="container">

	<nav class="navbar navbar-expand-sm bg-light navbar-light">
	 	<a class="navbar-brand" href="#"> <img style="max-width:100px; "
	      	src="http://carefy.com.br/public/landing/images/logos/auditoria-em-saude-logo.png" id="icon" alt="User Icon"/></a>
	    
		<ul class="navbar-nav">
		    <li class="nav-item">
		      <a class="nav-link" href="patients-list.php">Home</a>
		    </li>
		</ul>
	</nav>
 
	<div class="card">
		<div class="card-header">
			<h1  class="card-title" style="margin-left: 10px" >Cadastro de Paciente</h1>
		</div>
	  	<div class="card-body">
			<form action="patients-register.php" method="post" class="needs-validation" novalidate>
			  <div class="form-group">
			    <label for="name">Nome:</label>
			    <input type="text" class="form-control" placeholder="Insira o nome" id="name" name="name" required>
			    <div class="invalid-feedback">Por favor, preencha esse campo.</div>
			  </div>
			  <div class="form-group">
			    <label for="hosp">Hospital:</label>
			    <input type="hospital" class="form-control" placeholder="Insira o hospital" id="hosp" name="hosp" required>
			    <div class="invalid-feedback">Por favor, preencha esse campo.</div>
			  </div>
				<div class="form-group">
			  		<button type="submit" class="btn btn-primary" >Cadastrar</button>
			 		<button type="button" class="btn btn-danger" onclick="window.location.href='patients-list.php'" style="margin-left: 10px;">Cancelar</button>
			   </div>
			</form>
		</div>
	</div>




</body>
</html>

<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();

        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
