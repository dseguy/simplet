<?php

////	Forum Topic Check Function
// 
// Counts the Responses to a given Topic.
// 
// Forum_Topic_Count('slug');

function Forum_Topic_Count($Topic_Slug, $Status_Check = false) {
	
	global $Database;
	
	$Forum_Topic_Count = 'SELECT COUNT(`Canonical`) AS `Count` FROM `'.$Database['Prefix'].'Responses` WHERE `Canonical`=\''.$Topic_Slug.'\' AND (`Status`=\'Public\' OR `Status`=\'Private\')';
	$Forum_Topic_Count = mysqli_query($Database['Connection'], $Forum_Topic_Count, MYSQLI_STORE_RESULT);
	
	// IFQUERY Unsuccessful
	if (!$Forum_Topic_Count) {
		if ( $Sitewide_Debug ) echo 'Invalid Query (Forum_Topic_Count): '.mysqli_error($Database['Connection']);
		return false;
		
	// IFQUERY Successful
	} else {
		$Forum_Topic_Count_Fetch = mysqli_fetch_assoc($Forum_Topic_Count);
		return $Forum_Topic_Count_Fetch['Count'];
		
	} // IFQUERY
	
}