<?php
return array(
	//random alpha-numeric 32 characters for cookie encriptation
	"key" => "wgoKzmYuVRSRsZZsemSEKCFg8Pg0asY5",

	//use or not the build version
	"usedist" => false,

	//allowed directories that can have files downloaded from
	"downloadPaths" => array(
		"app/storage/"
	),

	//allowed directories that can have images resized automatically
	"thumbPaths" => array(
		"app/storage/",
		"app/assets/img/",
		"public/img/"
	)
);
?>