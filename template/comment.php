<li id="comment-<?= $comment->id() ?>" class="comment">
	<h3 class="block half"><a href="<?= rootURL() ?>u/<?= $comment->author() ?>"><?= $comment->author() ?></a></h3>
	<span class="block half date disapear"><a href="<?= rootURL() ?>post.php?id=<?= $post->id() ?>#comment-<?= $comment->id() ?>"><?= $comment->date() ?></a></span>
	<p><?= $comment->content() ?></p>
</li>