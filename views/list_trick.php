<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['auth']) && $_SESSION['role'] !== "admin") {
    header('Location: ./index.php');
}
ob_start();

?>
<!DOCTYPE html>
<html lang='fr'>

<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" integrity="sha384-ejwKkLla8gPP8t2u0eQyL0Q/4ItcnyveF505U0NIobD/SMsNyXrLti6CWaD0L52l" crossorigin="anonymous">
    <title>Check Trick</title>
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="bootstrap" viewBox="0 0 118 94">
            <title>Check trick</title>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
        </symbol>
    </svg>
    <h1 class="visually-hidden">Headers examples</h1>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="home" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap" />
                </svg>
                <span class="fs-4">Check Trick</span>
            </a>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <form action="" method='post'>
                        <button type="submit" class="nav-link active bg-dark" name="deco">Déconnexion</button>
                    </form>
                </li>
            </ul>
        </header>
        <main>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Beginner tricks
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name trick</th>
                                        <th scope="col">Stars</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col">Partially completed</th>
                                        <th scope="col">Completed</th>
                                    </tr>
                                </thead>
                                <tbody id="list_trick_begginer">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Intermediaire tricks
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name trick</th>
                                        <th scope="col">Stars</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col">Partiellement completé</th>
                                        <th scope="col">Completé</th>
                                    </tr>
                                </thead>
                                <tbody id="list_trick_intermediate">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Confirmed tricks
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name trick</th>
                                        <th scope="col">Stars</th>
                                        <th scope="col">Actions</th>
                                        <th scope="col">Partiellement completé</th>
                                        <th scope="col">Completé</th>
                                    </tr>
                                </thead>
                                <tbody id="list_trick_confirmed">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title mx-auto">Add trick by stance</h4>
                            <button type="button" class="close" data-dismiss="modal"><i class="bi bi-x"></i></button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body px-4">
                            <form action="" method="POST" id="edit-form-data">
                                <input type="hidden" name="trick_id" id="trick_id">
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="normal">Normal</label>
                                    <input class="form-check-input" type="checkbox" name="stance[]" id="normal" value="normal">
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="stance[]" id="fakie" value="fakie">
                                    <label class="form-check-label" for="fakie">Fakie</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="stance[]" id="switch" value="switch">
                                    <label class="form-check-label" for="switch">Switch</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="stance[]" id="nollie" value="nollie">
                                    <label class="form-check-label" for="nollie">Nollie</label>
                                </div>
                                <div class="form-group p-2">
                                    <input type="submit" name="addTrick" id="addTrick" value="VALIDER" class="btn btn-outline-primary btn-block form-control">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php
        require_once('../classes/ConnexionPdo.class.php');
        require_once('../classes/Authentification.class.php');
        if (isset($_POST['deco'])) {
            $auth = new Authentification();
            $auth->deco();
        }
        ?>
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="./js/appscript.js"></script>
</body>

</html>