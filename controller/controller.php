<?php

/**
 * ownCloud - Music app
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


namespace OCA\Music\Controller;

use \OCA\AppFramework\Controller\Controller as BaseController;
use \OCA\AppFramework\Core\API;
use \OCA\AppFramework\Http\Request;
use \OCA\AppFramework\Http\JSONResponse;


class Controller extends BaseController {


	public function __construct(API $api, Request $request){
		parent::__construct($api, $request);
	}


	/**
	 * Shortcut for rendering a JSON response with just the data
	 * @param array $data the PHP array that will be converted to JSON
	 * empty by default
	 * @return \OCA\AppFramework\Http\PlainJSONResponse containing the values
	 */
	public function renderPlainJSON(array $data=array()){
		$response = new JSONResponse();
		$response->setData($data);

		return $response;
	}
}