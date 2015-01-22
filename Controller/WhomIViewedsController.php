<?php 
App::uses('AppController', 'Controller');
class WhomIViewedsController extends AppController{
	public function admin_infos(){
		// get plugin info
		$xmlPath = sprintf(PLUGIN_INFO_PATH, 'WhomIViewed');
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
    public function myWIVs() {
    	if ($this->request->is('requested')) {   
    	$num_item_show = $this->request->named['num_item_show'];
        $uid=$this->Session->read('uid');
        $wivs = $this->WhomIViewed->getWIVs( $uid, null, $num_item_show );
        return $wivs;
    	}
    }
    public function index(){
    	$uid=$this->Session->read('uid');
    	$wivs=$this->WhomIViewed->getWIVs( $uid, null, null);
    	$this->set('wivs',$wivs);
    }
    
}
