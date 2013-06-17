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
use \OCA\Music\BusinessLayer\TrackBusinessLayer;


class ApiController extends Controller {

	private $trackBusinessLayer;

	private $dummyArtists = array();
	private $dummyAlbums = array();
	private $dummyTracks = array();

	public function __construct(API $api, Request $request, TrackBusinessLayer $trackbusinesslayer){
		parent::__construct($api, $request);
		$this->trackBusinessLayer = $trackbusinesslayer;
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
		$userId = $this->api->getUserId();
		if($artistId = $this->params('artist')) {
			$tracks = $this->trackBusinessLayer->findAllByArtist($artistId, $userId);
		} elseif($albumId = $this->params('album')) {
			$tracks = $this->trackBusinessLayer->findAllByAlbum($albumId, $userId);
		} else {
			$tracks = $this->trackBusinessLayer->findAll($userId);
		}
		return $this->renderPlainJSON($tracks);
	}

	/**
	 * @CSRFExemption
	 * @IsAdminExemption
	 * @IsSubAdminExemption
	 * @Ajax
	 */
	public function track() {
		$userId = $this->api->getUserId();
		$trackId = $this->getIdFromSlug($this->params('trackIdOrSlug'));
		$track = $this->trackBusinessLayer->find($trackId, $userId);
		return $this->renderPlainJSON($track);
	}
}