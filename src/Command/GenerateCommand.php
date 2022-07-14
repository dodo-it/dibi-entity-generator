<?php declare (strict_types=1);

namespace DodoIt\DibiEntityGenerator\Command;

use DodoIt\EntityGenerator\Generator\Generator;
use Nette\Utils\Finder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends Command
{

	/**
	 * @var string
	 */
	protected static $defaultName = 'entity:generate';

	private Generator $generator;

	public function __construct(Generator $generator)
	{
		parent::__construct();
		$this->generator = $generator;
	}


	protected function configure()
	{
		$this->setName('entity:generate')
			->setDescription('Generate entities from database');
		$this->addArgument('table', InputArgument::OPTIONAL);
		$this->addOption('query', NULL, InputOption::VALUE_OPTIONAL, 'Provide SQL query from which I can generate entity (WARNING: This will create view with name of table argument and DROP it afterwards)');
		$this->addOption('query-file', NULL, InputOption::VALUE_OPTIONAL, 'Provide file path that holds SQL query from which to generate entity (works in similar way as query but it loads query from file)');
		$this->addOption('query-dir', NULL, InputOption::VALUE_OPTIONAL, 'Provide directory path that holds SQL queries from which to generate entities (works in similar way as query but it loads query from .sql files in directory, 1 file = 1 query, entity name is same as sql filename + suffix/prefix)');

	}


	protected function execute(InputInterface $input, OutputInterface $output)
	{
		if ($dir = $input->getOption('query-dir')) {
			/**
			 * @var string $filepath
			 * @var \SplFileInfo $file
			 */
			foreach (Finder::findFiles('*.sql')->in($dir) as $filepath => $file) {
				$this->generator->generate($file->getBasename('.sql'), file_get_contents($filepath));
			}

			return;
		}

		$query = $input->getOption('query');

		if($input->getOption('query-file')) {
			$query = file_get_contents($input->getOption('query-file'));
		}
		$this->generator->generate($input->getArgument('table'), $query);
		return 0;
	}
}
