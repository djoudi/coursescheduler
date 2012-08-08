<?php

if($role != "admin"){
	echo "<div style='text-align:center;'><h3>You do not have permission to view this page.<br/>If you think this in error contact your site administrator.</h3></div>";
	exit();
	}