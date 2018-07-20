<?php
namespace App\Library\Services;

use Illuminate\Support\Facades\Storage;
  
class Countries
{
  public function fetchCountries()
  {

    $url = 'http://www.umass.edu/microbio/rasmol/country-.txt';
    $ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    $output = curl_exec ($ch);

    if (curl_error($ch)) {
      if (Storage::disk('local')->exists('cache')){
        $output = Storage::disk('local')->get('cache');
      } else {
        abort(404, "Cant access the link and also the cache");
      }
      
    }else {
      if (!Storage::disk('local')->exists('cache')){
        Storage::disk('local')->put('cache', $output);
      }
    }
    curl_close ($ch);

    preg_match_all('/\w+\s\s\s.+\n/',$output,$list);

    $cList = array();
    foreach ($list[0] as $unit => $country){
      $splitted = preg_split('/\s\s\s/', $country);
      array_push($cList,array(
        'sigla' => $splitted[0],
        'pais' => $splitted[1],
        'full' => '(' . $splitted[0] . ')' . ' ' . $splitted[1]
      ));
    }
    $collection = collect($cList);
    $sorted = $collection->sortByDesc('pais');
    return $sorted;
  }
}