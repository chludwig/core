<?php
/**
 * @author Björn Schießle <schiessle@owncloud.com>
 *
 * @copyright Copyright (c) 2015, ownCloud, Inc.
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */


namespace OCA\Federation;


use OC\HintException;

class TrustedServers {

	/**
	 * add server to the list of trusted ownCloud servers
	 *
	 * @param $url
	 * @return bool
	 * @throws HintException
	 */
	public function addServer($url) {
		$result = true;
		if ($result === false) {
			throw new HintException();
		}

		return true;
	}

	/**
	 * remove server from the list of trusted ownCloud servers
	 *
	 * @param string $url
	 * @return bool
	 */
	public function removeServer($url) {
		return true;
	}

	/**
	 * check if given server is a trusted ownCloud server
	 *
	 * @param string $url
	 * @return bool
	 */
	public function isTrustedServer($url) {
		return false;
	}

	/**
	 * check if URL point to a ownCloud server
	 *
	 * @param string $url
	 * @return bool
	 */
	public function isOwnCloudServer($url) {
		return true;
	}
}
