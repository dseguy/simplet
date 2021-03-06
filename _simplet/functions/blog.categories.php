<?php

////	Blog Categories Function
//
// Returns the Categories of posts in the caller directory and below as an array,
// along with the counts for each, sorted by most first.
//
// Categories(__DIR__);
// Categories(__DIR__, 'exclude-this-canonical');

function Blog_Categories($Caller, $Exclude = false) {

	global $Place, $Request;

	// List all the files
	$Items = globRecursive('*.php', GLOB_NOSORT);

	// Make an empty array
	$Categories_Return = array();

	// Order them by time
	array_multisort(array_map('filemtime', $Items), SORT_NUMERIC, SORT_DESC, $Items);

	// FOREACH: For each Item
	foreach ($Items as $Item) {

		// IFNOTTHIS: So long as it isn't this file
		if ($Item != $Caller) {

			// Require it
			require $Item;

			// IFPOST
			if ( $Page['Type'] === 'Blog Post' ) {

				// Add Category or Increment
				$Categories_Return[$Page['Category']] = isset($Categories_Return[$Page['Category']]) ? $Categories_Return[$Page['Category']]++ : 1;

			} // IFPOST

		} // IFNOTTHIS

	} // FOREACH

	// Unset current page to avoid require problems
	unset($Categories_Return['']);
	if ( $Exclude ) {
		unset($Categories_Return[$Exclude]);
	}

	// Order by Count
	arsort($Categories_Return);

	// Return Array
	return $Categories_Return;

}