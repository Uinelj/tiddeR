<div id="sidebar" class="block side">
	<div class="sidebar-element">
		<ul>
			<li>
				<a href="<?= rootURL() ?>a=order&amp;o=1">Popular</a>
			</li>
			<li>
				<a href="<?= rootURL() ?>a=order&amp;o=2" class="selected">Recents</a>
			</li>
			<li>
				<a href="<?= rootURL() ?>a=order&amp;o=3">Best</a>
			</li>
			<li>
				<a href="<?= rootURL() ?>a=order&amp;o=4">Controversé</a>
			</li>
		</ul>
	</div>
	<div class="sidebar-element">
		<ul>
			<? foreach($tags as $tag): ?>
				<li>
					<? if($tag == $_GET["tag"]): ?>
						<a href="<?= rootURL() ?>t/<?= $tag ?>" class="selected"><?= $tag ?></a>
					<? else: ?>
						<a href="<?= rootURL() ?>t/<?= $tag ?>"><?= $tag ?></a>
					<? endif ?>
				</li>
			<? endforeach ?>
		</ul>
	</div>
</div>