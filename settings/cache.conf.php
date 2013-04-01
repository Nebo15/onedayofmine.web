<?php

$conf = array();
$conf['cache_enabled'] = true;
$conf['default_cache_dsn'] = "file:///".lmb_var_dir()."/default";
$conf['fb_cache_dsn'] = "file:///".lmb_var_dir()."/fb";
$conf['session_cache_dsn'] = "file:///".lmb_var_dir()."/sessions";
$conf['db_info_cache_dsn'] = "file:///".lmb_var_dir()."/db_info";
$conf['photo_sources_cache_dsn'] = "file:///".lmb_var_dir()."/photo_source";
