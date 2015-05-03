		<div id="footer" class="center">
			<div class="block side">
				<p><a href="#top"><i class="fa fa-angle-double-up"></i> Top</a></p>
			</div>
			<div class="block main">
				<p>Created by <a href="http://uinelj.eu">Uinelj</a> &amp; <a href="http://akkes.fr">Ak:kes</a></p>
			</div>
			<div class="block side">
				<? if(isLogged()): ?>
					<p><a href="<?= rootUrl() ?>action.php?a=logout">Déconnexion <i class="fa fa-sign-out"></i></a></p>
				<? endif ?>
			</div>
		</div>
	</body>
</html>