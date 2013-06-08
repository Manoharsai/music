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
 * Shiva api https://github.com/tooxie/shiva-server#resources
 */

/**
 * Artist(s)
 */
$this->create('media_version', '/api/artists')->get()->action(
	function($params){
		App::main('ApiController', 'artists', $params, new DIContainer());
	}
);
$this->create('media_version', '/api/artist/{id}')->get()->action(
	function($params){
		App::main('ApiController', 'artist', $params, new DIContainer());
	}
);
/*$this->create('media_version', '/api/artist/{id}/shows')->get()->action(
	function($params){
		App::main('ApiController', 'artist-shows', $params, new DIContainer());
	}
);*/

/**
 * Album(s)
 */
$this->create('media_version', '/api/albums')->get()->action(
	function($params){
		App::main('ApiController', 'albums', $params, new DIContainer());
	}
);
$this->create('media_version', '/api/album/{id}')->get()->action(
	function($params){
		App::main('ApiController', 'album', $params, new DIContainer());
	}
);

/**
 * Track(s)
 */
$this->create('media_version', '/api/tracks')->get()->action(
	function($params){
		App::main('ApiController', 'tracks', $params, new DIContainer());
	}
);
$this->create('media_version', '/api/track/{id}')->get()->action(
	function($params){
		App::main('ApiController', 'track', $params, new DIContainer());
	}
);
/*$this->create('media_version', '/api/track/{id}/shows')->get()->action(
	function($params){
		App::main('ApiController', 'track-lyrics', $params, new DIContainer());
	}
);*/