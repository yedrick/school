<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class CreatedService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear un servicio en la aplicación central para los inquilinos';

    protected Filesystem $files;


    public function __construct(Filesystem $files){
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle() {
        $name = $this->argument('name');
        $className = Str::studly($name);  // Capitalize the first letter of each word
        $variableName = Str::camel($name);  // Convert to camelCase
        $pluralClass = Str::plural(Str::lower($name));  // Get the plural form
        $singularClass = Str::singular(Str::lower($name));  // Get the singular form
        $this->generateModelAndMigration($className);
        $this->createDirectory($className);

        // Create each component
        $this->generateFile($className, 'service.stub', 'App/Services/' . $className . '/' . $className . 'Service.php');
        // $this->generateFile($className, 'resource.stub', 'App/Http/Resources/' . $className . '/' . $className . 'Resource.php');
        $this->generateFile($className, 'request_store.stub', 'App/Http/Requests/' . $className . '/Store' . $className . 'Request.php');
        $this->generateFile($className, 'request_update.stub', 'App/Http/Requests/' . $className . '/Update' . $className . 'Request.php');
        $this->generateFile($className, 'controller.stub', 'App/Http/Controllers/' . $className . 'Controller.php');

        // index.blade.php
        $this->generateFile($className, 'index.stub', 'resources/views/' . Str::plural(Str::lower($className)) . '/index.blade.php');
        $this->generateFile($className, 'create.stub', 'resources/views/' . Str::plural(Str::lower($className)) . '/create.blade.php');
        $this->generateFile($className, 'edit.stub', 'resources/views/' . Str::plural(Str::lower($className)) . '/edit.blade.php');


        $this->info('Service and related files for ' . $className . ' created successfully.');

    }

    public function createDirectory($name) {
        // Create directories for services, resources, requests if they don't exist
        $paths = [
            app_path('Services/' . $name),
            // app_path('Http/Resources/' . $name),
            app_path('Http/Requests/' . $name),
            // resource_path('views/' . $name),
        ];

        foreach ($paths as $path) {
            if (!$this->files->isDirectory($path)) {
                $this->files->makeDirectory($path, 0755, true);
            }
        }
    }

    protected function generateModelAndMigration($className) {
        // Check if model exists
        $modelPath = app_path('Models/' . $className . '.php');
        if ($this->files->exists($modelPath)) {
            $this->info("Model $className already exists. Skipping...");
        } else {
            // Generate the model
            $this->call('make:model', ['name' =>$className, '--migration' => true]);
            $this->info("Model and migration for $className created successfully.");
        }
    }

    protected function generateFile($className, $stub, $destination) {
        if ($this->files->exists($destination)) {
            $this->info("$destination already exists. Skipping...");
            return;
        }
        $stubPath = resource_path('views/stubs/' . $stub);
        $content = $this->files->get($stubPath);

        // Replace placeholders in the stub content
        $content = str_replace(
            ['{{ class }}', '{{ variable }}', '{{ plural_class }}', '{{ singular_class }}'],
            [$className, Str::camel($className), Str::plural(Str::lower($className)), Str::singular(Str::lower($className))],
            $content
        );

        // Ensure directory exists
        $this->files->ensureDirectoryExists(dirname($destination));

        // Write the final content to the destination
        $this->files->put($destination, $content);
    }
}
