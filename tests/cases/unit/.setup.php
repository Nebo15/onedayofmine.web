<?php

$toolkit = lmbToolkit::instance();
$toolkit->setConfIncludePath('tests/cases/unit/settings;tests/settings;settings');
$toolkit->resetConfs();
$toolkit->resetFileLocators();