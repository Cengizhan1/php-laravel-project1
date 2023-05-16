<?php

namespace App\Console\Commands;

use App\Enums\AdminRoleEnum;
use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class PanelInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'panel:install {--f|force : Overwrite} {--d|dummy : Dummy}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle(): int
    {
        set_time_limit(0);
        ini_set('memory_limit', '10240M');

        // Database check
        try {
            DB::connection()->getPdo();
        } catch (\PDOException $PDOException) {
            $this->error('Database Connection Error');

            return false;
        }

        // Install Check
        if (!$this->option('force') && Schema::hasTable('admins')) {
            $this->error('Panel Already Installed');

            return false;
        }

        Artisan::call('migrate:fresh', [
            '--force' => $this->option('force'),
        ]);

        $this->callSilent('passport:client', [
            '--client' => true,
            '--name' => config('app.name') . ' Access Client',
        ]);

        \Laravel\Passport\Client::where('name', config('app.name') . ' Access Client')->update([
            'id' => '97be436e-0dd6-418b-a870-162588964b8b',
            'secret' => 'v0caqrvd1XIaQpQffjdp7G7SbUJjFA45eFNXc3up',
        ]);

        /*$this->call('passport:client', [
            '--client' => true,
            '--name' => config('app.name').' Personal Access Client',
        ]);*/

        $this->callSilent('passport:client', [
            '--personal' => true,
            '--name' => config('app.name') . ' Personal Access Client',
        ]);


        if (app()->environment('production')) {
            $developer = hash('md5', uniqid());
            $kumsalajans = hash('md5', $developer);
            $uhc = hash('md5', $kumsalajans);

            Admin::create([
                'name' => 'Developer',
                'email' => 'developer@kumsalajans.com',
                'password' => Hash::make($developer),
                'role_id' => AdminRoleEnum::superAdmin()->value
            ]);

            error_log("(Super Admin)\t developer@kumsalajans.com \t\t=> $developer");
            error_log("(Admin)\t\t merhaba@kumsalajans.com \t\t=> $kumsalajans");
            error_log("(Super Admin)\t hakan.ceylan@kumsalajans.com \t\t=> $uhc");
        } else {
            Admin::create([
                'name' => 'Developer',
                'email' => 'developer@kumsalajans.com',
                'password' => Hash::make('kumsalajans'),
                'role_id' => AdminRoleEnum::superAdmin()->value
            ]);
        }

        if (app()->environment('production')) {
            $this->call('cache:clear');

            foreach ([
                         'assets', 'private', 'media', 'public',
                     ] as $disk) {
                foreach (Storage::disk($disk)->allDirectories() as $directory) {
                    Storage::deleteDirectory($directory);
                }

                foreach (Storage::disk($disk)->allFiles() as $file) {
                    Storage::delete($file);
                }
            }
        }


        return 0;
    }
}
