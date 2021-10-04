<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Finder\Finder;

class ParsingProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:product';

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
                if ($file == 'product.csv') {
                    $this->getParse($rr[$key]['f']);
                    $this->getParseCategory($rr[$key]['f']);
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
            $razdel = 1000000;
            $sql = null;
            $f = 0;
            $f1 = array();
            $j = array();
            $names = ($data = fgetcsv($h, 100000, ","));
            $i = [];
            while (($data = fgetcsv($h, '', ",")) !== FALSE) {

                if ($a != 0) {
                    $id = !empty($data[0]) ? $this->clearString($data[0]) : null;
                    $type_id = !empty($data[1]) ? $this->clearString($data[1]) : null;
                    $sku = !empty($data[2]) ? $this->clearString($data[2]) : null;
                    $opera_sku = !empty($data[3]) ? $this->clearString($data[3]) : null;
                    $old_sku = !empty($data[4]) ? $this->clearString($data[4]) : null;
                    $override_opera = !empty($data[5]) ? $this->clearString($data[5]) : null;
                    $name = !empty($data[6]) ? $this->clearString($data[6]) : null;
                    $inlet = !empty($data[7]) ? $this->clearString($data[7]) : null;
                    $outlet = !empty($data[8]) ? $this->clearString($data[8]) : null;
                    $hose_type = !empty($data[9]) ? $this->clearString($data[9]) : null;
                    $angle_in_deg = !empty($data[10]) ? $this->clearString($data[10]) : null;
                    $max_lpm = !empty($data[11]) ? $this->clearString($data[11]) : null;
                    $voltage = !empty($data[12]) ? $this->clearString($data[12]) : null;
                    $material = !empty($data[13]) ? $this->clearString($data[13]) : null;
                    $bar = !empty($data[14]) ? $this->clearString($data[14]) : null;
                    $o_ring_thickness = !empty($data[15]) ? $this->clearString($data[15]) : null;
                    $diameter = !empty($data[16]) ? $this->clearString($data[16]) : null;
                    $colour = !empty($data[17]) ? $this->clearString($data[17]) : null;
                    $rpm = !empty($data[18]) ? $this->clearString($data[18]) : null;
                    $status = !empty($data[19]) ? $this->clearString($data[19]) : null;
                    $url_key = !empty($data[20]) ? $this->clearString($data[20]) : null;
                    $visibility = !empty($data[21]) ? $this->clearString($data[21]) : null;
                    $clearance = !empty($data[22]) ? $this->clearString($data[22]) : null;
                    $max_temperature = !empty($data[23]) ? $this->clearString($data[23]) : null;
                    $description = !empty($data[24]) ? $this->clearString($data[24]) : null;
                    $short_description = !empty($data[25]) ? $this->clearString($data[25]) : null;
                    $tech_spec_1 = !empty($data[26]) ? $this->clearString($data[26]) : null;
                    $tech_spec_2 = !empty($data[27]) ? $this->clearString($data[27]) : null;
                    $tech_spec_3 = !empty($data[28]) ? $this->clearString($data[28]) : null;
                    $product_videos = !empty($data[29]) ? $this->clearString($data[29]) : null;
                    $nozzle_value = !empty($data[30]) ? $this->clearString($data[30]) : null;
                    $nozzle_size = !empty($data[31]) ? $this->clearString($data[31]) : null;
                    $foam_value = !empty($data[32]) ? $this->clearString($data[32]) : null;
                    $is_featured = !empty($data[33]) ? $this->clearString($data[33]) : null;
                    $featured_position = !empty($data[34]) ? $this->clearString($data[34]) : null;
                    $hose_clamp_size = !empty($data[35]) ? $this->clearString($data[35]) : null;
                    $orifice_size = !empty($data[36]) ? $this->clearString($data[36]) : null;
                    $shoe_size = !empty($data[37]) ? $this->clearString($data[37]) : null;
                    $thread = !empty($data[38]) ? $this->clearString($data[38]) : null;
                    $size_and_angle = !empty($data[39]) ? $this->clearString($data[39]) : null;
                    $inlet_outlet = !empty($data[40]) ? $this->clearString($data[40]) : null;
                    $clothing_size = !empty($data[41]) ? $this->clearString($data[41]) : null;
                    $wheel_style = !empty($data[42]) ? $this->clearString($data[42]) : null;
                    $flow_and_pressure = !empty($data[43]) ? $this->clearString($data[43]) : null;
                    $country_of_manufacture = !empty($data[44]) ? $this->clearString($data[44]) : null;
                    $select_nozzle_size = !empty($data[45]) ? $this->clearString($data[45]) : null;
                    $dn_internal_diameter = !empty($data[46]) ? $this->clearString($data[46]) : null;
                    $currency = !empty($data[47]) ? $this->clearString($data[47]) : null;
                    $pack_size = !empty($data[48]) ? $this->clearString($data[48]) : null;
                    $easyturn = !empty($data[49]) ? $this->clearString($data[49]) : null;
                    $priority = !empty($data[50]) ? $this->clearString($data[50]) : null;
                    $manufacturer_number_1 = !empty($data[51]) ? $this->clearString($data[51]) : null;
                    $manufacturer_number_2 = !empty($data[52]) ? $this->clearString($data[52]) : null;
                    $manufacturer_number_3 = !empty($data[53]) ? $this->clearString($data[53]) : null;
                    $manufacturer_number_4 = !empty($data[54]) ? $this->clearString($data[54]) : null;
                    $manufacturer_number_5 = !empty($data[55]) ? $this->clearString($data[55]) : null;
                    $manufacturer_number_6 = !empty($data[56]) ? $this->clearString($data[56]) : null;
                    $manufacturer_number_7 = !empty($data[57]) ? $this->clearString($data[57]) : null;
                    $manufacturer_number_8 = !empty($data[58]) ? $this->clearString($data[58]) : null;
                    $manufacturer_number_9 = !empty($data[59]) ? $this->clearString($data[59]) : null;
                    $manufacturer_number_10 = !empty($data[60]) ? $this->clearString($data[60]) : null;
                    $hose_application = !empty($data[61]) ? $this->clearString($data[61]) : null;
                    $hose_inlet = !empty($data[62]) ? $this->clearString($data[62]) : null;
                    $hose_outlet = !empty($data[63]) ? $this->clearString($data[63]) : null;
                    $hose_length = !empty($data[64]) ? $this->clearString($data[64]) : null;
                    $hose_colour = !empty($data[65]) ? $this->clearString($data[65]) : null;
                    $price = !empty($data[66]) ? $this->clearString($data[66]) : null;
                    $special_price = !empty($data[67]) ? $this->clearString($data[67]) : null;
                    $poa = !empty($data[68]) ? $this->clearString($data[68]) : null;
                    $poa_price = !empty($data[69]) ? $this->clearString($data[69]) : null;
                    $msrp = !empty($data[70]) ? $this->clearString($data[70]) : null;
                    $meta_title = !empty($data[71]) ? $this->clearString($data[71]) : null;
                    $meta_keywords = !empty($data[72]) ? $this->clearString($data[72]) : null;
                    $meta_description = !empty($data[73]) ? $this->clearString($data[73]) : null;
                    $pdf_title_1 = !empty($data[74]) ? $this->clearString($data[74]) : null;
                    $pdf_title_2 = !empty($data[75]) ? $this->clearString($data[75]) : null;
                    $pdf_title_3 = !empty($data[76]) ? $this->clearString($data[76]) : null;
                    $pdf_title_4 = !empty($data[77]) ? $this->clearString($data[77]) : null;
                    $categories = !empty($data[78]) ? $this->clearString($data[78]) : null;
                    $bullet_point_1 = !empty($data[79]) ? $this->clearString($data[79]) : null;
                    $bullet_point_2 = !empty($data[80]) ? $this->clearString($data[80]) : null;
                    $bullet_point_3 = !empty($data[81]) ? $this->clearString($data[81]) : null;
                    $bullet_point_4 = !empty($data[82]) ? $this->clearString($data[82]) : null;
                    $maintenance_videos = !empty($data[83]) ? $this->clearString($data[83]) : null;
                    $maintenance_video_title_1 = !empty($data[84]) ? $this->clearString($data[84]) : null;
                    $maintenance_video_url_1 = !empty($data[85]) ? $this->clearString($data[85]) : null;
                    $maintenance_video_title_2 = !empty($data[86]) ? $this->clearString($data[86]) : null;
                    $maintenance_video_url_2 = !empty($data[87]) ? $this->clearString($data[87]) : null;
                    $maintenance_video_title_3 = !empty($data[88]) ? $this->clearString($data[88]) : null;
                    $maintenance_video_url_3 = !empty($data[89]) ? $this->clearString($data[89]) : null;
                    $maintenance_video_title_4 = !empty($data[90]) ? $this->clearString($data[90]) : null;
                    $maintenance_video_url_4 = !empty($data[91]) ? $this->clearString($data[91]) : null;
                    $stock_status = !empty($data[92]) ? $this->clearString($data[92]) : null;
                    $related_products = !empty($data[93]) ? $this->clearString($data[93]) : null;
                    $configurable_product_parent_id = !empty($data[94]) ? $this->clearString($data[94]) : null;


                    $val = "`id` = '$id',`type_id` = '$type_id',`sku` = '$sku',`opera_sku` = '$opera_sku',`old_sku` = '$old_sku',`override_opera` = '$override_opera',`name` = '$name',`inlet` = '$inlet',`outlet` = '$outlet',`hose_type` = '$hose_type',`angle_in_deg` = '$angle_in_deg',`max_lpm` = '$max_lpm',`voltage` = '$voltage',`material` = '$material',`bar` = '$bar',`o-ring_thickness` = '$o_ring_thickness',`diameter` = '$diameter',`colour` = '$colour',`rpm` = '$rpm',`status` = '$status',`url_key` = '$url_key',`visibility` = '$visibility',`clearance` = '$clearance',`max_temperature` = '$max_temperature',`description` = '$description',`short_description` = '$short_description',`tech_spec_1` = '$tech_spec_1',`tech_spec_2` = '$tech_spec_2',`tech_spec_3` = '$tech_spec_3',`product_videos` = '$product_videos',`nozzle_value` = '$nozzle_value',`nozzle_size` = '$nozzle_size',`foam_value` = '$foam_value',`is_featured` = '$is_featured',`featured_position` = '$featured_position',`hose_clamp_size` = '$hose_clamp_size',`orifice_size` = '$orifice_size',`shoe_size` = '$shoe_size',`thread` = '$thread',`size_and_angle` = '$size_and_angle',`inlet_outlet` = '$inlet_outlet',`clothing_size` = '$clothing_size',`wheel_style` = '$wheel_style',`flow_and_pressure` = '$flow_and_pressure',`country_of_manufacture` = '$country_of_manufacture',`select_nozzle_size` = '$select_nozzle_size',`dn_internal_diameter` = '$dn_internal_diameter',`currency` = '$currency',`pack_size` = '$pack_size',`easyturn` = '$easyturn',`priority` = '$priority',`manufacturer_number_1` = '$manufacturer_number_1',`manufacturer_number_2` = '$manufacturer_number_2',`manufacturer_number_3` = '$manufacturer_number_3',`manufacturer_number_4` = '$manufacturer_number_4',`manufacturer_number_5` = '$manufacturer_number_5',`manufacturer_number_6` = '$manufacturer_number_6',`manufacturer_number_7` = '$manufacturer_number_7',`manufacturer_number_8` = '$manufacturer_number_8',`manufacturer_number_9` = '$manufacturer_number_9',`manufacturer_number_10` = '$manufacturer_number_10',`hose_application` = '$hose_application',`hose_inlet` = '$hose_inlet',`hose_outlet` = '$hose_outlet',`hose_length` = '$hose_length',`hose_colour` = '$hose_colour',`price` = '$price',`special_price` = '$special_price',`poa` = '$poa',`poa_price` = '$poa_price',`msrp` = '$msrp',`meta_title` = '$meta_title',`meta_keywords` = '$meta_keywords',`meta_description` = '$meta_description',`pdf_title_1` = '$pdf_title_1',`pdf_title_2` = '$pdf_title_2',`pdf_title_3` = '$pdf_title_3',`pdf_title_4` = '$pdf_title_4',`categories` = '$categories',`bullet_point_1` = '$bullet_point_1',`bullet_point_2` = '$bullet_point_2',`bullet_point_3` = '$bullet_point_3',`bullet_point_4` = '$bullet_point_4',`maintenance_videos` = '$maintenance_videos',`maintenance_video_title_1` = '$maintenance_video_title_1',`maintenance_video_url_1` = '$maintenance_video_url_1',`maintenance_video_title_2` = '$maintenance_video_title_2',`maintenance_video_url_2` = '$maintenance_video_url_2',`maintenance_video_title_3` = '$maintenance_video_title_3',`maintenance_video_url_3` = '$maintenance_video_url_3',`maintenance_video_title_4` = '$maintenance_video_title_4',`maintenance_video_url_4` = '$maintenance_video_url_4',`stock_status` = '$stock_status',`related_products` = '$related_products',`configurable_product_parent_id` = '$configurable_product_parent_id'";
                    $sql = $sql . "INSERT INTO products SET $val ON DUPLICATE KEY UPDATE $val; ";

                }
                if ($a == $razdel) {
                    $g = DB::unprepared($sql);
                    $sql = null;
                    $a = null;
//                    $b++;

                }

                //Старт счетчика
                $a++;
                $d++;
            }
            if (!is_null($sql)) {
                $u = DB::unprepared($sql);
            }
            fclose($h);
        }


        return "1";
    }

    private function getParseCategory($file = null): string
    {
        $csv_arr = [];
        if (($h = fopen($file, "r")) !== FALSE) {

            DB::table('category_product')->truncate();
            $csv_arr = array();

            $a = 0;
            $b = 0;
            $d = 0;
            $razdel = 100;
            $sql = null;
            $f = 0;
            $f1 = array();
            $j = array();
            $names = ($data = fgetcsv($h, 100000, ","));
            $i = [];
            while (($data = fgetcsv($h, 100000, ",")) !== FALSE) {
                if ($a != 0) {
                    $categories = !empty($data[78]) ? $this->clearString($data[78]) : null;
                    $val = '';
                    $tok = strtok($categories, ",");

                    while ($tok !== false) {
                        $tok = strtok(",");
                        if ($tok) {
                            try {
                                $sq = DB::insert("INSERT INTO category_product (category_id,product_id) value ($tok,$data[0])");
                            } catch (\Exception $exception) {
                                exit();
                            }
                        }
                    }
                    $sql = $sql . "INSERT INTO products SET $val ON DUPLICATE KEY UPDATE $val; ";
                }
                if ($a == $razdel) {
                    try {
                        $g = DB::unprepared($sql);
                    } catch (\Exception $exception) {
                        exit();
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
        return str_replace(array('\\', "'", "\n"), array('/', '', '', ""), $text);
    }
}



