<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Configuration\Model;

/**
 * \Playground\Make\Configuration\Model\CreateDate
 */
class CreateDate extends CreateColumn
{
    /**
     * @var array<int, string>
     */
    public $allowed_types = [
        'dateTime',
    ];

    protected string $type = 'dateTime';
}
