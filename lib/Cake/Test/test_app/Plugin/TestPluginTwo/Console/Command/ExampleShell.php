<?php
/**
 * Short description for file.
 *
 * CakePHP(tm) Tests <http://book.cakephp.org/2.0/en/development/testing.html>
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://book.cakephp.org/2.0/en/development/testing.html CakePHP(tm) Tests
 * @package       Cake.Test.TestApp.Plugin.TestPluginTwo.Console.Command
 * @since         CakePHP(tm) v 1.2.0.7871
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Class ExampleShell
 *
 * @package       Cake.Test.TestApp.Plugin.TestPluginTwo.Console.Command
 */
class ExampleShell extends Shell {

/**
 * main method
 *
 * @return void
 */
	public function main() {
		$this->out('This is the main method called from TestPluginTwo.ExampleShell');
	}
}
