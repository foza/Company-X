<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Finder\Finder;

class ParsingCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:category';

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
    public function handle()
    {

        $finder = new Finder();
        $finder->files()->in(base_path('exports'));
        $finder->sortByChangedTime();

        foreach ($finder as $key => $file) {
            if (!empty($file->getRealPath())) {
                $rr[$key]['f'] = $file->getRealPath();
                $file = $file->getRelativePathname();
                if ($file == 'category.csv') {
                    $this->getParse($rr[$key]['f']);
                }

            }
        }
        return 0;
    }

    /**
     * @param string $file
     * @return string
     */
    private function getParse($file = null): string
    {
        $csv_arr = [];
        if (($h = fopen($file, "r")) !== FALSE) {


            $csv_arr = array();

            $a = 0;
            $b = 0;
            $d = 0;
            $razdel = 1000;
            $sql = null;
            $f = 0;
            $f1 = array();
            $j = array();
            while (($data = fgetcsv($h, 100000, ",")) !== FALSE) {

                /*
                      0 => "id"
                      1 => "name"
                      2 => "url_key"
                      3 => "description"
                      4 => "image"
                      5 => "parent_id"

                 * */

                if ($a != 0) {
                    $id = $data[0];
                    $name = !empty($data[1]) || isset($data[1]) ? self::clearString($data[1]) : null;
                    $url_key = !empty($data[2]) || isset($data[2]) ? self::clearString(htmlspecialchars($data[2], ENT_QUOTES)) : null;
                    $description = !empty($data[3]) || isset($data[3]) ? self::clearString(htmlspecialchars($data[3], ENT_QUOTES)) : null;
                    $image = !empty($data[4]) || isset($data[4]) ? str_replace(' ', '', $data[4]) : null;
                    $parent_id = !empty($data[5]) ? $data[5] : null;
                    $val = "id='$id',name='$name', url_key='$url_key', description='$description', image='$image', parent_id='$parent_id'";
                    $sql = $sql . "INSERT INTO category SET $val ON DUPLICATE KEY UPDATE $val; ";

                }


                if ($a == $razdel) {
                    $g = DB::unprepared($sql);


                    if ($g) {
                        $csv_arr[] = array($b, $a);
                    }

                    $sql = null;
                    $a = null;
                    $b++;

                }

                //Старт счетчика
                $a++;
                $d++;

            }

            fclose($h);
        }


        return "1";
    }

    private static function clearString($text)
    {
        return str_replace(
            array('\\', "'"),
            array('/', '', '', ""),
            $text);
    }
}
