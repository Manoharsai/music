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

use \OCA\AppFramework\Core\API;
use \OCA\AppFramework\Http\Request;
use \OCA\Music\Db\Artist;


class ApiController extends Controller {

	private $dummyArtists = array();
	private $dummyAlbums = array();
	private $dummyTracks = array();

	public function __construct(API $api, Request $request){
		parent::__construct($api, $request);
	}

	private function createDummyArtists(){
		$artist = new Artist();
		$artist->setId(1);
		$artist->setUserId(3);
		$artist->setName('The artist name');
		$artist->setImage('http://lorempixel.com/200/200/nightlife');
		$this->dummyArtists[$artist->getId()] = $artist->toApi();
		$artist = new Artist();
		$artist->setId(2);
		$artist->setUserId(3);
		$artist->setName('The proper artist name');
		$artist->setImage('http://lorempixel.com/200/200/people');
		$this->dummyArtists[$artist->getId()] = $artist->toApi();
	}
	private function createDummyAlbums(){
		$album = new Album();
		$album->setId(1);
		$album->setUserId(3);
		$album->setName('The album name');
		$album->setImage('http://lorempixel.com/200/200/nightlife');
		$this->dummyAlbums[$album->getId()] = $album->toApi();
		$album = new Album();
		$album->setId(2);
		$album->setUserId(3);
		$album->setName('The proper album name');
		$album->setImage('http://lorempixel.com/200/200/people');
		$this->dummyAlbums[$album->getId()] = $album->toApi();
		$album = new Album();
		$album->setId(3);
		$album->setUserId(3);
		$album->setName('The properer album name');
		$album->setImage('http://lorempixel.com/200/200/people');
		$this->dummyAlbums[$album->getId()] = $album->toApi();
	}
	private function createDummyTracks(){
		$track = new Track();
		$track->setId(1);
		$track->setUserId(3);
		$track->setTitle('The title');
		$track->setNumber(4);
		$track->setArtistId(2);
		$track->setAlbumId(3);
		$track->setLength(123);
		$track->setFile('path/to/file.ogg');
		$track->setBitrate(123);
		$this->dummyTracks[$track->getId()] = $track->toApi();
		$track = new Track();
		$track->setId(2);
		$track->setUserId(3);
		$track->setTitle('The title2');
		$track->setNumber(56);
		$track->setArtistId(2);
		$track->setAlbumId(1);
		$track->setLength(123);
		$track->setFile('path/to/file.ogg');
		$track->setBitrate(123);
		$this->dummyTracks[$track->getId()] = $track->toApi();
		$track = new Track();
		$track->setId(3);
		$track->setUserId(3);
		$track->setTitle('The title3');
		$track->setNumber(4);
		$track->setArtistId(2);
		$track->setAlbumId(3);
		$track->setLength(123);
		$track->setFile('path/to/file.ogg');
		$track->setBitrate(123);
		$this->dummyTracks[$track->getId()] = $track->toApi();
	}
	/**
	 * @CSRFExemption
	 * @IsAdminExemption
	 * @IsSubAdminExemption
	 * @Ajax
	 */
	public function artists() {
		$this->createDummyArtists();
		return $this->renderPlainJSON(array_values($this->dummyArtists));
	}

	/**
	 * @CSRFExemption
	 * @IsAdminExemption
	 * @IsSubAdminExemption
	 * @Ajax
	 */
	public function artist() {
		$artistId = $this->getIdFromSlug($this->params('artistIdOrSlug'));
		$this->createDummyArtists();
		if(array_key_exists($artistId, $this->dummyArtists))
			return $this->renderPlainJSON($this->dummyArtists[$artistId]);
		else
			return $this->renderPlainJSON(Array('error' => 'No such artist'));
	}

	/**
	 * @CSRFExemption
	 * @IsAdminExemption
	 * @IsSubAdminExemption
	 * @Ajax
	 */
	public function albums() {
		$this->createDummyAlbums();
		return $this->renderPlainJSON(array_values($this->dummyAlbums));
	}

	/**
	 * @CSRFExemption
	 * @IsAdminExemption
	 * @IsSubAdminExemption
	 * @Ajax
	 */
	public function album() {
		$albumId = $this->getIdFromSlug($this->params('albumIdOrSlug'));
		$this->createDummyAlbums();
		if(array_key_exists($albumId, $this->dummyAlbums))
			return $this->renderPlainJSON($this->dummyAlbums[$albumId]);
		else
			return $this->renderPlainJSON(Array('error' => 'No such album'));
	}

	/**
	 * @CSRFExemption
	 * @IsAdminExemption
	 * @IsSubAdminExemption
	 * @Ajax
	 */
	public function tracks() {
		$this->createDummyTracks();
		return $this->renderPlainJSON(array_values($this->dummyTracks));
	}

	/**
	 * @CSRFExemption
	 * @IsAdminExemption
	 * @IsSubAdminExemption
	 * @Ajax
	 */
	public function track() {
		$trackId = $this->getIdFromSlug($this->params('trackIdOrSlug'));
		$this->createDummyTracks();
		if(array_key_exists($trackId, $this->dummyTracks))
			return $this->renderPlainJSON($this->dummyTracks[$trackId]);
		else
			return $this->renderPlainJSON(Array('error' => 'No such track'));
	}
}