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
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

/**
 * Class App
 *
 * @author  Jeremy Ward <jeremy@jmichaelward.com>
 * @since   2019-10-12
 * @package JMichaelWard\WPPluginStarterInit
 */
class Scaffold extends Command {
	/**
	 * Default string values to replace.
	 *
	 * @since 2019-10-12
	 * @var array
	 */
	private $defaults = [
		'name'              => 'wp-plugin-starter',
		'description'       => '',
		'git_repo'          => '',
		'author_name'       => 'Jeremy Ward',
		'author_email'      => 'jeremy@jmichaelward.com',
		'author_uri'        => 'https://jmichaelward.com',
		'package_namespace' => 'JMichaelWard\WPPluginStarter',
	];

	/**
	 * Files requiring string replacement.
	 *
	 * @since 2019-10-12
	 * @var array
	 */
	private $files = [
		'wp-plugin-starter.php',
		'README.md',
		'composer.json',
		'src/autoload.php',
		'src/Plugin.php',
	];

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
	 * @TODO This whole thing is a work in progress and will be teased out into separate files/functions once I get the core bits working.
	 *
	 * @param InputInterface  $input
	 * @param OutputInterface $output
	 *
	 *
	 * @author Jeremy Ward <jeremy@jmichaelward.com>
	 * @since  2019-10-12
	 * @return int|void|null
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) {
		$output->writeln( "Let's gather the details to update your plugin scaffolding..." );

		$path = trim( `pwd` );

		/* @var QuestionHelper $helper Interactive input. */
		$helper = $this->getHelper('question');

		// Namespace question.
		$question1 = new Question("Enter your package namespace in Vendor\\PackageName format: ");
		$namespace = $helper->ask($input, $output, $question1);

		foreach ( $this->files as $filename ) {
			$file_path = $path . '/' . $filename;

			$file = file_get_contents( $file_path );

			$replacement = str_replace( $this->defaults['package_namespace'], $namespace, $file );

			file_put_contents( $file_path, $replacement );
		}

		$output->writeln( 'Matching plugin filename to plugin directory name...' );

		// rename the plugin file.
		$path_parts       = explode( DIRECTORY_SEPARATOR, $path );
		$plugin_directory = trim( array_pop( $path_parts ) );

		$this->match_plugin_file_to_directory( $plugin_directory );
	}

	/**
	 * Match the plugin file name to the directory.
	 *
	 * @param string $plugin_directory The string representing the plugin directory name.
	 *
	 * @author Jeremy Ward <jeremy@jmichaelward.com>
	 * @since  2019-10-12
	 * @return void
	 */
	private function match_plugin_file_to_directory( string $plugin_directory ) {
		if ( $plugin_directory === $this->defaults['name'] || ! file_exists( $this->defaults['name'] . '.php' ) ) {
			return;
		}

		rename( $this->defaults['name'] . '.php', $plugin_directory . '.php' );
	}
}
