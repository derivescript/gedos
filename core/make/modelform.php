<?php

use core\ConsoleError;

use function core\pre;

class Modelform{ 
	public function do($name,$db=''){ 
		if($name!='')
		{
			$location  = explode('/',$name);
			$database = explode('.',$db);
			$dbname = $database[0];
			$tablename = $database[1];
			if(is_dir(appdir.'/'.$location[0]))
			{
				$application = $location[0];
				unset($location[0]);
				foreach($location as $part=>$target)
				{
				   //A segunda parte do endereco e uma pasta?
				   if(is_dir(appdir.'/'.$application.'/views/'.$location[$part]))
				   {
						$handle = fopen(appdir.'/'.$application.'/views/'.$location[$part].'/'.$location[$part+1].'.php','w');
					}else{
						$handle = fopen(appdir.'/'.$application.'/views/'.$target.'.php','w');
					}
				}                            
			}else{
					$console = new ConsoleError;
					$console->msgErro("O diretorio apontado ($location[0]) não existe!");
			}
			
		}
	}
}
	