<?php



class databaze
{      
        
	private $jaky;
	private $soubor;
	private $konektor;
	private $verze=1.01;
	
	public function __construct($jaky,$soubor){
		  
		  if($jaky=='rajce'){
                        $server = "localhost";
                        $logindb = "****"; 
                        $heslo = "****"; 
                        $databaze = "****";
                        $mysql=mysqli_connect($server, $logindb, $heslo,$databaze) or die("Nepodarilo se pripojit k databazi"); 
                        mysqli_query($mysql,"SET NAMES utf8");
                        $this->konektor=$mysql;
                        $this->soubor=$soubor;
                }

		  
	//konec konstruktoru	    
        }
	
	
	public function db_query($dotaz){
		
		  $this->log($dotaz);
		  $sql=mysqli_query($this->konektor,$dotaz);
		   if(!$sql){  db_chyba("chyba ve sql dotazu $dotaz"); }
									
						
		   return $sql;
		  //konec db_query
		}
		
	public function db_fetch_assoc($dotaz){
		
		     return mysqli_fetch_assoc($dotaz);
		}
		
	public function db_fetch_array($dotaz){
		
		     return mysqli_fetch_assoc($dotaz);
		}
		
	public function db_num_rows($sql){
		
		   
		   return mysqli_num_rows($sql);
		}		
	
	public function db_real_escape_string($dotaz){
		
		return mysqli_real_escape_string($this->konektor,$dotaz);
		
		
		}
	public function db_class_verze(){
		
		  return $verze;
		}	
		
		
		
		
		
		
	private function log($dotaz){
	  
	    if(isset($_SESSION["admin"]["id"])){$admin=$_SESSION["admin"]["id"];}
	    else {$admin=0;} 
	  
	    mysqli_query($this->konektor,"INSERT INTO `log_sql` (`id_admin` ,`dotaz` ,`soubor`,`time`)VALUES ('".$admin."',  '".$this->db_real_escape_string($dotaz)."','".$this->soubor."',  '".time()."');");
	   
	
	}
	
	//KONEC TRIDY
	}

?>
