<?php
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 13.01.2018
 * Time: 16:10
 */

namespace Trafik8787\LaraCrud2\Console\Commands;

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

        if (!defined('SLEEPINGOWL_STUB_PATH')) {
            define('SLEEPINGOWL_artisan_PATH', __DIR__ . '/stubs');
        }

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
