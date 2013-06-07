<?php
lmb_require('limb/filter_chain/src/lmbInterceptingFilter.interface.php');

class LanguageSelectFilter implements lmbInterceptingFilter
{
	function run($filter_chain)
	{
		$default_locale = 'ru_RU';
		$available_locales = [$default_locale, 'en_US'];
		$locale = lmbToolkit::instance()->getRequest()->getCookie('locale', $default_locale);
		if(!in_array($locale, $available_locales))
			$locale = $default_locale;
		lmbToolkit::instance()->setLocale($locale);
		setlocale(LC_ALL, $locale);
		$filter_chain->next();
	}
}

