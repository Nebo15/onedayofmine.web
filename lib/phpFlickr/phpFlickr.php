<?php


	class phpFlickr {
		var $api_key;
		var $secret;
		
		var $rest_endpoint = 'http://api.flickr.com/services/rest/';
		var $upload_endpoint = 'http://api.flickr.com/services/upload/';
		var $replace_endpoint = 'http://api.flickr.com/services/replace/';
		var $req;
		var $response;
		var $parsed_response;
		var $cache = false;
		var $last_request = null;
		var $die_on_error;
		var $error_code;
		Var $error_msg;
		var $token;
		var $php_version;
		var $custom_post = null, $custom_cache_get = null, $custom_cache_set = null;

		/*
		 * When your database cache table hits this many rows, a cleanup
		 * will occur to get rid of all of the old rows and cleanup the
		 * garbage in the table.  For most personal apps, 1000 rows should
		 * be more than enough.  If your site gets hit by a lot of traffic
		 * or you have a lot of disk space to spare, bump this number up.
		 * You should try to set it high enough that the cleanup only
		 * happens every once in a while, so this will depend on the growth
		 * of your table.
		 */
		var $max_cache_rows = 1000;

		function __construct($api_key, $secret = NULL, $die_on_error = false) {
			//The API Key must be set before any calls can be made.  You can
			//get your own at http://www.flickr.com/services/api/misc.api_keys.html
			$this->api_key = $api_key;
			$this->secret = $secret;
			$this->die_on_error = $die_on_error;
			$this->service = "flickr";

			//Find the PHP version and store it for future reference
			$this->php_version = explode("-", phpversion());
			$this->php_version = explode(".", $this->php_version[0]);
		}

		function setCustomPost ( $function ) {
			$this->custom_post = $function;
		}
		
		function post ($data, $type = null) {
			if ( is_null($type) ) {
				$url = $this->rest_endpoint;
			}
			
			if ( !is_null($this->custom_post) ) {
				return call_user_func($this->custom_post, $url, $data);
			}
			
			if ( !preg_match("|http://(.*?)(/.*)|", $url, $matches) ) {
				die('There was some problem figuring out your endpoint');
			}
			
			if ( function_exists('curl_init') ) {
				// Has curl. Use it!
				$curl = curl_init($this->rest_endpoint);
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($curl);
				curl_close($curl);
			} else {
				// Use sockets.
				foreach ( $data as $key => $value ) {
					$data[$key] = $key . '=' . urlencode($value);
				}
				$data = implode('&', $data);
			
				$fp = @pfsockopen($matches[1], 80);
				if (!$fp) {
					die('Could not connect to the web service');
				}
				fputs ($fp,'POST ' . $matches[2] . " HTTP/1.1\n");
				fputs ($fp,'Host: ' . $matches[1] . "\n");
				fputs ($fp,"Content-type: application/x-www-form-urlencoded\n");
				fputs ($fp,"Content-length: ".strlen($data)."\n");
				fputs ($fp,"Connection: close\r\n\r\n");
				fputs ($fp,$data . "\n\n");
				$response = "";
				while(!feof($fp)) {
					$response .= fgets($fp, 1024);
				}
				fclose ($fp);
				$chunked = false;
				$http_status = trim(substr($response, 0, strpos($response, "\n")));
				if ( $http_status != 'HTTP/1.1 200 OK' ) {
					die('The web service endpoint returned a "' . $http_status . '" response');
				}
				if ( strpos($response, 'Transfer-Encoding: chunked') !== false ) {
					$temp = trim(strstr($response, "\r\n\r\n"));
					$response = '';
					$length = trim(substr($temp, 0, strpos($temp, "\r")));
					while ( trim($temp) != "0" && ($length = trim(substr($temp, 0, strpos($temp, "\r")))) != "0" ) {
						$response .= trim(substr($temp, strlen($length)+2, hexdec($length)));
						$temp = trim(substr($temp, strlen($length) + 2 + hexdec($length)));
					}
				} elseif ( strpos($response, 'HTTP/1.1 200 OK') !== false ) {
					$response = trim(strstr($response, "\r\n\r\n"));
				}
			}
			return $response;
		}
		
		function request ($command, $args = array(), $nocache = false)
		{
			//Sends a request to Flickr's REST endpoint via POST.
			if (substr($command,0,7) != "flickr.") {
				$command = "flickr." . $command;
			}

			//Process arguments, including method and login data.
			$args = array_merge(array("method" => $command, "format" => "php_serial", "api_key" => $this->api_key), $args);
			if (!empty($this->token)) {
				$args = array_merge($args, array("auth_token" => $this->token));
			} elseif (!empty($_SESSION['phpFlickr_auth_token'])) {
				$args = array_merge($args, array("auth_token" => $_SESSION['phpFlickr_auth_token']));
			}
			ksort($args);
			$auth_sig = "";
			$this->last_request = $args;
			if (!($this->response = $this->getCached($args)) || $nocache) {
				foreach ($args as $key => $data) {
					if ( is_null($data) ) {
						unset($args[$key]);
						continue;
					}
					$auth_sig .= $key . $data;
				}
				if (!empty($this->secret)) {
					$api_sig = md5($this->secret . $auth_sig);
					$args['api_sig'] = $api_sig;
				}
				$this->response = $this->post($args);
				$this->cache($args, $this->response);
			}
			
			/*
			 * Uncomment this line (and comment out the next one) if you're doing large queries
			 * and you're concerned about time.  This will, however, change the structure of
			 * the result, so be sure that you look at the results.
			 */
			//$this->parsed_response = unserialize($this->response);
			$this->parsed_response = $this->clean_text_nodes(unserialize($this->response));
			if ($this->parsed_response['stat'] == 'fail') {
				if ($this->die_on_error) die("The Flickr API returned the following error: #{$this->parsed_response['code']} - {$this->parsed_response['message']}");
				else {
					$this->error_code = $this->parsed_response['code'];
					$this->error_msg = $this->parsed_response['message'];
					$this->parsed_response = false;
				}
			} else {
				$this->error_code = false;
				$this->error_msg = false;
			}
			return $this->response;
		}

		function clean_text_nodes ($arr) {
			if (!is_array($arr)) {
				return $arr;
			} elseif (count($arr) == 0) {
				return $arr;
			} elseif (count($arr) == 1 && array_key_exists('_content', $arr)) {
				return $arr['_content'];
			} else {
				foreach ($arr as $key => $element) {
					$arr[$key] = $this->clean_text_nodes($element);
				}
				return($arr);
			}
		}

		function setToken ($token) {
			// Sets an authentication token to use instead of the session variable
			$this->token = $token;
		}

		function setProxy ($server, $port) {
			// Sets the proxy for all phpFlickr calls.
			$this->req->setProxy($server, $port);
		}

		function getErrorCode () {
			// Returns the error code of the last call.  If the last call did not
			// return an error. This will return a false boolean.
			return $this->error_code;
		}

		function getErrorMsg () {
			// Returns the error message of the last call.  If the last call did not
			// return an error. This will return a false boolean.
			return $this->error_msg;
		}

		/* These functions are front ends for the flickr calls */

		function buildPhotoURL ($photo, $size = "Medium") {
			//receives an array (can use the individual photo data returned
			//from an API call) and returns a URL (doesn't mean that the
			//file size exists)
			$sizes = array(
				"square" => "_s",
				"thumbnail" => "_t",
				"small" => "_m",
				"medium" => "",
				"medium_640" => "_z",
				"large" => "_b",
				"original" => "_o"
			);
			
			$size = strtolower($size);
			if (!array_key_exists($size, $sizes)) {
				$size = "medium";
			}
			
			if ($size == "original") {
				$url = "http://farm" . $photo['farm'] . ".static.flickr.com/" . $photo['server'] . "/" . $photo['id'] . "_" . $photo['originalsecret'] . "_o" . "." . $photo['originalformat'];
			} else {
				$url = "http://farm" . $photo['farm'] . ".static.flickr.com/" . $photo['server'] . "/" . $photo['id'] . "_" . $photo['secret'] . $sizes[$size] . ".jpg";
			}
			return $url;
		}

		function getFriendlyGeodata ($lat, $lon) {
			/* I've added this method to get the friendly geodata (i.e. 'in New York, NY') that the
			 * website provides, but isn't available in the API. I'm providing this service as long
			 * as it doesn't flood my server with requests and crash it all the time.
			 */
			return unserialize(file_get_contents('http://phpflickr.com/geodata/?format=php&lat=' . $lat . '&lon=' . $lon));
		}

		function auth ($perms = "read", $remember_uri = true) {
			// Redirects to Flickr's authentication piece if there is no valid token.
			// If remember_uri is set to false, the callback script (included) will
			// redirect to its default page.

			if (empty($_SESSION['phpFlickr_auth_token']) && empty($this->token)) {
				if ( $remember_uri === true ) {
					$_SESSION['phpFlickr_auth_redirect'] = $_SERVER['REQUEST_URI'];
				} elseif ( $remember_uri !== false ) {
					$_SESSION['phpFlickr_auth_redirect'] = $remember_uri;
				}
				$api_sig = md5($this->secret . "api_key" . $this->api_key . "perms" . $perms);
				
				if ($this->service == "23") {
					header("Location: http://www.23hq.com/services/auth/?api_key=" . $this->api_key . "&perms=" . $perms . "&api_sig=". $api_sig);
				} else {
					header("Location: http://www.flickr.com/services/auth/?api_key=" . $this->api_key . "&perms=" . $perms . "&api_sig=". $api_sig);
				}
				exit;
			} else {
				$tmp = $this->die_on_error;
				$this->die_on_error = false;
				$rsp = $this->auth_checkToken();
				if ($this->error_code !== false) {
					unset($_SESSION['phpFlickr_auth_token']);
					$this->auth($perms, $remember_uri);
				}
				$this->die_on_error = $tmp;
				return $rsp['perms'];
			}
		}

		/*******************************

		To use the phpFlickr::call method, pass a string containing the API method you want
		to use and an associative array of arguments.  For example:
			$result = $f->call("flickr.photos.comments.getList", array("photo_id"=>'34952612'));
		This method will allow you to make calls to arbitrary methods that haven't been
		implemented in phpFlickr yet.

		*******************************/

		function call ($method, $arguments) {
			foreach ( $arguments as $key => $value ) {
				if ( is_null($value) ) unset($arguments[$key]);
			}
			$this->request($method, $arguments);
			return $this->parsed_response ? $this->parsed_response : false;
		}

		/*
			These functions are the direct implementations of flickr calls.
			For method documentation, including arguments, visit the address
			included in a comment in the function.
		*/

		/* Activity methods */
		function activity_userComments ($per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.activity.userComments.html */
			$this->request('flickr.activity.userComments', array("per_page" => $per_page, "page" => $page));
			return $this->parsed_response ? $this->parsed_response['items']['item'] : false;
		}

		function activity_userPhotos ($timeframe = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.activity.userPhotos.html */
			$this->request('flickr.activity.userPhotos', array("timeframe" => $timeframe, "per_page" => $per_page, "page" => $page));
			return $this->parsed_response ? $this->parsed_response['items']['item'] : false;
		}

		/* Authentication methods */
		function auth_checkToken () {
			/* http://www.flickr.com/services/api/flickr.auth.checkToken.html */
			$this->request('flickr.auth.checkToken');
			return $this->parsed_response ? $this->parsed_response['auth'] : false;
		}

		function auth_getFrob () {
			/* http://www.flickr.com/services/api/flickr.auth.getFrob.html */
			$this->request('flickr.auth.getFrob');
			return $this->parsed_response ? $this->parsed_response['frob'] : false;
		}

		function auth_getFullToken ($mini_token) {
			/* http://www.flickr.com/services/api/flickr.auth.getFullToken.html */
			$this->request('flickr.auth.getFullToken', array('mini_token'=>$mini_token));
			return $this->parsed_response ? $this->parsed_response['auth'] : false;
		}

		function auth_getToken ($frob) {
			/* http://www.flickr.com/services/api/flickr.auth.getToken.html */
			$this->request('flickr.auth.getToken', array('frob'=>$frob));
			$_SESSION['phpFlickr_auth_token'] = $this->parsed_response['auth']['token'];
			return $this->parsed_response ? $this->parsed_response['auth'] : false;
		}

		/* Collections Methods */
		function collections_getInfo ($collection_id) {
			/* http://www.flickr.com/services/api/flickr.collections.getInfo.html */
			return $this->call('flickr.collections.getInfo', array('collection_id' => $collection_id));
		}

		function collections_getTree ($collection_id = NULL, $user_id = NULL) {
			/* http://www.flickr.com/services/api/flickr.collections.getTree.html */
			return $this->call('flickr.collections.getTree', array('collection_id' => $collection_id, 'user_id' => $user_id));
		}
		
		/* Commons Methods */
		function commons_getInstitutions () {
			/* http://www.flickr.com/services/api/flickr.commons.getInstitutions.html */
			return $this->call('flickr.commons.getInstitutions', array());
		}
		
		/* Contacts Methods */
		function contacts_getList ($filter = NULL, $page = NULL, $per_page = NULL) {
			/* http://www.flickr.com/services/api/flickr.contacts.getList.html */
			$this->request('flickr.contacts.getList', array('filter'=>$filter, 'page'=>$page, 'per_page'=>$per_page));
			return $this->parsed_response ? $this->parsed_response['contacts'] : false;
		}

		function contacts_getPublicList ($user_id, $page = NULL, $per_page = NULL) {
			/* http://www.flickr.com/services/api/flickr.contacts.getPublicList.html */
			$this->request('flickr.contacts.getPublicList', array('user_id'=>$user_id, 'page'=>$page, 'per_page'=>$per_page));
			return $this->parsed_response ? $this->parsed_response['contacts'] : false;
		}
		
		function contacts_getListRecentlyUploaded ($date_lastupload = NULL, $filter = NULL) {
			/* http://www.flickr.com/services/api/flickr.contacts.getListRecentlyUploaded.html */
			return $this->call('flickr.contacts.getListRecentlyUploaded', array('date_lastupload' => $date_lastupload, 'filter' => $filter));
		}

		function favorites_getList ($user_id = NULL, $jump_to = NULL, $min_fave_date = NULL, $max_fave_date = NULL, $extras = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.favorites.getList.html */
			return $this->call('flickr.favorites.getList', array('user_id' => $user_id, 'jump_to' => $jump_to, 'min_fave_date' => $min_fave_date, 'max_fave_date' => $max_fave_date, 'extras' => $extras, 'per_page' => $per_page, 'page' => $page));
		}
		
		function favorites_getPublicList ($user_id, $jump_to = NULL, $min_fave_date = NULL, $max_fave_date = NULL, $extras = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.favorites.getPublicList.html */
			return $this->call('flickr.favorites.getPublicList', array('user_id' => $user_id, 'jump_to' => $jump_to, 'min_fave_date' => $min_fave_date, 'max_fave_date' => $max_fave_date, 'extras' => $extras, 'per_page' => $per_page, 'page' => $page));
		}

		function galleries_getInfo ($gallery_id) {
			/* http://www.flickr.com/services/api/flickr.galleries.getInfo.html */
			return $this->call('flickr.galleries.getInfo', array('gallery_id' => $gallery_id));
		}

		function galleries_getList ($user_id, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.galleries.getList.html */
			return $this->call('flickr.galleries.getList', array('user_id' => $user_id, 'per_page' => $per_page, 'page' => $page));
		}

		function galleries_getListForPhoto ($photo_id, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.galleries.getListForPhoto.html */
			return $this->call('flickr.galleries.getListForPhoto', array('photo_id' => $photo_id, 'per_page' => $per_page, 'page' => $page));
		}
			
		function galleries_getPhotos ($gallery_id, $extras = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.galleries.getPhotos.html */
			return $this->call('flickr.galleries.getPhotos', array('gallery_id' => $gallery_id, 'extras' => $extras, 'per_page' => $per_page, 'page' => $page));
		}

		/* Interestingness methods */
		function interestingness_getList ($date = NULL, $use_panda = NULL, $extras = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.interestingness.getList.html */
			if (is_array($extras)) {
				$extras = implode(",", $extras);
			}

			return $this->call('flickr.interestingness.getList', array('date' => $date, 'use_panda' => $use_panda, 'extras' => $extras, 'per_page' => $per_page, 'page' => $page));
		}

		/* Machine Tag methods */
		function machinetags_getNamespaces ($predicate = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.machinetags.getNamespaces.html */
			return $this->call('flickr.machinetags.getNamespaces', array('predicate' => $predicate, 'per_page' => $per_page, 'page' => $page));
		}

		function machinetags_getPairs ($namespace = NULL, $predicate = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.machinetags.getPairs.html */
			return $this->call('flickr.machinetags.getPairs', array('namespace' => $namespace, 'predicate' => $predicate, 'per_page' => $per_page, 'page' => $page));
		}

		function machinetags_getPredicates ($namespace = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.machinetags.getPredicates.html */
			return $this->call('flickr.machinetags.getPredicates', array('namespace' => $namespace, 'per_page' => $per_page, 'page' => $page));
		}
		
		function machinetags_getRecentValues ($namespace = NULL, $predicate = NULL, $added_since = NULL) {
			/* http://www.flickr.com/services/api/flickr.machinetags.getRecentValues.html */
			return $this->call('flickr.machinetags.getRecentValues', array('namespace' => $namespace, 'predicate' => $predicate, 'added_since' => $added_since));
		}

		function machinetags_getValues ($namespace, $predicate, $per_page = NULL, $page = NULL, $usage = NULL) {
			/* http://www.flickr.com/services/api/flickr.machinetags.getValues.html */
			return $this->call('flickr.machinetags.getValues', array('namespace' => $namespace, 'predicate' => $predicate, 'per_page' => $per_page, 'page' => $page, 'usage' => $usage));
		}
		
		/* Panda methods */
		function panda_getList () {
			/* http://www.flickr.com/services/api/flickr.panda.getList.html */
			return $this->call('flickr.panda.getList', array());
		}

		function panda_getPhotos ($panda_name, $extras = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.panda.getPhotos.html */
			return $this->call('flickr.panda.getPhotos', array('panda_name' => $panda_name, 'extras' => $extras, 'per_page' => $per_page, 'page' => $page));
		}

		/* People methods */
		function people_findByEmail ($find_email) {
			/* http://www.flickr.com/services/api/flickr.people.findByEmail.html */
			$this->request("flickr.people.findByEmail", array("find_email"=>$find_email));
			return $this->parsed_response ? $this->parsed_response['user'] : false;
		}

		function people_findByUsername ($username) {
			/* http://www.flickr.com/services/api/flickr.people.findByUsername.html */
			$this->request("flickr.people.findByUsername", array("username"=>$username));
			return $this->parsed_response ? $this->parsed_response['user'] : false;
		}

		function people_getInfo ($user_id) {
			/* http://www.flickr.com/services/api/flickr.people.getInfo.html */
			$this->request("flickr.people.getInfo", array("user_id"=>$user_id));
			return $this->parsed_response ? $this->parsed_response['person'] : false;
		}

		function people_getPhotos ($user_id, $args = array()) {
			/* This function strays from the method of arguments that I've
			 * used in the other functions for the fact that there are just
			 * so many arguments to this API method. What you'll need to do
			 * is pass an associative array to the function containing the
			 * arguments you want to pass to the API.  For example:
			 *   $photos = $f->photos_search(array("tags"=>"brown,cow", "tag_mode"=>"any"));
			 * This will return photos tagged with either "brown" or "cow"
			 * or both. See the API documentation (link below) for a full
			 * list of arguments.
			 */

			 /* http://www.flickr.com/services/api/flickr.people.getPhotos.html */
			return $this->call('flickr.people.getPhotos', array_merge(array('user_id' => $user_id), $args));
		}

		function people_getPhotosOf ($user_id, $extras = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.people.getPhotosOf.html */
			return $this->call('flickr.people.getPhotosOf', array('user_id' => $user_id, 'extras' => $extras, 'per_page' => $per_page, 'page' => $page));
		}

		function people_getPublicPhotos ($user_id, $safe_search = NULL, $extras = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.people.getPublicPhotos.html */
			return $this->call('flickr.people.getPublicPhotos', array('user_id' => $user_id, 'safe_search' => $safe_search, 'extras' => $extras, 'per_page' => $per_page, 'page' => $page));
		}

		function photos_getAllContexts ($photo_id) {
			/* http://www.flickr.com/services/api/flickr.photos.getAllContexts.html */
			$this->request("flickr.photos.getAllContexts", array("photo_id"=>$photo_id));
			return $this->parsed_response ? $this->parsed_response : false;
		}

		function photos_getContactsPhotos ($count = NULL, $just_friends = NULL, $single_photo = NULL, $include_self = NULL, $extras = NULL) {
			/* http://www.flickr.com/services/api/flickr.photos.getContactsPhotos.html */
			$this->request("flickr.photos.getContactsPhotos", array("count"=>$count, "just_friends"=>$just_friends, "single_photo"=>$single_photo, "include_self"=>$include_self, "extras"=>$extras));
			return $this->parsed_response ? $this->parsed_response['photos']['photo'] : false;
		}

		function photos_getContactsPublicPhotos ($user_id, $count = NULL, $just_friends = NULL, $single_photo = NULL, $include_self = NULL, $extras = NULL) {
			/* http://www.flickr.com/services/api/flickr.photos.getContactsPublicPhotos.html */
			$this->request("flickr.photos.getContactsPublicPhotos", array("user_id"=>$user_id, "count"=>$count, "just_friends"=>$just_friends, "single_photo"=>$single_photo, "include_self"=>$include_self, "extras"=>$extras));
			return $this->parsed_response ? $this->parsed_response['photos']['photo'] : false;
		}

		function photos_getContext ($photo_id, $num_prev = NULL, $num_next = NULL, $extras = NULL, $order_by = NULL) {
			/* http://www.flickr.com/services/api/flickr.photos.getContext.html */
			return $this->call('flickr.photos.getContext', array('photo_id' => $photo_id, 'num_prev' => $num_prev, 'num_next' => $num_next, 'extras' => $extras, 'order_by' => $order_by));
		}

		function photos_getCounts ($dates = NULL, $taken_dates = NULL) {
			/* http://www.flickr.com/services/api/flickr.photos.getCounts.html */
			$this->request("flickr.photos.getCounts", array("dates"=>$dates, "taken_dates"=>$taken_dates));
			return $this->parsed_response ? $this->parsed_response['photocounts']['photocount'] : false;
		}

		function photos_getExif ($photo_id, $secret = NULL) {
			/* http://www.flickr.com/services/api/flickr.photos.getExif.html */
			$this->request("flickr.photos.getExif", array("photo_id"=>$photo_id, "secret"=>$secret));
			return $this->parsed_response ? $this->parsed_response['photo'] : false;
		}
		
		function photos_getFavorites ($photo_id, $page = NULL, $per_page = NULL) {
			/* http://www.flickr.com/services/api/flickr.photos.getFavorites.html */
			$this->request("flickr.photos.getFavorites", array("photo_id"=>$photo_id, "page"=>$page, "per_page"=>$per_page));
			return $this->parsed_response ? $this->parsed_response['photo'] : false;
		}

		function photos_getInfo ($photo_id, $secret = NULL, $humandates = NULL, $privacy_filter = NULL, $get_contexts = NULL) {
			/* http://www.flickr.com/services/api/flickr.photos.getInfo.html */
			return $this->call('flickr.photos.getInfo', array('photo_id' => $photo_id, 'secret' => $secret, 'humandates' => $humandates, 'privacy_filter' => $privacy_filter, 'get_contexts' => $get_contexts));
		}
		
		function photos_getNotInSet ($max_upload_date = NULL, $min_taken_date = NULL, $max_taken_date = NULL, $privacy_filter = NULL, $media = NULL, $min_upload_date = NULL, $extras = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.photos.getNotInSet.html */
			return $this->call('flickr.photos.getNotInSet', array('max_upload_date' => $max_upload_date, 'min_taken_date' => $min_taken_date, 'max_taken_date' => $max_taken_date, 'privacy_filter' => $privacy_filter, 'media' => $media, 'min_upload_date' => $min_upload_date, 'extras' => $extras, 'per_page' => $per_page, 'page' => $page));
		}
		
		function photos_getPerms ($photo_id) {
			/* http://www.flickr.com/services/api/flickr.photos.getPerms.html */
			$this->request("flickr.photos.getPerms", array("photo_id"=>$photo_id));
			return $this->parsed_response ? $this->parsed_response['perms'] : false;
		}

		function photos_getRecent ($jump_to = NULL, $extras = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.photos.getRecent.html */
			if (is_array($extras)) {
				$extras = implode(",", $extras);
			}
			return $this->call('flickr.photos.getRecent', array('jump_to' => $jump_to, 'extras' => $extras, 'per_page' => $per_page, 'page' => $page));
		}

		function photos_getSizes ($photo_id) {
			/* http://www.flickr.com/services/api/flickr.photos.getSizes.html */
			$this->request("flickr.photos.getSizes", array("photo_id"=>$photo_id));
			return $this->parsed_response ? $this->parsed_response['sizes']['size'] : false;
		}

		function photos_getUntagged ($min_upload_date = NULL, $max_upload_date = NULL, $min_taken_date = NULL, $max_taken_date = NULL, $privacy_filter = NULL, $media = NULL, $extras = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.photos.getUntagged.html */
			return $this->call('flickr.photos.getUntagged', array('min_upload_date' => $min_upload_date, 'max_upload_date' => $max_upload_date, 'min_taken_date' => $min_taken_date, 'max_taken_date' => $max_taken_date, 'privacy_filter' => $privacy_filter, 'media' => $media, 'extras' => $extras, 'per_page' => $per_page, 'page' => $page));
		}

		function photos_getWithGeoData ($args = array()) {
			/* See the documentation included with the photos_search() function.
			 * I'm using the same style of arguments for this function. The only
			 * difference here is that this doesn't require any arguments. The
			 * flickr.photos.search method requires at least one search parameter.
			 */
			/* http://www.flickr.com/services/api/flickr.photos.getWithGeoData.html */
			$this->request("flickr.photos.getWithGeoData", $args);
			return $this->parsed_response ? $this->parsed_response['photos'] : false;
		}

		function photos_getWithoutGeoData ($args = array()) {
			/* See the documentation included with the photos_search() function.
			 * I'm using the same style of arguments for this function. The only
			 * difference here is that this doesn't require any arguments. The
			 * flickr.photos.search method requires at least one search parameter.
			 */
			/* http://www.flickr.com/services/api/flickr.photos.getWithoutGeoData.html */
			$this->request("flickr.photos.getWithoutGeoData", $args);
			return $this->parsed_response ? $this->parsed_response['photos'] : false;
		}

		function photos_recentlyUpdated ($min_date, $extras = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.photos.recentlyUpdated.html */
			return $this->call('flickr.photos.recentlyUpdated', array('min_date' => $min_date, 'extras' => $extras, 'per_page' => $per_page, 'page' => $page));
		}

		function photos_removeTag ($tag_id) {
			/* http://www.flickr.com/services/api/flickr.photos.removeTag.html */
			$this->request("flickr.photos.removeTag", array("tag_id"=>$tag_id), TRUE);
			return $this->parsed_response ? true : false;
		}

		function photos_search ($args = array()) {
			/* This function strays from the method of arguments that I've
			 * used in the other functions for the fact that there are just
			 * so many arguments to this API method. What you'll need to do
			 * is pass an associative array to the function containing the
			 * arguments you want to pass to the API.  For example:
			 *   $photos = $f->photos_search(array("tags"=>"brown,cow", "tag_mode"=>"any"));
			 * This will return photos tagged with either "brown" or "cow"
			 * or both. See the API documentation (link below) for a full
			 * list of arguments.
			 */

			/* http://www.flickr.com/services/api/flickr.photos.search.html */
			$this->request("flickr.photos.search", $args);
			return $this->parsed_response ? $this->parsed_response['photos'] : false;
		}

		function photos_comments_getList ($photo_id, $min_comment_date = NULL, $max_comment_date = NULL, $page = NULL, $per_page = NULL, $include_faves = NULL) {
			/* http://www.flickr.com/services/api/flickr.photos.comments.getList.html */
			return $this->call('flickr.photos.comments.getList', array('photo_id' => $photo_id, 'min_comment_date' => $min_comment_date, 'max_comment_date' => $max_comment_date, 'page' => $page, 'per_page' => $per_page, 'include_faves' => $include_faves));
		}
		
		function photos_comments_getRecentForContacts ($date_lastcomment = NULL, $contacts_filter = NULL, $extras = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.photos.comments.getRecentForContacts.html */
			return $this->call('flickr.photos.comments.getRecentForContacts', array('date_lastcomment' => $date_lastcomment, 'contacts_filter' => $contacts_filter, 'extras' => $extras, 'per_page' => $per_page, 'page' => $page));
		}

		function photos_geo_getLocation ($photo_id) {
			/* http://www.flickr.com/services/api/flickr.photos.geo.getLocation.html */
			$this->request("flickr.photos.geo.getLocation", array("photo_id"=>$photo_id));
			return $this->parsed_response ? $this->parsed_response['photo'] : false;
		}

		function photos_geo_getPerms ($photo_id) {
			/* http://www.flickr.com/services/api/flickr.photos.geo.getPerms.html */
			$this->request("flickr.photos.geo.getPerms", array("photo_id"=>$photo_id));
			return $this->parsed_response ? $this->parsed_response['perms'] : false;
		}
		
		function photos_geo_photosForLocation ($lat, $lon, $accuracy = NULL, $extras = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.photos.geo.photosForLocation.html */
			return $this->call('flickr.photos.geo.photosForLocation', array('lat' => $lat, 'lon' => $lon, 'accuracy' => $accuracy, 'extras' => $extras, 'per_page' => $per_page, 'page' => $page));
		}

		/* Photos - Licenses Methods */
		function photos_licenses_getInfo () {
			/* http://www.flickr.com/services/api/flickr.photos.licenses.getInfo.html */
			$this->request("flickr.photos.licenses.getInfo");
			return $this->parsed_response ? $this->parsed_response['licenses']['license'] : false;
		}

		function photos_people_getList ($photo_id) {
			/* http://www.flickr.com/services/api/flickr.photos.people.getList.html */
			return $this->call('flickr.photos.people.getList', array('photo_id' => $photo_id));
		}
		
		/* Photos - Upload Methods */
		function photos_upload_checkTickets ($tickets) {
			/* http://www.flickr.com/services/api/flickr.photos.upload.checkTickets.html */
			if (is_array($tickets)) {
				$tickets = implode(",", $tickets);
			}
			$this->request("flickr.photos.upload.checkTickets", array("tickets" => $tickets), TRUE);
			return $this->parsed_response ? $this->parsed_response['uploader']['ticket'] : false;
		}

		/* Photosets Methods */
		function photosets_getContext ($photo_id, $photoset_id, $num_prev = NULL, $num_next = NULL) {
			/* http://www.flickr.com/services/api/flickr.photosets.getContext.html */
			return $this->call('flickr.photosets.getContext', array('photo_id' => $photo_id, 'photoset_id' => $photoset_id, 'num_prev' => $num_prev, 'num_next' => $num_next));
		}
		
		function photosets_getInfo ($photoset_id) {
			/* http://www.flickr.com/services/api/flickr.photosets.getInfo.html */
			$this->request("flickr.photosets.getInfo", array("photoset_id" => $photoset_id));
			return $this->parsed_response ? $this->parsed_response['photoset'] : false;
		}

		function photosets_getList ($user_id = NULL) {
			/* http://www.flickr.com/services/api/flickr.photosets.getList.html */
			$this->request("flickr.photosets.getList", array("user_id" => $user_id));
			return $this->parsed_response ? $this->parsed_response['photosets'] : false;
		}

		function photosets_getPhotos ($photoset_id, $extras = NULL, $privacy_filter = NULL, $per_page = NULL, $page = NULL, $media = NULL) {
			/* http://www.flickr.com/services/api/flickr.photosets.getPhotos.html */
			return $this->call('flickr.photosets.getPhotos', array('photoset_id' => $photoset_id, 'extras' => $extras, 'privacy_filter' => $privacy_filter, 'per_page' => $per_page, 'page' => $page, 'media' => $media));
		}

		/* Photosets Comments Methods */
		function photosets_comments_getList ($photoset_id) {
			/* http://www.flickr.com/services/api/flickr.photosets.comments.getList.html */
			$this->request("flickr.photosets.comments.getList", array("photoset_id"=>$photoset_id));
			return $this->parsed_response ? $this->parsed_response['comments'] : false;
		}
		
		/* Places Methods */
		function places_find ($query) {
			/* http://www.flickr.com/services/api/flickr.places.find.html */
			return $this->call('flickr.places.find', array('query' => $query));
		}

		function places_findByLatLon ($lat, $lon, $accuracy = NULL) {
			/* http://www.flickr.com/services/api/flickr.places.findByLatLon.html */
			return $this->call('flickr.places.findByLatLon', array('lat' => $lat, 'lon' => $lon, 'accuracy' => $accuracy));
		}

		function places_getChildrenWithPhotosPublic ($place_id = NULL, $woe_id = NULL) {
			/* http://www.flickr.com/services/api/flickr.places.getChildrenWithPhotosPublic.html */
			return $this->call('flickr.places.getChildrenWithPhotosPublic', array('place_id' => $place_id, 'woe_id' => $woe_id));
		}

		function places_getInfo ($place_id = NULL, $woe_id = NULL) {
			/* http://www.flickr.com/services/api/flickr.places.getInfo.html */
			return $this->call('flickr.places.getInfo', array('place_id' => $place_id, 'woe_id' => $woe_id));
		}

		function places_getInfoByUrl ($url) {
			/* http://www.flickr.com/services/api/flickr.places.getInfoByUrl.html */
			return $this->call('flickr.places.getInfoByUrl', array('url' => $url));
		}
		
		function places_getPlaceTypes () {
			/* http://www.flickr.com/services/api/flickr.places.getPlaceTypes.html */
			return $this->call('flickr.places.getPlaceTypes', array());
		}
		
		function places_getShapeHistory ($place_id = NULL, $woe_id = NULL) {
			/* http://www.flickr.com/services/api/flickr.places.getShapeHistory.html */
			return $this->call('flickr.places.getShapeHistory', array('place_id' => $place_id, 'woe_id' => $woe_id));
		}

		function places_getTopPlacesList ($place_type_id, $date = NULL, $woe_id = NULL, $place_id = NULL) {
			/* http://www.flickr.com/services/api/flickr.places.getTopPlacesList.html */
			return $this->call('flickr.places.getTopPlacesList', array('place_type_id' => $place_type_id, 'date' => $date, 'woe_id' => $woe_id, 'place_id' => $place_id));
		}
		
		function places_placesForBoundingBox ($bbox, $place_type = NULL, $place_type_id = NULL, $recursive = NULL) {
			/* http://www.flickr.com/services/api/flickr.places.placesForBoundingBox.html */
			return $this->call('flickr.places.placesForBoundingBox', array('bbox' => $bbox, 'place_type' => $place_type, 'place_type_id' => $place_type_id, 'recursive' => $recursive));
		}

		function places_placesForContacts ($place_type = NULL, $place_type_id = NULL, $woe_id = NULL, $place_id = NULL, $threshold = NULL, $contacts = NULL, $min_upload_date = NULL, $max_upload_date = NULL, $min_taken_date = NULL, $max_taken_date = NULL) {
			/* http://www.flickr.com/services/api/flickr.places.placesForContacts.html */
			return $this->call('flickr.places.placesForContacts', array('place_type' => $place_type, 'place_type_id' => $place_type_id, 'woe_id' => $woe_id, 'place_id' => $place_id, 'threshold' => $threshold, 'contacts' => $contacts, 'min_upload_date' => $min_upload_date, 'max_upload_date' => $max_upload_date, 'min_taken_date' => $min_taken_date, 'max_taken_date' => $max_taken_date));
		}

		function places_placesForTags ($place_type_id, $woe_id = NULL, $place_id = NULL, $threshold = NULL, $tags = NULL, $tag_mode = NULL, $machine_tags = NULL, $machine_tag_mode = NULL, $min_upload_date = NULL, $max_upload_date = NULL, $min_taken_date = NULL, $max_taken_date = NULL) {
			/* http://www.flickr.com/services/api/flickr.places.placesForTags.html */
			return $this->call('flickr.places.placesForTags', array('place_type_id' => $place_type_id, 'woe_id' => $woe_id, 'place_id' => $place_id, 'threshold' => $threshold, 'tags' => $tags, 'tag_mode' => $tag_mode, 'machine_tags' => $machine_tags, 'machine_tag_mode' => $machine_tag_mode, 'min_upload_date' => $min_upload_date, 'max_upload_date' => $max_upload_date, 'min_taken_date' => $min_taken_date, 'max_taken_date' => $max_taken_date));
		}

		function places_placesForUser ($place_type_id = NULL, $place_type = NULL, $woe_id = NULL, $place_id = NULL, $threshold = NULL, $min_upload_date = NULL, $max_upload_date = NULL, $min_taken_date = NULL, $max_taken_date = NULL) {
			/* http://www.flickr.com/services/api/flickr.places.placesForUser.html */
			return $this->call('flickr.places.placesForUser', array('place_type_id' => $place_type_id, 'place_type' => $place_type, 'woe_id' => $woe_id, 'place_id' => $place_id, 'threshold' => $threshold, 'min_upload_date' => $min_upload_date, 'max_upload_date' => $max_upload_date, 'min_taken_date' => $min_taken_date, 'max_taken_date' => $max_taken_date));
		}
		
		function places_resolvePlaceId ($place_id) {
			/* http://www.flickr.com/services/api/flickr.places.resolvePlaceId.html */
			$rsp = $this->call('flickr.places.resolvePlaceId', array('place_id' => $place_id));
			return $rsp ? $rsp['location'] : $rsp;
		}
		
		function places_resolvePlaceURL ($url) {
			/* http://www.flickr.com/services/api/flickr.places.resolvePlaceURL.html */
			$rsp = $this->call('flickr.places.resolvePlaceURL', array('url' => $url));
			return $rsp ? $rsp['location'] : $rsp;
		}
		
		function places_tagsForPlace ($woe_id = NULL, $place_id = NULL, $min_upload_date = NULL, $max_upload_date = NULL, $min_taken_date = NULL, $max_taken_date = NULL) {
			/* http://www.flickr.com/services/api/flickr.places.tagsForPlace.html */
			return $this->call('flickr.places.tagsForPlace', array('woe_id' => $woe_id, 'place_id' => $place_id, 'min_upload_date' => $min_upload_date, 'max_upload_date' => $max_upload_date, 'min_taken_date' => $min_taken_date, 'max_taken_date' => $max_taken_date));
		}

		/* Prefs Methods */
		function prefs_getContentType () {
			/* http://www.flickr.com/services/api/flickr.prefs.getContentType.html */
			$rsp = $this->call('flickr.prefs.getContentType', array());
			return $rsp ? $rsp['person'] : $rsp;
		}
		
		function prefs_getGeoPerms () {
			/* http://www.flickr.com/services/api/flickr.prefs.getGeoPerms.html */
			return $this->call('flickr.prefs.getGeoPerms', array());
		}
		
		function prefs_getHidden () {
			/* http://www.flickr.com/services/api/flickr.prefs.getHidden.html */
			$rsp = $this->call('flickr.prefs.getHidden', array());
			return $rsp ? $rsp['person'] : $rsp;
		}
		
		function prefs_getPrivacy () {
			/* http://www.flickr.com/services/api/flickr.prefs.getPrivacy.html */
			$rsp = $this->call('flickr.prefs.getPrivacy', array());
			return $rsp ? $rsp['person'] : $rsp;
		}
		
		function prefs_getSafetyLevel () {
			/* http://www.flickr.com/services/api/flickr.prefs.getSafetyLevel.html */
			$rsp = $this->call('flickr.prefs.getSafetyLevel', array());
			return $rsp ? $rsp['person'] : $rsp;
		}

		/* Reflection Methods */
		function reflection_getMethodInfo ($method_name) {
			/* http://www.flickr.com/services/api/flickr.reflection.getMethodInfo.html */
			$this->request("flickr.reflection.getMethodInfo", array("method_name" => $method_name));
			return $this->parsed_response ? $this->parsed_response : false;
		}

		function reflection_getMethods () {
			/* http://www.flickr.com/services/api/flickr.reflection.getMethods.html */
			$this->request("flickr.reflection.getMethods");
			return $this->parsed_response ? $this->parsed_response['methods']['method'] : false;
		}

		/* Stats Methods */
		function stats_getCollectionDomains ($date, $collection_id = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.stats.getCollectionDomains.html */
			return $this->call('flickr.stats.getCollectionDomains', array('date' => $date, 'collection_id' => $collection_id, 'per_page' => $per_page, 'page' => $page));
		}

		function stats_getCollectionReferrers ($date, $domain, $collection_id = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.stats.getCollectionReferrers.html */
			return $this->call('flickr.stats.getCollectionReferrers', array('date' => $date, 'domain' => $domain, 'collection_id' => $collection_id, 'per_page' => $per_page, 'page' => $page));
		}

		function stats_getCollectionStats ($date, $collection_id) {
			/* http://www.flickr.com/services/api/flickr.stats.getCollectionStats.html */
			return $this->call('flickr.stats.getCollectionStats', array('date' => $date, 'collection_id' => $collection_id));
		}
		
		function stats_getCSVFiles () {
			/* http://www.flickr.com/services/api/flickr.stats.getCSVFiles.html */
			return $this->call('flickr.stats.getCSVFiles', array());
		}

		function stats_getPhotoDomains ($date, $photo_id = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.stats.getPhotoDomains.html */
			return $this->call('flickr.stats.getPhotoDomains', array('date' => $date, 'photo_id' => $photo_id, 'per_page' => $per_page, 'page' => $page));
		}

		function stats_getPhotoReferrers ($date, $domain, $photo_id = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.stats.getPhotoReferrers.html */
			return $this->call('flickr.stats.getPhotoReferrers', array('date' => $date, 'domain' => $domain, 'photo_id' => $photo_id, 'per_page' => $per_page, 'page' => $page));
		}

		function stats_getPhotosetDomains ($date, $photoset_id = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.stats.getPhotosetDomains.html */
			return $this->call('flickr.stats.getPhotosetDomains', array('date' => $date, 'photoset_id' => $photoset_id, 'per_page' => $per_page, 'page' => $page));
		}

		function stats_getPhotosetReferrers ($date, $domain, $photoset_id = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.stats.getPhotosetReferrers.html */
			return $this->call('flickr.stats.getPhotosetReferrers', array('date' => $date, 'domain' => $domain, 'photoset_id' => $photoset_id, 'per_page' => $per_page, 'page' => $page));
		}

		function stats_getPhotosetStats ($date, $photoset_id) {
			/* http://www.flickr.com/services/api/flickr.stats.getPhotosetStats.html */
			return $this->call('flickr.stats.getPhotosetStats', array('date' => $date, 'photoset_id' => $photoset_id));
		}

		function stats_getPhotoStats ($date, $photo_id) {
			/* http://www.flickr.com/services/api/flickr.stats.getPhotoStats.html */
			return $this->call('flickr.stats.getPhotoStats', array('date' => $date, 'photo_id' => $photo_id));
		}

		function stats_getPhotostreamDomains ($date, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.stats.getPhotostreamDomains.html */
			return $this->call('flickr.stats.getPhotostreamDomains', array('date' => $date, 'per_page' => $per_page, 'page' => $page));
		}

		function stats_getPhotostreamReferrers ($date, $domain, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.stats.getPhotostreamReferrers.html */
			return $this->call('flickr.stats.getPhotostreamReferrers', array('date' => $date, 'domain' => $domain, 'per_page' => $per_page, 'page' => $page));
		}

		function stats_getPhotostreamStats ($date) {
			/* http://www.flickr.com/services/api/flickr.stats.getPhotostreamStats.html */
			return $this->call('flickr.stats.getPhotostreamStats', array('date' => $date));
		}

		function stats_getPopularPhotos ($date = NULL, $sort = NULL, $per_page = NULL, $page = NULL) {
			/* http://www.flickr.com/services/api/flickr.stats.getPopularPhotos.html */
			return $this->call('flickr.stats.getPopularPhotos', array('date' => $date, 'sort' => $sort, 'per_page' => $per_page, 'page' => $page));
		}

		function stats_getTotalViews ($date = NULL) {
			/* http://www.flickr.com/services/api/flickr.stats.getTotalViews.html */
			return $this->call('flickr.stats.getTotalViews', array('date' => $date));
		}
		
		/* Tags Methods */
		function tags_getClusterPhotos ($tag, $cluster_id) {
			/* http://www.flickr.com/services/api/flickr.tags.getClusterPhotos.html */
			return $this->call('flickr.tags.getClusterPhotos', array('tag' => $tag, 'cluster_id' => $cluster_id));
		}

		function tags_getClusters ($tag) {
			/* http://www.flickr.com/services/api/flickr.tags.getClusters.html */
			return $this->call('flickr.tags.getClusters', array('tag' => $tag));
		}

		function tags_getHotList ($period = NULL, $count = NULL) {
			/* http://www.flickr.com/services/api/flickr.tags.getHotList.html */
			$this->request("flickr.tags.getHotList", array("period" => $period, "count" => $count));
			return $this->parsed_response ? $this->parsed_response['hottags'] : false;
		}

		function tags_getListPhoto ($photo_id) {
			/* http://www.flickr.com/services/api/flickr.tags.getListPhoto.html */
			$this->request("flickr.tags.getListPhoto", array("photo_id" => $photo_id));
			return $this->parsed_response ? $this->parsed_response['photo']['tags']['tag'] : false;
		}

		function tags_getListUser ($user_id = NULL) {
			/* http://www.flickr.com/services/api/flickr.tags.getListUser.html */
			$this->request("flickr.tags.getListUser", array("user_id" => $user_id));
			return $this->parsed_response ? $this->parsed_response['who']['tags']['tag'] : false;
		}

		function tags_getListUserPopular ($user_id = NULL, $count = NULL) {
			/* http://www.flickr.com/services/api/flickr.tags.getListUserPopular.html */
			$this->request("flickr.tags.getListUserPopular", array("user_id" => $user_id, "count" => $count));
			return $this->parsed_response ? $this->parsed_response['who']['tags']['tag'] : false;
		}

		function tags_getListUserRaw ($tag = NULL) {
			/* http://www.flickr.com/services/api/flickr.tags.getListUserRaw.html */
			return $this->call('flickr.tags.getListUserRaw', array('tag' => $tag));
		}
		
		function tags_getRelated ($tag) {
			/* http://www.flickr.com/services/api/flickr.tags.getRelated.html */
			$this->request("flickr.tags.getRelated", array("tag" => $tag));
			return $this->parsed_response ? $this->parsed_response['tags'] : false;
		}

		function test_echo ($args = array()) {
			/* http://www.flickr.com/services/api/flickr.test.echo.html */
			$this->request("flickr.test.echo", $args);
			return $this->parsed_response ? $this->parsed_response : false;
		}

		function test_login () {
			/* http://www.flickr.com/services/api/flickr.test.login.html */
			$this->request("flickr.test.login");
			return $this->parsed_response ? $this->parsed_response['user'] : false;
		}

		function urls_getGroup ($group_id) {
			/* http://www.flickr.com/services/api/flickr.urls.getGroup.html */
			$this->request("flickr.urls.getGroup", array("group_id"=>$group_id));
			return $this->parsed_response ? $this->parsed_response['group']['url'] : false;
		}

		function urls_getUserPhotos ($user_id = NULL) {
			/* http://www.flickr.com/services/api/flickr.urls.getUserPhotos.html */
			$this->request("flickr.urls.getUserPhotos", array("user_id"=>$user_id));
			return $this->parsed_response ? $this->parsed_response['user']['url'] : false;
		}

		function urls_getUserProfile ($user_id = NULL) {
			/* http://www.flickr.com/services/api/flickr.urls.getUserProfile.html */
			$this->request("flickr.urls.getUserProfile", array("user_id"=>$user_id));
			return $this->parsed_response ? $this->parsed_response['user']['url'] : false;
		}
		
		function urls_lookupGallery ($url) {
			/* http://www.flickr.com/services/api/flickr.urls.lookupGallery.html */
			return $this->call('flickr.urls.lookupGallery', array('url' => $url));
		}

		function urls_lookupGroup ($url) {
			/* http://www.flickr.com/services/api/flickr.urls.lookupGroup.html */
			$this->request("flickr.urls.lookupGroup", array("url"=>$url));
			return $this->parsed_response ? $this->parsed_response['group'] : false;
		}

		function urls_lookupUser ($url) {
			/* http://www.flickr.com/services/api/flickr.photos.notes.edit.html */
			$this->request("flickr.urls.lookupUser", array("url"=>$url));
			return $this->parsed_response ? $this->parsed_response['user'] : false;
		}
	}

	class phpFlickr_pager {
		var $phpFlickr, $per_page, $method, $args, $results, $global_phpFlickr;
		var $total = null, $page = 0, $pages = null, $photos, $_extra = null;
		
		
		function phpFlickr_pager($phpFlickr, $method = null, $args = null, $per_page = 30) {
			$this->per_page = $per_page;
			$this->method = $method;
			$this->args = $args;
			$this->set_phpFlickr($phpFlickr);
		}
		
		function set_phpFlickr($phpFlickr) {
			if ( is_a($phpFlickr, 'phpFlickr') ) {
				$this->phpFlickr = $phpFlickr;
				if ( $this->phpFlickr->cache ) {
					$this->args['per_page'] = 500;
				} else {
					$this->args['per_page'] = (int) $this->per_page;
				}
			}
		}
		
		function __sleep() {
			return array(
				'method',
				'args',
				'per_page',
				'page',
				'_extra',
			);
		}
		
		function load($page) {
			$allowed_methods = array(
				'flickr.photos.search' => 'photos',
				'flickr.photosets.getPhotos' => 'photoset',
			);
			if ( !in_array($this->method, array_keys($allowed_methods)) ) return false;
			
			if ( $this->phpFlickr->cache ) {
				$min = ($page - 1) * $this->per_page;
				$max = $page * $this->per_page - 1;
				if ( floor($min/500) == floor($max/500) ) {
					$this->args['page'] = floor($min/500) + 1;
					$this->results = $this->phpFlickr->call($this->method, $this->args);
					if ( $this->results ) {
						$this->results = $this->results[$allowed_methods[$this->method]];
						$this->photos = array_slice($this->results['photo'], $min % 500, $this->per_page);
						$this->total = $this->results['total'];
						$this->pages = ceil($this->results['total'] / $this->per_page);
						return true;
					} else {
						return false;
					}
				} else {
					$this->args['page'] = floor($min/500) + 1;
					$this->results = $this->phpFlickr->call($this->method, $this->args);
					if ( $this->results ) {
						$this->results = $this->results[$allowed_methods[$this->method]];

						$this->photos = array_slice($this->results['photo'], $min % 500);
						$this->total = $this->results['total'];
						$this->pages = ceil($this->results['total'] / $this->per_page);
						
						$this->args['page'] = floor($min/500) + 2;
						$this->results = $this->phpFlickr->call($this->method, $this->args);
						if ( $this->results ) {
							$this->results = $this->results[$allowed_methods[$this->method]];
							$this->photos = array_merge($this->photos, array_slice($this->results['photo'], 0, $max % 500 + 1));
						}
						return true;
					} else {
						return false;
					}

				}
			} else {
				$this->args['page'] = $page;
				$this->results = $this->phpFlickr->call($this->method, $this->args);
				if ( $this->results ) {
					$this->results = $this->results[$allowed_methods[$this->method]];
					
					$this->photos = $this->results['photo'];
					$this->total = $this->results['total'];
					$this->pages = $this->results['pages'];
					return true;
				} else {
					return false;
				}
			}
		}
		
		function get($page = null) {
			if ( is_null($page) ) {
				$page = $this->page;
			} else {
				$this->page = $page;
			}
			if ( $this->load($page) ) {
				return $this->photos;
			}
			$this->total = 0;
			$this->pages = 0;
			return array();
		}
		
		function next() {
			$this->page++;
			if ( $this->load($this->page) ) {
				return $this->photos;
			}
			$this->total = 0;
			$this->pages = 0;
			return array();
		}
		
	}
