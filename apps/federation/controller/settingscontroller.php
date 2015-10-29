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

namespace OCA\Federation\Controller;

use OC\HintException;
use OCA\Federation\TrustedServers;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http;
use OCP\AppFramework\Http\DataResponse;
use OCP\IL10N;
use OCP\IRequest;


class SettingsController extends Controller {

	/** @var IL10N */
	private $l;

	/** @var  TrustedServers */
	private $trustedServers;

	/**
	 * @param string $AppName
	 * @param IRequest $request
	 * @param IL10N $l10n
	 * @param TrustedServers $trustedServers
	 */
	public function __construct($AppName,
								IRequest $request,
								IL10N $l10n,
								TrustedServers $trustedServers
	) {
		parent::__construct($AppName, $request);
		$this->l = $l10n;
		$this->trustedServers = $trustedServers;
	}


	/**
	 * add server to the list of trusted ownClouds
	 *
	 * @UseSession
	 *
	 * @param string $url
	 * @return DataResponse
	 * @throws HintException
	 */
	public function addServer($url) {
		$this->checkServer($url);
		$this->trustedServers->addServer($url);

		return new DataResponse(
			[
				'url' => $url,
				'message' => (string) $this->l->t('Server added to the list of trusted ownClouds')
			]
		);
	}

	/**
	 * add server to the list of trusted ownClouds
	 *
	 * @UseSession
	 *
	 * @param string $url
	 * @return DataResponse
	 * @throws HintException
	 */
	public function removeServer($url) {
		$this->trustedServers->removeServer($url);
		return new DataResponse();
	}

	/**
	 * check if the server should be added to the list of trusted servers or not
	 *
	 * @param string $url
	 * @return bool
	 * @throws HintException
	 */
	protected function checkServer($url) {
		if ($this->trustedServers->isTrustedServer($url) === true) {
			$message = 'Server is already in the list of trusted servers.';
			$hint = $this->l->t('Server is already in the list of trusted servers.');
			throw new HintException($message, $hint);
		}

		if ($this->trustedServers->isOwnCloudServer($url) === false) {
			$message = 'No ownCloud server found';
			$hint = $this->l->t('No ownCloud server found');
			throw new HintException($message, $hint);
		}

		return true;
	}

}
