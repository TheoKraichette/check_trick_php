<?php
require_once('../classes/ConnexionPdo.class.php');
require_once('../classes/Permission.class.php');

$con = new ConnexionPdo();
$user = new Permission;

$con = $con->getmyDB();

if (isset($_POST['action']) && $_POST['action'] == 'viewUser') {
    $list = new Permission();
    $list->listUser($con);
}

if (isset($_POST['action']) && $_POST['action'] == 'view') {
    $user->showUpdateProfil($con);
}


if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['delete_id'];
    $user->delete($con, $id);
}


//Recuperation des données pour les insérer dans le modal Modification
if (isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];
    $row = $user->getUserById($con, $id);
    echo json_encode($row); // response retournée
}

// Modification du profil via le modal
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['edit_id'];
    $role = $_POST['role'];
    $country = $_POST['country'];
    $biographie = $_POST['biographie'];
    $skating_since = $_POST['skating_since'];
    $stance = $_POST['stance'];
    $fav_trick = $_POST['fav_trick'];

    $user->update($con, $id, $country, $biographie, $skating_since, $stance, $fav_trick);
}

// creation
if(isset($_POST['action']) && $_POST['action']=='insert'){
 
    $login = htmlspecialchars($_POST['login_user']);
    $mdp = htmlspecialchars($_POST['mdp_user']);
    $role = htmlspecialchars($_POST['role']);
    
    $user->verifLogin($con,$login,$mdp,$role);
  }

  if (isset($_POST['edit_id_admin'])) {
    $id = $_POST['edit_id_admin'];
    $row = $user->getArticleById($con, $id);
    echo json_encode($row); // response retournée
}

  if (isset($_POST['action']) && $_POST['action'] == 'updateAdmin') {
    $id = $_POST['edit_id_admin'];
    $role = $_POST['role'];

    $user->updateAdmin($con, $id, $role);
}