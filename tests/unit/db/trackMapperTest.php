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

require_once(__DIR__ . "/../../classloader.php");


class TrackMapperTest extends \OCA\AppFramework\Utility\MapperTestUtility {

	private $mapper;
	private $tracks;

	private $userId = 'john';
	private $id = 5;
	private $rows;

	public function setUp()
	{
		$this->beforeEach();

		$this->mapper = new TrackMapper($this->api);

		// create mock items
		$track1 = new Track();
		$track1->setTitle('Test title');
		$track1->resetUpdatedFields();
		$track2 = new Track();

		$this->tracks = array(
			$track1,
			$track2
		);

		$this->rows = array(
			array('id' => $this->tracks[0]->getId(), 'title' => 'Test title'),
			array('id' => $this->tracks[1]->getId()),
		);

	}


	private function makeSelectQuery($condition=null){
		return 'SELECT `track`.`title`, `track`.`number`, '.
			'`track`.`artist_id`, `track`.`album_id`, `track`.`length`, '.
			'`track`.`file`, `track`.`bitrate`, `track`.`id` '.
			'FROM `*PREFIX*music_tracks` `track` '.
			'WHERE `track`.`user_id` = ? ' . $condition;
	}

	public function testFind(){
		$sql = $this->makeSelectQuery('AND `track`.`id` = ?');
		$this->setMapperResult($sql, array($this->userId, $this->id), array($this->rows[0]));
		$result = $this->mapper->find($this->id, $this->userId);
		$this->assertEquals($this->tracks[0], $result);
	}

	public function testFindAll(){
		$sql = $this->makeSelectQuery();
		$this->setMapperResult($sql, array($this->userId), $this->rows);
		$result = $this->mapper->findAll($this->userId);
		$this->assertEquals($this->tracks, $result);
	}
}