<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Personnel Account</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style_profil.css">
</head>
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
                            <a class="nav-link active" aria-current="page" href="home_twitter.php">
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
            <div class="col-12 col-sm-12 col-lg-9 col-md-9">
                <div class="d-flex flex-column bd-highlight mb-3 " style="background-color: white;">
                    <div class="p-2 bd-highlight ">
                        <h3 class="e2"> PERSONEL ACCOUNT</h3>
                    </div>
                </div>
                <div class="row shadow rounded  p-5 d-flex ">
                    <!-- Requette pac -->
                    <?php
                    include('connexion.php');
                    $sql = "select * from user where ID_USER='" . $_SESSION['id'] . "'";
                    $sql2 = "select TIMESTAMPDIFF(YEAR,DATE_NAISSANCE,CURDATE()) AS age from user where ID_USER='" . $_SESSION['id'] . "'";
                    $result = mysqli_query($link, $sql);
                    $result2 = mysqli_query($link, $sql2);
                    $row = mysqli_fetch_assoc($result);
                    $row2 = mysqli_fetch_assoc($result2);

                    $photo = $row['PDP'];
                    ?>
                    <!-- -->
                    <div class="col-3 mt-3 mb-3">
                        <!--img src=alt="..." width="130" class="rounded mb-2 img-thumbnail"-->
                        <?php echo "<img src=\"photo/$photo\" class=\"rounded mb-2 img-thumbnail\"  width=130/>"; ?>
                    </div>
                    <div class="col-5 col-sm-5 col-lg-5 col-md-5">
                        <div class="mt-3">
                            <h4><?php echo $_SESSION['name'] ?></h4>
                            <p class="text-secondary mb-1"><?php echo $row['DESCRIPTION'] ?></p>
                            <p class="text-muted font-size-sm"><?php echo $row2['age'] ?> years</p>
                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">Edit informations</button>
                        </div>
                    </div>
                    <!-- Modal 1 -->
                    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><img class="img-fluid logo" src="images/logo.png"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Contenu du modal-->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5>Modifier vos informations</h5>
                                        </div>
                                        <!-- Requette pac -->
                                        <?php
                                        include('connexion.php');
                                        $sql = "select * from user where ID_USER='" . $_SESSION['id'] . "'";
                                        $result1 = mysqli_query($link, $sql);
                                        $row1 = mysqli_fetch_assoc($result1);
                                        $photo = $row1['PDP'];
                                        $nom = $row1['NOM_PRENOM'];
                                        $date = $row1['DATE_NAISSANCE'];
                                        $mail = $row1['EMAIL'];
                                        $mdp = $row1['MDP'];
                                        $descri = $row1['DESCRIPTION'];
                                        /*SELECT `ID_SUJET` FROM `interesser` WHERE `ID_USER`='12' */
                                        $sql2 = "select `ID_SUJET` from `interesser` where ID_USER='" . $_SESSION['id'] . "'";
                                        $result2 = mysqli_query($link, $sql2);
                                        $row2 = mysqli_fetch_assoc($result2);

                                        ?>
                                        <form action="modification.php" method="post" id="form_connexion" enctype="multipart/form-data" class="row">
                                            <div class="col xs-12 col-sm-12 col-lg-6 col-md-12">
                                                <input type="text" class="form-control" placeholder="Votre nom et prenom" name="nompre" required="required" <?php echo 'value="' . $nom . '"' ?>><br>
                                                <input type="text" class="form-control" placeholder="Adresse email" name="mail" required="required" <?php echo 'value="' . $mail . '"' ?>><br>
                                                <input type="password" class="form-control" placeholder="Mot de passe" name="mdp" required <?php echo 'value="' . $mdp . '"' ?>><br>
                                                <label for="date" id="naissance">Saisissez votre date de naissance</label> <br><br>
                                                <input type="date" id="date" name="date_naissance" required="required" <?php echo 'value="' . $date . '"' ?>> <br> <br>
                                                <!--label for="date" id="pays">veuillez choisir votre pays</label> <br><br-->
                                                <textarea class="form-control" rows="3" placeholder="Votre biographie.." name="bio"><?php echo "$descri"; ?></textarea><br>
                                            </div>
                                            <div class="col xs-12 col-sm-12 col-lg-6 col-md-12">
                                                <div class="col-12 mt-3 mb-3" style="text-align:center;">
                                                    <!--img src=alt="..." width="130" class="rounded mb-2 img-thumbnail"-->
                                                    <?php echo "<img src=\"photo/$photo\" class=\"rounded mb-2 img-thumbnail\"  width=130/>"; ?>
                                                </div>
                                                <label for="exampleInputFile" class="form-label"> Si vous souhaitez changer votre photo de profil Selectionnez là </label><br><br>
                                                <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name="fichier"><br><br>
                                                <small id="fileHelp" class="form-text text-muted">En appuyant sur modifier vous informations persnnel seront modifié
                                                </small><br><br>
                                                <input type="submit" class=" btn btn-primary insc" name="sub" value="Modifier">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-lg-4 col-md-4">
                        <!--tweets followers followings-->
                        <?php
                        $sql3 = "select count(ID_TWEET) as cardt from tweet where ID_USER='" . $_SESSION['id'] . "'";
                        $result3 = mysqli_query($link, $sql3);
                        $row3 = mysqli_fetch_assoc($result3);
                        $sql4 = "select count(ID_USER1) as cardf from suivre where ID_USER2='" . $_SESSION['id'] . "'";
                        $result4 = mysqli_query($link, $sql4);
                        $row4 = mysqli_fetch_assoc($result4);
                        $sql5 = "select count(ID_USER2) as cardfl from suivre where ID_USER1='" . $_SESSION['id'] . "'";
                        $result5 = mysqli_query($link, $sql5);
                        $row5 = mysqli_fetch_assoc($result5);
                        ?>
                        <div class=" p-4 d-flex justify-content-end text-center ">
                            <ul class="list-inline mb-0 bg-light rounded p-2">
                                <li class="list-inline-item">
                                    <h5 class="font-weight-bold mb-0 d-block"><?php echo $row3['cardt'] ?></h5>
                                    <small class="text-muted">Tweets</small>
                                </li>
                                <li class="list-inline-item">
                                    <h5 class="font-weight-bold mb-0 d-block"><?php echo $row4['cardf'] ?></h5>
                                    <small class="text-muted"> Followers</small>
                                </li>
                                <li class="list-inline-item">
                                    <h5 class="font-weight-bold mb-0 d-block"><?php echo $row5['cardfl'] ?></h5>
                                    <small class="text-muted">Following</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="py-4 px-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">Latest tweet</h5><a href="#" class="btn btn-link text-muted">Show all</a>
                    </div>
                    <div class="row">
                        <?php
                        /*include("connexion.php");
                        $reqtweet = "select * from tweet join user on tweet.ID_USER=user.ID_USER where user.ID_USER='" . $_SESSION['id'] . "' limit 20";
                        $rowtweet = mysqli_query($link,$reqtweet);
                        while($rest=mysqli_fetch_assoc($rowtweet)){
                            echo "<div class='col-lg-6 mb-2 pr-lg-1'>";
                            echo "<img src='photo/" . $rest['PDP'] . "'class='rounded-circle' style='width:55px'>" . $rest['NOM_PRENOM'] ;
                            echo $rest['TEXTE'];
                            if($rest['IMAGE'] != NULL){
                                echo "<img src='photo/".$rest['IMAGE']."'class='img-fluid rounded shadow-sm'>";
                            }
                        }*/
                        ?>
                        <div class="col-lg-6 mb-2 pr-lg-1"><img src="https://images.unsplash.com/photo-1469594292607-7bd90f8d3ba4?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" class="img-fluid rounded shadow-sm"></div>
                        <div class="col-lg-6 mb-2 pl-lg-1"><img src="https://images.unsplash.com/photo-1493571716545-b559a19edd14?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" class="img-fluid rounded shadow-sm"></div>
                        <div class="col-lg-6 pr-lg-1 mb-2"><img src="https://images.unsplash.com/photo-1453791052107-5c843da62d97?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" alt="" class="img-fluid rounded shadow-sm"></div>
                        <div class="col-lg-6 pl-lg-1"><img src="https://images.unsplash.com/photo-1475724017904-b712052c192a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="" class="img-fluid rounded shadow-sm"></div-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--js code link-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    </script>
</body>

</html>