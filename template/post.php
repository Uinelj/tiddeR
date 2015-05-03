<h2 class="block three-quarter title"><a href="<?= $post->link() ?>"><?= $post->title() ?></a></h2>
<p class="block quarter disapear date"><a href="<?= rootURL() ?>p/<?= $post->id() ?>"><?= $post->date() ?></a></p>
<p><?= $post->content() ?></p>
<div class="disapear">
	<ul class="block third tags">
		<? foreach($post->tags() as $tag): ?>
			<li><a href="<?= rootURL() ?>t/<?= $tag ?>"><?= $tag ?></a></li>
		<? endforeach ?>
	</ul>
	<p class="block third author"><a href="<?= rootURL() ?>u/<?= $post->author() ?>"><?= $post->author() ?></a></p>
	<div class="block third rating">
		<ul>
			<? for($i = 1; $i <= 5; $i++): ?>
				<? if($post->rating()>=$i): ?>
					<li class="block"><a href="<?= rootURL() ?>action.php?a=vote&amp;id=<?= $post->id() ?>&amp;v=<?= $i ?>" class="fa fa-star"></a></li>
				<? else: ?>
					<li class="block"><a href="<?= rootURL() ?>action.php?a=vote&amp;id=<?= $post->id() ?>&amp;v=<?= $i ?>" class="fa fa-star-o"></a></li>
				<? endif ?>
			<? endfor ?>
		</ul>
	</div>
</div>