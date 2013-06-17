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

namespace OCA\Music\Db;

use \OCA\AppFramework\Db\Mapper;
use \OCA\AppFramework\Core\API;

class ArtistMapper extends Mapper {

	public function __construct(API $api){
		parent::__construct($api, 'music_artists');
	}

	protected function findAllRows($sql, $params) {
		$result = $this->execute($sql, $params);

		$artists = array();

		while($row = $result->fetchRow()){
			$artist = new Artist();
			$artist->fromRow($row);

			array_push($artists, $artist);
		}

		return $artists;
	}

	private function makeSelectQuery($condition=null){
		return 'SELECT `artist`.`name`, `artist`.`image`, `artist`.`id`'.
			'FROM `*PREFIX*music_artists` `artist` '.
			'WHERE `artist`.`user_id` = ? ' . $condition;
	}

	public function findAll($userId){
		$sql = $this->makeSelectQuery();
		$params = array($userId);
		return $this->findAllRows($sql, $params);
	}

	public function find($id, $userId){
		$sql = $this->makeSelectQuery('AND `artist`.`id` = ?');
		$params = array($userId, $id);
		$artist = new Artist();
		$artist->fromRow($this->findOneQuery($sql, $params));
		return $artist;
	}
}
