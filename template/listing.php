<? require("template/head.php") ?>
		<div class="center">
			<? require("template/sidebar.php") ?>
			<div id="content" class="block main">
				<ul>
					<? if(!isset($posts)): echo "<h1>PROBLEM</h1>"; endif ?>
					<? foreach($posts as $post): ?>
						<li class="post">
							<? require("template/post.php") ?>
						</li>
					<? endforeach ?>
					<? if(count($posts) === 0): ?>
						<h2>Aucun post</h2>
					<? endif ?>
				</ul>
			</div>
			<? require("template/userSidebar.php") ?>
		</div>
<? require("template/foot.php") ?>