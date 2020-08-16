<?php
  include_once ($_SERVER['DOCUMENT_ROOT'].'/conexion_cultural/conf.php');
  class DataSource{
  private $cadenaConexion;
  private $conexion;
	public function __construct(){
		try{
			
			$this->cadenaConexion = "mysql:host=".HOST.";dbname=".BASENAME;
      $this->conexion = new PDO($this->cadenaConexion,USERDATABASE,PASSDATABASE);
      
		}catch(PDOException $e){
			echo "<div class='alert alert-inv alert alert-dark alert-wth-icon alert-dismissible fade show'
                                     role='alert'>
                <span class='alert-icon-wrap'>
                    <i class='zmdi zmdi-bug'></i>
                </span> ".$e->getMessage()."
            </div>";
      }
	}
	public function ejecutarConsulta($sql,$values = array()){
    try{  
		  if($sql != ""){
			$consulta = $this->conexion->prepare($sql);
      $consulta->execute($values);
			$tabla_datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
			return $tabla_datos;}
            else{return 0;}
      }catch(PDOException $e){
        echo "<div class='alert alert-inv alert
                                       alert-dark alert-wth-icon 
                                       alert-dismissible fade show'
                                       role='alert'>
                              <span class='alert-icon-wrap'>
                                    <i class='zmdi zmdi-bug'></i>
                              </span> ".$e->getMessage()."
                             </div>";}     
  }
    public  function multiplesTransacciones($consultas = array()){
        
        $resultado = false;
         try {  
             $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $this->conexion->beginTransaction();
            foreach ($consultas as $key => $value) {  $this->conexion->exec($consultas[$key]);}
             $this->conexion->commit();
             $resultado = true;
           } catch (Exception $e) {
             $this->conexion->rollBack();
                   echo "<div class='alert alert-inv alert
                                     alert-dark alert-wth-icon 
                                     alert-dismissible fade show'
                                     role='alert'>
                            <span class='alert-icon-wrap'>
                                  <i class='zmdi zmdi-bug'></i>
                            </span> ".$e->getMessage()."
                           </div>";
          }
    }
    
	public function ejecutarActualizacion($sql ,$values = array()){
    try {  
      $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  if($sql != ""){
			  $consulta = $this->conexion->prepare($sql);
		  	$consulta->execute($values);
        $numero_tablas_afectadas = $consulta->rowCount();
			  return $numero_tablas_afectadas;
      }else{ return 0;}
    
    } catch (Exception $e) {
        echo "<div class='alert alert-inv alert alert-dark alert-wth-icon alert-dismissible fade show'
                          role='alert'>
                  <span class='alert-icon-wrap'>
                      <i class='zmdi zmdi-bug'></i>
                  </span> ".$e->getMessage()."
              </div>";
    }
  }
}
    
 ?>
