<?php

namespace Kizi\Core\Console\Commands\Make;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Kizi\Core\Generators\FileAlreadyExistsException;
use Kizi\Core\Generators\MigrationGenerator;
use Kizi\Core\Generators\ModelGenerator;
use Kizi\Core\Generators\ModelTranslationsGenerator;
use Kizi\Core\Generators\RepositoryEloquentGenerator;
use Kizi\Core\Generators\RepositoryInterfaceGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class RepositoryMakeCommand extends Command
{
    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new repository.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * @var Collection
     */
    protected $generators = null;


    /**
     * Execute the command.
     *
     * @see fire()
     * @return void
     */
    public function handle(){
        $this->laravel->call([$this, 'fire'], func_get_args());
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        $this->generators = new Collection();

        $name = 'create_' . Str::snake(Str::plural($this->argument('name'))) . '_table';

        if(app() instanceof \Illuminate\Foundation\Application){
            echo 'laravel';
        }else{
            $path = realpath(__DIR__.'/../../../../../database/migrations');
        }

        $files = File::files($path);
        $migration = true;
        foreach ($files as $file) {
            if($file->getExtension() === 'php'){
                if (strpos($file->getFilenameWithoutExtension(), $name) !== false) {
                    $migration = false;
                }
            }
        }

        if (!$this->option('skip-migration') && $migration) {
            try {
                (new MigrationGenerator([
                    'name' => 'create_'.Str::snake(Str::plural($this->argument('name'))).'_table',
                    'fields' => $this->option('fillable'),
                    'force' => $this->option('force'),
                ]))->run();
                sleep(1);
                if ($this->option('translations')) {
                    $name = Str::of($this->argument('name'))->snake().'_translations';
                    (new MigrationGenerator([
                        'name' => 'create_'.Str::snake(Str::plural($name)).'_table',
                        'fields' => $this->option('fillable'),
                        'force' => $this->option('force'),
                    ]))->run();
                }
            } catch (\Exception $e) {
            }
        }


        if (!$this->option('skip-model')) {
            $name = Str::ucfirst($this->argument('name'));
            if (!$this->option('translations')) {
                $modelGenerator = new ModelGenerator([
                    'name' => Str::plural($name),
                    'fillable' => $this->option('fillable'),
                    'force' => $this->option('force')
                ]);
                try {
                    $this->generators->push($modelGenerator);
                } catch (\Exception $e) {
                }
            } else {
                $modelGenerator = new ModelTranslationsGenerator([
                    'name' => Str::plural($name),
                    'translation_class' => Str::plural($name.'Translations'),
                    'translation_key' => Str::of($this->argument('name'))->snake().'_id',
                    'fillable' => $this->option('fillable'),
                    'force' => $this->option('force')
                ]);
                $modelTranslationsGenerator = new ModelGenerator([
                    'name' => Str::plural($name.'Translations'),
                    'fillable' => [],
                    'force' => $this->option('force')
                ]);
                try {
                    $this->generators->push($modelGenerator);
                    $this->generators->push($modelTranslationsGenerator);
                } catch (\Exception $e) {
                }
            }
        }

        $this->generators->push(new RepositoryInterfaceGenerator([
            'name'  => $this->argument('name'),
            'force' => $this->option('force'),
        ]));

        foreach ($this->generators as $generator) {
            $generator->run();
        }

        $model = $modelGenerator->getRootNamespace() . '\\' . $modelGenerator->getName();
        $model = str_replace([
            "\\",
            '/'
        ], '\\', $model);

        try {
            (new RepositoryEloquentGenerator([
                'name'      => $this->argument('name'),
                'rules'     => $this->option('rules'),
                'validator' => $this->option('validator'),
                'force'     => $this->option('force'),
                'model'     => $model,
                'modelName' => $modelGenerator->getName()
            ]))->run();
            $this->info("Repository created successfully.");
        } catch (FileAlreadyExistsException $e) {
            $this->error($this->type . ' already exists!');

            return false;
        }
    }


    /**
     * The array of command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            [
                'name',
                InputArgument::REQUIRED,
                'The name of class being generated.',
                null
            ],
        ];
    }


    /**
     * The array of command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            [
                'fillable',
                null,
                InputOption::VALUE_OPTIONAL,
                'The fillable attributes.',
                null
            ],
            [
                'rules',
                null,
                InputOption::VALUE_OPTIONAL,
                'The rules of validation attributes.',
                null
            ],
            [
                'validator',
                null,
                InputOption::VALUE_OPTIONAL,
                'Adds validator reference to the repository.',
                null
            ],
            [
                'force',
                'f',
                InputOption::VALUE_NONE,
                'Force the creation if file already exists.',
                null
            ],
            [
                'skip-migration',
                null,
                InputOption::VALUE_NONE,
                'Skip the creation of a migration file.',
                null,
            ],
            [
                'skip-model',
                null,
                InputOption::VALUE_NONE,
                'Skip the creation of a model.',
                null,
            ],
            [
                'translations',
                null,
                InputOption::VALUE_NONE,
                'Create a new translations of a model.',
                null,
            ],
        ];
    }
}
