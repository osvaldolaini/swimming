<?php

use App\Models\Model\Categories;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;



if (! function_exists('imageProfile')) {
    function imageProfile($profile)
    {
        // URL do site que contém a imagem
        $url = 'https://www.cbda.org.br/atleta/natacao/'.$profile;

        // Cria uma instância do Guzzle Client
        $client = new Client();

        // Faz a requisição GET ao site
        $response = $client->request('GET', $url);

        // Obtém o conteúdo HTML da resposta
        $html = $response->getBody()->getContents();

        // Cria um objeto Crawler para analisar o HTML
        $crawler = new Crawler($html);

        // Encontra a imagem com base na classe
        $imagem = $crawler->filter('.MuiAvatar-img')->first();

        // Obtém o valor do atributo src da imagem
        $src = $imagem->attr('src');

        // Define a propriedade $imageUrl do componente com a URL da imagem
        return $src;
    }
}
if (! function_exists('converTime')) {
    function converTime(string $string)
    {
        $time = explode('.',$string);
        if($time[0] > 0){
            $seconds = intval($time[0]); //Converte para inteiro

            $mins = floor($seconds / 60);
            $secs = floor($seconds % 60);

            if(isset($time[1])){
                $sign = sprintf('%02d:%02d', $mins, $secs).','.$time[1];
            }else{
                $sign = sprintf('%02d:%02d', $mins, $secs).',00';
            }

        }else{
            $sign = '00:00,'.$time[1];
        }

        return $sign;
    }
}
if (!function_exists('convertDate')) {
    function convertDate($date)
    {
        if ($date) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)
                ->format('d/m/Y H:i:s');
        } else {
            return '';
        }
    }
}
if (!function_exists('convertOnlyDate')) {
    function convertOnlyDate($date)
    {
        if ($date) {

            return Carbon::createFromFormat('Y-m-d H:i:s', $date)
                ->format('d/m/Y');
        } else {
            return '';
        }
    }
}
if (!function_exists('getCategory')) {
    function getCategory($date)
    {
        $d = explode('-',$date);
            return Categories::select('name')->where('birth_year',$d[0])->first()->name ;

    }
}
