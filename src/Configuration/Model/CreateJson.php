<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Configuration\Model;

/**
 * \Playground\Make\Configuration\Model\CreateJson
 */
class CreateJson extends CreateColumn
{
    /**
     * @var array<int, string>
     */
    public $allowed_types = [
        'JSON_OBJECT',
        'JSON_ARRAY',
    ];
}
