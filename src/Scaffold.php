<?php
/**
 *
 *
 * @author  Jeremy Ward <jeremy@jmichaelward.com>
 * @since   2019-10-12
 * @package JMichaelWard\WPPluginStarterInit
 */

namespace JMichaelWard\WPPluginStarterInit;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class App
 *
 * @author  Jeremy Ward <jeremy@jmichaelward.com>
 * @since   2019-10-12
 * @package JMichaelWard\WPPluginStarterInit
 */
class Scaffold extends Command {
	/**
	 * The name of this command.
	 *
	 * @since 2019-10-12
	 * @var string
	 */
	protected static $defaultName = 'scaffold';

	/**
	 * Configuration for this scaffold command.
	 *
	 * @author Jeremy Ward <jeremy@jmichaelward.com>
	 * @since  2019-10-12
	 * @return void
	 */
	protected function configure() {
		$this
			->setDescription( 'Scaffolds a brand new WordPress plugin.' )
			->setHelp( 'This command allows you to replace starter plugin values with your own custom ones.' );
	}

	/**
	 * Executes this scaffold command.
	 *
	 * @param InputInterface  $input
	 * @param OutputInterface $output
	 *
	 * @author Jeremy Ward <jeremy@jmichaelward.com>
	 * @since  2019-10-12
	 * @return int|void|null
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) {
		$output->writeln( 'Attempting to scaffold your plugin. Initializing wizard.' );
	}
}
