<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;


class Bootstrap
{
	public static function boot(): Configurator
	{

		$configurator = new Configurator;
		$appDir = dirname(__DIR__);

        //print_r(getenv());die;

		//$configurator->setDebugMode('secret@23.75.345.200'); // enable for your remote IP
		$configurator->enableTracy($appDir . '/log');

		$configurator->setTempDirectory($appDir . '/temp');

		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();


        \Dotenv\Dotenv::createImmutable(__DIR__.'/../')->safeLoad();
        $configurator->addDynamicParameters(['ENV' => $_SERVER]);

		$configurator->addConfig($appDir . '/config/common.neon');
		$configurator->addConfig($appDir . '/config/services.neon');
		$configurator->addConfig($appDir . '/config/local.neon');

		return $configurator;
	}
}
