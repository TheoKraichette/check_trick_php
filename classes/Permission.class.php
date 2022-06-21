<?php

class Permission
{
    public function menuCrea()
    {
        if ($_SESSION["role"] == "admin") {
            ob_start();
            echo '
            <li class="nav-item">
            <button class="nav-link active bg-dark me-3" name="list_user"><a href="creation-utilisateur" class="text-decoration-none text-white">Créer un utilisateur</a></button>
        </li>';
        }
    }
    public function menuList()
    {
        if ($_SESSION["role"] == "admin") {
            ob_start();
            echo '<li class="nav-item">
            <button class="nav-link active bg-dark me-3" name="list_user"><a href="liste-utilisateur" class="text-decoration-none text-white">Listes des utilisateurs</a></button>
        </li>';
        }
    }

    public function listUser($con)
    {
        $req_sel = "select * from user";
        $res_sel = $con->prepare($req_sel);
        $res_sel->execute();
        $sel = $res_sel->fetchAll();

        $aff_sel = "";

        foreach ($sel as $v) :
            $aff_sel .= "<tr> <td>" . $v['id_user'] . "</td>";
            $aff_sel .= "<td>" . $v['login_user'] . "</td>";
            $aff_sel .= "<td>" . substr($v['mdp_user'], 35) . "</td>";
            $aff_sel .= "<td>" . $v['role'] . "</td>";
            $aff_sel .= '<td>
                <a href="#" title="Modifier cet élément" class="text-primary editBtn"
                data-toggle="modal" data-target="#editModal" id="' . $v['id_user'] . '">
                  <i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;
          
                  <a href="#" title="Supprimer cet élément" class="text-danger deleteBtn"
                   id="' . $v['id_user'] . '">
                  <i class="bi bi-x-circle-fill"></i></a>
          
              </td></tr>
        ';
        endforeach;
        ob_start();
        echo $aff_sel;
    }

    public function getUserById($con, $id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $con->prepare($query);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function insert($co, $login, $mdp, $role)
    {
        //Création de la requête d'insertion
        $req_ins = "insert into user values (0, :login_user, sha2(:mdp_user, 512), :role)";
        //Préparation de la requête grâce à la variable $co qui établit la connexion avec la bdd
        $res_ins = $co->prepare($req_ins);
        //Execution de la requête avec l'envoi du tableau contenant les données traitées dans la requête
        $res_ins->execute(array(
            ':login_user' => $login,
            ':mdp_user' => $mdp,
            'role' => $role
        ));

        return true;
    }

    public function verifLogin($co, $login, $mdp, $role)
    {
        $stmt = $co->prepare("SELECT login_user FROM user WHERE login_user=:login_user");
        $stmt->execute(array(':login_user' => $login));
        $user = $stmt->fetch();
        if ($user) {
            echo '<p class="text-center text-danger mt-3">Ce login est déja utilisé.</p>';
        } else {
            $this->insert($co, $login, $mdp, $role);
        }
    }

    function delete($co, $id)
    {
        $req_del = "DELETE FROM user WHERE id_user=:id";
        $res_del = $co->prepare($req_del);
        $res_del->execute(array(':id' => $id));
        return true;
    }

    public function update($co, $id, $country, $biographie, $skating_since, $stance, $fav_trick)
    {
        session_start();
        $query = "UPDATE users SET country=:country, biographie=:biographie, skating_since=:skating_since, stance=:stance, fav_trick=:fav_trick  WHERE id = :id";
        $stmt = $co->prepare($query);
        $stmt->execute([
            'id' => $id,
            'country' => $country,
            'biographie' => $biographie,
            'skating_since' => $skating_since,
            'stance' => $stance,
            'fav_trick' => $fav_trick,
        ]);
        ob_start();
        $_SESSION['country'] = $country;
        $_SESSION['biographie'] = $biographie;
        $_SESSION['skating_since'] = $skating_since;
        $_SESSION['stance'] = $stance;
        $_SESSION['fav_trick'] = $fav_trick;

        return true;
    }

    public function getTotalStarsByUser($co, $id)
    {
        $query = 'SELECT sum(stars) as total_stars FROM realised r, tricks t, users u, difficulty d  WHERE r.id_user = u.id AND r.id_tricks = t.id_trick AND t.id_diff = d.id_diff AND u.id =:id_user';
        $stmt = $co->prepare($query);
        $stmt->execute([
            'id_user' => $id
        ]);
        $totalStars = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['total_stars'] = $totalStars['total_stars'];

        return $totalStars;
    }

    public function showUpdateProfil()
    {
        session_start();
        $stars = new Permission;
        $id = $_SESSION['auth'];
        $co = new ConnexionPdo;
        $co = $co->getmyDB();
        $stars->getTotalStarsByUser($co, $id);

        echo    '<div class="container mt-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-7">
                        <div class="card p-3 py-4">
                            <div class="text-center">
                                <img src="https://i.imgur.com/bDLhJiP.jpg" width="100" class="rounded-circle">
                            </div>
                            <div class="text-center mt-3">
                                <h5 class="mt-2 mb-0">' . $_SESSION["nickname"] . '</h5>
                                <span>' . $_SESSION["country"] . '</span>
                                <div class="px-4 mt-1">
                                    <p class="fonts">' . $_SESSION["biographie"] . '</p>
                                </div>                                
                                <div class="px-4 mt-1">
                                <p class="fonts">Skating since : ' . $_SESSION["skating_since"] . '</p>
                            </div>                      <div class="px-4 mt-1">
                            <p class="fonts">Stance : ' . $_SESSION["stance"] . '</p>
                        </div>
                        <div class="px-4 mt-1">
                        <p class="fonts">Fav trick : ' . $_SESSION["fav_trick"] . '</p>
                        
                    </div>                     <div class="px-4 mt-1">
                    <p class="fonts">My stars : ' . $_SESSION["total_stars"] . '<i class="bi bi-star-fill text-warning"></i></p>
                    
                </div>
                                <div class="buttons">
                                    <a href="#" title="Modifier cet élément" class="btn btn-outline-dark px-4 editBtn" data-toggle="modal" data-target="#editModal" id="' . $_SESSION["auth"] . '"">
                                        <i class="bi bi-pencil-square"></i>Modifier le profil</a>
                                    <a href="tricks" class="btn btn-dark px-4 ms-3">Acceder à la liste des tricks<a/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
    }
}
