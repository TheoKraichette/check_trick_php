<?php

class Trick
{
    public function getTrickBegginer($co)
    {
        $query = "SELECT DISTINCT * FROM tricks t, difficulty d, stance s WHERE d.libelle_diff = 'beginner' GROUP BY t.nom_trick ORDER BY t.id_trick";
        $stmt = $co->prepare($query);
        $stmt->execute();
        $sel = $stmt->fetchAll();

        $aff_sel = "";

        foreach ($sel as $so) {

            $trick = new Trick;
            $stances =  $trick->getTrickByUser($co, $so['id_trick'], $_SESSION['auth']);
            $aff_sel .= "<tr> <td>" . $so['id_trick'] . "</td>";
            $aff_sel .= "<td>" . $so['nom_trick'] . "</td>";
            $aff_sel .= "<td>" . $so['stars'] . "</td>";
            $aff_sel .= '<td>
                <a href="#" title="Modifier cet élément" class="text-primary trickBtn"
                data-toggle="modal" data-target="#editModal" id="' . $so['id_trick'] . '">
                  <i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;
              </td>
        ';

            if ($stances) {
                foreach ($stances as $stance) {
                    if ($stance['libelle_stance']) {
                        $aff_sel .= "<td><i class='bi bi-check2-circle text-success'></i></td>";
                        break;
                    }
                }
            } else $aff_sel .= "<td><i class='bi bi-x-circle text-danger'></i></td>";

            if (count($stances) > 3) {
                $aff_sel .= "<td><i class='bi bi-check2-circle text-success'></i></td>";
            } else $aff_sel .= "<td><i class='bi bi-x-circle text-danger'></i></td>";
        }
        echo $aff_sel;
    }


    public function addTrick($con, $id_trick, $id_user, $stance)
    {
        if (in_array('normal', $stance)) {
            $query = 'INSERT INTO realised VALUES (:id_user, :id_trick, :id_stance)';
            $res_ins = $con->prepare($query);
            $reussi = $res_ins->execute(array(
                ':id_user' => $id_user,
                ':id_trick' => $id_trick,
                ':id_stance' => 1
            ));
        } else if (!in_array('normal', $stance)) {
            $req_del = "DELETE FROM realised WHERE id_tricks=:id AND id_stance=1";
            $res_del = $con->prepare($req_del);
            $res_del->execute(array(':id' => $id_trick));
        }

        if (in_array('fakie', $stance)) {
            $query = 'INSERT INTO realised VALUES (:id_user, :id_trick, :id_stance)';
            $res_ins = $con->prepare($query);
            $reussi = $res_ins->execute(array(
                ':id_user' => $id_user,
                ':id_trick' => $id_trick,
                ':id_stance' => 2
            ));
        } else  if (!in_array('fakie', $stance)) {
            $req_del = "DELETE FROM realised WHERE id_tricks=:id AND id_stance=2";
            $res_del = $con->prepare($req_del);
            $res_del->execute(array(':id' => $id_trick));
        }

        if (in_array('switch', $stance)) {
            $query = 'INSERT INTO realised VALUES (:id_user, :id_trick, :id_stance)';
            $res_ins = $con->prepare($query);
            $reussi = $res_ins->execute(array(
                ':id_user' => $id_user,
                ':id_trick' => $id_trick,
                ':id_stance' => 3
            ));
        } else if (!in_array('switch', $stance)) {
            $req_del = "DELETE FROM realised WHERE id_tricks=:id AND id_stance=3";
            $res_del = $con->prepare($req_del);
            $res_del->execute(array(':id' => $id_trick));
        }
        
        if (in_array('nollie', $stance)) {
            $query = 'INSERT INTO realised VALUES (:id_user, :id_trick, :id_stance)';
            $res_ins = $con->prepare($query);
            $reussi = $res_ins->execute(array(
                ':id_user' => $id_user,
                ':id_trick' => $id_trick,
                ':id_stance' => 4
            ));
        } else if (!in_array('nollie', $stance)) {
            $req_del = "DELETE FROM realised WHERE id_tricks=:id AND id_stance=4";
            $res_del = $con->prepare($req_del);
            $res_del->execute(array(':id' => $id_trick));
        }
    }

    public function getTrickByUser($co, $id_trick, $id_user)
    {
        $query = 'SELECT libelle_stance FROM realised r, stance s WHERE r.id_user=:id_user AND r.id_tricks=:id_trick AND s.id_stance = r.id_stance';
        $stmt = $co->prepare($query);
        $stmt->execute(array(
            ':id_trick' => $id_trick,
            ':id_user' => $id_user
        ));
        $sel = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $sel;
    }
}
