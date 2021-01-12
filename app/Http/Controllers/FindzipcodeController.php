<?php

namespace App\Http\Controllers;

class FindzipcodeController extends Controller
{
    public function find($zipcode)
    {
        $response =  $this->sendGetRequest("https://brasilapi.com.br/api/cep/v1/{$zipcode}");

        if (!empty($zipcodeSearchResult['errors'])) {
            $response['success'] = false;
        } else {
            $response['success'] = true;
        }

        return response()->json($response);
    }

    private function sendGetRequest($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Accept: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $resp = curl_exec($curl);
        curl_close($curl);

        return json_decode($resp, true);
    }
}
