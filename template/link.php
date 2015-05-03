<? require("template/head.php") ?>
		<div class="center">
			<div id="sidebar" class="block side">
			</div>
			<div id="content" class="block main">
				<div class="post">
					<? require("template/post.php") ?>
				</div>
				<div id="comments">
					<ul>
						<? foreach($comments as $comment): ?>
							<? require("template/comment.php") ?>
						<? endforeach ?>
					</ul>
				</div>
			</div>
		</div>
<? require("template/foot.php") ?>