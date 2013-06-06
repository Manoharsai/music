<?php

/**
 * ownCloud - Media app
 *
 * @author Morris Jobke
 * @copyright 2013 Morris Jobke <morris.jobke@gmail.com>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 *
 */


namespace OCA\Media;

use \OCA\AppFramework\App;
use \OCA\Media\DependencyInjection\DIContainer;


/**
 * Webinterface
 */
$this->create('media_index', '/')->get()->action(
	function($params){
		App::main('PageController', 'index', $params, new DIContainer());
	}
);

/**
 * Version api
 */
$this->create('media_version', '/version')->get()->action(
	function($params){
		App::main('PageController', 'version', $params, new DIContainer());
	}
);