<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class ComponentController extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function load_data(){
    $data['data'] = $this->loadData('kota.json');
    $data['id_kota']=array_keys($data['data']['1']['jarak']);
    // $this->load->view('component/data',$data);
    $this->load->view('component/data', $data);
  }

  public function load_input(){
    $data['data'] = $this->loadData('kota.json');
    $data['id_kota']=array_keys($data['data']['1']['jarak']);
    $checked=[];
    if($this->session->userdata('kota_terpilih')){
      foreach ($data['id_kota'] as $key => $value) {
        if(in_array($value,$this->session->userdata('kota_terpilih'))){
          $checked[$value]='checked';
        }else{
          $checked[$value]='';
        }
      }
      $data['checked']=$checked;
    }else{
      $data['checked']=false;
    }
    $this->load->view('component/input',$data);
  }

  public function input_handler(){
    if($this->input->post('submit')){
      if($this->input->post('kota_terpilih')!= "false"){
        $this->session->set_userdata('kota_terpilih',$this->input->post('kota_terpilih'));
        $this->session->set_userdata('mutation_rate',(float)$this->input->post('mutation_rate'));
        $this->session->set_userdata('crossover_rate',(float)$this->input->post('crossover_rate'));
        echo json_encode(true);
        $this->session->unset_userdata('populasi');
      }
    }
  }

  public function input_reset(){
    // $this->session->unset_userdata('kota_terpilih');
    session_destroy();
  }

  public function load_kota_terpilih(){
    $data['kota_terpilih']=false;
    $data['data']=$this->loadData('kota.json');
    if($this->session->userdata('kota_terpilih')){
      $data['kota_terpilih']=$this->session->userdata('kota_terpilih');
    }
    $this->load->view('component/kota_terpilih',$data);
  }

  public function load_populasi(){
    $data['data']=$this->loadData('kota.json');
    $data['kota_terpilih']=false;
    $data['populasi']=false;

    if($this->session->userdata('kota_terpilih')){
      $data['kota_terpilih']=$this->session->userdata('kota_terpilih');
      // var_dump($this->session->userdata('populasi'));
      if ($this->session->userdata('populasi')) {
        $data['populasi'] = $this->session->userdata('populasi');
      }else{
        $data['populasi'] = $this->initPopulasi($data['kota_terpilih']);
        $this->session->set_userdata('populasi',$data['populasi']);
      }
    }

    $this->load->view('component/populasi', $data);
  }

  public function load_evaluasi_fitness(){
    $data['data']=$this->loadData('kota.json');
    $data['kota_terpilih']=false;
    $data['populasi']=false;
    $data['evaluasi']=false;
    $data['fitness']=false;

    if($this->session->userdata('kota_terpilih')){
      $data['kota_terpilih']=$this->session->userdata('kota_terpilih');
      // var_dump($this->session->userdata('populasi'));
      if ($this->session->userdata('populasi')) {
        $data['populasi'] = $this->session->userdata('populasi');
        $data['evaluasi'] = $this->initEvaluasi($data['populasi'], $data['data']);
        $data['fitness'] = $this->initFitness($data['populasi'],$data['data']);
        $data['data_wheel'] = $this->generate_wheel($data['fitness']);
      }else{
        $data['populasi'] = $this->initPopulasi($data['kota_terpilih']);
        $this->session->set_userdata('populasi',$data['populasi']);
        $data['evaluasi'] = $this->initEvaluasi($data['populasi'], $data['data']);
        $data['fitness'] = $this->initFitness($data['populasi'], $data['data']);
        $data['data_wheel'] = $this->generate_wheel($data['fitness']);
      }
    }

    $this->load->view('component/evaluasi', $data);
      // var_dump($data['data_wheel']);
  }

  public function load_selected_parent_awal(){

    $data['data']=$this->loadData('kota.json');
    $data['kota_terpilih']=false;
    $data['populasi']=false;
    $data['evaluasi']=false;
    $data['fitness']=false;

    $data['parent']=false;

    if($this->session->userdata('kota_terpilih')){
      $data['kota_terpilih']=$this->session->userdata('kota_terpilih');
      // var_dump($this->session->userdata('populasi'));
      if ($this->session->userdata('populasi')) {
        $data['populasi'] = $this->session->userdata('populasi');
        $data['evaluasi'] = $this->initEvaluasi($data['populasi'], $data['data']);
        $data['fitness'] = $this->initFitness($data['populasi'],$data['data']);
        $data['data_wheel'] = $this->generate_wheel($data['fitness']);
      }else{
        $data['populasi'] = $this->initPopulasi($data['kota_terpilih']);
        $this->session->set_userdata('populasi',$data['populasi']);
        $data['evaluasi'] = $this->initEvaluasi($data['populasi'], $data['data']);
        $data['fitness'] = $this->initFitness($data['populasi'], $data['data']);
        $data['data_wheel'] = $this->generate_wheel($data['fitness']);
      }
      if($this->session->userdata('selected_parent_awal')){
        $data['parent'] = $this->session->userdata('selected_parent_awal');
        $data['crossover'] = $this->session->userdata('crossover');
        // if ($this->session->userdata('mutation')) {
        //   // code...
        //     $this->session->unset_userdata('mutation');
        //     $data['mutation']=$this->mutation($data['crossover']);
        // } else {
        //   $data['mutation']=$this->mutation($data['crossover']);
        // }
        // $data['mutation'] = $this->session->userdata('mutation');
      }else{
        $parent = array();
        for ($i=0; $i <3 ; $i++) {
          # generate 3 pair parent
          $temp_parent = $this->roulete_selection($data['data_wheel']);
          $parent[] = $temp_parent;
        }
        $this->session->set_userdata('selected_parent_awal',$parent);
        $data['parent']=$parent;

        $crossover=array();
        for ($i=0; $i <3 ; $i++) {
          $crossover[]=$this->crossover($data['parent'][$i],'populasi');
        }

        $crossover_structured = array();
        foreach ($crossover as $key_crossover => $value_crossover) {
          foreach ($value_crossover as $key => $value) {
            $crossover_structured[] = $value;
          }
        }
        $this->session->set_userdata('crossover',$crossover_structured);
        $data['crossover']=$crossover_structured;

      }

      if($this->session->userdata('mutation')){
        $data['mutation']=$this->session->userdata('mutation');
      }else{
        $data['mutation']=$this->mutation($data['crossover']);
        $this->session->set_userdata('mutation',$data['mutation']);
      }
      // $this->session->unset_userdata('offspring');
      $this->session->set_userdata('offspring',$data['mutation']);
    }
    // var_dump($crossover);

    $this->load->view('component/seleksi_awal', $data);

  }

  // public function first_crossover(){
  //   $data['data']=$this->loadData('kota.json');
  //   $data['kota_terpilih']=false;
  //   $data['populasi']=false;
  //   $data['evaluasi']=false;
  //   $data['fitness']=false;
  //
  //   $data['parent']=false;
  //   $data['crossover']=false;
  //
  //   if($this->session->userdata('kota_terpilih')){
  //     $data['kota_terpilih']=$this->session->userdata('kota_terpilih');
  //     // var_dump($this->session->userdata('populasi'));
  //     if ($this->session->userdata('populasi')) {
  //       $data['populasi'] = $this->session->userdata('populasi');
  //       $data['evaluasi'] = $this->initEvaluasi($data['populasi'], $data['data']);
  //       $data['fitness'] = $this->initFitness($data['populasi'],$data['data']);
  //       $data['data_wheel'] = $this->generate_wheel($data['fitness']);
  //     }else{
  //       $data['populasi'] = $this->initPopulasi($data['kota_terpilih']);
  //       $this->session->set_userdata('populasi',$data['populasi']);
  //       $data['evaluasi'] = $this->initEvaluasi($data['populasi'], $data['data']);
  //       $data['fitness'] = $this->initFitness($data['populasi'], $data['data']);
  //       $data['data_wheel'] = $this->generate_wheel($data['fitness']);
  //     }
  //   }
  //
  //   $parent = array();
  //   $crossover = array();
  //   for ($i=0; $i <3 ; $i++) {
  //     // generate 3 pair parent
  //       $temp_parent = $this->roulete_selection($data['data_wheel']);
  //       $parent[] = $temp_parent;
  //       $temp_crossover = $this->crossover($temp_parent);
  //   }
  //   var_dump($temp_parent);
  //
  // }

  public function load_populasi_akhir(){
    $data['data']=$this->loadData('kota.json');
    $data['populasi']=false;
    $data['kota_terpilih']=false;
    $data['evaluasi']=false;
    if($this->session->userdata('kota_terpilih')){
      $data['kota_terpilih']=$this->session->userdata('kota_terpilih');
      if($this->session->userdata('hasil')){
        $data['populasi']=$this->session->userdata('hasil');
      }else{
        if($this->session->userdata('offspring')){
          $temp_offspring=$this->session->userdata('offspring');
          $fitness_log=array();
          $average_log=array();
          for($counter=1;$counter<=10000;$counter++){
            $temp_fitness=$this->initFitness($temp_offspring,$data['data']);
            // var_dump($temp_fitness);
            $fitness_log[]=max($temp_fitness['fitness']);
            $average_log[]=array_sum($temp_fitness['fitness'])/sizeof($temp_fitness['fitness']);
            // var_dump($fitness_log);
            $temp_generate_wheel=$this->generate_wheel($temp_fitness);
            $temp_selection=$this->roulete_selection($temp_generate_wheel);
            // var_dump($this->session->userdata('offspring'));
            // var_dump($temp_selection);
            $temp_crossover=array();
            for($i=1;$i<=3;$i++){
              $temp_crossover[]=$this->crossover($temp_selection,'offspring');
            }
            $temp_structured_crossover=array();
            foreach ($temp_crossover as $key => $value) {
              foreach ($value as $key1 => $value1) {
                // code...
                $temp_structured_crossover[]=$value1;
              }
            }
            $temp_mutation=$this->mutation($temp_structured_crossover);
            $temp_offspring=$temp_mutation;
            $data['populasi']=$temp_offspring;
            $this->session->set_userdata('offspring',$temp_offspring);
          }
          $this->session->set_userdata('hasil',$data['populasi']);
          $this->session->set_userdata('fitness_log',$fitness_log);
          $this->session->set_userdata('average_log',$average_log);
          $this->session->set_userdata('fitness_akhir',$this->initFitness($data['populasi'],$data['data']));
          $this->session->set_userdata('evaluasi_akhir',$this->initEvaluasi($data['populasi'],$data['data']));
        }
      }
      $data['fitness']=$this->session->userdata('fitness_akhir');
      $data['evaluasi']=$this->session->userdata('evaluasi_akhir');
    }
    // die(print_r($this->initEvaluasi($data['populasi'],$data['data'])));
    $this->load->view('component/populasi_akhir',$data);
  }
  public function load_grafik(){
    $data['kota_terpilih']=false;
    if ($this->session->userdata('kota_terpilih')) {
      // code...
      $data['kota_terpilih'] = $this->session->userdata('kota_terpilih');
      $this->load->view('component/grafik', $data);
    }
  }
}

?>
