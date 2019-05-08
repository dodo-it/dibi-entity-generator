# Dibi Entity generator
Typed entity generator from database. It can generate entities for whole database, table/view and from query.

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
    propertyVisibility: 'public'
```
You can see list of all options and their default values in: 
https://github.com/dodo-it/entity-generator/blob/master/src/Generator/Config.php
    
