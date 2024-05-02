<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Tests\Unit\Playground\Make;

/**
 * \Tests\Unit\Playground\Make\FileTrait
 */
trait FileTrait
{
    /**
     * @return array<mixed>
     */
    protected function getResourceFileAsArray(string $type = ''): array
    {
        $file = $this->getResourceFile($type);
        $content = file_exists($file) ? file_get_contents($file) : null;
        $data = $content ? json_decode($content, true) : [];
        return is_array($data) ? $data : [];
    }

    protected function getResourceFile(string $type = ''): string
    {
        $package_base = dirname(dirname(__DIR__));

        //
        // Controllers
        //

        if (in_array($type, [
            'model',
            'model-backlog',
            'playground-model',
        ])) {
            $file = sprintf(
                '%1$s/resources/testing/configurations/model.backlog.json',
                $package_base
            );

        } else {
            $file = sprintf(
                '%1$s/resources/testing/empty.json',
                $package_base
            );
        }

        return $file;
    }
}
