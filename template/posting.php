<?php require("head.php") ?>
		<div class="center">
			<?php require("template/sidebar.php") ?>
			<?php if($edit): ?>
				<form id="posting" class="block main" action="action.php?a=editPost&amp;id=<?= $post->id() ?>" method="post">
			<?php else: ?>
				<form id="posting" class="block main" action="action.php?a=post" method="post">
			<?php endif ?>
				<fieldset>
					<?php if($edit): ?>
						<h2>Editer un lien</h2>
					<?php else: ?>
						<h2>Ajouter un lien</h2>
					<?php endif ?>
					<label for="pass">Lien</label>
					<p>Laissez vide pour un post</p>
					<?php if($edit): ?>
						<input type="text" name="link" value="<?= $post->link() ?>" disabled/>
					<?php else: ?>
						<input type="text" name="link"/>
					<?php endif ?>
					<label for="user">Titre</label>
					<p>Laissez vide pour utiliser le titre de la page</p>
					<input type="text" name="title" value="<?= $post->title() ?>"/>
					<label for="pass">Résumé</label>
					<textarea name="content" rows="5"><?= $post->content() ?></textarea>
					<label for="tags">tags</label>
					<ul>
						<?php foreach($tags as $tag): ?>
							<li>
								<?php if(in_array($tag, $post->tags())): ?>
									<input type="checkbox" name="tags" value="<?= $tag ?>" checked><?= $tag ?>
								<?php else: ?>
									<input type="checkbox" name="tags" value="<?= $tag ?>"><?= $tag ?>
								<?php endif ?>
							</li>
						<?php endforeach ?>
					</ul>
					<button name="button">Poster <i class="fa fa-pencil"></i></button>
				</fieldset>
			</form>
			<?php require("template/userSidebar.php") ?>
		</div>
<?php require("foot.php") ?>
