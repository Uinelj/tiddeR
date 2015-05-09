<div id="sidebar" class="block side">
	<div class="sidebar-element">
		<ul>
			<?php for($i = 0; $i<4; $i++): ?>
			<li>
				<?php if($_SESSION["order"] == $i): ?>
					<a href="<?= rootURL() ?>index.php?search=<?=editOrder(search()) ?>" class="selected"><?= $orders[$i] ?></a>
				<?php else: ?>
					<a href="<?= rootURL() ?>index.php?search=<?=editOrder(search(), $orders[$i]) ?>" ><?= $orders[$i] ?></a>
				<?php endif ?>
			</li>
			<?php endfor ?>
		</ul>
	</div>
	<div class="sidebar-element">
		<ul>
			<?php foreach($tags as $tag): ?>
				<li>
					<?php if(!empty($_SESSION["tags"]) && in_array($tag, $_SESSION["tags"], 1)): ?>
						<a href="<?= rootURL() ?>index.php?search=<?= rmTag(search(), $tag) ?>" class="selected"><?= $tag ?></a>
					<?php else: ?>
						<a href="<?= rootURL() ?>index.php?search=<?= addTag(search(), $tag) ?>"><?= $tag ?></a>
					<?php endif ?>
				</li>
			<?php endforeach ?>
		</ul>
	</div>
</div>
