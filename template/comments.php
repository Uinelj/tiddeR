<?php require("template/head.php") ?>
		<div class="center">
			<?php require("template/sidebar.php") ?>
			<div id="content" class="block main">
				<ul>
					<?php foreach($comments as $comment): ?>
						<li class="post">
							<?php require("template/comment.php") ?>
						</li>
					<?php endforeach ?>
					<?php if(count($comments) === 0): ?>
						<h2>Aucun post</h2>
					<?php endif ?>
				</ul>
			</div>
			<?php require("template/userSidebar.php") ?>
		</div>
<?php require("template/foot.php") ?>
