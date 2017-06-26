<?php
if ($_POST['link']) {
	if ($_POST['customLink']) {
		$link = $_POST['customLink'];
	} else {
		$link = $_POST['link'];
	}
	$domain;
	$protocol;
	$linkArr = explode ('.', $link);
	if (sizeOf ($linkArr) > 1 && $linkArr[sizeOf ($linkArr)-1] != "") {
		$domain = "." . $linkArr[sizeOf($linkArr)-1];
		$link = substr ($link, 0, -strlen ($domain));
		$linkArr = explode('://', $link);
		if (sizeOf ($linkArr) > 1) {
			$protocol = $linkArr[0] . "://";
			$link = $linkArr[1];
		} else {
			$protocol = "";
		}
		$linkArr = explode ('.', $link);
		if (sizeOf ($linkArr) > 1) {
			if ($linkArr[0] === "www") {
				$link = $linkArr[1];
			} else {
				$link = preg_replace('/[^\p{L}\p{N}\s]/u', '', $link);
			}
		}
		if ($_POST['customLink']) {
			echo '<a href="' . $_POST['link'] . '">' . $protocol . $link . $domain . '</a>';
		} else {
			$middle = floor(strlen ($link) / 2);
			$result = substr($link, 0, $middle);
			echo '<a href="' . $_POST['link'] . '">' . $protocol . $result . $domain . '<a>';
		}
	} else {
		echo "Enter correct URL";
	}	
}
?>