<?php

use function core\basedir;

class Folder{ 
	public function do($name,$db=''){ 
		try{
			$path = basedir().'/apps/'.$name;
			if(is_dir($path)){
				echo "\e[0;37;44m                                   \e[0m\n";
				echo "\e[0;37;44m A pasta de destino ja existe!     \e[0m\n";
				echo "\e[0;37;44m                                   \e[0m\n";
				
			}else if(mkdir($path)){
				echo "\e[0;37;44m                                   \e[0m\n";
				echo "\e[0;37;44m Pasta criada com sucesso!         \e[0m\n";
				echo "\e[0;37;44m                                   \e[0m\n";
			}
			
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
}
	