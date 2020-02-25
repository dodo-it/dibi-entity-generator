# Dibi Entity generator
Highly configurable typed entity generator from database. It can generate entities for whole database, table/view and from queries.

This is dibi/nette bridge for https://github.com/dodo-it/entity-generator/


[![Latest Stable Version](https://poser.pugx.org/dodo-it/dibi-entity-generator/v/stable)](https://packagist.org/packages/dodo-it/dibi-entity-generator)
[![Total Downloads](https://poser.pugx.org/dodo-it/dibi-entity-generator/downloads)](https://packagist.org/packages/dodo-it/dibi-entity-generator)
[![License](https://poser.pugx.org/dodo-it/dibi-entity-generator/license)](https://packagist.org/packages/dodo-it/dibi-entity-generator)


## Installation

    $ composer require dodo-it/dibi-entity-generator
    
## Registration

```yaml
  extensions:
    entityGenerator: DodoIt\DibiEntityGenerator\DI\DibiEntityGeneratorExtension
```

## Configuration

example:
```yaml
entityGenerator:
    path: %appDir%/Model/Entity
    namespace: App\Model\Entity
    extends: App\Model\Entities\BaseEntity
    generateGetters: false
    generateSetters: false
    extends: DodoIt\EntityGenerator\Entity
    propertyVisibility: 'public'
```
You can see list of all options and their default values in: 
https://github.com/dodo-it/entity-generator/blob/master/src/Generator/Config.php
    
## Usage

### Abstract entity class
 First create your BaseEntity class which all entities will extends and set option extends to that class in your configuration.
 As a starting point you can just Use Dibi\Row and set to only generate phpdoc comments that way nothing will change but you will have full autocomplete in your queries. 
Better scenario would be to generate getters and setters which then can have return typehints...

### Example code in repository
```php
public function getById(int $id): ArticleEntity
{
		return $this->db->select('*')->from('articles')->where('id = %i', $id)
				->execute()
				->setRowClass(ArticleEntity::class)
				->fetch();
}
```

### Generate all
To generate all entities run from database tables and views run
```ssh
console entity:generate 
```
### Generate one table/view only

```ssh
console entity:generate table_name
```

### Generate from query
Write your query in .sql file
after that run command:

```ssh
 console entity:generate --query-file=path/to/QueryFile.sql EntityName
```

### Generate from directory where query sql files are
Write your queries in one folder in .sql files and (re) generate entities for all queries with:

```ssh
 console entity:generate --query-dir=/path/to/dir
```
