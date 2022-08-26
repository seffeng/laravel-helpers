<?php

namespace Seffeng\LaravelHelpers\Commands;

use Illuminate\Console\Command;
use Illuminate\Encryption\Encrypter;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Contracts\Encryption\DecryptException;

class Crypt extends Command
{
    use ConfirmableTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crypt
                        {value : 待加密或解密的字符串或文件}
                        {--d|decrypt : 是否解密，无此选项时为加密}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '根据APP_KEY加密解密数据，会自动生成APP_KEY';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->initKey();
            $value = $this->argument('value');
            $decrypt = $this->option('decrypt');
            is_file($value) && $value = file_get_contents($value);

            if ($decrypt) {
                $this->info('解密: ' . decrypt($value));
            } else {
                $this->info('加密: ' . encrypt($value));
            }
        } catch (DecryptException $e) {
            $this->error('解密失败：无效的加密数据！');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     *
     * @author zxf
     * @date   2021年1月12日
     * @return boolean
     */
    protected function initKey()
    {
        if (strlen($this->laravel['config']['app.key']) === 0) {
            $key = $this->generateRandomKey();
            if (!$this->setKeyInEnvironmentFile($key)) {
                return false;
            }
            $this->laravel['config']['app.key'] = $key;
        }
        return true;
    }


    /**
     * Generate a random key for the application.
     *
     * @return string
     */
    protected function generateRandomKey()
    {
        return 'base64:'.base64_encode(
            Encrypter::generateKey($this->laravel['config']['app.cipher'])
        );
    }


    /**
     * Set the application key in the environment file.
     *
     * @param  string  $key
     * @return bool
     */
    protected function setKeyInEnvironmentFile($key)
    {
        $currentKey = $this->laravel['config']['app.key'];

        if (strlen($currentKey) !== 0 && (! $this->confirmToProceed())) {
            return false;
        }

        $this->writeNewEnvironmentFileWith($key);

        return true;
    }

    /**
     * Write a new environment file with the given key.
     *
     * @param  string  $key
     * @return void
     */
    protected function writeNewEnvironmentFileWith($key)
    {
        file_put_contents($this->envPath(), preg_replace(
            $this->keyReplacementPattern(),
            'APP_KEY='.$key,
            file_get_contents($this->envPath())
            ));
    }

    /**
     * Get a regex pattern that will match env APP_KEY with any random key.
     *
     * @return string
     */
    protected function keyReplacementPattern()
    {
        $escaped = preg_quote('='.$this->laravel['config']['app.key'], '/');

        return "/^APP_KEY{$escaped}/m";
    }

    /**
     *
     * @author zxf
     * @date   2021年1月12日
     * @return string
     */
    protected function envPath()
    {
        if (method_exists($this->laravel, 'environmentFilePath')) {
            return $this->laravel->environmentFilePath();
        }

        return $this->laravel->basePath('.env');
    }
}
