<?php

class Inscription
{
    public function insert($co)
    {
        $last_name = htmlspecialchars($_POST['last_name']);
        $first_name = htmlspecialchars($_POST['first_name']);
        $nickname = htmlspecialchars($_POST['nickname']);
        $login = htmlspecialchars($_POST['login_user']);
        $mdp = htmlspecialchars($_POST['mdp_user']);

        //Création de la requête d'insertion
        $req_ins = "insert into users values (0, :last_name, :first_name, :country, :nickname, sha2(:mdp_user, 512), :mail, :birth_date, :biographie, :skating_since, :stance, :fav_trick, :role, :createdAt, :updatedAt)";
        //Préparation de la requête grâce à la variable $co qui établit la connexion avec la bdd
        $res_ins = $co->prepare($req_ins);
        //Execution de la requête avec l'envoi du tableau contenant les données traitées dans la requête
        $reussi = $res_ins->execute(array(
            ':last_name' => $last_name,
            ':first_name' => $first_name,
            ':country' => null,
            ':nickname' => $nickname,
            ':mdp_user' => $mdp,
            ':mail' => $login,
            ':birth_date' => null,
            ':biographie' => null,
            ':skating_since' => null,
            ':stance' => null,
            ':fav_trick' => null,
            ':role' => 'user',
            ':createdAt' => null,
            ':updatedAt' => null
        )); 

        if ($reussi) {
            ob_start();
            echo '<p class="text-center text-success mt-3">Votre compte a bien été créé</p>
		<p class="text-center text-success mt-2">Vous allez etre redirigé pour vous connecter.</p>';
        header("Refresh:2; url='./index.php'");
        } else {
            echo "quelque chose c'est mal passé";
        }
    }

    public function verifLogin($co)
    {
        $login = htmlspecialchars($_POST['login_user']);
        $stmt = $co->prepare("SELECT mail FROM users WHERE mail=:login_user");
        $stmt->execute(array(':login_user' => $login));
        $user = $stmt->fetch();
        if ($user) {
            echo '<p class="text-center text-danger mt-3">Ce login est déja utilisé.</p>';
        } else {
            $this->insert($co);
        }
    }
}
