<?php

////	Runonce Create
//
// Create a runonce key by Key and Owner
// All parameters are optional.
// Key is the string for the key. It is automatically generated if not passed.
// Key_Owner is the Member_ID of the owner. This should be who created it, or the person to reset if a password reset.
// Timeout is a unix timestamp of when to expire.
// Uses is how many times it can be used.
// Notes are arbitrary descriptive text.
//
// Create a single use key that expires in 1 hour.
// Runonce_Create();
//
// Create a 1 day key.
// Runonce_Create($Time+(60*60*24));
//
// Create an unlimited use 1 hour key.
// Runonce_Create('1hour', 0);
//
// Create a single use unlimited time key.
// Runonce_Create(0, 1);
//
// Create a coupon that expires in 1 day limited to th first 100 people.
// Runonce_Create($Time+(60*60*24), 100);
//
// Add a note as an explanation.
// Runonce_Create('1hour', 1, 'Password Reset');
//
// Specify the Key.
// Runonce_Create('1hour', 1, 'Password Reset', 'resetme');
//
// Specify the Owner.
// Runonce_Create('1hour', 1, 'Password Reset', 'resetme', 'admin');

function Runonce_Create($Timeout = '15mins', $Uses = 1, $Notes = '', $Key = '', $Key_Owner = '') {

	// Set some Globals so the required scripts don't error.
	global $Database, $Member_ID, $Time, $Time_15mins, $Time_1hour, $User_IP;

	// IFEXISTSRUNONCE
	if ( !$Database['Exists']['Runonce'] ) return false;
	else {

		if ( empty($Key) ) $Key = Generator_String();
		if ( empty($Key_Owner) ) $Key_Owner = $Member_ID;

		// TODO Make timeout intelligent using end of string
		if ($Timeout == '15mins') $Timeout = $Time['15mins'];
		if ($Timeout == '1hour') $Timeout = $Time['1hour'];

		$Key_New = 'INSERT INTO `'.$Database['Prefix'].'Runonce` (`Member_ID`, `Key`, `Status`, `IP`, `Timeout`, `Uses`, `Created`, `Modified`, `Notes`) VALUES (\''.$Key_Owner.'\', \''.$Key.'\', \'Active\', \''.$User_IP.'\', \''.$Timeout.'\', \''.$Uses.'\', \''.$Time['Now'].'\', \''.$Time['Now'].'\', \''.$Notes.'\')';
		$Key_New = mysqli_query($Database['Connection'], $Key_New, MYSQLI_STORE_RESULT);
		if (!$Key_New) return array('Error' => 'Invalid Query (Key_New): '.mysqli_error($Database['Connection']));

		return array(
			'Key' => $Key,
			'Key_Owner' => $Key_Owner,
			'Key_IP' => $User_IP,
			'Key_Timeout' => $Timeout,
			'Key_Uses' => $Uses,
			'Key_Time' => $Time,
			'Key_Notes' => $Notes,
		);

	} // IFEXISTSRUNONCE

}