<?php 
require("../private/config.php"); // this is for the classes autoloader and allat.
use watrlabs\pages\builder;
$pages = new builder();

$pages->loadtemplate("header"); // might improve this and actually use blade (php templating thing)
// page content...
?>
<div id="main">
    <h1>tests</h1>
</div>
<? $pages->loadtemplate("footer") ?>
