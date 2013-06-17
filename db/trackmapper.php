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

class TrackMapper extends Mapper {

	public function __construct(API $api){
		parent::__construct($api, 'music_tracks');
	}

	protected function findAllRows($sql, $params) {
		$result = $this->execute($sql, $params);

		$tracks = array();

		while($row = $result->fetchRow()){
			$track = new Track();
			$track->fromRow($row);

			array_push($tracks, $track);
		}

		return $tracks;
	}

	private function makeSelectQuery($condition=null){
		return 'SELECT `track`.`title`, `track`.`number`, '.
			'`track`.`artist_id`, `track`.`album_id`, `track`.`length`, '.
			'`track`.`file`, `track`.`bitrate`, `track`.`id` '.
			'FROM `*PREFIX*music_tracks` `track` '.
			'WHERE `track`.`user_id` = ? ' . $condition;
	}

	public function findAll($userId){
		$sql = $this->makeSelectQuery();
		$params = array($userId);
		return $this->findAllRows($sql, $params);
	}

	public function findAllByArtist($artistId, $userId){
		$sql = $this->makeSelectQuery('AND `track`.`artist_id` = ?');
		$params = array($userId, $artistId);
		return $this->findAllRows($sql, $params);
	}

	public function findAllByAlbum($albumId, $userId){
		$sql = $this->makeSelectQuery('AND `track`.`album_id` = ?');
		$params = array($userId, $albumId);
		return $this->findAllRows($sql, $params);
	}

	public function find($id, $userId){
		$sql = $this->makeSelectQuery('AND `track`.`id` = ?');
		$params = array($userId, $id);
		$track = new Track();
		$track->fromRow($this->findOneQuery($sql, $params));
		return $track;
	}
}
