<?php
/**
 * Playground
 */

declare(strict_types=1);
namespace Playground\Make\Console\Commands;

use Illuminate\Support\Str;

abstract class GeneratorCommand extends Command
{
    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @link https://tldp.org/LDP/abs/html/exitcodes.html TRUE (1) is an error. FALSE and NULL (0) is a success
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $this->reset();

        $name = $this->getNameInput();

        if (empty($name)) {
            if ($this->hasOption('file') && $this->option('file')) {
                $this->components->error(sprintf('Please provide a valid configuration for [--file %s]', static::class));
                $this->return_status = true;

                return $this->return_status;
            }

            $error = __('playground-make::generator.input.error');

            // Check if interactive
            if ($this->interactive && $this->hasOption('interactive') && $this->option('interactive')) {
                $name = $this->interactive();
                if (! $name) {
                    $this->components->error('Interactive mode was canceled');

                    $this->return_status = true;

                    return $this->return_status;
                }
            } else {
                if ($this->interactive) {
                    $error .= ' or use [--interactive] mode';
                }
                $this->components->error($error);

                $this->return_status = true;

                return $this->return_status;
            }
        }

        $name = $this->handleName($name);

        // First we need to ensure that the given name is not a reserved word within the PHP
        // language and that the class name will actually be valid. If it is not valid we
        // can error now and prevent from polluting the filesystem using invalid files.
        if ($this->isReservedName($name)) {
            $this->components->error('The name "'.$name.'" is reserved by PHP.');

            $this->return_status = true;

            return $this->return_status;
        }

        $this->qualifiedName = $this->qualifyClass($name);

        $this->c->setOptions([
            'fqdn' => $this->parseClassConfig($this->qualifiedName),
        ]);

        $path = $this->getPath($this->qualifiedName);

        // Next, We will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.
        if ((! $this->hasOption('force') ||
             ! $this->option('force')) &&
             $this->alreadyExists($name)) {
            $this->components->error($this->type.' already exists.');

            $this->return_status = true;

            return $this->return_status;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);

        $this->files->put($path, $this->sortImports($this->buildClass($this->qualifiedName)));

        $info = $this->type;

        if ($this->handleTestCreation($path)) {
            $info .= ' and test';
        }

        $this->components->info(sprintf('%s [%s] created successfully.', $info, $path));

        return $this->finish();
    }

    public function finish(): ?bool
    {
        $this->saveConfiguration();

        return $this->return_status;
    }

    public function handleName(string $name): string
    {
        $name = ltrim($name, '\\/');

        $name = str_replace('/', '\\', $name);

        if ($this->qualifiedNameStudly && ! ctype_upper($name)) {
            $name = Str::of($name)->studly()->toString();
        }

        $this->c->setOptions([
            'name' => $name,
        ]);

        return $name;
    }

    /**
     * Create the matching test case if requested.
     *
     * @param  string  $path
     * @return bool
     */
    protected function handleTestCreation($path)
    {
        return false;
    }

    /**
     * Qualify the given model class base name.
     *
     * @return string
     */
    protected function qualifyModel(string $model)
    {
        return $this->parseClassInput($model);
    }

    /**
     * Get the desired class name from the input.
     */
    protected function getNameInput(): ?string
    {
        $this->applyConfigurationToSearch();

        $this->prepareOptions();

        $this->c->apply();

        return $this->c->name();
    }
}
