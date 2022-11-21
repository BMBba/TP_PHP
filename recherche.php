<?php if (isset($_POST["verif"])) {
  if (isset($_POST["classe"])) {
    $classe = $_POST["classe"];
    if (!empty($classe)) {

      $list = "SELECT * FROM utilisateurs WHERE id NOT IN ($connec) AND Etat=0 AND Nom LIKE '%$classe%' OR Prenom LIKE '%$classe%'  ";
      $ins = $pdo->query($list);

      $ins->execute();
      while ($row = $ins->fetch(PDO::FETCH_ASSOC)/* $row = $ins->fetch(PDO::FETCH_ASSOC) /) {

        $ID = $row['id'];
        $nom = $row['Nom'];
        $prenom = $row['Prenom'];
        $email = $row['Email'];

        $role = $row['Roles'];
        $matricule = $row['Matricule'];
        /  $modifier=$row['modifier']; */
        $etat = $row['Etat'];
        $action = "Action";

        if ($etat == 0 && $ID!==$connec) {


          echo '<tr>

    <td >' . $nom . '</td>
    <td >' . $prenom . '</td>
    <td >' . $email . '</td>
    <td>' . $role . '</td>

    <td>' . $matricule . '</td>




    <td>



    <span name="modifierr" style="text-decoration: none; "><a href="admin.php?modifid=' . $ID . '" > <img  style="height:40px ;width:40px;"src="image/user.svg"></a></span>
    <span style="text-decoration: none; "><a href="../modeles/change1.php?changeid=' . $ID . '" > <img style="height:40px ;width:40px;"  src="image/role.svg"></a></span>

    <span classe="b1"style=" text-decoration: none;" OnClick="return(confirm('voulez-vous vraiment Archiver cet employé?'))";>
    <a href="../modeles/supp.php?archiverid=' . $ID . '" > <img style="height:40px ;width:40px;" src="image/ar.svg"></a></span>
    </td>

  </tr>';?>