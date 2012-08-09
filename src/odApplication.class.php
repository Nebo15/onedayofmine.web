<?php
lmb_require('limb/web_app/src/lmbWebApplication.class.php');

class odApplication extends lmbWebApplication
{
  protected function _registerFilters()
  {
    $this->registerFilter(new lmbHandle('src/filter/ErrorHandlingFilter'));

    $this->registerFilter(new lmbHandle('src/filter/InputOutputLogWritterFilter'));

    $this->registerFilter(new lmbHandle('limb/dbal/src/filter/lmbAutoDbTransactionFilter'));
    $this->registerFilter(new lmbHandle('limb/profile/src/filter/lmbProfileReportingFilter'));

    $this->registerFilter(new lmbHandle('src/filter/SessionStartupFilter'));

    $this->registerFilter(
      new lmbHandle('src/filter/RequestDispatchingFilter',
        array(new lmbHandle('limb/web_app/src/request/lmbRoutesRequestDispatcher')))
    );
    $this->registerFilter(new lmbHandle('limb/web_app/src/filter/lmbResponseTransactionFilter'));

    $this->registerFilter(new lmbHandle('limb/web_app/src/filter/lmbActionPerformingFilter'));

    $this->registerFilter(new lmbHandle('limb/web_app/src/filter/lmbViewRenderingFilter'));
  }
}

