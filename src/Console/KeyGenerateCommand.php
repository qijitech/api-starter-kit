<?php

namespace Api\StarterKit\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class KeyGenerateCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'key:generate {--show : Display the key instead of modifying files}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Set the application key';

  /**
   * Execute the console command.
   *
   * @return void
   */
  public function fire()
  {
    $key = $this->generateRandomKey();

    if ($this->option('show')) {
      return $this->line('<comment>' . $key . '</comment>');
    }

    // Next, we will replace the application key in the environment file so it is
    // automatically setup for this developer. This key gets generated using a
    // secure random byte generator and is later base64 encoded for storage.
    $this->setKeyInEnvironmentFile($key);

    $this->laravel['config']['app.key'] = $key;

    $this->info("Application key [$key] set successfully.");
  }

  /**
   * Set the environmeny key in the environment file.
   *
   * @param  string $key
   * @return void
   */
  protected function setKeyInEnvironmentFile($key)
  {
    $path = base_path('.env');
    if (file_exists($path)) {
      // check if there is already a secret set first
      if (!Str::contains(file_get_contents($path), 'APP_KEY')) {
        file_put_contents($path, "APP_KEY=$key", FILE_APPEND);
      } else {
        file_put_contents($path, str_replace(
          'APP_KEY=' . $this->laravel['config']['app.key'], 'APP_KEY=' . $key, file_get_contents($path)
        ));
      }
    }
  }

  /**
   * Generate a random key for the application.
   *
   * @return string
   */
  protected function generateRandomKey()
  {
    return 'base64:' . base64_encode(random_bytes(
      $this->laravel['config']['app.cipher'] == 'AES-128-CBC' ? 16 : 32
    ));
  }
}