<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function GuzzleHttp\json_decode;

class GithubApiController extends Controller
{
    public static function obterUsuario(Request $request) {

        $dados = array();
        $erro = null;
        if( strlen($request->usuario) ) {
            try {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.github.com/users/".$request->usuario,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_USERAGENT => "Required",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $dados = json_decode($response);
            }
            catch (Exception $e) {
                $dados[] = $e->getMessage();
            }

        }
        return view('githubUser', array('dados'=>$dados));
    }
}
