<?php

$conf = array();
$conf['cache_enabled'] = true;
$conf['default_cache_dsn'] = "file:///".lmb_var_dir()."/cache_default";
$conf['fb_cache_dsn'] = "file:///".lmb_var_dir()."/cache_fb";
$conf['session_cache_dsn'] = "file:///".lmb_var_dir()."/sessions";
$conf['db_info_cache_dsn'] = "file:///".lmb_var_dir()."/cache_db_info";
$conf['photo_sources_cache_dsn'] = "file:///".lmb_var_dir()."/cache_photo_source";
$conf['i18n_cache_dsn'] = "file:///".lmb_var_dir()."/cache_i18n";
