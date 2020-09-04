<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use function GuzzleHttp\json_decode;

class GithubApiController extends Controller
{
    public static function obterUsuario(Request $request) {

        $dados = array();
        $erro = null;
        if( strlen($request->usuario) ) {
            try {
                $client = new Client();
                $response = $client->get("https://api.github.com/users/".$request->usuario);
                $dados = json_decode($response->getBody()->getContents());
            }
            catch (ClientException $e) {
                $dados[] = $e->getResponse()->getReasonPhrase();
            }

        }
        return view('githubUser', array('dados'=>$dados));
    }
}
