<?php declare (strict_types = 1);

namespace DodoIt\DibiEntityGenerator\Repository;

use Dibi\Connection;
use DodoIt\EntityGenerator\Entity\Column;
use DodoIt\EntityGenerator\Repository\IRepository;

class DibiRepository implements IRepository
{
	/**
	 * @var
	 */
	private Connection $db;


	public function __construct(Connection $db)
	{
		$this->db = $db;
	}


	/**
	 * @return string[]
	 */
	public function getTables(): array
	{
		return $this->db->fetchPairs('SHOW TABLES');
	}


	/**
	 * @throws \Dibi\Exception
	 */
	public function getTableColumns(string $table): array
	{
		return $this->db->query('SHOW COLUMNS FROM %n', $table)->setRowClass(Column::class)->fetchAll();
	}


	public function createViewFromQuery(string $name, string $query): void
	{
		$this->db->query('CREATE VIEW %n AS ' . $query, $name);
	}


	public function dropView(string $name): void
	{
		$this->db->query('DROP VIEW %n', $name);
	}
}