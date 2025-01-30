<?php

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
  $protocol = 'http://';
} else {
  $protocol = 'https://';
}
$ROOT_URL = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/";

$media_dir = "media";
$media_files = scandir($media_dir);

echo '<rss version="2.0" xmlns:jwplayer="http://rss.jwpcdn.com/">' . PHP_EOL;
echo '<channel>' . PHP_EOL . PHP_EOL;
header("Access-Control-Allow-Origin: *");
header("Content-type: application/xml");
foreach($media_files as $item) {
    if($item!="." && $item!="..") {
	$title = $item;
	$title = substr($title, 0, (strlen ($title)) - (strlen (strrchr($title,'.'))));
	$description = substr($item, 0, (strlen ($item)) - (strlen (strrchr($item,'.'))));
	$file = rawurlencode($item);

$file = str_replace(
array("\/\/","\/"),
array("//", "/"),
$file
);

$title = str_replace(
array("&","\/"),
array("&amp;", "/"),
$title
);

$description = str_replace(
array("&","\/"),
array("&amp;", "/"),
$description
);

$player_files = $ROOT_URL . $media_dir . "/" . $file;

    echo "<item>" . PHP_EOL;
	echo "<title>{$title}</title>" . PHP_EOL;
    echo "<description>". $description . "</description>" . PHP_EOL;
    echo "<jwplayer:image>https://png.kodi.al/tv/albdroid/logo_bar.png</jwplayer:image>" . PHP_EOL;
    echo '<jwplayer:source file="'.$player_files.'" />' . PHP_EOL;
    echo "</item>" . PHP_EOL . PHP_EOL;
   }
}
echo "</channel>" . PHP_EOL;
echo "</rss>" . PHP_EOL;