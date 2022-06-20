<?php
session_start();
require_once('../classes/ConnexionPdo.class.php');
require_once('../classes/Trick.class.php');

$con = new ConnexionPdo();
$con = $con->getmyDB();
$trick = new Trick();

// if (isset($_POST['edit_id'])) {
//     $id = $_POST['edit_id'];
//     var_dump($_POST["edit_id"]);
//     $row = $trick->getTrickById($con, $id);
//     echo json_encode($row); // response retournée
// }

if (isset($_POST['action']) && $_POST['action'] == 'viewBegginer') {
    $trick->getTrickBegginer($con);
}

if (isset($_POST['action']) && $_POST['action'] == 'viewIntermediate') {
    $trick->getIntermediateTricks($con);
}

if (isset($_POST['action']) && $_POST['action'] == 'viewConfirmed') {
    $trick->getConfirmedTricks($con);
}

if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id_trick = $_POST['trick_id'];
    $id_user = $_SESSION['auth'];
    $stance = $_POST['stance'];

    $trick->addTrick($con, $id_trick, $id_user, $stance);
}

if (isset($_POST['trick_id'])) {

    $id_trick = $_POST['trick_id'];
    $id_user = $_SESSION['auth'];
    $rows = $trick->getTrickByUser($con, $id_trick, $id_user);
    echo json_encode($rows); // response retournée

}
