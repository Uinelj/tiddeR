<?php require("head.php") ?>
		<div class="center">
			<?php require("template/sidebar.php") ?>
			<form id="posting" class="block main" action="action.php?a=post" method="post">
				<fieldset>
					<h2>Ajouter un lien</h2>
					<label for="pass">Lien</label>
					<p>Laissez vide pour un post</p>
					<input type="text" name="link"/>
					<label for="user">Titre</label>
					<p>Laissez vide utiliser le titre de la page</p>
					<input type="text" name="title"/>
					<label for="pass">Résumé</label>
					<textarea name="content" rows="5"></textarea>
					<label for="tags">tags</label>
					<ul>
						<?php foreach($tags as $tag): ?>
							<li>
								<input type="checkbox" name="tags[]" value="<?= $tag ?>"><?= $tag ?>
							</li>
						<?php endforeach ?>
					</ul>
					<button name="button">Poster <i class="fa fa-pencil"></i></button>
				</fieldset>
			</form>
			<?php require("template/userSidebar.php") ?>
		</div>
<?php require("foot.php") ?>
