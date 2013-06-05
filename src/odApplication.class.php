<?php
lmb_require('limb/web_app/src/lmbWebApplication.class.php');
lmb_require('src/filter/ErrorHandlingFilter.class.php');
lmb_require('src/filter/InputOutputLogWritterFilter.class.php');
lmb_require('limb/dbal/src/filter/lmbAutoDbTransactionFilter.class.php');
lmb_require('limb/profile/src/filter/lmbProfileReportingFilter.class.php');
lmb_require('src/filter/LanguageSelectFilter.class.php');
lmb_require('src/filter/SessionStartupFilter.class.php');
lmb_require('limb/web_app/src/filter/lmbRequestDispatchingFilter.class.php');
lmb_require('src/request/RoutesRequestDispatcher.class.php');
lmb_require('limb/web_app/src/filter/lmbResponseTransactionFilter.class.php');
lmb_require('limb/web_app/src/filter/lmbActionPerformingFilter.class.php');
lmb_require('limb/web_app/src/filter/lmbViewRenderingFilter.class.php');

class odApplication extends lmbWebApplication
{
  protected function _registerFilters()
  {
    $this->registerFilter(new ErrorHandlingFilter());

    $this->registerFilter(new InputOutputLogWritterFilter());

	  $this->registerFilter(new LanguageSelectFilter());

    $this->registerFilter(new lmbAutoDbTransactionFilter());
    $this->registerFilter(new lmbProfileReportingFilter());

    $this->registerFilter(new SessionStartupFilter());

    $this->registerFilter(new lmbRequestDispatchingFilter(new RoutesRequestDispatcher()));
    $this->registerFilter(new lmbResponseTransactionFilter());

    $this->registerFilter(new lmbActionPerformingFilter());

    $this->registerFilter(new lmbViewRenderingFilter());
  }
}

