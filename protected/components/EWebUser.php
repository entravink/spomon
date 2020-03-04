<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class EWebUser extends CWebUser{
 
    protected $_model;
 
    protected function loadUser()
    {
        if ( $this->_model === null ) {
                $this->_model = MUser::model()->findByPk($this->id);
        }
        return $this->_model;
    }
    
    function getLevel()
    {
        $user=$this->loadUser();
        if($user)
            return $user->user_level;
        return 100;
    }
    
    function getLevelName()
    {
        $user=$this->loadUser();
        if($user)
            return $user->userLevel->nama;
        return "";
    }
    
    function getWilayah()
    {
        $user=$this->loadUser();
        if($user)
            return $user->user_wil;
        return "";
    }
    
    function getUserId()
    {
        $user=$this->loadUser();
        if($user)
            return $user->id_user;
        return null;
    }
    function getNama()
    {
        $user=$this->loadUser();
        if($user)
            return $user->nama;
        return null;
    }
    
    function getAvatar()
    {
        $user=$this->loadUser();
        if($user)
            return $user->avatar;
        return null;
    }
    
    function getUser()
    {
        $user=$this->loadUser();
        if($user){
            return $user;
        }
        return null;
    }
}
?>
