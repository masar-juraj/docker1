<?php

/**
CREATE TABLE messages (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	text TEXT NOT NULL,
	datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);
INSERT INTO messages(name,text) VALUES('Juraj','Ahojte');
*/

$host = "192.168.160.2";
$database = "guestbook";
$username = "guestbook";
$password = "Passw0rd";


$mysqli = new mysqli($host, $username, $password, $database);
if ($mysqli->connect_errno)
	throw new RuntimeException('mysqli error: ' . $mysqli->connect_error);

$mysqli->set_charset('utf8');
if ($mysqli->errno)
	throw new RuntimeException('mysqli error: ' . $mysqli->error);


if (strlen($_POST['name']) > 0)
	$message['name'] = addslashes($_POST['name']);
if (strlen($_POST['text']) > 0)
	$message['text'] = addslashes($_POST['text']);

if ($message['name'] && $message['text']) {
	$query = 'INSERT INTO messages(name,text) VALUES("' . $message['name'] . '","' . $message['text'] . '");';	
	$result = $mysqli->query($query);
	if ($mysqli->errno)
		throw new RuntimeException('mysqli error: ' . $mysqli->error);
}
?>
<html>
	<head>
		<title>Guestbook App</title>
		<meta charset="UTF-8">
		<style>
			body {background-color: powderblue;}
			h1 { text-align: center; }
			h2 { text-align: left; margin-top: 30px; margin-bottom: 30px; }
			table { width: 100%; border-collapse: collapse; border: 1px solid; }
			th, td { border: 1px solid; }
			#text { width: 300px; }
		</style>
	</head>
	<body>
		<h1>Guestbook App</h1>
		<h2>Add Message</h2>
		<form method="POST" action="index.php">
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" value="<?php echo $message['name']; ?>">
			<label for="text">Text:</label>
			<input type="text" id="text" name="text" value="<?php echo $message['text']; ?>">
			<input type="submit" value="Submit">
		</form>
<?php
$result = $mysqli->query("SELECT id,name,text,datetime FROM messages;");
if ($mysqli->errno) {
	throw new RuntimeException('mysqli error: ' . $mysqli->error);
}
if($result) {
?>
		<h2>Message list</h2>
		<table> 
		<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Message</th>
			<th>Datetime</th>
		</tr>
		</thead>
		<tbody>
<?php
	foreach ($result as $row) {
?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['text']; ?></td>
			<td><?php echo $row['datetime']; ?></td>
		</tr>
<?php
	}
?>
		</tbody>
		</table>
<?php
} else {
	echo 'Table messages is empty.';
}
?>
	</body>
</html>
<?php
$mysqli->close();
?>
