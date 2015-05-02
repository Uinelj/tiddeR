<? require("head.php") ?>
		<div class="center">
			<? require("sidebar.php") ?>
			<div id="content" class="block main">
				<div class="post">
					<? require("post.php") ?>
				</div>
				<div id="comments">
					<ul>
						<? foreach($comments as $comment): ?>
							<? require("comment.php") ?>
						<? endforeach ?>
					</ul>
				</div>
			</div>
		</div>
<? require("foot.php") ?>