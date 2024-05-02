<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Configuration\Model;

/**
 * \Playground\Make\Configuration\Model\CreateFlag
 */
class CreateFlag extends CreateColumn
{
    /**
     * @var array<int, string>
     */
    public $allowed_types = [
        'boolean',
        'integer',
        'bigInteger',
        'mediumInteger',
        'smallInteger',
        'tinyInteger',
    ];

    /**
     * @var array<string, mixed>
     */
    protected $properties = [
        'column' => '',
        'label' => '',
        'description' => '',
        'icon' => '',
        'default' => null,
        'index' => false,
        'nullable' => false,
        'readOnly' => false,
        'type' => 'bool',
    ];

    // /**
    //  * @param array<string, mixed> $options
    //  */
    // public function setOptions(array $options = []): self
    // {
    //     parent::setOptions($options);

    //     dump([
    //         '__METHOD__' => __METHOD__,
    //         '$options' => $options,
    //         '$this' => $this,
    //     ]);
    //     return $this;
    // }
}
