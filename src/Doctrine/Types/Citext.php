<?php

namespace App\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;

final class Citext extends TextType
{
    const NAME = 'citext';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getDoctrineTypeMapping(self::NAME);
    }
}
