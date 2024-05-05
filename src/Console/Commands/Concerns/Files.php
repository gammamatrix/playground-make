<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Console\Commands\Concerns;

use Illuminate\Support\Str;

/**
 * \Playground\Make\Console\Commands\Concerns\Files
 */
trait Files
{
    /**
     * Load a JSON file.
     *
     * Path priority for relative files:
     * - $pathInApp = base_path($file)
     * - $pathInPackage
     * - $pathInMakePackage
     * - absolute path
     *
     * @return array<string, mixed>
     */
    protected function readJsonFileAsArray(string $file, bool $required = true, string $name = 'file'): array
    {
        if (empty($file)) {
            throw new \RuntimeException(__('playground-make::generator.json.file.required'));
        }

        $stringable = Str::of($file);

        if (! $stringable->endsWith('.json')) {
            throw new \RuntimeException(__('playground-make::generator.json.file.json', [
                'file' => $file,
            ]));
        }

        $pathInApp = '';
        $pathInPackage = '';

        $payload = null;

        // Check relative paths
        if (! $stringable->startsWith('/')) {

            $pathInApp = base_path($file);
            $pathInPackage = sprintf('%1$s/%2$s', $this->getPackageDirectoryFromCommand(), $file);
            $pathInMakePackage = sprintf('%1$s/%2$s', dirname(dirname(dirname(dirname(__DIR__)))), $file);

            if ($this->files->exists($pathInApp)) {
                $this->components->info(sprintf('Loading %s [%s] from the app [%s]', $name, $file, $pathInApp));
                $payload = $this->files->json($pathInApp);
            } elseif ($this->files->exists($pathInPackage)) {
                $this->components->info(sprintf('Loading %s [%s] from %s [%s]', $name, $file, $this->type, $pathInApp));
                $payload = $this->files->json($pathInPackage);
            } elseif ($this->files->exists($pathInMakePackage)) {
                $this->components->info(sprintf('Loading %s [%s] from playground-make [%s]', $name, $file, $pathInApp));
                $payload = $this->files->json($pathInMakePackage);
            } else {
                $this->components->error(sprintf('Unable to find %s [%s] in the app [%s] or package [%s]', $name, $file, $pathInApp, $pathInPackage));
            }

        } else {
            if ($this->files->exists($file)) {
                $this->components->info(sprintf('Loading %s [%s]', $name, $file));
                // $contents = file_get_contents($file);
                $payload = $this->files->json($file);
            } else {
                $this->components->error(sprintf('Unable to find %s [%s]', $name, $file));
            }
        }

        // TODO Figure out if there is a need for failing here if a file does not exist and it should.
        // // NOTE: An empty file is not necessarily an error when building skeletons.
        // if ($contents === false) {
        //     if ($required) {
        //         throw new \RuntimeException(__('playground-make::generator.json.file.invalid', [
        //             'file' => $file,
        //         ]));
        //     }
        // } elseif (! is_null($contents)) {
        //     $payload = json_decode($contents, true);
        //     if (json_last_error() && $required) {
        //         Log::debug(__METHOD__, [
        //             'file' => $file,
        //             'json_last_error_msg()' => json_last_error_msg(),
        //         ]);
        //         throw new \RuntimeException(__('playground-make::generator.json.file.invalid', [
        //             'file' => $file,
        //         ]));
        //     }
        // }
        // dump([
        //     '__METHOD__' => __METHOD__,
        //     'dir' => dirname(dirname(dirname(__DIR__))),
        //     '$file' => $file,
        //     '$required' => $required,
        //     '$pathInApp' => $pathInApp,
        //     '$pathInPackage' => $pathInPackage,
        //     // '$contents' => $contents,
        //     '$payload' => $payload,
        // ]);

        return is_array($payload) ? $payload : [];
    }

    protected function getDestinationPath(): string
    {
        $path = $this->getPackageFolder();

        // dump([
        //     '__METHOD__' => __METHOD__,
        //     '$path' => $path,
        // ]);
        if ($this->path_destination_folder) {
            $path .= '/'.ltrim($this->path_destination_folder, '/');
        }
        // dd([
        //     '__METHOD__' => __METHOD__,
        //     '$path' => $path,
        // ]);

        return $path;
    }

    protected function folder(): string
    {
        if (empty($this->folder)) {
            $this->folder = $this->getDestinationPath();
        }

        return $this->folder;
    }
}
