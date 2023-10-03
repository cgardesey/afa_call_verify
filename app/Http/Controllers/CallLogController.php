<?php

namespace App\Http\Controllers;

use App\CallLog;
use App\Services\GsmCallService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CallLogController extends Controller
{
    protected $gsmCallService;
    public function __construct(GsmCallService $gsmCallService)
    {
        $this->gsmCallService = $gsmCallService;
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function callLog(Request $request)
    {
        $request->validate([
            'caller_phonenumber' => 'required',
            'callee_phonenumber' => 'required'
        ]);

        $caller_phonenumber = substr($request->input("caller_phonenumber"), 1);
        $callee_phonenumber = substr($request->input("callee_phonenumber"), 1);
        $call_id = mt_rand(10000000, 99999999);

        $response = $this->gsmCallService->sendRequest(new Client(), $call_id, $caller_phonenumber, $callee_phonenumber);


        CallLog::forceCreate([
            'caller_phonenumber' => $request->input("caller_phonenumber"),
            'callee_phonenumber' => $request->input("callee_phonenumber"),
            'call_id' => $call_id,
            'user_id' => Auth::id()
        ]);

        return Response::json([
            'success' => true,
            'guzzle_response' => $response->getBody()->getContents(),
            'caller_phonenumber' => $request->input("caller_phonenumber")
        ]);
    }
}
