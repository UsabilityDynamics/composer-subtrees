<?php

namespace UsabilityDynamics\Composer\Worklow;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Plugin\PluginEvents;
use Composer\Plugin\PreFileDownloadEvent;
use Composer\Plugin\CommandEvent;

#use Composer\Plugin\PluginCommandInterface;
#use Jderusse\Console\Command\GreetCommand;

class Plugin implements PluginCommandInterface  {

	public function activate(Composer $composer, IOInterface $io)
	{


		$installer = new TemplateInstaller($io, $composer);
		$composer->getInstallationManager()->addInstaller($installer);

	}

	public static function getSubscribedEvents() {
		return array(
			PluginEvents::PRE_FILE_DOWNLOAD => array(
				array( 'onPreFileDownload', 0 )
			),
			PluginEvents::COMMAND           => array(
				array( 'onAnyCommand', 0 )
			),
		);
	}

	public function onAnyCommand( CommandEvent $event ) {

		//die( '<pre>' . print_r( $event, true ) . '</pre>');
		//echo "Event:" . $event::COMMAND;
	}

	public function onPreFileDownload(PreFileDownloadEvent $event)
	{
		$protocol = parse_url($event->getProcessedUrl(), PHP_URL_SCHEME);

		if ($protocol === 's3') {
			$awsClient = new AwsClient($this->io, $this->composer->getConfig());
			$s3RemoteFilesystem = new S3RemoteFilesystem(
				$this->io,
				$this->composer->getConfig(),
				$event->getRemoteFilesystem()->getOptions(),
				$awsClient
			);
			$event->setRemoteFilesystem($s3RemoteFilesystem);
		}
	}

	public function getCommands()
	{
		return array(new GreetCommand());
	}

}