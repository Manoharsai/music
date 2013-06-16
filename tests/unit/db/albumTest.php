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


namespace OCA\Media\Db;

require_once(__DIR__ . "/../../classloader.php");


class AlbumTest extends \PHPUnit_Framework_TestCase {

	public function testToAPI() {
		$album = new Album();
		$album->setUserId(3);
		$album->setName('The name');
		$album->setYear(2013);
		$album->setArtistIds(array(2, 3));
		$album->setCoverUrl('The url');

		$this->assertEquals(array(
			'userId' => 3,
			'name' => 'The name',
			'year' => 2013,
			'artistIds' => array(2, 3),
			'coverUrl' => 'The url'
			), $album->toAPI());
	}

}