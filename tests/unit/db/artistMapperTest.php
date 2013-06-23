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


class ArtistMapperTest extends \OCA\AppFramework\Utility\MapperTestUtility {

	private $mapper;
	private $artists;

	private $userId = 'john';
	private $id = 5;
	private $row;

	public function setUp()
	{
		$this->beforeEach();

		$this->mapper = new ArtistMapper($this->api);

		// create mock items
		$artist1 = new Artist();
		$artist1->setName('Test name');
		$artist1->setImage('http://example.org');
		$artist1->resetUpdatedFields();

		$this->artists = array(
			$artist1
		);

		$this->row = array(
			array('id' => $this->artists[0]->getId(), 'name' => 'Test name', 'image' => 'http://example.org'),
		);

	}


	private function makeSelectQuery($condition=null){
		return 'SELECT `artist`.`name`, `artist`.`image`, `artist`.`id`'.
			'FROM `*PREFIX*music_artists` `artist` '.
			'WHERE `artist`.`user_id` = ? ' . $condition;
	}

	public function testFind(){
		$sql = $this->makeSelectQuery('AND `artist`.`id` = ?');
		$this->setMapperResult($sql, array($this->userId, $this->id), $this->row);
		$result = $this->mapper->find($this->id, $this->userId);
		$this->assertEquals($this->artists[0], $result);
	}
}