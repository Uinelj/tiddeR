<? require("head.php") ?>
		<div class="center">
			<? require("template/sidebar.php") ?>
			<form id="posting" class="block main" action="action.php?a=post" method="post">
				<h2>Ajouter un lien</h2>
				<label for="pass">Lien</label>
				<p>Laissez vide pour un post</p>
				<input type="text" name="link"/>
				<label for="user">Titre</label>
				<p>Laissez vide utiliser le titre de la page</p>
				<input type="text" name="title"/>
				<label for="pass">Résumé</label>
				<textarea name="textarea" rows="5"></textarea>
				<button name="button">Poster <i class="fa fa-pencil"></i></button>
			</form>
			<? require("template/userSidebar.php") ?>
		</div>
<? require("foot.php") ?>