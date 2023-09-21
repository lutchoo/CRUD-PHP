<?php 
require_once 'partial/header.php' ;
require_once 'partial/nav.php';
require_once 'function.php';

if(isset($_POST) && !empty($_POST)){
    $email = $_POST["email"];
    $password = $_POST["password"];
    logIn($email,$password);

}
?>

<main class='container'>

<h1 class="text-center">CONNECTION</h1>
<form action="login.php" method ="POST">
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input style='background-color: #adabb2 !important;' type="email" class="form-control" id="email" placeholder="name@example.com" name='email'>
    </div>
    <div>
        <label for="Password" class="form-label">Password</label>
        <input style='background-color: #adabb2 !important;' type="password" id="Password" class="form-control" aria-describedby="passwordHelpBlock" name='password'>
    </div>
    <button type="submit" class=" btn mb-3">Confirm</button>
</form>

<?php require_once 'partial/footer.php' ?>