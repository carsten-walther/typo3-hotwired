<?php

namespace Walther\WebsocketService\Server\Connection;

use Walther\WebsocketService\Exceptions\InvalidConnectionComponentException;
use Walther\WebsocketService\Exceptions\NotRegisteredException;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ConnectionComponentRegistry
{
    private static array $registry = [];

    public static function addConnectionComponent(string $identifier, string $title, string $className, array $options) : void
    {
        if (!is_subclass_of($className, ConnectionComponentInterface::class)) {
            $message = sprintf('"%s" does not implement "%s" and is therefor invalid', $className, ConnectionComponentInterface::class);
            throw new InvalidConnectionComponentException($message, 1558815163);
        }
        self::$registry[$identifier] = [
            'className' => $className,
            'instance' => null,
            'options' => $options,
            'title' => $title
        ];
    }

    public static function getConnectionComponentInstance(string $identifier) : AbstractConnectionComponent
    {
        if (!array_key_exists($identifier, self::$registry)) {
            $message = sprintf('"%s" has not been registered as a ConnectionComponent', $identifier);
            throw new NotRegisteredException($message, 1558815703);
        }
        if (self::$registry[$identifier]['instance'] === null) {
            self::$registry[$identifier]['instance'] = GeneralUtility::makeInstance(
                self::$registry[$identifier]['className'],
                self::$registry[$identifier]['options']['arguments']
            );
        }
        return self::$registry[$identifier]['instance'];
    }

    public static function getConnectionComponents() : array
    {
        return self::$registry;
    }
}
