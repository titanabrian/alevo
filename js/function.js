function base_url(x){
  return "http://localhost/alevo-project/"+x
}
function load_component(container,url){
  $(container).load(url,function(){
    $(this).clone().appendTo(container).remove();
  });
}

function ajax_send_input(){
  var crossover_rate=$('#crossover-rate').val()
  var mutation_rate=$('#mutation-rate').val()
  if(mutation_rate==''||crossover_rate==''){
    return false;
  }
  var kota=[];
  $. each($("input[name='kota[]']:checked"), function(){
    kota.push($(this).val());
  });
  if(kota.length===0){
    kota=false
  }
  $.ajax({
    method:"POST",
    url: base_url('ComponentController/input_handler'),
    data:{submit:true,kota_terpilih:kota,mutation_rate:mutation_rate,crossover_rate:crossover_rate},
    dataType:"JSON",
    success:function(data){
      load_component('#nav-input',base_url('ComponentController/load_input'));
      // load_component('#kota-terpilih',base_url('ComponentController/load_kota_terpilih'));
    },
    error : function(err){
      console.log(err)
    }
  })
}

function ajax_reset_input(){
  $.ajax({
    method:"POST",
    url: base_url('ComponentController/input_reset'),
    success:function(data){
      load_component('#nav-input',base_url('ComponentController/load_input'));
    },
    error : function(err){
      console.log(err)
    }
  })
}
