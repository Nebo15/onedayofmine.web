<?php

$conf = array();
$conf['cache_enabled'] = true;
$conf['default_cache_dsn'] = "fake:///";
$conf['fb_cache_dsn'] = "fake:///";
$conf['session_cache_dsn'] = "file:///".lmb_var_dir()."/sessions";
$conf['db_info_cache_dsn'] = "fake:///";
$conf['photo_sources_cache_dsn'] = "fake:///";
$conf['i18n_cache_dsn'] = "fake:///";
