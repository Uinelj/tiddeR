<?php require("head.php") ?>
		<div class="center">
			<?php require("template/sidebar.php") ?>
			<?php if(isset($message)): ?>
				<p><?= $message ?></p>
			<?php endif ?>
			<table>
				<tr>
					<th>Utilisateur</th>
					<th>Courriel</th>
					<th>Accepter</th>
					<th>Refuser</th>
				</tr>
				<?php foreach($users as $user): ?>
					<tr>
						<td><?php $user->nick() ?></td>
						<td><?php $user->mail() ?></td>
						<td><a href="<?= rootURL() ?>action.php?a=accept&amp;id=<?= $user->id() ?>">Accepter</a</td>
						<td><a href="<?= rootURL() ?>action.php?a=accept&amp;id=<?= $user->id() ?>">Refuser</a</td>
					</tr>
				<?php endforeach ?>
			</table>
			<?php require("template/userSidebar.php") ?>
		</div>
<?php require("foot.php") ?>
