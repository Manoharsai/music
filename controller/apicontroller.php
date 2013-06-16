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


namespace OCA\Media\Controller;

use \OCA\AppFramework\Core\API;
use \OCA\AppFramework\Http\Request;


class ApiController extends Controller {

	private $dummyArtists = Array(
		1 => Array(
			'name' => 'Abc Artist',
			'image' => 'http://lorempixel.com/200/200/nightlife',
			'uri' => '/artist/1',
			'slug' => 'abc-artist',
			'id' => 1
		),
		2 => Array(
			'name' => 'Bcd Artist',
			'image' => 'http://lorempixel.com/200/200/nightlife',
			'uri' => '/artist/2',
			'slug' => 'bcd-artist',
			'id' => 2
		)
	);

	private $dummyAlbums = Array(
		1 => Array(
			'name' => 'Abc Album',
			'year' => 2003,
			'cover' => 'http://lorempixel.com/200/200/nightlife',
			'uri' => '/album/1',
			'slug' => 'abc-album',
			'id' => 1,
			'artists' => Array(
				Array('id' => 1, 'uri' => '/artist/1')
			)
		),
		2 => Array(
			'name' => 'Bcd Album',
			'year' => 2007,
			'cover' => 'http://lorempixel.com/200/200/nightlife',
			'uri' => '/album/2',
			'slug' => 'bcd-album',
			'id' => 2,
			'artists' => Array(
				Array('id' => 2, 'uri' => '/artist/2')
			)
		),
		3 => Array(
			'name' => 'Cde Album',
			'year' => 2013,
			'cover' => 'http://lorempixel.com/200/200/nightlife',
			'uri' => '/album/3',
			'slug' => 'cde-album',
			'id' => 3,
			'artists' => Array(
				Array('id' => 1, 'uri' => '/artist/1'),
				Array('id' => 2, 'uri' => '/artist/2')
			)
		)
	);

	private $dummyTracks = Array(
		1 => Array(
			'title' => 'Abc Title',
			'uri' => '/track/1',
			'slug' => 'abc-title',
			'id' => 1,
			'artist' => Array('id' => 1, 'uri' => '/artist/1'),
			'number' => 4,
			'bitrate' => 128,
			'album' => Array('id' => 3, 'uri' => '/album/3'),
			'length' => 512,
			'files' => Array(
				'audio/mp3' => 'path/to/track.mp3',
				'audio/ogg' => '/track/1/convert?mimetype=audio%2Fogg'
			)
		),
		2 => Array(
			'title' => 'Bcd Title',
			'uri' => '/track/2',
			'slug' => 'bcd-title',
			'id' => 2,
			'artist' => Array('id' => 1, 'uri' => '/artist/1'),
			'number' => 7,
			'bitrate' => 128,
			'album' => Array('id' => 3, 'uri' => '/album/3'),
			'length' => 512,
			'files' => Array(
				'audio/mp3' => 'path/to/track2.mp3',
				'audio/ogg' => '/track/2/convert?mimetype=audio%2Fogg'
			)
		),
		3 => Array(
			'title' => 'Cde Title',
			'uri' => '/track/3',
			'slug' => 'cde-title',
			'id' => 3,
			'artist' => Array('id' => 2, 'uri' => '/artist/2'),
			'number' => 10,
			'bitrate' => 128,
			'album' => Array('id' => 2, 'uri' => '/album/2'),
			'length' => 512,
			'files' => Array(
				'audio/mp3' => 'path/to/track3.mp3',
				'audio/ogg' => '/track/3/convert?mimetype=audio%2Fogg'
			)
		),
		4 => Array(
			'title' => 'Def Title',
			'uri' => '/track/4',
			'slug' => 'def-title',
			'id' => 4,
			'artist' => Array('id' => 1, 'uri' => '/artist/1'),
			'number' => 2,
			'bitrate' => 128,
			'album' => Array('id' => 1, 'uri' => '/album/1'),
			'length' => 512,
			'files' => Array(
				'audio/mp3' => 'path/to/track4.mp3',
				'audio/ogg' => '/track/4/convert?mimetype=audio%2Fogg'
			)
		)
	);


	public function __construct(API $api, Request $request){
		parent::__construct($api, $request);
	}

	/**
	 * @CSRFExemption
	 * @IsAdminExemption
	 * @IsSubAdminExemption
	 * @Ajax
	 */
	public function artists() {
		return $this->renderPlainJSON(array_values($this->dummyArtists));
	}

	/**
	 * @CSRFExemption
	 * @IsAdminExemption
	 * @IsSubAdminExemption
	 * @Ajax
	 */
	public function artist() {
		$artists = Array(Array(
			'name' => 'Abc Artist',
			'image' => 'http://lorempixel.com/200/200/nightlife',
			'uri' => '/artist/1',
			'slug' => 'abc-artist',
			'id' => 1
		),Array(
			'name' => 'Bcd Artist',
			'image' => 'http://lorempixel.com/200/200/nightlife',
			'uri' => '/artist/2',
			'slug' => 'bcd-artist',
			'id' => 2
		));
		if(array_key_exists($this->params('artistId'), $this->dummyArtists))
			return $this->renderPlainJSON($this->dummyArtists[$this->params('artistId')]);
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
		return $this->renderPlainJSON(array_values($this->dummyAlbums));
	}

	/**
	 * @CSRFExemption
	 * @IsAdminExemption
	 * @IsSubAdminExemption
	 * @Ajax
	 */
	public function album() {
		if(array_key_exists($this->params('albumId'), $this->dummyAlbums))
			return $this->renderPlainJSON($this->dummyAlbums[$this->params('albumId')]);
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
		return $this->renderPlainJSON(array_values($this->dummyTracks));
	}

	/**
	 * @CSRFExemption
	 * @IsAdminExemption
	 * @IsSubAdminExemption
	 * @Ajax
	 */
	public function track() {
		if(array_key_exists($this->params('trackId'), $this->dummyTracks))
			return $this->renderPlainJSON($this->dummyTracks[$this->params('trackId')]);
		else
			return $this->renderPlainJSON(Array('error' => 'No such track'));
	}
}