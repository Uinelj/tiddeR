<div class="block side right disapear">
	<div class="sidebar-element">
		<? if(isLogged()): ?>
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
			</ul>
		<? endif ?>
	</div>
</div>