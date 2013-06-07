<?php
lmb_require('limb/filter_chain/src/lmbInterceptingFilter.interface.php');

class LanguageSelectFilter implements lmbInterceptingFilter
{
	function run($filter_chain)
	{
		$locale = lmbToolkit::instance()->getRequest()->getCookie('locale');
		if(!$locale)
			$locale = $this->_getLocaleFromBrowser();
		lmbToolkit::instance()->setLocale($locale);
		setlocale(LC_ALL, $locale);
		$filter_chain->next();
	}

	function _getLocaleFromBrowser()
	{
		$default_lang = 'ru';
		$available_languages = [$default_lang, 'en'];
		$lang = http_negotiate_language($available_languages);

		$locales = ['ru' => 'ru_RU', 'en' => 'en_US'];
		$current_locale = $locales[$lang];

		lmbToolkit::instance()->getRequest()->setCookie('locale', $current_locale);
	}
}

