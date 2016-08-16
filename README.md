# Timestamp

## Usage

```yaml
extensions:
    - Thunbolt\Doctrine\DI\TimestampExtension
```

For created and updated fields:

```php

/**
 * @ORM\Entity()
 */
class Entity {

    use Thunbolt\Doctrine\Traits\Timestamp;

}

```

For created:

```php
/**
 * @ORM\Entity()
 */
class Entity {

    use Thunbolt\Doctrine\Traits\TimestampCreated;

}
```

For updated:

```php
/**
 * @ORM\Entity()
 */
class Entity {

    use Thunbolt\Doctrine\Traits\TimestampUpdated;

}
```
