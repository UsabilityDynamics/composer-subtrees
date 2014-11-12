<?php

namespace UsabilityDynamics\Composer\Worklow;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class WorkflowPlugin implements PluginInterface
{
	public function activate(Composer $composer, IOInterface $io)
	{
		$installer = new TemplateInstaller($io, $composer);
		$composer->getInstallationManager()->addInstaller($installer);
	}
}
