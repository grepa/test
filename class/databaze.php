<?php



class databaze
{      
        
	private $jaky;
	private $soubor;
	private $konektor;
	private $verze=1.02;
	private $logovani=1;
	
	public function __construct($jaky,$soubor){
		  
		  if($jaky=='billing'){
                        $server = "localhost";
                        $logindb = "****t"; 
                        $heslo = "****"; 
                        $databaze = "***";
                        $mysql=mysqli_connect($server, $logindb, $heslo,$databaze) or die("Nepodarilo se pripojit k databazi"); 
                        mysqli_query($mysql,"SET NAMES utf8");
                        $this->konektor=$mysql;
                        $this->soubor=$soubor;
                }
         
		  
	//konec konstruktoru	    
        }
	
	
	public function db_query($dotaz){
		
		  if($this->logovani==1){ 
			  
			  $this->log($dotaz); 
			  $this->logovani=1;
			  }
		  $sql=mysqli_query($this->konektor,$dotaz);
		   if(!$sql){  echo $this->db_chyba("chyba ve sql dotazu $dotaz"); }
									
						
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
	    $this->logovani=0;
	    $tabulka=$this->db_query("SHOW TABLES LIKE  'log_sql'");


	    if($this->db_num_rows($tabulka)==0){
			
			$this->db_query('CREATE TABLE IF NOT EXISTS `log_sql` (
																  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
																  `id_admin` int(10) unsigned NOT NULL,
																  `dotaz` text COLLATE utf8_czech_ci NOT NULL,
																  `soubor` text COLLATE utf8_czech_ci NOT NULL,
																  `time` int(10) unsigned NOT NULL,
																  PRIMARY KEY (`id`)
																) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=1 ;');
			
			}
	  
	   
	    
	     $this->db_query("INSERT INTO `log_sql` (`id_admin` ,`dotaz` ,`soubor`,`time`)VALUES ('".$admin."',  '".$this->db_real_escape_string($dotaz)."','".$this->soubor."',  '".time()."');");
	   
	//konec funkce na log
	}
	
	
	private function db_chyba($text){
		
		  return $text;
		  
		  
		}
	
	//KONEC TRIDY
	}

?>
