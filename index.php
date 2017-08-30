<?php 
session_start();

if(!empty($_GET['lang'])){
	$_SESSION['lang'] = $_GET['lang'];
}

require_once 'Lang.php';
$lang = new Lang();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Linguagens PHP</title>
</head>
<body>
	<a href="?lang=en">English</a>
	<a href="?lang=pt-br">Portugues</a>
	<hr>
	<h2><?php echo $lang->get('NAME'); ?> Esveraldo </h2>
	<h3><?php echo $lang->get('TRANSLATOR'); ?></h3>
	<hr>
	<p>Linguagem <?= $lang->getLanguage(); ?></p>
	<hr>
	<?php echo $_SESSION['lang']; ?>
</body>
</html>