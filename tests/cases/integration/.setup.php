<?php
lmbToolkit::instance()->checkServer(lmb_env_get('HOST_URL'));
$toolkit = lmbToolkit::instance();
$toolkit->setConfIncludePath('tests/cases/integration/settings;tests/settings;settings');
$toolkit->resetConfs();
$toolkit->resetFileLocators();

