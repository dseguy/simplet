<?php

////	Runonce CSRF Create
//
// Create a new CSRF Key for the current session.
//
// Runonce_CSRF_Create();

function Runonce_CSRF_Create() {

	// Set some Globals so the required scripts don't error.
	global $Backend, $Cookie, $Member, $Request, $Time;

	require_once $Backend['functions'].'generator.string.php';
	require_once $Backend['functions'].'runonce.create.php';

	if ( $Member['ID'] ) {
		$Owner = $Member['ID'];
	} else {
		$Owner = '*';
	}

	$Key = Generator_String();

	$Timeout = $Time['1month'];

	// Create a 28 day CSRF Protection Key
	$Runonce_CSRF_Create = Runonce_Create($Timeout, 0, 'CSRF Protection', $Key, $Owner);
	setcookie($Cookie['CSRF'], $Runonce_CSRF_Create['Key'], $Time['1month'], '/', $Request['Host'], $Request['Secure'], $Request['HTTPOnly']);
	return $Runonce_CSRF_Create;

}