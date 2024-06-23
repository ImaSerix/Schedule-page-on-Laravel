<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Route;
use App\Models\RouteNetwork;
use App\Models\Run;
use App\Models\SavedStop;
use App\Models\Schedule;
use App\Models\Stop;
use App\Models\User;
use DOMDocument;
use DOMXPath;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\type;

class SatiksmeSeeader extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $dataList = array (['web' => 1, 'name' => '1', 'id'=> 0, 'type'=>'tram', 'fromSid'=> 71017, 'toSid'=> 71035, 'dest'=>'a-b', 'url'=> 'https://satiksme.daugavpils.lv/tramvajs-nr-1-butlerova-iela-stacija'],
        ['web'=> 1, 'name'=> '1', 'id'=> 1, 'type'=>'tram', 'fromSid'=> 7279, 'toSid'=> 7280, 'dest'=>'b-a', 'url'=> 'https://satiksme.daugavpils.lv/tramvajs-nr-1-stacija-butlerova-iela'],
        ['web'=> 2, 'name'=> '2', 'id'=> 0, 'type'=>'tram', 'fromSid'=> 71017, 'toSid'=> 71026, 'dest'=>'a-b', 'url'=> 'https://satiksme.daugavpils.lv/lv-tramvajs-nr-2-butlerova-iela-maizes-kombinats'],
        ['web'=> 2, 'name'=> '2', 'id'=> 1, 'type'=>'tram', 'fromSid'=> 8482, 'toSid'=> 7280, 'dest'=>'b-a', 'url'=> 'https://satiksme.daugavpils.lv/lv-tramvajs-nr-2-maizes-kombinats-butlerova-iela'],
        ['web'=> 3, 'name'=> '17A', 'id'=> 0, 'type'=>'bus', 'fromSid'=> 8768, 'toSid'=> 18149, 'dest'=>'a-b', 'url'=> 'https://satiksme.daugavpils.lv/autobuss-nr-17a-autoosta-csdd-jaunforstadte'],
        ['web'=> 3, 'name'=> '17A', 'id'=> 1, 'type'=>'bus', 'fromSid'=> 9057, 'toSid'=> 18036, 'dest'=>'b-a', 'url'=> 'https://satiksme.daugavpils.lv/autobuss-17a-jaunforstadte-csdd-autoosta'],
        ['web'=> 4, 'name'=> '20B', 'id'=> 0, 'type'=>'bus', 'fromSid'=> 8768, 'toSid'=> 9057, 'dest'=>'a-b', 'url'=> 'https://satiksme.daugavpils.lv/autobuss-nr20b-jaunforstadte-smiltenes-jaunbuve-kimiku-ciemats'],
        ['web'=> 4, 'name'=> '20B', 'id'=> 1, 'type'=>'bus', 'fromSid'=> 9057, 'toSid'=> 88597, 'dest'=>'b-c', 'url'=> 'https://satiksme.daugavpils.lv/autobuss-nr20b-jaunforstadte-smiltenes-jaunbuve-kimiku-ciemats'],
        ['web'=> 4, 'name'=> '20B', 'id'=> 2, 'type'=>'bus', 'fromSid'=> 88597, 'toSid'=> 9057, 'dest'=>'c-b', 'url'=> 'https://satiksme.daugavpils.lv/autobuss-nr20b-jaunforstadte-smiltenes-jaunbuve-kimiku-ciemats-no-ciolkovska'],
        ['web'=> 4, 'name'=> '20B', 'id'=> 3, 'type'=>'bus', 'fromSid'=> 9057, 'toSid'=> 18036, 'dest'=>'b-a', 'url'=> 'https://satiksme.daugavpils.lv/autobuss-nr20b-jaunforstadte-smiltenes-jaunbuve-kimiku-ciemats-no-ciolkovska'],
        ['web'=> 5, 'name'=> '19', 'id'=> 0, 'type'=>'bus', 'fromSid'=> 8768, 'toSid'=> 18164, 'dest'=>'a-b', 'url'=> 'https://satiksme.daugavpils.lv/lv-autobuss-nr-19-jaunforstadte-kimiku-ciemats-jaunbuve-jaunforstadte'],
        ['web'=> 5, 'name'=> '19', 'id'=> 1, 'type'=>'bus', 'fromSid'=> 18164, 'toSid'=> 9057, 'dest'=>'b-c', 'url'=> 'https://satiksme.daugavpils.lv/lv-autobuss-nr-19-jaunforstadte-kimiku-ciemats-jaunbuve-jaunforstadte'],
        ['web'=> 5, 'name'=> '19', 'id'=> 2, 'type'=>'bus', 'fromSid'=> 9057, 'toSid'=> 88596, 'dest'=>'c-d', 'url'=> 'https://satiksme.daugavpils.lv/lv-autobuss-nr-19-jaunforstadte-kimiku-ciemats-jaunbuve-jaunforstadte'],
        ['web'=> 5, 'name'=> '19', 'id'=> 3, 'type'=>'bus', 'fromSid'=> 88596, 'toSid'=> 9057, 'dest'=>'d-c', 'url'=> 'https://satiksme.daugavpils.lv/lv-autobuss-nr-19-jaunforstadte-kimiku-ciemats-jaunbuve-jaunforstadte-ciolkovska'],
        ['web'=> 5, 'name'=> '19', 'id'=> 4, 'type'=>'bus', 'fromSid'=> 9057, 'toSid'=> 18036, 'dest'=>'c-a', 'url'=> 'https://satiksme.daugavpils.lv/lv-autobuss-nr-19-jaunforstadte-kimiku-ciemats-jaunbuve-jaunforstadte-ciolkovska']);
        $this->makeDB($dataList[0]);
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
    private function getPartOfArray($data, $routeData){
        $res = array();
        $copy = false;
        foreach($routeData->stations as $station){
            if ($station->number == $data['name'] and (int) ($station->sid) == $data['fromSid']) $copy = true;
            if ($copy) array_push($res, $station);
            if ($station->number == $data['name'] and (int) ($station->sid) == $data['toSid']) return $res;
        }
        return $res;
    }
    //Chose row, which have all "time" fields full
    private function bestRow($stations, $key){
        $i = 0;
        foreach($stations as $station) foreach(array_slice ($station->$key, $i) as $schedule) if(!strpos($schedule, ':')) $i++; else break; 
        return $i;
    }
    private function makeDB($data){
        $client = new Client();
        $response = $client->get($data['url']);
        $html = (string) $response->getBody();
        $stationsToInsert = $this->getPartOfArray($data, $this->getVar($html));
        $targetRow = $this->bestRow($stationsToInsert, 'wtlist');
        RouteNetwork::create(['RouteNetworkID' => $data['web'], 'Name' => $data['name']]);
    }
}
