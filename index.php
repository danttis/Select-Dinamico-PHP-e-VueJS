<?php 
include 'connect.php';

$sql_select = $conexao->prepare("SELECT * FROM Municipios");
$sql_select->execute();
while($array = $sql_select->fetch(PDO::FETCH_OBJ)){
	$nome =  $array->Nome;
	$uf = $array->Uf;
	$id =  $array->Codigo;
	$array_municipios[]=array($uf,$nome,$id);
}
?>
<html>
<head>
<script type="text/javascript" src="vue.js"></script>	
</head>
<div id='app'>
    <select  @click="newValue"  v-model="estado">
     <option selected>Selecione um Estado</option>
     <?php 
       $select = $conexao->prepare("SELECT DISTINCT Uf FROM Municipios");
	   $select->execute();
       while($array = $select->fetch(PDO::FETCH_OBJ)){
	      $uf = $array->Uf;
	      echo "<option value=$uf>$uf</option>";
       }?>
    </select></br>
    <select><option v-for="option in options" v-bind:value="option.value">{{ option.nome }}</option></select> 
</div>
 
<script>
 var arr = <?php echo json_encode($array_municipios); ?>;   
    new Vue({
         el: '#app',
            data: {			
		options: [
                    { nome:'Selecione a Cidade' , value: 0 }
                ],
		data: {
	          estado: ''
		     }
            },
           methods: {
                newValue: function(event) {
	            while(this.options.length>1) {
                         this.options.pop();
                     }
		    for(var i = 0; i < arr.length; i++) {
			if(arr[i][0] == this.estado){
		          this.options.push({ nome: arr[i][1], id: arr[i][2]});
			}
                    }	   
		}
            }
	 });
    	
</script>
</html>
