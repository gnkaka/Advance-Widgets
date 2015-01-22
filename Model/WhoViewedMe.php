<?php
App::uses('AppModel', 'Model');
App::uses('User', 'Model');
class WhoViewedMe extends AppModel {
	public function getWVMs( $uid, $page = 1, $limit = RESULTS_LIMIT )
	{
		$this->unbindModel(
				array('belongsTo' => array('User'))
		);
	
		$this->bindModel(
				array('belongsTo' => array(
						'User' => array(
								'className' => 'User',
								'foreignKey' => 'user_view'
						)
				)
				)
		);
		$wvms = $this->find('all', array( 'conditions' => array( 'view_user' => $uid),
				'order' => 'WhoViewedMe.id desc',
				'limit' => $limit,
				'page' => $page)
		);
		return $wvms;	
	}   	
	public function updateModel(){
		App::uses('CakeSession', 'Model/Datasource');
		$user_view = CakeSession::read('uid');
		$view_user=reset(Router::getParam('pass'));
		$string_date = date('Y-m-d H:i:s');
		$check=$this->find('all',array('conditions'=>array('user_view'=>$user_view,'view_user'=>$view_user)));
		if($check==null)
		{
			if($user_view!=$view_user)
			{
				$sql="INSERT INTO `who_viewed_mes`(`view_user`, `user_view`, `count_view`, `date_view`) VALUES (".$view_user.",".$user_view.",1,'".$string_date."')";
				$this->query($sql);
			}
		}else{
			$id=implode(reset($this->find('first',array('conditions'=>array('user_view'=>$user_view,'view_user'=>$view_user),'fields'=>'id'))));		
			$sql1="UPDATE `who_viewed_mes`SET `count_view`=count_view+1,`date_view`= '".$string_date."' where `id`=".$id."";
			$this->query($sql1);
		}
	}
}
