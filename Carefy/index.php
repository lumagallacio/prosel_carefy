<?php
    require_once dirname(__FILE__) . "/POJO/User.php";
    require_once dirname(__FILE__) . "/DAO/USersDAO.php";
    require_once dirname(__FILE__) . "/config/Database.php";

    $db = new Database();
    $usersDao = new UsersDAO($db);

    $name = $pass = "";
 
    if (!empty($_POST)) {
      $email = $_POST["email"];
      $pass = $_POST["password"];
      if($usersDao->loginExist($email, $pass)==true){
        header('Location: pages/patients-list.php');
      }
    }
?>  

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/indexcss.css">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<title>Lista de Pacientes</title>
</head>
<body>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="http://carefy.com.br/public/landing/images/logos/auditoria-em-saude-logo.png" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <input type="text" id="email" class="fadeIn second" name="email" placeholder="e-mail">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>


</body>
</html>