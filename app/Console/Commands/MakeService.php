<?php

namespace App\Console\Commands;


use Illuminate\Console\GeneratorCommand;

class MakeService extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service contract';


    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'service';
    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);
        $name = explode("/", $this->argument('name'));
        return str_replace('DummyService', $name[count($name) - 1], $stub);
    }
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return  app_path() . '/Console/Commands/Stubs/make-service.stub';
    }


    protected function replaceNamespace(&$stub, $name)
    {
        $name = explode("/", $this->argument('name'));
        $string  = str_replace('/' . $name[count($name) - 1], '', $this->argument('name'));
        $string = str_replace('/', '\\', $string);
        $stub = str_replace('DummyNameSpace', 'App\Services' . $string, $stub);
        return $this;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Services';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
