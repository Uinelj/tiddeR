<?php require("template/head.php") ?>
		<div class="center">
			<?php require("template/sidebar.php") ?>
			<div id="content" class="block main">
				<ul>
					<?php if(!isset($posts)): echo "<h1>PROBLEM</h1>"; endif ?>
					<?php foreach($posts as $post): ?>
						<li class="post">
							<?php require("template/post.php") ?>
						</li>
					<?php endforeach ?>
					<?php if(count($posts) === 0): ?>
						<h2>Aucun post</h2>
					<?php endif ?>
				</ul>
			</div>
			<?php require("template/userSidebar.php") ?>
		</div>
<?php require("template/foot.php") ?>
