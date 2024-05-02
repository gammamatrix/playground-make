<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Configuration\Model;

use Playground\Make\Configuration;

/**
 * \Playground\Make\Configuration\Model\ModelConfiguration
 */
class ModelConfiguration extends Configuration\Configuration
{
    private ?Configuration\Model $_parent = null;

    public function getParent(): ?Configuration\Model
    {
        return $this->_parent;
    }

    public function setParent(Configuration\Model $parent = null): self
    {
        $this->_parent = $parent;

        return $this;
    }
}
