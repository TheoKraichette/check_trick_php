<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang='fr'>

<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Check trick</title>
    <style>
        * {

            font-family: 'Patrick Hand', cursive;
        }

        button {
            font-family: 'Permanent Marker', cursive;
            font-size: 22px;
        }
    </style>
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="bootstrap" viewBox="0 0 118 94">
            <title>Check trick</title>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
        </symbol>
    </svg>


    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap" />
                </svg>
                <span class="fs-4">Check trick</span>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item"><a href="index.php" class="nav-link text-dark" aria-current="page">Se connecter</a></li>
                <li class="nav-item"><a href="inscription.php" class="nav-link active bg-dark">Inscription</a></li>
            </ul>
        </header>
    </div>
    <main>
        <div class="container">
            <form class="col-6 m-auto" action='' method='post'>
                <h1 class="text-center">Inscription</h1>
                <div class="mb-3">
                    <label class="form-label">Prenom :</label>
                    <input type="text" class="form-control" name="first_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nom :</label>
                    <input type="text" class="form-control" name="last_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Pseudo :</label>
                    <input type="text" class="form-control" name="nickname" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email :</label>
                    <input type="email" class="form-control" name="login_user" value="<?php
                                                                                        if (isset($_POST['login_user'])) {
                                                                                            echo $_POST['login_user'];
                                                                                        }
                                                                                        ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mot de passe :</label>
                    <input type="password" class="form-control" name="mdp_user" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirmation mot de passe :</label>
                    <input type="password" class="form-control" name="mdp_user_confirmation" required>
                    <div class="form-text">Votre mot de passe doit contenir au moins une majuscule, un chiffre et un caractère spécial.</div>
                </div>
                <button type="submit" class="btn btn-dark m-2" name="insert">Créer</button>
            </form>
        </div>
    </main>

    <?php
    require_once('../classes/ConnexionPdo.class.php');
    require_once('../classes/Inscription.class.php');

    if (isset($_POST['insert'])) {
        if ($_POST['mdp_user'] !== $_POST['mdp_user_confirmation']) {
            echo '<p class="mt-3 text-center text-danger" >Les mots de passes ne correspondent pas </p>';
        } else if (!preg_match(
            "#^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$#",
            $_POST['mdp_user']
        )) {
            echo '<p class="mt-3 text-center text-danger">Votre mot de passe ne respecte pas les conditions</p>';
        } else {
            $con = new ConnexionPdo();
            $inscription = new Inscription();
            $conn = $con->getmyDB();
            $inscription->verifLogin($conn);
        }
    }

    ?>
</body>

</html>