<?php
lmb_require('limb/filter_chain/src/lmbInterceptingFilter.interface.php');

class LanguageSelectFilter implements lmbInterceptingFilter
{
	function run($filter_chain)
	{
		lmbToolkit::instance()->setLocale('ru_RU');
		$filter_chain->next();
	}
}

