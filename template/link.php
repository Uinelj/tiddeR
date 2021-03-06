<?php require("template/head.php") ?>
		<div class="center">
			<?php require("template/sidebar.php") ?>
			<div id="content" class="block main">
				<div class="post">
					<?php require("template/post.php") ?>
				</div>
				<div id="comments">
					<ul>
						<?php foreach($comments as $comment): ?>
							<?php require("template/comment.php") ?>
						<?php endforeach ?>
					</ul>
				</div>
				<?php if(isLogged()): ?>
					<div id="comment">
						<form class="block full" action="<?= rootURL() ?>action.php?a=comment&amp;id=<?= $post->id()?>" method="post">
							<h2>Commenter</h2>
							<textarea name="msg" rows="5"></textarea>
							<button name="button">Connexion <i class="fa fa-sign-in"></i></button>
						</form>
					</div>
				<?php endif ?>
			</div>
		</div>
<?php require("template/foot.php") ?>
