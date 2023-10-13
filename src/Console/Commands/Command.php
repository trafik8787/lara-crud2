<?php
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 13.01.2018
 * Time: 16:10
 */

namespace Trafik8787\laraCrud2\Console\Commands;

use Illuminate\Console\Command as ConsoleCommand;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Filesystem\Filesystem;

abstract class Command extends ConsoleCommand
{
    use ConfirmableTrait;
    protected $files;

    /**
     * @param Filesystem $files
     */
    public function handle(Filesystem $files)
    {


        if (!$this->confirmToProceed('Lara-Crud Admin')) {
            return;
        }

        $this->call('vendor:publish', ['--tag' => 'config']);
        $this->call('vendor:publish', ['--tag' => 'public']);

        $this->files = $files;

        $this->Installalation();
    }

    /**
     * @return mixed
     */
    abstract protected function Installalation();

    /**
     * @return mixed
     */
    public function files()
    {
        return $this->files;
    }
}
