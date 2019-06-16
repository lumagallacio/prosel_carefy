<?php
	require_once dirname(__FILE__) . "/../POJO/Patient.php";
	require_once dirname(__FILE__) . "/../DAO/PatientsDAO.php";
	require_once dirname(__FILE__) . "/../config/Database.php";

	$db = new Database();
	$patientsDao = new PatientsDAO($db);
	$patients = $patientsDao->selectAll();
?>	

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


	<!-- JQUERY -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	<!-- Bootstrap 4  -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<title>Lista de Pacientes</title>
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
			<h1  class="card-title" style="margin-left: 10px" >Listagem de Pacientes</h1>
		</div>
	  	<div class="card-body">
	  		<div class="row">
	  			<div class="col-sm-4">
					<div class="form-group form-inline" style="">
				    <label class="mr-sm-2">Busca: </label>
				    <input type="text" class="form-control" id="busca">
			 		</div>
	  			</div>
			  	<div class="col-sm-8" style="">
				  <div class="form-group" style="text-align:right;">
				    <button type="button" class="btn btn-primary" style="position: relative; justify-content: center;" 
				    onclick="window.location = 'patients-register.php';">
				    Cadastrar Paciente</button>
				  </div>
			  	</div>
		    </div>	
			  <table class="table table-bordered table-hover table-striped" id="table">
			  	<thead>
				  <tr>
				    <th>Nome</th> 
				    <th>Hospital</th>
				    <th></th>
				  </tr>
			  	</thead>
			  	<tbody>
				<?php
					if (!empty($patients)) {
						foreach ($patients as $key => $patient) {
							if ($patient->getEnabled()==2) {
								continue;
							}
				?>
					  	<tr>
						    <td><?=$patient->getName();?></td>
						    <td><?=$patient->getHospital();?></td>
						    <td align="center"> 
						    	<button onclick="openModal(<?=$patient->getId()?>)" class="btn btn-danger"><i class="fa fa-trash" style="color: white;"></i></button>
						</tr>	
				<?php
						}
					}
				?>
				<tbody>
			<table/>
		</div>
	</div>

<!-- The Modal -->
<div class="modal" id="modalDelete">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Remover Paciente</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Ter certeza que deseja remover este paciente?
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="delete">Confirmar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>

    </div>
  </div>
</div>


</body>
</html>

<script>
$(document).ready(function(){
	jQuery.noConflict();
    $("#busca").on("keyup", function() {
	var value = $(this).val().toLowerCase();
		$("#table tbody tr").filter(function() {
  			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
		});
});

var idPatient;
function openModal(id) {
	idPatient = id;	
	$("#modalDelete").modal('show');
	};

$("#delete").click(function(){
	  $.post("delete-patient.php",
	  {
	    id: idPatient,
	  },
	  function(data, status){
	     console.log("Data: " + data + "\nStatus: " + status);
	     location.reload();
	  });
  });
</script>