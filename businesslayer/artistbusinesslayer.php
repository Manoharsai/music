<?php

/**
* ownCloud - Music app
*
* @author Morris Jobke
* @copyright 2013 Morris Jobke morris.jobke@gmail.com
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

namespace OCA\Music\BusinessLayer;

use \OCA\Music\Db\ArtistMapper;


class ArtistBusinessLayer extends BusinessLayer {

	public function __construct(ArtistMapper $artistMapper){
		parent::__construct($artistMapper);
	}

	/**
	 * Returns all artists
	 * @param string $userId the name of the user
	 * @return array of artists
	 */
	public function findAll($userId){
		return $this->mapper->findAll($userId);
	}

	/**
	 * Returns a artist
	 * @param string $id the id of the artist
	 * @param string $userId the name of the user
	 * @return artist
	 */
	public function find($id, $userId){
		return $this->mapper->find($id, $userId);
	}
}
