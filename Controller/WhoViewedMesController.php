<?php 
App::uses('AppController', 'Controller');
class WhoViewedMesController extends AppController{
	public function admin_infos(){
		// get plugin info
		$xmlPath = sprintf(PLUGIN_INFO_PATH, 'WhoViewedMe');
		if(file_exists($xmlPath))
		{
			$content = file_get_contents($xmlPath);
			$info = new SimpleXMLElement($content);
			$this->set('info', $info);
		}
		else
		{
			$this->set('info', null);
		}
	}
    public function myWVMs() {  
    	if ($this->request->is('requested')) {
    	$num_item_show = $this->request->named['num_item_show'];
        $uid=$this->Session->read('uid');
        $wvms = $this->WhoViewedMe->getWVMs( $uid, null, $num_item_show );
        return $wvms;
    	}
    }
    public function index(){
    	$uid=$this->Session->read('uid');
    	$wvms=$this->WhoViewedMe->getWVMs( $uid, null, null);
    	$this->set('wvms',$wvms);    	
    }
   
}
