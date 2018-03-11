<!doctype html>
<html>
<head>
<title>My webapp!</title>
</head>
<body>
<h1>This is my awesome web application</h1>
<h3>Last 10 requests</h3>
<?php

include_once('config.php');

$link = mysql_connect("$dbhost:$dbport", $dbuser, $dbpass);
if(!$link) {
    die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db($dbname, $link);
if(!$db_selected) {
    die('Could not select database: ' . mysql_error());
}

$query = 'CREATE TABLE IF NOT EXISTS `access` (
    id int NOT NULL AUTO_INCREMENT,
    useragent varchar(255),
    requesttime int,
    PRIMARY KEY (id)
);';

mysql_query($query);

$query = 'INSERT INTO access (useragent, requesttime)
    VALUES (\'' . $_SERVER['HTTP_USER_AGENT'] . '\', '. $_SERVER['REQUEST_TIME'] . ');';

$db_inserted = mysql_query($query);
if(!$db_inserted) {
    die('Could not insert into database: ' . mysql_error());
}

$query = 'SELECT * FROM access ORDER BY id DESC LIMIT 10;';

$selected = mysql_query($query);

if(!$selected) {
    die('Could not select from database: ' . mysql_error());
}

print('<ul>');
while($row = mysql_fetch_array($selected, MYSQL_ASSOC)) {
    printf('<li>%s - %s', $row['requesttime'], $row['useragent']);
}
print('</ul>');

mysql_close($link);
?>
</body>
</html>
