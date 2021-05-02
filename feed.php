<?php
session_start();
$photo=$_SESSION['pdp'];
include("connexion.php");
$sql = "select * from tweet join user on tweet.ID_USER=user.ID_USER order by DATE_PARTAGE desc LIMIT 20";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $sql2="select commenter.ID_USER AS idc , commenter.CONTENU AS cont from tweet join commenter on tweet.ID_TWEET=commenter.ID_TWEET where tweet.ID_TWEET='".$row['ID_TWEET']."' order by commenter.DATEC";
    $res2=mysqli_query($link,$sql2);?>
    <div class="card">
    <?php
        if($row['IMAGE'] !=NULL){
            echo "<img src='photo/" . $row['IMAGE'] . "'class='card-img-top ' style='height:600px'>";
        }
    ?>
    <div class="card-body">
        <p class="card-text"><small class="text-muted"><?php echo $row['DATE_PARTAGE']?></small></p>
        <p class="card-text"><?php echo $row['TEXTE']?></p>
        <div class="row">
            <div class="button-wrapper col-3">
                <span class="label"><span style="color:#1266B0;font-weight:bold;">135 </span><i class="far fa-heart"></i> </span>
            </div>
            <div class="button-wrapper col-3">
                <span class="label"><span style="color:#1266B0;font-weight:bold;">135 </span><i class="far fa-comment"></i> </span>
            </div>
            <div class="button-wrapper col-3">
                <span class="label"><span style="color:#1266B0;font-weight:bold;">135 </span><i class="fas fa-retweet"></i> </span>
            </div>
        </div>
        <hr>
        <div class="row">
        <?php
            while($rowcom=mysqli_fetch_assoc($res2)){
                $sqlcom="select PDP from user where ID_USER='".$rowcom['idc']."'";
                $rescom=mysqli_query($link,$sqlcom);
                $rowcom2=mysqli_fetch_assoc($rescom);
                $photo1=$rowcom2['PDP'];
            ?>
            <div class="col-sm-1 col-1 photoc">
                <img class="profile" <?php echo "src=\"photo/$photo1\"" ?> style="width:50px; border-radius:100%;margin-top:0%">
            </div>
            <div class="col-sm-11 col-11 commc" style="color: black;">
                <?php echo $rowcom['cont'] ?>
            </div>
            <hr>
            <? } ?>
        </div>
        <hr>
        <!--Comment-->
        <div class="row">
            <div class="col-sm-1 col-1">
                <img class="profile" <?php echo "src=\"photo/$photo\"" ?> style="width:50px; border-radius:100%;margin-top:0%">
            </div>
            <div class="col-sm-8 col-8 ">
                <div class="col p-3 ">
                    <form action="ajax.php" method="POST">
                        <input type="text" class="form-control form-control-dark w-100 border-0 shadow-none" type="text" placeholder="Comment here" name="comm" autofocus>
                        <div class="col-sm-3 col-3 position-absolute  top-100 start-100 translate-middle">
                            <div class="button-wrapper">
                                <input type="submit" name="fichier" id="upload" class="upload-box" placeholder="Upload File" value=<?php echo $row['ID_TWEET'] ?>>
                                <span class="label"><i class="far fa-paper-plane"></i></span>
                            </div>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
        <hr>
    </div>
    <br><br><br>
<?php } ?>