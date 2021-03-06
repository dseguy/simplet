<?php

////	Runonce Check
//
// Check a runonce key exists and is not expired by Key and Owner
// Key_Owner defaults to Member_ID if not set.
// Set to '*' to avoid checking.
//
// Runonce_Check('key');
// Runonce_Check($Key_ID, $Member_ID);
// Runonce_Check($Key_ID, $Key_Owner);
// Runonce_Check('key', '*');

function Runonce_Check($Key, $Key_Owner = '', $Key_Notes = '*') {

	// Set some Globals so the required scripts don't error.
	global $Backend, $Database, $Member, $Time;

	// IFEXISTSRUNONCE
	if ( !$Database['Exists']['Runonce'] ) {
		return false;
	} else {

		if ( empty($Key_Owner) ) {
			$Key_Owner = $Member['ID'];
		}

		$Key_Query = 'SELECT * FROM `'.$Database['Prefix'].'Runonce` WHERE';
		$Key_Query .= ' `Key`=\''.$Key.'\' AND `Status`=\'Active\'';
		if ($Key_Owner !== '*') {
			$Key_Query .= ' AND ( `Member_ID`=\''.$Key_Owner.'\' OR `Member_ID`=\'*\')';
		}
		if ($Key_Notes !== '*') {
			$Key_Query .= ' AND `Notes`=\''.$Key_Notes.'\'';
		}
		$Key_Query .= ' AND `Timeout` > \''.$Time['Now'].'\'';
		$Key_Query .= ' LIMIT 0, 1';

		$Key_Check = mysqli_query($Database['Connection'], $Key_Query, MYSQLI_STORE_RESULT);
		if (!$Key_Check) {
			if ( $Backend['Debug'] ) {
				return array('Error' => 'Invalid Query (Key_Check): '.mysqli_error($Database['Connection']));
			}
			return false;
		}

		$Key_Count = mysqli_num_rows($Key_Check);

		// IFKEYCOUNT
		if ( $Key_Count > 0 ) {

			$Key_Check_Fetch = mysqli_fetch_assoc($Key_Check);

			if (
				$Key_Check_Fetch['Uses'] > $Key_Check_Fetch['Used'] || // If it has uses left
				$Key_Check_Fetch['Uses'] == 0 // Or it doesn't have a limit
				// TODO IP Check too
			) {
				return $Key_Check_Fetch;
			} else {
				return false;
			}

		// IFKEYCOUNT
		} else {
			return false;
		}

	} // IFEXISTSRUNONCE

}