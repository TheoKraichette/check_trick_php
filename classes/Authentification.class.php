<?php
class Authentification extends ConnexionPdo
{
    /* Properties */
    public $conn;
    /* Get database access */

    public function __construct()
    {
        $this->conn = new ConnexionPdo();
        $this->conn = $this->conn->getmyDB();
    }

    public function login($loginUser, $mdpUser)
    {
        if (!empty($loginUser) && !empty($mdpUser)) {

            $query = "SELECT * FROM users WHERE mail=:login_user AND mdp_user=sha2(:mdp_user, 512)";
            $req = $this->conn->prepare($query);
            $req->execute(array(':login_user' => $loginUser, ':mdp_user' => $mdpUser));
            $user = $req->fetch();

            if ($user) {
                session_start();
                ob_start();
                $_SESSION['auth'] = $user[0];
                $_SESSION['first_name'] = $user[1];
                $_SESSION['last_name'] = $user[2];
                $_SESSION['country'] = $user[3];
                $_SESSION['nickname'] = $user[4];
                $_SESSION['mdp_user'] = $user[5];
                $_SESSION['mail'] = $user[6];
                $_SESSION['birth_date'] = $user[7];
                $_SESSION['biographie'] = $user[8];
                $_SESSION['skating_since'] = $user[9];
                $_SESSION['stance'] = $user[10];
                $_SESSION['fav_trick'] = $user[11];
                $_SESSION['role'] = $user[12];

                header('Location: ./home');
            } else echo '<p class="mt-3 text-center text-danger">Login ou mot de passe incorrecte</p>';
        }
    }

    public function deco()
    {ob_start();
        session_unset();
        session_destroy();
        header('Location: index.php');
        ob_end_flush();
    }
}
