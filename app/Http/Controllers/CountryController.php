<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function lista(\Countries $countries){
        $list = $countries->fetchCountries();
        return view('lista')->with('data', json_decode($list, true));
    }

    public function excel (\Countries $countries){
        $list = $countries->fetchCountries();
        
        header("Content-Disposition: attachment; filename=\"demo.xls\"");
        header("Content-Type: application/vnd.ms-excel;");
        header("Pragma: no-cache");
        header("Expires: 0");
        $out = fopen("php://output", 'w');
        foreach ($list as $data)
        {
            fputcsv($out, $data,"\t");
        }
        fclose($out);
    }

    public function csv (\Countries $countries){
        $list = $countries->fetchCountries();
        
        header("Content-Disposition: attachment; filename=\"demo.csv\"");
        header("Content-Type: text/csv;");
        header("Pragma: no-cache");
        header("Expires: 0");
        $out = fopen("php://output", 'w');
        foreach ($list as $data)
        {
            fputcsv($out, $data,"\t");
        }
        fclose($out);
    }
}
