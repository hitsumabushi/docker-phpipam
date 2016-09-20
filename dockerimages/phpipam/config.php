<?php

# basefile: https://github.com/phpipam/phpipam/blob/44cb08e59d122fc95db5d08389256f9c64ef627d/config.dist.php

/* database connection details
 ******************************/
$db['host'] = getenv('MYSQL_DB_HOSTNAME');
$db['user'] = getenv('MYSQL_DB_USERNAME');
$db['pass'] = getenv('MYSQL_DB_PASSWORD');
$db['name'] = getenv('MYSQL_DB_NAME');
$db['port'] = getenv('MYSQL_DB_PORT');

/* SSL options for MySQL
 ******************************
 See http://php.net/manual/en/ref.pdo-mysql.php
     https://dev.mysql.com/doc/refman/5.7/en/ssl-options.html

     Please update these settings before setting 'ssl' to true.
     All settings can be commented out or set to NULL if not needed

     php 5.3.7 required
*/
$db['ssl']        = getenv('SSL_ENABLED'); # true/false, enable or disable SSL as a whole
$db['ssl_key']    = getenv('SSL_KEY');     # path to an SSL key file. Only makes sense combined with ssl_cert
$db['ssl_cert']   = getenv('SSL_CERT');    # path to an SSL certificate file. Only makes sense combined with ssl_key
$db['ssl_ca']     = getenv('SSL_CA');      # path to a file containing SSL CA certs
$db['ssl_capath'] = getenv('SSL_CAPATH');  # path to a directory containing CA certs
$db['ssl_cipher'] = getenv('SSL_CIPHER');  # one or more SSL Ciphers

/**
 * php debugging on/off
 *
 * true  = SHOW all php errors
 * false = HIDE all php errors
 ******************************/
$debugging = getenv('DEBUGGING');

/**
 *  manual set session name for auth
 *  increases security
 *  optional
 */
$phpsessname = getenv('PHPSESSNAME');

/**
 *	BASE definition if phpipam
 * 	is not in root directory (e.g. /phpipam/)
 *
 *  Also change
 *	RewriteBase / in .htaccess
 ******************************/
if(!defined('BASE'))
define('BASE', "/");

/**
 * Multicast unique mac requirement - section or vlan
 */

if(!defined('MCUNIQUE'))
define('MCUNIQUE', "section");


/**
 * Google MAPs API key for locations to display map
 *
 *  Obtain key: Go to your Google Console (https://console.developers.google.com) and enable "Google Maps JavaScript API"
 *  from overview tab, so go to Credentials tab and make an API key for your project.
 */
$gmaps_api_key = getenv('GMAPS_API_KEY');

/*  proxy connection details
 ******************************/
$proxy_enabled  = getenv('PROXY_ENABLED');             # Enable/Disable usage of the Proxy server
$proxy_server   = getenv('PROXY_SERVER');              # Proxy server FQDN or IP
$proxy_port     = getenv('PROXY_PORT');                # Proxy server port
$proxy_user     = getenv('PROXY_USER');                # Proxy Username
$proxy_pass     = getenv('PROXY_PASS');                # Proxy Password
$proxy_use_auth = getenv('PROXY_USE_AUTH');            # Enable/Disable Proxy authentication

/**
 * proxy to use for every internet access like update check
 */
$proxy_auth     = base64_encode("$proxy_user:$proxy_pass");

if ($proxy_enabled == true && $proxy_use_auth == false) {
    stream_context_set_default(array('http' => array('proxy'=>'tcp://'.$proxy_server.':'.$proxy_port)));
}
elseif ($proxy_enabled == true && $proxy_use_auth == true) {
    stream_context_set_default(
        array('http' => array(
              'proxy' => "tcp://$proxy_server:$proxy_port",
              'request_fulluri' => true,
              'header' => "Proxy-Authorization: Basic $proxy_auth"
        )));
}

/* for debugging proxy config uncomment next line */
#var_dump(stream_context_get_options(stream_context_get_default()));

?>
