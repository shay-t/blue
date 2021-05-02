<?php session_start() ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Home page</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/home.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
  <style>
    .button-wrapper {
      position: relative;
      width: 95px;
      height: 30.33px;
      text-align: center;
      background: #0d6efd;
      border: 1px solid #0d6efd;
      padding: .25rem .5rem;
      font-size: .875rem;
      border-radius: 50rem !important;
      margin-top: 0.5rem !important;
      margin-right: 0.5rem !important;
      margin-left: 0.5rem !important;

    }

    .reaction {
      float: left;
    }

    .button-wrapper span.label {
      position: relative;
      z-index: 0;
      display: inline-block;
      width: 100%;
      cursor: pointer;
      color: #fff;
      text-transform: uppercase;
    }

    #upload {
      cursor: pointer;
      display: inline-block;
      position: absolute;
      z-index: 1;
      width: 100%;
      height: 50px;
      top: 0;
      left: 0;
      opacity: 0;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <!--Partie 1-->
    <div class="row">
      <div class="col-sm-12 col-lg-2 col-md-3 col-12 e1">
        <div class="pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <img src="images/logo.png" class="rounded-circle logo" style="width:70px;">
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <img src="icons/home.png" class="rounded-circle " style="width:30px;"> HOME
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="user.php">
                <img src="icons/profil.png" style="width:30px;"> PROFILE
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <img src="icons/notification.png" class="rounded-circle" style="width:30px;"> NOTIFICATION
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="messagerie.php">
                <img src="icons/msg.png" class="rounded-circle" style="width:30px;"> MESSAGES
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="logout.php" type="submit">
                <img src="icons/signout.png" class="rounded-circle" style="width:30px;"> SIGN OUT
              </a>
            </li>
          </ul>
        </div>
      </div>
      <!--Partie 2-->
      <div class="col-12 col-sm-12 col-lg-7 col-md-6">
        <div class="d-flex flex-column bd-highlight mb-3 sticky-top" style="background-color: white;">
          <div class="p-2 bd-highlight ">
            <h3 class="e2">HOME</h3>
          </div>
        </div>
        <div class="row">
          <div class="row col-sm-11 col-11 border rounded overflow-hidden  mb-4 shadow-sm position-relative" style="margin-left: 25px;">
            <?php
            include('connexion.php');
            $sql = "select PDP from user where ID_USER='" . $_SESSION['id'] . "'";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($result);
            $photo = $row['PDP'];
            ?>
            <div class="col-sm-1 col-1">
              <img class="profile" <?php echo "src=\"photo/$photo\"" ?> style="width:60px;">
            </div>
            <div class="col-sm-10 col-10">
              <div class="col p-5 d-flex flex-column position-static ">
                <form action="" method="POST" enctype="multipart/form-data">
                  <input class="form-control form-control-dark w-100 border-0 shadow-none" type="text" placeholder="what's happening?" autofocus name="text">
                  <div class="col-sm-3 col-3 position-absolute bottom-0 end-0 ">
                    <div class="button-wrapper">
                      <input type="file" name="fichier" id="upload" class="upload-box" placeholder="Upload File">
                      <span class="label"><i class="fas fa-folder-plus"></i></span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm m-2 rounded-pill b1" style="padding-left: 20%!important;padding-right: 20%!important;" name="blue">Blue</button>
                  </div>
                </form>
                <?php
                if (isset($_POST['blue'])) {
                  $txt = $_POST['text'];
                  $id = $_SESSION['id'];
                  $result = mysqli_query($link, $sql);
                  $ph_name = NULL;
                  if (isset($_FILES['fichier']) and $_FILES['fichier']['error'] == 0) {
                    $dossier = 'photo/';
                    $temp_name = $_FILES['fichier']['tmp_name'];
                    if (!is_uploaded_file($temp_name)) {
                      exit("le fichier est untrouvable");
                    }
                    if ($_FILES['fichier']['size'] >= 1000000) {
                      exit("Erreur, le fichier est volumineux");
                    }
                    $infosfichier = pathinfo($_FILES['fichier']['name']);
                    $extension_upload = $infosfichier['extension'];

                    $extension_upload = strtolower($extension_upload);
                    $extensions_autorisees = array('png', 'jpeg', 'jpg');
                    if (!in_array($extension_upload, $extensions_autorisees)) {
                      exit("Erreur, Veuillez inserer une image svp (extensions autorisées: png)");
                    }
                    $nom_photo = $id . date('Y-m-d- h-i-s') . "." . $extension_upload;
                    if (!move_uploaded_file($temp_name, $dossier . $nom_photo)) {
                      exit("Probleme dans le telechargement de l'image, Ressayez");
                    }
                    $ph_name = $nom_photo;
                  }
                  $sql = "INSERT INTO tweet(ID_USER, TEXTE,IMAGE) VALUES ('$id','$txt','$ph_name')";
                  $res = mysqli_query($link, $sql);
                  mysqli_close($link);
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <div id="feed">
        </div>
      </div>
      <!--Partie 3-->
      <div class="col-12 col-sm-12 col-lg-3 col-md-3">
        <div class=" pt-3">
          <input type="search" id="form1" placeholder="Search Twitter" class="form-control rounded-pill shadow-none" style="background-color: #F2F2F2;" />
          <table class="table tableau">
            <thead>
              <tr>
                <th>Trends for you</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include("connexion.php");
              $sql2 = "select * from interesser join centre_interet on centre_interet.ID_SUJET=interesser.ID_SUJET WHERE ID_USER='" . $_SESSION['id'] . "'";
              $res2 = mysqli_query($link, $sql2);
              while ($row2 = mysqli_fetch_assoc($res2)) {
                echo "<tr><td>";
                echo $row2['LIB_CONTENU'];
                echo "</td></tr></br>";
              }
              ?>
            </tbody>
          </table>

          <table class="table tableau">
            <thead>
              <tr>
                <th>who to follow </th>
              </tr>
            </thead>
            <tbody>
              <?php
              include("connexion.php");
              $id1 = $_SESSION['id'];
              $req = "SELECT * from user WHERE user.ID_USER NOT IN( SELECT suivre.ID_USER2 FROM suivre WHERE suivre.ID_USER1='" . $id1 . "') and user.ID_USER !='" . $_SESSION['id'] . "'";
              $res = mysqli_query($link, $req);
              while ($row = mysqli_fetch_assoc($res)) {
                $photo = $row['PDP'];
                echo '<tr><td>';
                echo "<img src=\"photo/$photo\" class=\"rounded-circle\"  width=60/>";
                echo "<span>" . $row['NOM_PRENOM'] . "</span></td>";
                echo '<td><form action="ajax.php" method="POST">';
                echo '<button class="btn btn-primary btn-sm m-2 rounded-pill" style="padding-left: 10% padding-right: 10% " name="follow" value="' . $row['ID_USER'] . '">follow
                                    </button></form></td>';
              }
              mysqli_close($link);

              ?>
            </tbody>

          </table>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!--js code link-->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $('#feed').load('feed.php');
      setInterval(function() {
        $('#feed').load('feed.php');
      },  600000);
    })
  </script>
</body>

</html>