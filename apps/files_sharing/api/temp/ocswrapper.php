<?php

namespace OCA\Files_Sharing\API\Temp;

class OCSWrapper {

	private function getOCS() {
		return new OCS(new \OC\Share20\Manager(
		                   \OC::$server->getUserSession()->getUser(),
		                   \OC::$server->getUserManager(),
		                   \OC::$server->getGroupManager(),
		                   \OC::$server->getLogger(),
		                   \OC::$server->getAppConfig(),
		                   \OC::$server->getUserFolder(),
		                    new \OC\Share20\DefaultShareProvider(
		                       \OC::$server->getDatabaseConnection()
		                   )
		               ),
		               \OC::$server->getGroupManager(),
		               \OC::$server->getUserManager(),
		               \OC::$server->getRequest(),
		               \OC::$server->getUserFolder());
	}

	public function createShare() {
		return $this->getOCS()->createShare();
	}
	
}
