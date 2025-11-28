<?php
use function core\pre;
class Allmodels{ 
    public function do($db){ 
        require(appdir.'/config/database.php');                    
        require(sisdir.'/helpers/Classbuilder.php');
        $schema = substr($db,0,'-2');

        $builder =  new helpers\Classbuilder();
        $tables = $builder->gettables($schema);
        foreach($tables as $tablename){
           if(strpos('_',$tablename)>0){
                $name = explode('_',$tablename);
                $entity = ucwords($name[0]);
                $entity2 = ucwords($nome[1]);
                $entity = $entity.$entity2;
           }else{
                $entity = ucfirst($tablename);
           } 
           echo $entity."\n";
        }
        
    }
}