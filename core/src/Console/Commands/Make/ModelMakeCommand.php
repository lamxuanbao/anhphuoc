<?php


namespace Kizi\Core\Console\Commands\Make;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Kizi\Core\Generators\FileAlreadyExistsException;
use Kizi\Core\Generators\ModelGenerator;
use Kizi\Core\Generators\ModelTranslationsGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ModelMakeCommand extends Command
{

    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'make:model';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new model.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * ControllerCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the command.
     *
     * @return void
     * @see fire()
     */
    public function handle()
    {
        $this->laravel->call([$this, 'fire'], func_get_args());
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        try {
            $name = Str::ucfirst($this->argument('name'));
            if (!$this->option('translations')) {
                (new ModelGenerator([
                    'name' => Str::plural($name),
                    'fillable' => $this->option('fillable')
                ]))->run();
            } else {
                (new ModelTranslationsGenerator([
                    'name' => Str::plural($name),
                    'translation_class' => Str::plural($name.'Translations'),
                    'translation_key' => Str::of($this->argument('name'))->snake().'_id',
                    'fillable' => $this->option('fillable')
                ]))->run();

                (new ModelGenerator([
                    'name' => Str::plural($name.'Translations'),
                    'fillable' => []
                ]))->run();
            }

            $this->info($this->type.' created successfully.');

        } catch (FileAlreadyExistsException $e) {
            $this->error($this->type.' already exists!');

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
                'The name of model for which the controller is being generated.',
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
                'translations',
                null,
                InputOption::VALUE_NONE,
                'Create a new translations of a model.',
                null,
            ],
        ];
    }
}
