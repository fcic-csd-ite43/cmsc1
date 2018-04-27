<?php
/*
	Contain the common functions 
	required in pages and admin pages
*/

function getPagingQuery($sql, $itemPerPage = 10)
{
	if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
		$page = (int)$_GET['page'];
	} else {
		$page = 1;
	}
	
	// start fetching from this row number
	$offset = ($page - 1) * $itemPerPage;
	
	return $sql . " LIMIT $offset, $itemPerPage";
}

/*
	Get the links to navigate between one result page to another.
	Supply a value for $strGet if the page url already contain some
	GET values for example if the original page url is like this :
	
	http://www.fcic.net.ph/index.php?c=12
	
	use "c=12" as the value for $strGet. But if the url is like this :
	
	http://www.phpwebcommerce.com/mogmarket/index.php
	
	then there's no need to set a value for $strGet
	
	
*/
function getPagingLink($sql, $itemPerPage = 10, $strGet = '$catId')
{
	$result        = dbQuery($sql);
	$pagingLink    = '';
	$totalResults  = dbNumRows($result);
	$totalPages    = ceil($totalResults / $itemPerPage);
	
	// how many link pages to show
	$numLinks      = 10;

		
	// create the paging links only if we have more than one page of results
	if ($totalPages > 1) {
	
		$self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ;
		

		if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
			$pageNumber = (int)$_GET['page'];
		} else {
			$pageNumber = 1;
		}
		
		// print 'previous' link only if we're not
		// on page one
		if ($pageNumber > 1) {
			$page = $pageNumber - 1;
			
				$prev = " <a href=\"$self?page=$page&$strGet\"><img src=\"/images/btn_prev.gif\" alt=\"prev\" /></a> ";
				
				
			//$first = " <a href=\"$self?page=$page&$strGet\"><img src=\"/mogmarket/images/btn_first.gif\" alt=\"first\" /></a> ";
		} else {
			$prev  = "<img src=\"/images/btn_prev2.gif\" alt=\"prev\" /> "; // we're on page one, don't show 'previous' link
			//$first = ''; // nor 'first page' link
		}
	
		// print 'next' link only if we're not
		// on the last page
		if ($pageNumber < $totalPages) {
			$page = $pageNumber + 1;
			$next = " <a href=\"$self?page=$page&$strGet\"><img src=\"/images/btn_next.gif\" alt=\"next\" /></a>";
			//$last = " <a href=\"$self?page=$page&$strGet\"><img src=\"/mogmarket/images/btn_last.gif\" alt=\"last\" /></a> ";
		} else {
			$next = "<img src=\"/images/btn_next2.gif\" alt=\"next\" />"; // we're on the last page, don't show 'next' link
			//$last = ''; // nor 'last page' link
		}

		$start = $pageNumber - ($pageNumber % $numLinks) + 1;
		$end   = $start + $numLinks - 1;		
		
		$end   = min($totalPages, $end);
		
		$pagingLink = array();
		for($page = $start; $page <= $end; $page++)	{
			if ($page == $pageNumber) {
				$pagingLink[] = "[ $page ] ";   // no need to create a link to current page
			} else {
				
					$pagingLink[] = " <a href=\"$self?page=$page&$strGet\">[ $page ] </a> ";
					
			}
	
		}
		
		$pagingLink = implode($pagingLink);
		
		// return the page navigation link
		//$pagingLink = $first . $prev . $pagingLink . $next . $last;
		$pagingLink = $prev . $pagingLink . $next;
	}
	
	return $pagingLink;
}
?>