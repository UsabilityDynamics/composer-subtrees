<?php
/**
 *
 */
namespace UsabilityDynamics\Composer\Subtrees {

	use Composer\Composer;
	use Composer\EventDispatcher\EventSubscriberInterface;
	use Composer\Config;
	use Composer\IO\IOInterface;
	use Composer\Plugin\PluginInterface;
	use Composer\Plugin\PluginEvents;
	use Composer\Plugin\PreFileDownloadEvent;
	use Composer\Plugin\CommandEvent;

	class Plugin implements PluginInterface {

		public function activate( Composer $composer, IOInterface $io ) {
			//$installer = new TemplateInstaller( $io, $composer );
			//$composer->getInstallationManager()->addInstaller( $installer );
		}

	}

}