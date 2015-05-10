<h2 class="block three-quarter title"><a href="<?= $post->link() ?>"><?= $post->title() ?></a></h2>
<p class="block quarter disapear date"><a href="<?= rootURL() ?>p/<?= $post->id() ?>"><?= $post->date() ?></a></p>
<p><?= $post->content() ?></p>
<div class="disapear">
	<ul class="block third tags">
		<?php foreach($post->tags() as $tag): ?>
			<li><a href="<?= rootURL() ?>t/<?= $tag ?>"><?= $tag ?></a></li>
		<?php endforeach ?>
	</ul>
	<p class="block third author">
		<?php if($_SESSION['perms'] === 2 || $_SESSION['id'] === $user->id()): ?>
				<a href="<?= rootURL() ?>action.php?a=delPost&amp;id=<?= $post->id() ?>"><i class="fa fa-trash"></i></a>
				<a href="<?= rootURL() ?>post.php?edit=true&amp;id=<?= $post->id() ?>"><i class="fa fa-pencil"></i></a>
		<?php else: ?>
			<a href="<?= rootURL() ?>u/<?= $post->author() ?>"><?= $post->author() ?></a>
		<?php endif ?>
	</p>
	<div class="block third rating">
		<ul>
			<?php for($i = 1; $i <= 5; $i++): ?>
				<?php if($post->rating()>=$i): ?>
						<li class="block"><a href="<?= rootURL() ?>action.php?a=vote&amp;id=<?= $post->id() ?>&amp;v=<?= $i ?>" class="fa fa-star"></a></li>
				<?php else: ?>
						<li class="block"><a href="<?= rootURL() ?>action.php?a=vote&amp;id=<?= $post->id() ?>&amp;v=<?= $i ?>" class="fa fa-star-o"></a></li>
				<?php endif ?>
			<?php endfor ?>
		</ul>
	</div>
</div>
