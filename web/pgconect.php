<?php

$dbopts = parse_url(getenv('DATABASE_URL'));
$pgcon = pg_connect("host=".$dbopts['host']." port=".$dbopts['port']." dbname=".ltrim($dbopts["path"],'/')." user=".$dbopts['user']." password=".$dbopts['pass']);
pg_query($pgcon, "SET NAMES 'utf8'");


?>
