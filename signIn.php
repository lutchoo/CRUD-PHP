<?php
require_once 'partial/header.php' ;
require_once 'partial/nav.php';
require_once 'function.php';
//var_dump($_POST);
if(isset($_POST)&& !empty($_POST)){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    signIn($name,$email,$password);
}
?>

<main class='container'>
<form action="signIn.php" method ="POST">
    <div>
        <label for="exampleFormControlInput1" class="form-label">Name</label>
        <input class="form-control" type="text"  aria-label="Disabled input example" name='name'>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" placeholder="name@example.com" name='email'>
    </div>
    <div>
        <label for="Password" class="form-label">Password</label>
        <input type="password" id="Password" class="form-control" aria-describedby="passwordHelpBlock" name='password'>
    </div>
    <button type="submit" class="btn btn-primary mb-3">Confirm </button>
</form>
</main>

<?php require_once 'partial/footer.php' ?>


