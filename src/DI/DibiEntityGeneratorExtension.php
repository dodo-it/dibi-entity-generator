<?php declare (strict_types = 1);

namespace DodoIt\DibiEntityGenerator\DI;

use DodoIt\DibiEntityGenerator\Command\GenerateCommand;
use DodoIt\DibiEntityGenerator\Repository\DibiRepository;
use DodoIt\EntityGenerator\Generator\Config;
use DodoIt\EntityGenerator\Generator\Generator;
use DodoIt\EntityGenerator\Repository\IRepository;
use Nette\DI\CompilerExtension;
use Nette\DI\Helpers;

class DibiEntityGeneratorExtension extends CompilerExtension
{

	/** @var mixed[] */
	private $defaults;

	/**
	 * Register services
	 */
	public function loadConfiguration(): void
	{
		$defaults = new Config();
		$this->defaults = (array) $defaults;
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults);
		$config = Helpers::expand($config, $builder->parameters);

		$builder->addDefinition($this->prefix('repository'))
			->setFactory(DibiRepository::class);

		$builder->addDefinition($this->prefix('Generator'))
			->setFactory(Generator::class, ['config' => new Config($config)]);

		$builder->addDefinition($this->prefix('GenerateCommand'))
			->setFactory(GenerateCommand::class);
	}
}