<?php
/**
 * Classe 
 */ 
namespace apps\controllers;

use database\Select;
use database\Update;
use helpers\TDatagrid;
use helpers\TDataSelect;
use helpers\TextInput;
use helpers\ToolbarPadrao;
use helpers\TSelect;

use function core\closebox;
use function core\filterpost;
use function core\openbox;
use function core\pre;

class ItemmenuController extends \core\Controller{
    /**
	 * 
	 */
	public function checklevel($id_parent)
	{
		$select = new Select('nivel_menu','admin_menus');
		$select->where("id={$id_parent}");
		
		$rows = $select->run();
		if(sizeof($rows)>0)
		{
			$level = $rows[0]->nivel_menu+1;
		}else{
			$level = 1;
		}

		echo $level;
	}
    /**
	 * 
	 */
	public function checkposition($id_parent)
	{
		$select = new Select('ordem','admin_menus');
		$select->having('ordem','(Select MAX(ordem) as ordem from admin_menus where id_parent ="'.$id_parent.'")');
		$rows = $select->run();
		if(sizeof($rows)>0)
		{
			$position = $rows[0]->ordem+1;
		}else{
			$position = 1;
		}

		echo $position;
	}
}