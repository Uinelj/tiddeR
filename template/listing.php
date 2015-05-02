<? require("head.php") ?>
		<div class="center">
			<? require("sidebar.php") ?>
			<div id="content" class="block main">
				<ul>
					<? foreach($posts as $posts): ?>
						<li class="post">
							<? require("post.php") ?>
						</li>
					<? endforeach ?>
				</ul>
			</div>
		</div>
<? require("foot.php") ?>