<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>tiddeR</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<div id="top" class="center">
			<div id="header" class="block side">
				<h1 id="title">tiddeR</h1>
			</div>
			<div id="search" class="block main">
				<form action="index.php">
					<input type="text" name="search" value="* by date"/>
				</form>
			</div>
			<div id="user" class="block side disapear">
				<a href="#">Ak:kes <span class="fa fa-user"/></a>
			</div>
		</div>
		<div class="center">
			<div id="sidebar" class="block side">
				<div class="sidebar-element">
					<ul>
						<li>
							<a href="#">Popular</a>
						</li>
						<li>
							<a href="#" class="selected">Recents</a>
						</li>
						<li>
							<a href="#">Best</a>
						</li>
						<li>
							<a href="#">Controversé</a>
						</li>
					</ul>
				</div>
				<div class="sidebar-element">
					<ul>
						<?php foreach(tagsList() as $tag): //TODO: verify URL struct?>
						<li>
							<a href="<?=actualURL()?>&amp;addtag=<?=$tag ?>"><?=$tag ?></a>
						</li>
						<?php endforeach?>
					</ul>
				</div>
			</div>
			<div id="content" class="block main">
				<ul>
					<?php foreach(postsList() as $post): ?>
					<li class="post">
						<h2 class="block three-quarter title"><a href="<?=$post['url'] ?>"><?=$post['name'] ?></a></h2>
						<p class="block quarter disapear date"><?=$post['date'] ?></p>
						<p><?=$post['content'] ?></p>
						<div class="disapear">
							<ul class="block third tags">
								<?php foreach($post['tags'] as $tag): ?>
								<li><a href="tag.php?id=<?=$tag ?>"><?=$tag ?></a></li>
								<?php endforeach ?>
							</ul>
							<p class="block third author">Uinelj</p>
							<ul class="block third rating">
								<?php for($i=1; $i<6; $i++): ?>
								<li class="block"><a href="action.php?a=vote&amp;id=<?=$post['id'] ?>&amp;v=<?=$i ?>" class="fa fa-star<?php if($i>$post['note']) echo"-o"; ?>"></a></li>
								<?php endfor?>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div id="footer" class="center">
			<div class="block side">
				<p><a href="#top">^Top</a></p>
			</div>
			<div class="block main">
				<p>Created by <a href="http://uinelj.eu">Uinelj</a> &amp; <a href="http://akkes.fr">Ak:kes</a></p>
			</div>
		</div>
	</body>
</html>