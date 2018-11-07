<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class MY_Controller extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  function loadData($args){
    $json = file_get_contents(base_url('json/'.$args));
    $json = json_decode($json,true);
    return $json;
  }

  function initPopulasi($args){
    $populasi = array();
    foreach ($args as $key => $value) {
      $num = (int)$value;
      $populasi[] = $num;
    }
    // var_dump($populasi);

    $populasi_terpilih = array();
    for ($i=1; $i<=6 ; $i++) {
          # code...
          $kromosom = $populasi;
          shuffle($kromosom);
          $populasi_terpilih[] = $kromosom;
        }
    return $populasi_terpilih;
  }

  function initEvaluasi($args_populasi, $args_data){

    $evaluasi = array();

    foreach ($args_populasi as $kromosom) {
      $gen = $kromosom[0];
      $sum_jarak = 0;
      $size_kromosom=0;
      $size_kromosom = count($kromosom);

      for ($i=1; $i<$size_kromosom; $i++) {
        $jarak = $args_data[$gen]["jarak"][$kromosom[$i]];
        $sum_jarak += $jarak;
        $gen = $kromosom[$i];
        # code...

      }

      $evaluasi[] = $sum_jarak;
    }

    return $evaluasi;
  }

  function initFitness($args_populasi, $args_data){
    $fitness = array();
    $sum_fitness = 0;
    foreach ($args_populasi as $kromosom) {
      $gen = $kromosom[0];
      $sum_jarak = 0;
      $size_kromosom=0;
      $size_kromosom = count($kromosom);
      // die(print_r($size_kromosom));

      for ($i=1; $i<$size_kromosom; $i++) {
        $jarak = $args_data[$gen]["jarak"][$kromosom[$i]];
        $sum_jarak += $jarak;
        $gen = $kromosom[$i];
        # code...
      }
      $fitness[] = number_format((float)1/$sum_jarak, 7, '.', '');
      $sum_fitness += number_format((float)1/$sum_jarak, 7, '.', '');
    }
    $result_array['fitness']=$fitness;
    $result_array['jumlah']=$sum_fitness;
    return $result_array;
  }
  function generate_wheel($args_array){
    $array_hasil=[];
    if($args_array!=''){
      $data = $args_array['fitness'];
      $total_fitness = $args_array['jumlah'];
      $temp_kumulatif=0;
      $probabilitas = array();
      $probabilitas_kumulatif=array();
      foreach($data as $data){
        $temp_probabilitas = $data/$total_fitness;
        // $probabilitas[] = $temp_probabilitas;
        $probabilitas[] = number_format((float)$temp_probabilitas, 5, '.', '');
        $temp_kumulatif += $temp_probabilitas;
        $probabilitas_kumulatif[]= number_format((float)$temp_kumulatif, 5, '.', '');
      }
      $array_hasil['probabilitas']=$probabilitas;
      $array_hasil['probabilitas_kumulatif']=$probabilitas_kumulatif;
    }
    return $array_hasil;
  }

  function roulete_selection($args_data){
    $selected_key=array();
    for ($i=1; $i <=2 ; $i++) {
      $random = rand(0,100)/100;
      // var_dump($random);
      foreach ($args_data['probabilitas_kumulatif'] as $key => $value) {
        if($random<=$value){
          if(!in_array($key,$selected_key)){
            $selected_key[] = $key;
          }else{
            if($key==sizeof($args_data['probabilitas_kumulatif'])-1){
              $selected_key[]=$key-1;
            }else{
              $selected_key[]=$key+1;
            }
          }
          break;
        }
      }
    }
    return $selected_key;
  }

  function mutation($args_data){

    $banyak_mutation = round($this->session->userdata('mutation_rate') * 6 * sizeof($this->session->userdata('kota_terpilih')));
    $index =array();
    for ($i=0; $i < $banyak_mutation ; $i++) {
      // code...
      $random_index = rand(1, 6 * sizeof($this->session->userdata('kota_terpilih')));
      while ($random_index % sizeof($this->session->userdata('kota_terpilih')) == 0) {
        $random_index = rand(1, 6 * sizeof($this->session->userdata('kota_terpilih')));
      }
      // var_dump($random_index);
      $index[] = $random_index;
    }

    foreach ($index as $key => $value) {
      // code...
      $div_index = intdiv($value, sizeof($this->session->userdata('kota_terpilih')));
      $mod_index = $value % sizeof($this->session->userdata('kota_terpilih'));
      // var_dump($mod_index);

      if ($div_index == 6) {
        // code...
        $div_index -= 1;
      }
      if ($mod_index == 0) {
        $temp = $args_data[$div_index][$this->session->userdata('kota_terpilih')-1];
        $args_data[$div_index][$this->session->userdata('kota_terpilih')-1] = $args_data[$div_index][0];
        $args_data[$div_index][0] = $temp;
      } else {
        $temp = $args_data[$div_index][$mod_index-1];
        $args_data[$div_index][$mod_index-1] = $args_data[$div_index][$mod_index];
        $args_data[$div_index][$mod_index] = $temp;
      }
    }

    return $args_data;
  }

  function crossover($args_data,$index_name){
    $random_rate = rand(0,100)/100;
    // var_dump($random_rate);
    $parent1=$this->session->userdata($index_name)[$args_data[0]];
    $parent2=$this->session->userdata($index_name)[$args_data[1]];
    $temp_hasil1 = $parent1;
    $temp_hasil2 = $parent2;
    if($random_rate<=$this->session->userdata('crossover_rate')){
      $titik = intdiv(sizeof($parent1),2);
      for($i=$titik;$i<sizeof($parent1);$i++){
        $temp_hasil1[$i] = null;
        $temp_hasil2[$i] = null;
      }

      for($i=$titik;$i<sizeof($parent1);$i++){
        foreach ($parent2 as $key => $value) {
          if(in_array($value, $temp_hasil1)==false){
            $temp_hasil1[$i] = $value;
            break;
          }
        }
      }

      for($j=$titik;$j<sizeof($parent2);$j++){
        foreach ($parent1 as $key => $value) {
          if(!in_array($value, $temp_hasil2)){
            $temp_hasil2[$j] = $value;
            break;
          }
        }
      }
    }
    $result[0]=$temp_hasil1;
    $result[1]=$temp_hasil2;
    return $result;
  }

  // function ready_state(){
  //
  // }
}
?>
