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

namespace OCA\Federation\AppInfo;

use OCA\Federation\Middleware\AddServerMiddleware;
use OCP\App;

class Application extends \OCP\AppFramework\App {

	/**
	 * @param array $urlParams
	 */
	public function __construct($urlParams = array()) {
		parent::__construct('federation', $urlParams);
		$this->registerService();
		$this->registerMiddleware();

	}

	/**
	 * register setting scripts
	 */
	public function registerSettings() {
		App::registerAdmin('federation', 'settings/settings-admin');
	}

	private function registerService() {
		$container = $this->getContainer();

		$container->registerService('addServerMiddleware', function($c) use ($container) {
			return new AddServerMiddleware(
				$container->getAppName(),
				\OC::$server->getL10N($container->getAppName()),
				\OC::$server->getLogger()
			);
		});
	}

	private function registerMiddleware() {
		$container = $this->getContainer();
		$container->registerMiddleware('addServerMiddleware');
	}
}
