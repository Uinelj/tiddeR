<?php require("head.php") ?>
		<div class="center">
			<?php require("template/sidebar.php") ?>
			<?php if(isset($message)): ?>
				<p><?= $message ?></p>
			<?php endif ?>
			<div class="block main">
				<table>
				<tr>
					<th>Utilisateur</th>
					<th>Courriel</th>
					<th>Accepter</th>
					<th>Refuser</th>
				</tr>
				<?php foreach($users as $user): ?>
					<tr>
						<td><?= $user->nick() ?></td>
						<td><a href="mailto:<?= $user->mail() ?>"><?= $user->mail() ?></a></td>
						<td><a href="<?= rootURL() ?>action.php?a=accept&amp;id=<?= $user->id() ?>">Accepter</a</td>
						<td><a href="<?= rootURL() ?>action.php?a=refuse&amp;id=<?= $user->id() ?>">Refuser</a</td>
					</tr>
				<?php endforeach ?>
				</table>
			</div>
			<?php require("template/userSidebar.php") ?>
		</div>
<?php require("foot.php") ?>
