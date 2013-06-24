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

namespace OCA\Music\BusinessLayer;

require_once(__DIR__ . "/../../classloader.php");

use \OCA\AppFramework\Db\DoesNotExistException;

use \OCA\Music\Db\Album;


class AlbumBusinessLayerTest extends \OCA\AppFramework\Utility\TestUtility {

	private $api;
	private $mapper;
	private $albumBusinessLayer;
	private $userId;
	private $albums;
	private $artistIds;


	protected function setUp(){
		$this->api = $this->getAPIMock();
		$this->mapper = $this->getMockBuilder('\OCA\Music\Db\AlbumMapper')
			->disableOriginalConstructor()
			->getMock();
		$this->albumBusinessLayer = new AlbumBusinessLayer($this->mapper);
		$this->userId = 'jack';
		$album1 = new Album();
		$album2 = new Album();
		$album3 = new Album();
		$album1->setId(1);
		$album2->setId(2);
		$album3->setId(3);
		$this->albums = array($album1, $album2, $album3);
		$this->artistIds = array(
			1 => array(3, 5, 7),
			2 => array(3, 7, 9),
			3 => array(9, 13)
		);

		$album1->setArtistIds($this->artistIds[1]);
		$album2->setArtistIds($this->artistIds[1]);
		$album3->setArtistIds($this->artistIds[1]);
		$this->response = array($album1, $album2, $album3);
	}

	public function testFindAll(){

		$this->mapper->expects($this->once())
			->method('findAll')
			->with($this->equalTo($this->userId))
			->will($this->returnValue($this->albums));
		$this->mapper->expects($this->exactly(1))
			->method('getAlbumArtistsByAlbumId')
			->with($this->equalTo(array(1,2,3)))
			->will($this->returnValue($this->artistIds));

		$result = $this->albumBusinessLayer->findAll($this->userId);
		$this->assertEquals($this->response, $result);
	}
}


