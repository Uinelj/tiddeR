<?php require("head.php") ?>
		<div class="center">
			<?php require("template/sidebar.php") ?>
			<?php if(isset($message)): ?>
				<p><?= $message ?></p>
			<?php endif ?>
			<div class="block main">
				<h2>Demandes d'inscriptions</h2>
				<table>
				<tr>
					<th>Utilisateur</th>
					<th>Courriel</th>
					<th>Actions</th>
				</tr>
				<?php foreach($candidates as $user): ?>
					<tr>
						<td><?= $user->nick() ?></td>
						<td><a href="mailto:<?= $user->mail() ?>"><?= $user->mail() ?></a></td>
						<td><a href="<?= rootURL() ?>action.php?a=accept&amp;id=<?= $user->id() ?>"><i class="fa fa-thumbs-up"></i></a>
							<a href="<?= rootURL() ?>action.php?a=refuse&amp;id=<?= $user->id() ?>"><i class="fa fa-trash-o"></i></a></td>
					</tr>
				<?php endforeach ?>
				</table>
				
				<h2>Utilisateurs</h2>
				<table>
				<tr>
					<th>Utilisateur</th>
					<th>Courriel</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
				<?php foreach($users as $user): ?>
					<tr>
						<td><?= $user->nick() ?></td>
						<td><a href="mailto:<?= $user->mail() ?>"><?= $user->mail() ?></a></td>
						<td><?= $user->perms() ?></td>
						<td><a href="<?= rootURL() ?>action.php?a=ban&amp;id=<?= $user->id() ?>"><i class="fa fa-ban"></i></a>
							<a href="<?= rootURL() ?>action.php?a=admin&amp;id=<?= $user->id() ?>"><i class="fa fa-wrench"></i></a>
							<a href="<?= rootURL() ?>action.php?a=delete&amp;id=<?= $user->id() ?>"><i class="fa fa-trash"></i></a></td>
					</tr>
				<?php endforeach ?>
				</table>
				
				<h2>Tags</h2>
				<table>
				<tr>
					<th>Tag</th>
					<th>Supprimer</th>
				</tr>
				<?php foreach($tags as $tag): ?>
					<tr>
						<td><?= $tag ?></td>
						<td><a href="<?= rootURL() ?>action.php?a=dtag&amp;name=<?= $tag ?>"><i class="fa fa-trash-o"></i></a</td>
					</tr>
				<?php endforeach ?>
				</table>
				<form class="block main" action="action.php?a=atag" method="post">
					<label for="pass">Ajouter</label>
					<input type="text" name="tag"/>
					<button name="button">Ajouter <i class="fa fa-plus"></i></button>
				</form>
			</div>
			<?php require("template/userSidebar.php") ?>
		</div>
<?php require("foot.php") ?>
