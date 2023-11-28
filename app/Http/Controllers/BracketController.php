<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class BracketController extends Controller
{



    protected $brackets;

    public function __construct(){
        $this->brackets = [
            "("=>")",
            "{"=>"}",
            "["=>"]"
        ];
    }
    public function bracket_control(Request $request){
        $this->second_senario($request->brackets);
        $first_senario = $this->first_senario($request->brackets);
        $second_senario = $this->second_senario($request->brackets);
        if($first_senario || $second_senario){
            Session::flash('success',"Diziliş Doğru");
            return view("bracket")->with('success',"Diziliş doğru");
        }else{
            Session::flash('error');
            return view("bracket")->with('error',"Diziliş yanlış");
        }
    }




    //Eğer stringin karakter uzunluğu tekse otomatik false döndür.
    private function array_even_or_odd($string){
        $array = str_split($string);
        if(count($array) % 2 == 0){
            return true;
        }else{
            return false;
        }
    }




    private function first_senario($string){
       
        $array = str_split($string);
        $is_even = $this->array_even_or_odd($string);
        $sonuc_array = [];
        if(!$is_even){
            array_push($sonuc_array,"Yanlış"); 
            return false;
        }
        $array_length = count($array);
        for($i = 0; $i < $array_length / 2 ; $i++){
            if (isset($this->brackets[$array[$i]])) {
            if ($this->brackets[$array[$i]] == $array[count($array)-1-$i]){
                array_push($sonuc_array,"Doğru");
            }else{
                array_push($sonuc_array,"Yanlış");
            }
        }
        }
        if(in_array("Yanlış", $sonuc_array)){
            return false;
        }else{
            return true;
        }
    }



    private function second_senario($string){
        $array = str_split(str_replace(" ","",$string));
        $is_even = $this->array_even_or_odd($string);
        $sonuc_array = [];
        if(!$is_even){
            array_push($sonuc_array,"Yanlış");
            
            return false;
        }
        $string = mb_substr($string,1,-1);
        $array = str_split($string);
 
 
        for($i = 0; $i < count($array); $i++){
            if (isset($this->brackets[$array[$i]])) {
                if(  $this->brackets[$array[$i]] == $array[$i+1]){
                   return true;
                }else{
                    return false;
                }
            } 
        }


    }
}
