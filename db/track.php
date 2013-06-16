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

use \OCA\AppFramework\Db\Entity;


class Track extends Entity {

	public $userId;
	public $title;
	public $number;
	public $artistId;
	public $albumId;
	public $fileSize;
	public $length;
	public $file;
	public $bitrate;

	public function __construct(){
		$this->addType('number', 'int');
		$this->addType('artistId', 'int');
		$this->addType('albumId', 'int');
		$this->addType('fileSize', 'int');
		$this->addType('length', 'int');
		$this->addType('bitrate', 'int');
	}

	public function toAPI() {
		return array(
			'userId' => $this->getUserId(),
			'title' => $this->getTitle(),
			'number' => $this->getNumber(),
			'artistId' => $this->getArtistId(),
			'albumId' => $this->getAlbumId(),
			'fileSize' => $this->getFileSize(),
			'length' => $this->getLength(),
			'file' => $this->getFile(),
			'bitrate' => $this->getBitrate()
		);
	}
}