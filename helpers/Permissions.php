<?php

namespace Helpers;

use database\Connection;
use database\DB;
use database\QueryBuilder;

use function core\pre;

class Permissions
{

    public static function can($user, $module, $permission)
    {
        //Buscar o usuario
        $user = DB::table('users')->where("id='$user'");
        //Busca os is dos perfis atribuidos ao usuario
        $profileUser = DB::table("user_profiles")->where("id_usuario={$user[0]->id}");
        //Busca o modulo desejado
        $modules = DB::table("modules")->where("nome='{$module}'");
        if (!$module) {
            return false; //Modulo nao encontrado
        }    
        //Hora de buscar a permissao
        $permission = DB::table("permissions")->where("nome='{$permission}'");

        exit;
    }
}