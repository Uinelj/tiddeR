<? require("head.php") ?>
		<div class="center">
			<form id="signup" class="block three" action="../action.php?a=sign" method="post">
				<h2>Inscription</h2>
				<label for="pass">Courriel</label>
				<input type="text" name="mail"/>
				<label for="user">Utilisateur</label>
				<input type="text" name="nick"/>
				<label for="pass">Phrase secrète</label>
				<input type="password" name="pass"/>
				<button name="button">Inscription <i class="fa fa-sign-in"></i></button>
			</form>
			<form id="login" class="block three" action="../action.php?a=log" method="post">
				<h2>Connexion</h2>
				<label for="user">Utilisateur</label>
				<input type="text" name="nick"/>
				<label for="pass">Phrase secrète</label>
				<input type="password" name="pass"/>
				<button name="button">Connexion <i class="fa fa-sign-in"></i></button>
			</form>
		</div>
<? require("foot.php") ?>