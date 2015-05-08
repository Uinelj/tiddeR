<div id="sidebar" class="block side">
	<div class="sidebar-element">
		<ul>
			<?php for($i = 0; $i<4; $i++): ?>
			<li>
				<?php if($_SESSION["order"] == $i): ?>
					<a href="<?= rootURL() ?><?= search() ?>+by+<?= $orders[$i] ?>" class="selected"><?= $orders[$i] ?></a>
				<?php else: ?>
					<a href="<?= rootURL() ?><?= search() ?>+by+<?= $orders[$i] ?>"><?= $orders[$i] ?></a>
				<?php endif ?>
			</li>
			<?php endfor ?>
		</ul>
	</div>
	<div class="sidebar-element">
		<ul>
			<?php foreach($tags as $tag): ?>
				<li>
					<?php if(in_array($tag, $_SESSION["tags"])): ?>
						<a href="<?= rootURL() ?><?= search() ?>+in+<?= $tag ?>" class="selected"><?= $tag ?></a>
					<?php else: ?>
						<a href="<?= rootURL() ?><?= search() ?>+in+<?= $tag ?>"><?= $tag ?></a>
					<?php endif ?>
				</li>
			<?php endforeach ?>
		</ul>
	</div>
</div>
