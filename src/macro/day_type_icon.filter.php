<?php
lmb_require('limb/macro/src/compiler/lmbMacroFunctionBasedFilter.class.php');
/**
 * @filter day_type_icon
 */
class lmbMacroDayTypeIconFilter extends lmbMacroFunctionBasedFilter
{
	protected $function = ['lmbMacroDayTypeIconFilter', 'format'];
	protected $include_file = 'src/macro/day_type_icon.filter.php';

	static function format($value)
	{
		if('Day off' == $value)
			return 'icon-calendar-empty';
		if('Holiday' == $value)
			return 'icon-gift';
		if('Trip' == $value)
			return 'icon-rocket';

		return 'icon-cogs';
	}
}


