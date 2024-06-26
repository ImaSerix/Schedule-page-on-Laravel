<?php

namespace Database\Seeders;

use App\Models\Route;
use App\Models\RouteNetwork;
use App\Models\Run;
use App\Models\Schedule;
use App\Models\Stop;
use DOMDocument;
use DOMXPath;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;

class SatiksmeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $dataList = array (['web' => 1, 'name' => '1', 'description' => 'Butļerova iela - Stacija', 'routeDescription' => 'Butļerova iela - Stacija', 'id'=> 0, 'type'=>'tram', 'fromSid'=> 71017, 'toSid'=> 71035, 'dest'=>'a-b', 'url'=> 'https://satiksme.daugavpils.lv/tramvajs-nr-1-butlerova-iela-stacija'],
        ['web'=> 1, 'name'=> '1', 'description' => 'Butļerova iela - Stacija', 'routeDescription' => 'Stacija - Butļerova iela', 'id'=> 1, 'type'=>'tram', 'fromSid'=> 7279, 'toSid'=> 7280, 'dest'=>'b-a', 'url'=> 'https://satiksme.daugavpils.lv/tramvajs-nr-1-stacija-butlerova-iela'],
        ['web'=> 2, 'name'=> '2', 'description' => 'Butļerova iela - Maizes kombināts', 'routeDescription' => 'Butļerova iela - Maizes kombināts', 'id'=> 0, 'type'=>'tram', 'fromSid'=> 71017, 'toSid'=> 71079, 'dest'=>'a-b', 'url'=> 'https://satiksme.daugavpils.lv/lv-tramvajs-nr-2-butlerova-iela-maizes-kombinats'],
        ['web'=> 2, 'name'=> '2', 'description' => 'Butļerova iela - Maizes kombināts', 'routeDescription' => 'Maizes kombināts - Butļerova iela', 'id'=> 1, 'type'=>'tram', 'fromSid'=> 8482, 'toSid'=> 7280, 'dest'=>'b-a', 'url'=> 'https://satiksme.daugavpils.lv/lv-tramvajs-nr-2-maizes-kombinats-butlerova-iela'],
        ['web'=> 3, 'name'=> '17A', 'description' => 'Autoosta – CSDD – Jaunā Forštate', 'routeDescription' => 'Autoosta – CSDD – Jaunā Forštate', 'id'=> 0, 'type'=>'bus', 'fromSid'=> 8768, 'toSid'=> 18149, 'dest'=>'a-b', 'url'=> 'https://satiksme.daugavpils.lv/autobuss-nr-17a-autoosta-csdd-jaunforstadte'],
        ['web'=> 3, 'name'=> '17A', 'description' => 'Autoosta – CSDD – Jaunā Forštate', 'routeDescription' => 'Jaunforštadte - CSDD - Autoosta', 'id'=> 1, 'type'=>'bus', 'fromSid'=> 9057, 'toSid'=> 18036, 'dest'=>'b-a', 'url'=> 'https://satiksme.daugavpils.lv/autobuss-17a-jaunforstadte-csdd-autoosta'],
        ['web'=> 4, 'name'=> '20B', 'description' => 'Jaunā Forštate – Smiltenes iela – Jaunbūve – Ķīmija', 'routeDescription' => 'Autoosta - Jaunforštadte', 'id'=> 0, 'type'=>'bus', 'fromSid'=> 8768, 'toSid'=> 9057, 'dest'=>'a-b', 'url'=> 'https://satiksme.daugavpils.lv/autobuss-nr20b-jaunforstadte-smiltenes-jaunbuve-kimiku-ciemats'],
        ['web'=> 4, 'name'=> '20B', 'description' => 'Jaunā Forštate – Smiltenes iela – Jaunbūve – Ķīmija', 'routeDescription' => 'Jaunā Forštate – Smiltenes iela – Jaunbūve – Ķīmija', 'id'=> 1, 'type'=>'bus', 'fromSid'=> 9057, 'toSid'=> 88597, 'dest'=>'b-c', 'url'=> 'https://satiksme.daugavpils.lv/autobuss-nr20b-jaunforstadte-smiltenes-jaunbuve-kimiku-ciemats'],
        ['web'=> 4, 'name'=> '20B', 'description' => 'Jaunā Forštate – Smiltenes iela – Jaunbūve – Ķīmija', 'routeDescription' => 'Ķīmiķu ciemats – Jaunbūve – Smiltenes iela – Jaunforštadte', 'id'=> 2, 'type'=>'bus', 'fromSid'=> 88597, 'toSid'=> 9057, 'dest'=>'c-b', 'url'=> 'https://satiksme.daugavpils.lv/autobuss-nr20b-jaunforstadte-smiltenes-jaunbuve-kimiku-ciemats-no-ciolkovska'],
        ['web'=> 4, 'name'=> '20B', 'description' => 'Jaunā Forštate – Smiltenes iela – Jaunbūve – Ķīmija', 'routeDescription' => 'Jaunforštadte - Autoosta', 'id'=> 3, 'type'=>'bus', 'fromSid'=> 9057, 'toSid'=> 18036, 'dest'=>'b-a', 'url'=> 'https://satiksme.daugavpils.lv/autobuss-nr20b-jaunforstadte-smiltenes-jaunbuve-kimiku-ciemats-no-ciolkovska'],
        ['web'=> 5, 'name'=> '19', 'description' => 'Jaunā Forštate – Ķīmija – Jaunbūve – Jaunā Forštate', 'routeDescription' => 'Autoosta - Autobusu parks', 'id'=> 0, 'type'=>'bus', 'fromSid'=> 8768, 'toSid'=> 18164, 'dest'=>'a-b', 'url'=> 'https://satiksme.daugavpils.lv/lv-autobuss-nr-19-jaunforstadte-kimiku-ciemats-jaunbuve-jaunforstadte'],
        ['web'=> 5, 'name'=> '19', 'description' => 'Jaunā Forštate – Ķīmija – Jaunbūve – Jaunā Forštate', 'routeDescription' => 'Autobusu parks - Jaunā Forštate', 'id'=> 1, 'type'=>'bus', 'fromSid'=> 18164, 'toSid'=> 9057, 'dest'=>'b-c', 'url'=> 'https://satiksme.daugavpils.lv/lv-autobuss-nr-19-jaunforstadte-kimiku-ciemats-jaunbuve-jaunforstadte'],
        ['web'=> 5, 'name'=> '19', 'description' => 'Jaunā Forštate – Ķīmija – Jaunbūve – Jaunā Forštate', 'routeDescription' => 'Jaunā Forštate - Jaunā Forštate (Ciolkovska)', 'id'=> 2, 'type'=>'bus', 'fromSid'=> 9057, 'toSid'=> 88596, 'dest'=>'c-d', 'url'=> 'https://satiksme.daugavpils.lv/lv-autobuss-nr-19-jaunforstadte-kimiku-ciemats-jaunbuve-jaunforstadte'],
        ['web'=> 5, 'name'=> '19', 'description' => 'Jaunā Forštate – Ķīmija – Jaunbūve – Jaunā Forštate', 'routeDescription' => 'Jaunā Forštate (no Ciolkovska) – Ķīmija – Jaunbūve – Jaunā Forštate', 'id'=> 3, 'type'=>'bus', 'fromSid'=> 88596, 'toSid'=> 9057, 'dest'=>'d-c', 'url'=> 'https://satiksme.daugavpils.lv/lv-autobuss-nr-19-jaunforstadte-kimiku-ciemats-jaunbuve-jaunforstadte-ciolkovska'],
        ['web'=> 5, 'name'=> '19', 'description' => 'Jaunā Forštate – Ķīmija – Jaunbūve – Jaunā Forštate', 'routeDescription' => 'Jaunā Forštate - Autoosta', 'id'=> 4, 'type'=>'bus', 'fromSid'=> 9057, 'toSid'=> 18036, 'dest'=>'c-a', 'url'=> 'https://satiksme.daugavpils.lv/lv-autobuss-nr-19-jaunforstadte-kimiku-ciemats-jaunbuve-jaunforstadte-ciolkovska']);
        foreach($dataList as $i => $data) {
            echo round($i / count($dataList) * 100).'% ';
            $this->makeDB($data);
        };
    }
    //get routeData from HTML document
    private function getVar($html){
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();
        $xpath = new DOMXPath($dom);
        $elementWithId = $xpath->query("//*[@id='processDataForm']")->item(0);
        $elemContent = $elementWithId->nextSibling->nextSibling->textContent;
        $routeData = json_decode (substr($elemContent, strpos($elemContent, '{'), strpos($elemContent, '$') - strpos($elemContent, '{')));
        return $routeData;
    }
    //Chose a part of the routeData array, which needed
    private function getShedule($data, $routeData){
        $partOfSchedule = array();
        $copy = false;
        foreach($routeData->stations as $station){
            if ($station->number == $data['name'] and (int) ($station->sid) == $data['fromSid']) $copy = true;
            if ($copy) array_push($partOfSchedule, $station);
            if ($station->number == $data['name'] and (int) ($station->sid) == $data['toSid']) break;
        }
        $schedule = ['wtlist' => $this->bestRow($partOfSchedule, 'wtlist'), 'htlist' => $this->bestRow($partOfSchedule, 'htlist')];
        return $schedule;
    }
    //Chose row, which have all "time" fields full
    private function bestRow($stations, $key){
        $i = 0;
        foreach($stations as $station) foreach(array_slice ($station->$key, $i) as $time) if(!strpos($time, ':')) $i++; else break; 
        $station = $stations[0];
        $res = array();
        array_push($res, array('sid' =>$station->sid, 'name' => $station->name, 
                                                        'geo' => array('lat' => $station->geo->lat, 'lng' => $station->geo->lng), 
                                                        'schedule' => array()));
        foreach (array_slice ($station->$key, $i) as $run => $time) 
        {
            if ($time != '-'){
                $exp = explode(':', $time);
                $timeInMinutes = $exp[0] * 60 + $exp[1];
                if ($run != 0 && end($res[0]['schedule']) > $timeInMinutes) $timeInMinutes = 24 * 60 + $exp[1];
                array_push($res[0]['schedule'], $timeInMinutes);
            }
        }
        foreach(array_slice ($stations, 1) as $order => $station) 
        {
            $exp = explode(':', $station->$key[$i]);
            $timeInMinutes = $exp[0] * 60 + $exp[1];
            if ($order != 0 && end($res)['schedule'] > $timeInMinutes) $timeInMinutes = 24 * 60 + $exp[1];
            array_push($res, array('sid' =>$station->sid, 'name' => $station->name, 
                                                            'geo' => array('lat' => $station->geo->lat, 'lng' => $station->geo->lng), 
                                                            'schedule' => $timeInMinutes));
        }
        
        return $res;
    }
    private function makeDB($data){
        $client = new Client();
        $response = $client->get($data['url']);
        $html = (string) $response->getBody();
        $stationsToInsert = $this->getShedule($data, $this->getVar($html));
        //return;
        $routeNetwork = RouteNetwork::firstOrCreate(['name' => $data['name'], 'transport_type' => $data['type'], 'description' => $data['description']]);
        $route = Route::firstOrCreate(['route_network_id' => $routeNetwork->id, 'direction' => $data['dest'], 'description' => $data['routeDescription']]);
        foreach(array('wtlist', 'htlist') as $listKey)
        {
            $prevTime = $stationsToInsert[$listKey][0]['schedule'][0];
            foreach($stationsToInsert[$listKey] as $order => $station)
            {
                $stop = Stop::firstOrCreate(['name' => $station['name'], 'latitude' => floatval($station['geo']['lat']), 'longitude' => floatval($station['geo']['lng'])]);
                //Location::firstOrCreate(['$stop_id' => $stop->id], ['latitude' => $station['geo']['lat'], 'longitude' => $station['geo']['lng']]);
                if ($order == 0) 
                {
                    foreach($station['schedule'] as $run => $time)
                    {
                        if ($run == 0) Schedule::create(['route_id' => $route->id, 'stop_id' =>$stop->id, 
                                                        'is_work_day' => $listKey == 'wtlist', 'order' => $order, 'time_delta' => 0]);
                        Run::create(['route_id' => $route->id, 
                                    'is_work_day' => $listKey == 'wtlist', 'start_time' =>$time]);
                    }
                    continue;
                }
                Schedule::create(['route_id' => $route->id, 'stop_id' =>$stop->id, 
                                'is_work_day' => $listKey == 'wtlist', 'order' => $order, 'time_delta' => $station['schedule'] - $prevTime]);
                $prevTime = $station['schedule'];
            }
        }
    }  
}
