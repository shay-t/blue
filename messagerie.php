<?php session_start() ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Message</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/message.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
	<style>
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
							<a class="nav-link active" aria-current="page" href="">
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
			<div class="col-12 col-sm-12 col-lg-7 col-md-6 mess">
				<div class="d-flex flex-column bd-highlight mb-3 sticky-top" style="background-color: white;">
					<div class="p-2 bd-highlight ">
						<h3 class="e2">MESSAGES</h3>
					</div>
				</div>
				<div class="chat">
					<div class="col-12 col-lg-12 col-xl-12">
						<div class="py-2 px-4 border-bottom d-none d-lg-block">
							<?php
							include("connexion.php");
							$s = "select * from user where ID_USER='" . $_SESSION['id2'] . "'";
							$r = mysqli_query($link, $s);
							$row5 = mysqli_fetch_assoc($r);
							if ($row5) {
								$nom = $row5['NOM_PRENOM'];
								$pdp =  $row5['PDP'];
							} else {
								$nom = "Choose who to talk";
								$pdp =  "inconnu.jpg";
							}
							?>
							<div class="d-flex align-items-center py-1">
								<div class="position-relative">
									<?php echo "<img src=\"photo/$pdp\" class=\"rounded-circle mr-1\" width=40 height=40 />" ?>
								</div>
								<div class="flex-grow-1 pl-3">
									<strong class="messager pl-5"> <?php echo $nom ?> </strong>
									<div class="text-muted small"><em>Typing...</em></div>
								</div>
							</div>
						</div>

						<div class="position-relative">
							<div class="chat-messages p-4">
								<div id="chats">
									<?php
									$pdp2 = $_SESSION['pdp'];
									$id1 = $_SESSION['id'];
									$val = $_SESSION['id2'];
									include("connexion.php");
									$sql = "select * from envoi WHERE (ID_USER1='" . $id1 . "' and ID_USER2='" . $val . "') or (ID_USER2='" . $id1 . "' and ID_USER1='" . $val . "') order by DATEM";
									$res = mysqli_query($link, $sql);
									while ($row = mysqli_fetch_assoc($res)) {
										if ($row['ID_USER1'] == $id1) {
									?>
											<div class="chat-message-right pb-4 ">
												<div>
													<?php echo "<img src=\"photo/$pdp2\" class=\"rounded-circle mr-1\" width=40 height=40 />" ?>
													<div class="text-muted small text-nowrap mt-2"><?php echo $row['DATEM'] ?></div>
												</div>
												<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
													<div class="font-weight-bold mb-1 text align-center messager">You</div>
													<?php echo $row['CONTENU'] ?>
												</div>
											</div>
										<?php } else { ?>
											<div class="chat-message-left pb-4">
												<div>
													<?php echo "<img src=\"photo/$pdp\" class=\"rounded-circle mr-1\" width=40 height=40 />" ?>
													<div class="text-muted small text-nowrap mt-2"><?php echo $row['DATEM'] ?></div>
												</div>
												<div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
													<div class="font-weight-bold mb-1 messager"> <?php echo $nom ?> </div>
													<?php echo $row['CONTENU'] ?>
												</div>
											</div>
									<?php }
									}
									?>
								</div>
								<div class="flex-grow-0 py-3 px-4 border-top">
									<div class="input-group">
										<form action="" method="post">
											<input type="text" class="form-control" placeholder="Type your message" name="mess">
											<button class="btn btn-primary" type="submit" name="subm">Send</button>
										</form>
									</div>
								</div>
								<?php
								if (isset($_POST['subm'])) {
									include("connexion.php");
									$from = $_SESSION['id'];
									$to = $_SESSION['id2'];
									$message = $_POST['mess'];
									$sql = "insert into envoi(ID_USER1, ID_USER2, CONTENU) values($from, $to, '$message')";
									$resultat = mysqli_query($link, $sql);
									mysqli_close($link);
								}

								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--Partie 3-->
			<div class="col-12 col-sm-12 col-lg-3 col-md-3">
				<div class="col-12 col-sm-12 col-lg-3 col-md-3">
					<div class=" pt-3">
						<input type="search" id="form1" placeholder="Search Twitter" class="form-control rounded-pill shadow-none" style="background-color: #F2F2F2;" />
						<table class="table tableau">
							<thead>
								<tr>
									<th>Send message to: </th>
								</tr>
							</thead>
							<tbody>
								<?php
								include("connexion.php");
								$id1 = $_SESSION['id'];
								$req = "SELECT * from suivre join user on suivre.ID_USER2=user.ID_USER WHERE suivre.ID_USER1 ='" . $_SESSION['id'] . "'";
								$res = mysqli_query($link, $req);
								while ($row = mysqli_fetch_assoc($res)) {
									$photo = $row['PDP'];
									echo '<tr><td>';
									echo "<img src=\"photo/$photo\" class=\"rounded-circle\"  width=60/>";
									echo "<span>" . $row['NOM_PRENOM'] . "</span></td>";
									echo '<td><form action="messages.php" method="POST">';
									echo '<button class="btn btn-primary btn-sm m-2 rounded-pill" style="padding-left: 10% padding-right: 10% " name="send" value="' . $row['ID_USER'] . ' ">Message
                                    </button></form></td>';
								}
								mysqli_close($link);

								?>
							</tbody>

						</table>
					</div>
				</div>

			</div>
			<!--js code link-->
			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
			<script>
				$(document).ready(function() {
					setInterval(function updateDiv() {
						$("#chats").load(window.location.href + " #chats");
					}, 500);
				})
			</script>
</body>

</html>