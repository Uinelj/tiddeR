<div id="sidebar" class="block side">
	<div class="sidebar-element">
		<ul>
			<?php for($i = 0; $i<4; $i++): ?>
			<li>
				<?php if($_SESSION["order"] == $i): ?>
					<a href="<?= rootURL() ?>action.php?a=order&amp;o=<?= $i ?>&amp;ref=<?= referer() ?>" class="selected"><?= $orders[$i] ?></a>
				<?php else: ?>
					<a href="<?= rootURL() ?>action.php?a=order&amp;o=<?= $i ?>&amp;ref=<?= referer() ?>"><?= $orders[$i] ?></a>
				<?php endif ?>
			</li>
			<?php endfor ?>
		</ul>
	</div>
	<div class="sidebar-element">
		<ul>
			<?php foreach($tags as $tag): ?>
				<li>
					<?php if($tag == $selectedTag): ?>
						<a href="<?= rootURL() ?>t/<?= $tag ?>" class="selected"><?= $tag ?></a>
					<?php else: ?>
						<a href="<?= rootURL() ?>t/<?= $tag ?>"><?= $tag ?></a>
					<?php endif ?>
				</li>
			<?php endforeach ?>
		</ul>
	</div>
</div>
