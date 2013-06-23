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


namespace OCA\Music\Db;

require_once(__DIR__ . "/../../classloader.php");


class TrackTest extends \PHPUnit_Framework_TestCase {

	public function testToAPI() {
		$track = new Track();
		$track->setId(1);
		$track->setTitle('The title');
		$track->setNumber(4);
		$track->setArtistId(2);
		$track->setAlbumId(3);
		$track->setLength(123);
		$track->setFile('path/to/file.ogg');
		$track->setBitrate(123);

		$this->assertEquals(array(
			'id' => 1,
			'title' => 'The title',
			'number' => 4,
			'artistId' => 2,
			'albumId' => 3,
			'length' => 123,
			'file' => 'path/to/file.ogg',
			'bitrate' => 123,
			'slug' => '1-the-title',
			'uri' => ''
			), $track->toAPI());
	}

}