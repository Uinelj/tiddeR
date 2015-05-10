<div class="block side right disapear">
	<div class="sidebar-element">
		<?php if(isLogged()): ?>
			<ul>
				<li>
					<a href="<?= rootUrl() ?>action.php?a=logout">Déconnexion <i class="fa fa-sign-out"></i></a>
				</li>
				<li>
					<a href="<?= rootURL() ?>u/<?= $_SESSION["nick"] ?>">Posts</a>
				</li>
				<li>
					<a href="<?= rootURL() ?>c/<?= $_SESSION["nick"] ?>">Commentaires</a>
				</li>
				<?php if($_SESSION['perms']===2): ?>
					<li>
						<a href="<?= rootURL() ?>admin.php">Administration</a>
					</li>
				<?php endif ?>
			</ul>
		<?php endif ?>
	</div>
</div>
