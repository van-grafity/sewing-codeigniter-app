<?php

namespace App\Commands\Maintenance;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\App;
use Config\Services;

class Down extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Maintenance Mode';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'mmx:down';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = '';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'mm:down [arguments] [options]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        // Logika perintah "down"
        // $appConfig = new App();
        // $appConfig->siteStatus = 'down';

        // CLI::write('PHP Version: ' . CLI::color($appConfig->siteStatus, 'yellow'));

        // $configString = $appConfig->toIniString();

        // helper('filesystem');
        // if (! write_file(APPPATH . 'Config/App.php', $configString))
        // {
        //     CLI::error('Failed to update application status.');
        // }
        // else
        // {
        //     CLI::write('Application status updated successfully.');
        // }
       

        // putenv("APP_STATUS=down");
        // service('request')->config->siteStatus = 'down';
        // ENV("ENVIRONMENT","development");
        putenv('APP_STATUS=down');
        CLI::write('Application status updated successfully.');

       // Tampilkan pesan atau lakukan tindakan lainnya
    //    echo "Aplikasi sedang dalam status down.";
    }
}