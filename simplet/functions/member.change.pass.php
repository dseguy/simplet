<?php

////	Account Change Pass Function
//
// Changes an accounts pass.

function Member_Change_Pass($Redirect = true) {

	global $Database, $Error, $Member_ID, $Sitewide_Account, $Sitewide_Debug, $Success, $Time;

	// IF CSRF Okay
	if ( Runonce_CSRF_Check($_POST['csrf_protection']) ) {
		// Sanitize Pass
		$Member_Pass_New = Input_Prepare($_POST['pass']);
		// IF Pass is Empty
		if ( empty($Member_Pass_New) ) {
			$Error = '<h3 class="color-pomegranate">Your new Pass cannot be empty.</h3>';
		// END IF Pass is Empty
		// IF Pass is not Empty
		} else {
			// Generate a new Salt.
			$Member_Salt = Generator_String();
			// Hash the new Pass.
			$Member_Pass_Hash = Pass_Hash($Member_Pass_New, $Member_Salt);
			// Now forget the Pass immediately.
			unset($Member_Pass_New);
			// Construct Query
			$Pass_Change = 'UPDATE `'.$Database['Prefix'].'Members`';
			$Pass_Change .= ' SET `Pass`=\''.$Member_Pass_Hash.'\', `Salt`=\''.$Member_Salt.'\', `Modified`=\''.$Time.'\'';
			$Pass_Change .= ' WHERE `ID`=\''.$Member_ID.'\' AND `Status`=\'Active\'';
			// Execute Query
			$Pass_Change = mysqli_query($Database['Connection'], $Pass_Change, MYSQLI_STORE_RESULT);
			// IF Pass not Changed
			if ( !$Pass_Change ) {
				if ( $Sitewide_Debug ) {
					echo 'Invalid Query (Pass_Change): '.mysqli_error($Database['Connection']);
				}
				$Error = '<h3 class="color-pomegranate">Pass could not be changed.</h3>';
			// END IF Pass not Changed
			// IF Pass Changed
			} else {
				// Redirect
				if ( $Redirect ) {
					header('Location: '.$Sitewide_Account, true, 302);
				}
				$Success = true;
			} // IF Pass Changed

		} // END IF Pass is not Empty

	// END IF CSRF Okay
	// IF CSRF Not Okay
	} else {
		$Error = '<h3 class="color-pomegranate margin-0">Your Pass could not be changed.</h3>';
		$Error .= '<p class="text-center">Your security token did not match. Please try again.</p><br>';
	} // END IF CSRF Not Okay

}