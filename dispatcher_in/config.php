<?php
/****************************************************************************
 * config.php		- Configuration parameters for incoming dispatcher.
 * version 		- 1.0.2
 * 
 * Version: MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 *
 * The Initial Developer of the Original Code is
 *   Louise Berthilson <louise@it46.se>
 *
 *
 ***************************************************************************/

define("Version", '2.0');
define("ParentXML", "ff-event");
define("BaseDir", "/opt/freedomfone/");
define("DefaultXSL", "default.xsl");
define("BlackListXSL", "blacklist.xsl");
define("DirXSL", BaseDir."dispatcher_in/templates/");
define("LogFile", "/opt/freedomfone/log/dispatcher_in.log");
define("LocalDomain", "http://localhost/freedomfone/");
define("ESLPath", BaseDir."/esl/native/ESL.php");
define("PidFile", BaseDir."gui/app/webroot/system/pid/dispatcher_in.pid");
define("VersionFile", BaseDir."gui/app/webroot/system/version/dispatcher_in");
define("EpochFile", BaseDir."gui/app/webroot/system/epoch/dispatcher_in");
define("LogLevel", 3);  //1 = low, 2 = medium, 3 = high

$_SocketParam = array(
	      'host'=>'localhost',
	      'port'=>'8021',
	      'pass'=>'ClueCon',
	      'timeout'=>3,
	      'stream_timeout'=>0.5
	      );

$_DispatcherDB = array(
	      'host'=>'localhost',
	      'user'=>'dispatcher_in',
	      'password'=>'thefone',
	      'database'=>'spooler_in'
	      );

$_CallbackAPI = array(
	      'url_GET'      => 'http://localhost/freedomfone/api/get',
	      'url_POST'     => 'http://localhost/freedomfone/api/post',
	      'user'    => 'api',
	      'password'=> 'freddyboy',
	      );

$_AllowCURL = array('callback' => 'callback_in');
?>
