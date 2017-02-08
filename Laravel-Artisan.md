# Laravel and Artisan

Artisan is the command-line interface included with Laravel. It provides a number of helpful commands that can assist you while you build your application. 

## Basics

| Commands | Description |
| ---------------- | ---------------- |  
| `php artisan list` | List commands |
| `php aristan help migrate` | Example that every command has it's own help command |
| `php artisan tinker` | All Laravel applications include Tinker, a REPL powered by the PsySH package. |
| `php artisan make:command SendEmails` | Create custom command SendEmails |
| `email:send {user}` | Adding custom args |
| `email:send {user?}` | Optional custom args |
| `email:send {user=foo}` | Default custom args |
| `email:send {user} {--queue=}` | Adding custom options |
| `email:send {user} {--Q|queue}` | option shortcuts |
| `email:send {user*}` | Input arrays |
| `email:send {user : The ID of the user}` | Input descriptions |


**Laravel REPL**

All Laravel applications include Tinker, a REPL powered by the PsySH package. Tinker allows you to interact with your entire Laravel application on the command line, including the Eloquent ORM, jobs, events, and more. To enter the Tinker environment, run the tinker Artisan command `php artisan tinker`.

## Custom Commands

You can build your own custom commands which are typically stored in the `app/Console/Commands` directory.

Feel free to change storage as long as it can be accessed by `Composer`.

Once you have created a command for the CLI, you will need to register it before you can use it on the CLI.

**Command Structure**

Example commands `SendEmails`. Note that we are able to inject any dependencies we need into the command's constructor. The Laravel service container will automatically inject all dependencies type-hinted in the constructor.

```php
<?php

namespace App\Console\Commands;

use App\User;
use App\DripEmailer;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send drip e-mails to a user';

    /**
     * The drip e-mail service.
     *
     * @var DripEmailer
     */
    protected $drip;

    /**
     * Create a new command instance.
     *
     * @param  DripEmailer  $drip
     * @return void
     */
    public function __construct(DripEmailer $drip)
    {
        parent::__construct();

        $this->drip = $drip;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->drip->send(User::find($this->argument('user')));
    }
}
```

**Closure Commands**

This is an alternative to declaring a class for a console command. This is similar to the same way that route Closures are an alternative to controllers.

Within the commands method of your app/Console/Kernel.php file, Laravel loads the routes/console.php file.

```php
/**
 * Register the Closure based commands for the application.
 *
 * @return void
 */
protected function commands()
{
    require base_path('routes/console.php');
}
```

Even though this file does not define HTTP routes, it defines console based entry points (routes) into your application. Within this file, you may define all of your Closure based routes using the  Artisan::command method. The command method accepts two arguments: the command signature and a Closure which receives the commands arguments and options.

```php
Artisan::command('build {project}', function ($project) {
    $this->info("Building {$project}!");
});
```





