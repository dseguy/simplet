<?php

// ### Forum Topic Info Function ###
//
// Checks whether or not a category exists.
//
// Forum_Topic_Info('slug');

function Forum_Topic_Info($Topic_Slug) {

	// Set some Globals
	global $Database, $Member_Auth;

	// Count things first
	$Forum_Topic_Info_Query_Select = 'SELECT * FROM `Topics` WHERE `Slug`=\''.$Topic_Slug.'\' AND';

	// Limit by Status
	if ($Member_Auth) $Forum_Topic_Info_Query_Status = ' (`Status`=\'Public\' OR `Status`=\'Private\')';
	else $Forum_Topic_Info_Query_Status = ' `Status`=\'Public\'';

	// Order by Creation
	$Forum_Topic_Info_Query_Order = ' ORDER BY `Modified` DESC';

	// Build Responses_Query
	$Forum_Topic_Info_Query = $Forum_Topic_Info_Query_Select.$Forum_Topic_Info_Query_Status.$Forum_Topic_Info_Query_Order;

	// Get Responses
	$Forum_Topic_Info = mysqli_query($Database['Connection'], $Forum_Topic_Info_Query, MYSQLI_STORE_RESULT);
	if (!$Forum_Topic_Info) exit('Invalid Query (Forum_Topic_Info): '.mysqli_error($Database['Connection']));

	$Forum_Topic_Info_Count = mysqli_num_rows($Forum_Topic_Info);

	if ($Forum_Topic_Info_Count === 0) return false;
	else {
		$Forum_Topic_Info_Fetch = mysqli_fetch_assoc($Forum_Topic_Info);
		return $Forum_Topic_Info_Fetch;
	}

}
