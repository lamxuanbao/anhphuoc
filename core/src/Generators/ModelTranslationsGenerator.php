<?php


namespace Kizi\Core\Generators;


use Kizi\Core\Generators\Migrations\SchemaParser;

/**
 * Class ModelGenerator
 */
class ModelTranslationsGenerator extends Generator
{

    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'eloquent/translations';

    /**
     * Get root namespace.
     *
     * @return string
     */
    public function getRootNamespace()
    {
        return parent::getRootNamespace().parent::getConfigGeneratorClassPath($this->getPathConfigNode());
    }

    /**
     * Get generator path config node.
     *
     * @return string
     */
    public function getPathConfigNode()
    {
        return 'models';
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath().'/'.parent::getConfigGeneratorClassPath($this->getPathConfigNode(),
                true).'/'.$this->getName().'.php';
    }

    /**
     * Get base path of destination file.
     *
     * @return string
     */

    public function getBasePath()
    {
        return config('repository.generator.basePath', app()->path());
    }

    /**
     * Get array replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        return array_merge(parent::getReplacements(), [
            'fillable' => $this->getFillable(),
            'translation_class' => $this->translation_class,
            'translation_key' => $this->translation_key,
            'translation_fillable' => null,
        ]);
    }

    /**
     * Get the fillable attributes.
     *
     * @return string
     */
    public function getFillable()
    {
        if (!$this->fillable) {
            return '[]';
        }
        $results = '['.PHP_EOL;

        foreach ($this->getSchemaParser()->getSchemas() as $column) {
            $results .= "\t\t'{$column}',".PHP_EOL;
        }
        return $results."\t".']';
    }

    /**
     * Get schema parser.
     *
     * @return SchemaParser
     */
    public function getSchemaParser()
    {
        return new SchemaParser($this->fillable);
    }

    public function setTranslations($value)
    {
        return $this->translations = $value;
    }
}
