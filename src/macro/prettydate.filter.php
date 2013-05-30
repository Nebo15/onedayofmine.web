<?php
lmb_require('limb/macro/src/compiler/lmbMacroFunctionBasedFilter.class.php');

/**
 * @filter pretty_date
 * Class lmbMacroPrettyDateFilter
 */
class lmbMacroPrettyDateFilter extends lmbMacroFunctionBasedFilter
{
	protected $function = ['lmbMacroPrettyDateFilter', 'format'];
	protected $include_file = 'src/macro/prettydate.filter.php';

	static function format($stamp)
	{
		$date = new DateTime('@'.$stamp);
		$compareTo = new DateTime('now');

		$diff = $compareTo->format('U') - $date->format('U');
		$dayDiff = floor($diff / 86400);

		if(is_nan($dayDiff) || $dayDiff < 0) {
			return '';
		}

		if($dayDiff == 0) {
			if($diff < 60) {
				return 'Just now';
			} elseif($diff < 120) {
				return '1 minute ago';
			} elseif($diff < 3600) {
				return floor($diff/60) . ' minutes ago';
			} elseif($diff < 7200) {
				return '1 hour ago';
			} elseif($diff < 86400) {
				return floor($diff/3600) . ' hours ago';
			}
		} elseif($dayDiff == 1) {
			return 'Yesterday';
		} elseif($dayDiff < 7) {
			return $dayDiff . ' days ago';
		} elseif($dayDiff == 7) {
			return '1 week ago';
		} elseif($dayDiff < (7*6)) { // Modifications Start Here
			// 6 weeks at most
			return ceil($dayDiff/7) . ' weeks ago';
		} elseif($dayDiff < 365) {
			return ceil($dayDiff/(365/12)) . ' months ago';
		} else {
			$years = round($dayDiff/365);
			return $years . ' year' . ($years != 1 ? 's' : '') . ' ago';
		}
	}
}
