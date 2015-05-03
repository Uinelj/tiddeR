<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1" />
		<title>tiddeR</title>
		<link rel="stylesheet" type="text/css" href="<?= rootURL() ?>template/style.css" />
	</head>
	<body>
		<div id="top" class="center">
			<div id="header" class="block side">
				<h1 id="title"><a href="<?= rootUrl() ?>">tiddeR</a></h1>
			</div>
			<div id="search" class="block main">
				<form action="index.php">
					<fieldset>
						<input type="text" name="search" value="<?= search() ?>"/>
					</fieldset>
				</form>
			</div>
			<div id="user" class="block side disapear">
				<? if(isLogged()): ?>
					<a href="<?= rootUrl() ?>post.php">Poster <i class="fa fa-pencil"></i></a>
				<? else: ?>
					<a href="<?= rootUrl() ?>login.php">Connexion <i class="fa fa-sign-in"></i></a>
				<? endif ?>
			</div>
		</div>