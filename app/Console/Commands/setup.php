<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\model\Admin;
use App\model\User;

class setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '数据初始化';

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
    public function handle()
    {
      Admin::truncate();
      Admin::create(array('name' => 'admin', 'email' => 'test@test.com', 'password' => Hash::make('123123')));
      User::create(array('name' => 'user', 'email' => 'test@test.com', 'password' => Hash::make('123123')));
    }
}
