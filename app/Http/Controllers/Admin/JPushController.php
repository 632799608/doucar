<?php
/**
 *  广告控制器
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JPushController extends Controller
{
	protected $service;

	public function __construct() {
	}

    public function index()
    {
        $client = new \JPush\Client(config('jpush.app_key'), config('jpush.master_secret'), storage_path('logs/jpush.log'));
        $registration_id = '7733777a76f907920bd0ce91f5b9b42c';
        // $result = $client->device()->getDevices($registration_id);
        // print "before update alias = " . $result['body']['alias'] . "\n";
        $response = $client->device()->getDevices($registration_id);
        print_r($response);
    }

}
