<h2 class="block three-quarter title"><?= $post->title() ?></h2>
<p class="block quarter disapear date"><?= $post->date() ?></p>
<p><?= $post->content() ?></p>
<div class="disapear">
	<ul class="block third tags">
		<? foreach($post->tags() as $tag): ?>
			<li><a href="<?= rootURL() ?>#etLaFautTrouverCommentAjouterAuxTagsActives">$tag</a></li>
		<? endforeach ?>
	</ul>
	<p class="block third author">Uinelj</p>
	<div class="block third">
		<ul class="block rating">
			<? for($i = 1; $i <= 5; $i++): ?>
				<? if($post->rating()<=$i): ?>
					<li class="block"><a href="<?= rootURL() ?>action.php?a=vote&amp;v=<?= $i ?>" class="fa fa-star"></a></li>
				<? else: ?>
					<li class="block"><a href="<?= rootURL() ?>action.php?a=vote&amp;v=<?= $i ?>" class="fa fa-star-o"></a></li>
				<? endif ?>
			<? endfor ?>
		</ul>
	</div>
</div>