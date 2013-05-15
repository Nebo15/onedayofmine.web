<?php
require_once (dirname(__FILE__) . '/DbDriver.class.php');

class MysqliDbDriver extends DbDriver
{
	function _connect_string($dsn)
	{
		$password = ($dsn['password']) ? '-p' . $dsn['password'] : '';
		return "mysql -h{$dsn['host']} -u{$dsn['user']} $password";
	}

	function _nondb_exec($dsn, $cmd)
	{
		$dsn['database'] = '';
		return $this->_exec($dsn, $cmd);
	}

	function _exec($dsn, $cmd)
	{
		$shell_cmd = $this->_connect_string($dsn) . ' -e"' . $cmd . '" -N -B ' . $dsn['database'] . ' 2>&1';
		exec($shell_cmd, $out, $ret);
		$outstr = trim(implode("\n", $out));

		if ($ret)
			throw new Exception("Shell command '$shell_cmd' executing error \n'$outstr'");

		if (preg_match('~ERROR\s+\d+\s+\(\d+\)~', $outstr))
			throw new Exception("MySQL command '$cmd' with error \n'$outstr'");

		return $outstr;
	}

	function _load($dsn, $file)
	{
		$cmd = $this->_connect_string($dsn) . " {$dsn['database']} < $file 2>&1";

		echo "Starting to load '$file' file to '{$dsn['database']}' DB...";

		exec($cmd, $out, $ret);
		$outstr = trim(implode("\n", $out));

		if ($ret)
			throw new Exception("Shell command '$cmd' executing error \n'$outstr'");

		if (preg_match('~ERROR\s+\d+\s+\(\d+\)~', $outstr))
			throw new Exception("MySQL specific error \n'$outstr'");

		$this->_log("done\n");
	}

	function _db_exists($dsn)
	{
		$res = $this->_nondb_exec($dsn, "SHOW DATABASES");
		return strpos($res, $dsn['database']) !== false;
	}

	function _table_exists($dsn, $table)
	{
		$res = $this->_exec($dsn, "SHOW TABLES");
		return strpos($res, $table) !== false;
	}

	function _get_tables($dsn)
	{
		$password = ($dsn['password']) ? '-p' . $dsn['password'] : '';
		$cmd = "mysql -NB -u{$dsn['user']} $password -h{$dsn['host']} -e\"SHOW TABLES\" {$dsn['database']}";
		$tables = array_filter(explode("\n", `$cmd`));
		return $tables;
	}

	function _create_tmp_db($dsn)
	{
		$dsn['database'] = $dsn['database'] . '_migration';
		$this->_log("Creating tmp db '{$dsn['database']}'...");
		$this->_nondb_exec($dsn, "DROP DATABASE IF EXISTS {$dsn['database']}");
		$this->_nondb_exec($dsn, "CREATE DATABASE {$dsn['database']}");
		$this->_log("done\n");
		return $dsn['database'];
	}

	function _db_drop($dsn)
	{
		$this->_log("Dropping database '{$dsn['database']}'\n");
		$this->_exec($dsn, "DROP DATABASE {$dsn['database']}");
	}

	function _dump_schema($dsn, $file)
	{
		$password = ($dsn['password']) ? '-p' . $dsn['password'] : '';
		$cmd = "mysqldump -u{$dsn['user']} $password -h{$dsn['host']} " .
				"-d --default-character-set={$dsn['charset']} " .
				"--quote-names --allow-keywords --add-drop-table " .
				"--set-charset --result-file=$file " .
				$dsn['database'];

		$this->_log("Starting to dump schema to '$file' file...");

		system($cmd, $ret);

		// dumping shema_info table data to schema_info
		$cmd = "mysqldump -u{$dsn['user']} {$dsn['password']} -h{$dsn['host']} " .
				"-t --default-character-set={$dsn['charset']} " .
				"--add-drop-table --create-options --quick " .
				"--allow-keywords --max_allowed_packet=16M --quote-names " .
				"--complete-insert --set-charset " .
				"{$dsn['database']} schema_info >> $file";

		system($cmd, $ret1);

		if (!$ret and !$ret1)
			$this->_log("done! (" . filesize($file) . " bytes)\n");
		else
			$this->_log("error!\n");
	}

	function _dump_data($dsn, $file)
	{
		$password = ($dsn['password']) ? '-p' . $dsn['password'] : '';
		$cmd = "mysqldump -u{$dsn['user']} $password -h{$dsn['host']} " .
				"-t --default-character-set={$dsn['charset']} " .
				"--add-drop-table --create-options --quick " .
				"--allow-keywords --max_allowed_packet=16M --quote-names " .
				"--complete-insert --set-charset --ignore-table={$dsn['database']}.schema_info --result-file=$file " .
				$dsn['database'];


		$this->_log("Starting to dump to '$file' file...");

		system($cmd, $ret);

		if (!$ret)
			$this->_log("done! (" . filesize($file) . " bytes)\n");
		else
			$this->_log("error!\n");
	}

	function _dump_load($dsn, $file)
	{
		$password = ($dsn['password']) ? '-p' . $dsn['password'] : '';
		$cmd = "mysql -u{$dsn['user']} $password -h{$dsn['host']} --default-character-set={$dsn['charset']} {$dsn['database']} < $file";

		$this->_log("Starting to load '$file' file to '{$dsn['database']}' DB...");

		system($cmd, $ret);

		if (!$ret)
			$this->_log("done! (" . filesize($file) . " bytes)\n");
		else
			$this->_log("error!\n");
	}

	function copySchema($dsn_src, $dsn_dst)
	{
		$tables = $this->_get_tables($dsn_src);

		$src_password = ($dsn_src['password']) ? '-p' . $dsn_src['password'] : '';
		$dst_password = ($dsn_dst['password']) ? '-p' . $dsn_dst['password'] : '';

		$this->_log("Starting to clone schema from '{$dsn_src['database']}' DB to '{$dsn_dst['database']}' DB...\n");

		foreach ($tables as $table)
		{
			$cmd = "mysql -NB -u{$dsn_src['user']} $src_password -h{$dsn_src['host']} -e\"SHOW CREATE TABLE $table\" {$dsn_src['database']}";
			list(, $create_schema) = explode("\t", `$cmd`, 2);

			$create_schema = str_replace('\n', '', escapeshellarg(trim($create_schema)));
			$cmd = "mysql -u{$dsn_dst['user']} $dst_password -h{$dsn_dst['host']} -e$create_schema {$dsn_dst['database']}";
			system($cmd, $ret);
			if (!$ret)
				$this->_log("'$table' copied\n");
			else
				$this->_log("error while copying '$table'\n");
		}
		$this->_log("done\n");
	}

	function _copy_schema($dsn_src, $dsn_dst)
	{
		return $this->copySchema($dsn_src, $dsn_dst);
	}

	function _copy_schema_and_use_memory_engine($dsn_src, $dsn_dst)
	{
		$tables = $this->_get_tables($dsn_src);

		$src_password = ($dsn_src['password']) ? '-p' . $dsn_src['password'] : '';
		$dst_password = ($dsn_dst['password']) ? '-p' . $dsn_dst['password'] : '';

		$this->_log("Starting to clone schema from '{$dsn_src['database']}' DB to '{$dsn_dst['database']}' DB...\n");

		foreach ($tables as $table)
		{
			$cmd = "mysql -NB -u{$dsn_src['user']} $src_password -h{$dsn_src['host']} -e\"SHOW CREATE TABLE $table\" {$dsn_src['database']}";
			list(, $create_schema) = explode("\t", `$cmd`, 2);

			$create_schema = str_replace('\n', '', escapeshellarg(trim($create_schema)));
			$create_schema = preg_replace('/(.*)ENGINE=([^\s]*)(.*)/', '${1}ENGINE=MEMORY${3}', $create_schema);

			$create_schema = str_replace(array(' longtext', ' blob', ' text'), ' varchar(255)', $create_schema);

			$cmd = "mysql -u{$dsn_dst['user']} $dst_password -h{$dsn_dst['host']} -e$create_schema {$dsn_dst['database']}";
			system($cmd, $ret);
			if (!$ret)
				$this->_log("'$table' copied\n");
			else
				$this->_log("error while copying '$table'\n");
		}
		$this->_log("done\n");
	}

	function cleanup($dsn)
	{
		$tables = $this->_get_tables($dsn);
		$this->_drop_tables($dsn, $tables);

		$this->_log("Starting clean up of '{$dsn['database']}' DB...\n");

		$this->_log("done\n");
	}

	function _db_cleanup($dsn)
	{
		$this->cleanup($dsn);
	}

	function _drop_tables($dsn, $tables)
	{
		$password = ($dsn['password']) ? '-p' . $dsn['password'] : '';
		foreach ($tables as $table)
		{
			$cmd = "mysql -u{$dsn['user']} $password -h{$dsn['host']} -e\"DROP TABLE $table\" {$dsn['database']}";
			system($cmd, $ret);
			if (!$ret)
				$this->_log("'$table' removed\n");
			else
				$this->_log("error while removing '$table'\n");
		}
	}

	function _truncate_tables($dsn, $tables)
	{
		$password = ($dsn['password']) ? '-p' . $dsn['password'] : '';
		foreach ($tables as $table)
		{
			$cmd = "mysql -u{$dsn['user']} $password -h{$dsn['host']} -e\"TRUNCATE TABLE $table\" {$dsn['database']}";
			system($cmd, $ret);
			if (!$ret)
				echo "'$table' truncated\n";
			else
				echo "error while truncating '$table'\n";
		}
	}

	function _get_migration_files_since($migrations_dir, $base_version)
	{
		$files = array();
		foreach (glob($migrations_dir . '/*') as $file)
		{
			list($version,) = explode('_', basename($file));
			$version = intval($version);
			if ($version > $base_version)
				$files[$version] = $file;
		}
		ksort($files);
		return $files;
	}

	function _get_last_migration_file($migrations_dir)
	{
		$files = glob($migrations_dir . '/*');
		krsort($files);
		return reset($files);
	}

	function _migrate($dsn, $migrations_dir, $since = null)
	{
		if (!$this->_db_exists($dsn))
			return;

		if (!$this->_table_exists($dsn, 'schema_info'))
			$this->_exec($dsn, 'CREATE TABLE schema_info ("version" integer default 1);');

		if (!$this->_exec($dsn, 'SELECT COUNT(*) as c FROM schema_info'))
			$this->_exec($dsn, 'INSERT INTO schema_info VALUES (' . (int)$since . ');');

		if (is_null($since))
			$since = (int)$this->_exec($dsn, 'SELECT version FROM schema_info');

		$this->_log("Searching for dumps since version '$since' in '$migrations_dir'\n");
		foreach ($this->_get_migration_files_since($migrations_dir, $since) as $version => $file)
		{
			$this->_load($dsn, $file);
			$this->_exec($dsn, "UPDATE schema_info SET version=$version;");
		}
	}

	function getSchemaVersion($dsn)
	{
		if (!$this->_table_exists($dsn, 'schema_info'))
			return null;
		return (int)$this->_exec($dsn, 'SELECT version FROM schema_info');
	}

	function _get_schema_version($dsn)
	{
		return $this->getSchemaVersion($dsn);
	}

	function setSchemaVersion($dsn, $since = 1)
	{
		$this->_log('Setting schema version ' . (int)$since . PHP_EOL);
		if (!$this->_table_exists($dsn, 'schema_info'))
			$this->_exec($dsn, 'CREATE TABLE schema_info ("version" integer default 1);');

		if ((int)$this->_exec($dsn, 'SELECT COUNT(*) as c FROM schema_info'))
			$this->_exec($dsn, 'UPDATE schema_info SET version = ' . (int)$since . ';');
		else
			$this->_exec($dsn, 'INSERT INTO schema_info VALUES (' . (int)$since . ');');

		return (int)$this->_exec($dsn, 'SELECT version FROM schema_info');
	}

	function _set_schema_version($dsn, $since = 1)
	{
		return $this->setSchemaVersion($dsn, $since);
	}

	function _copy_tables_contents($dsn_src, $dsn_dst, $tables)
	{
		$this->_log("\nStarting to copy tables contents from '{$dsn_src['database']}' DB to '{$dsn_dst['database']}' DB...\n");

		$conn = mysql_connect($dsn_src['host'], $dsn_src['user'], $dsn_src['password']);

		mysql_query("set character_set_client='utf8'", $conn);
		mysql_query("set character_set_results='utf8'", $conn);
		mysql_query("set collation_connection='utf8_general_ci'", $conn);

		mysql_select_db($dsn_src['database'], $conn);

		$dump = array();
		foreach ($tables as $table)
		{
			$sql = "SELECT * FROM " . $table . ";";
			$result = mysql_query($sql, $conn);
			while ($record = mysql_fetch_assoc($result))
			{
				$dump[$table][] = $record;
			}
		}

		mysql_close($conn);

		$conn = mysql_connect($dsn_dst['host'], $dsn_dst['user'], $dsn_dst['password']);

		mysql_query("set character_set_client='utf8'", $conn);
		mysql_query("set character_set_results='utf8'", $conn);
		mysql_query("set collation_connection='utf8_general_ci'", $conn);

		mysql_select_db($dsn_dst['database'], $conn);

		foreach ($dump as $table => $records)
		{
			$sql = "INSERT INTO " . $table . " VALUES (";
			foreach ($records as $record)
			{
				foreach ($record as $field)
					$sql .= "'" . substr($field, 0, 255) . "',";

				$sql = preg_replace('/,$/', '', $sql);
				$sql .= "),(";
			}
			$sql = preg_replace('/,\($/', ';', $sql);

			if (mysql_query($sql, $conn))
				$this->_log("'" . $table . "' copied content\n");
		}

		mysql_close($conn);

		$this->_log("done\n");
	}

	function _diff($dsn, $schema, $data, $migrations_dir, $since = null)
	{
		require_once (dirname(__FILE__) . '/MysqlConnection.class.php');
		require_once (dirname(__FILE__) . '/Mysql.functions.php');

		$since = -1;
		if (preg_match('~INSERT\s+INTO\s+.*schema_info\D+(\d+)~i', file_get_contents($data), $m))
			$since = $m[1];
		if (preg_match('~INSERT\s+INTO\s+.*schema_info\D+(\d+)~i', file_get_contents($schema), $m))
			$since = $m[1];

		//collecting all not applied migrations
		$migrations = array();
		foreach (glob($migrations_dir . '/*.sql') as $migration)
		{
			list($version,) = explode('_', basename($migration));
			if ($since < intval($version))
				$migrations[] = $migration;
		}
		asort($migrations);

		$working_db = array(
			'hostname' => $dsn['host'],
			'username' => $dsn['user'],
			'password' => $dsn['password'],
			'database' => $dsn['database']
		);

		$conn = new MysqlConnection($dsn['host'], $dsn['user'], $dsn['password']);
		$conn->open();
		$tmp_db = $conn->createTemporaryDatabase();

		$repos_db = $working_db;
		$repos_db['database'] = $tmp_db;

		$conn->importSql($tmp_db, $schema);

		foreach ($migrations as $migration)
			$conn->importSql($tmp_db, $migration);

		$diff = generateScript($repos_db, $working_db);

		$conn->dropDatabase($tmp_db);
		$conn->close();

		return $diff;
	}

	function _create_migration($dsn, $name, $schema, $data, $migrations_dir, $since = 0)
	{
		$this->_log("===== Migrating production DB to apply all migrations =====\n");
		$this->_migrate($dsn, $migrations_dir, null);

		$diff = $this->_diff($dsn, $schema, $data, $migrations_dir);

		if ($diff)
		{
			$last = $this->_get_last_migration_file($migrations_dir);
			if (is_file($last) and file_get_contents($last) == $diff)
			{
				$this->_log("The last migration file '$last' is identical to the new migration, skipped\n");
				return;
			}

			$stamp = time();
			$file = "$migrations_dir/{$stamp}_{$name}.sql";

			$this->_log("Writing new migration to file '$file'...");
			file_put_contents($file, $diff);
			$this->_log("done! (" . strlen($diff) . " bytes)\n");

			if (!$this->_test_migration($dsn, $schema, $data, $migrations_dir))
				$this->_log("\nWARNING: migration has errors, please correct them before committing! Try dry-running it with mysql_migrate.php --dry-run\n");

			$this->_log("Updating version info...");
			$this->_exec($dsn, "UPDATE schema_info SET version = $stamp;");
			$this->_log("done!\n");
		}
		else
			$this->_log("There haven't been any changes according to the latest dump\n");
	}
}