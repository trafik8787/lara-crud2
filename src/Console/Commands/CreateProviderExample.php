<?php
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 13.01.2018
 * Time: 16:06
 */

namespace Trafik8787\laraCrud2\Console\Commands;


/**
 * Class CreateProviderExample
 * @package Trafik8787\laraCrud2\Console\Commands
 */
class CreateProviderExample extends Installer
{


    public function showInfo()
    {
        // TODO: Implement showInfo() method.
    }

    public function install()
    {

        $file = $this->getFilePath();
        $ns = rtrim($this->command->getLaravel()->getNamespace(), '\\');

        $contents = str_replace(
            '__NAMESPACE__',
            $ns,
            $this->command->files()->get(__DIR__ . '/stubs' . '/provider_example.stub')
        );

        $this->command->files()->put($file, $contents);
    }


    public function installed()
    {
        return file_exists($this->getFilePath());
    }

    /**
     * @return string
     */
    protected function getFilePath()
    {
        return app_path('Providers/LaraCrudProvider.php');
    }


}
