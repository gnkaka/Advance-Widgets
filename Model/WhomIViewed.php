<?php
App::uses('AppModel', 'Model');
App::uses('User', 'Model');
class WhomIViewed extends AppModel {
	public function getWIVs( $uid, $page = 1, $limit = RESULTS_LIMIT )
	{
		$this->unbindModel(
				array('belongsTo' => array('User'))
		);

		$this->bindModel(
				array('belongsTo' => array(
						'User' => array(
								'className' => 'User',
								'foreignKey' => 'whom_id'
						)
				)
				)
		);
		$wivs = $this->find('all', array( 'conditions' => array( 'me_id' => $uid),
				'order' => 'WhomIViewed.id desc',
				'limit' => $limit,
				'page' => $page)
		);
		
		return $wivs;
	}
	public function updateModel(){		
		App::uses('CakeSession', 'Model/Datasource');
		$me_id = CakeSession::read('uid');
		$whom_id=reset(Router::getParam('pass'));
		$string_date = date('Y-m-d H:i:s');
		$check=$this->find('all',array('conditions'=>array('me_id'=>$me_id,'whom_id'=>$whom_id)));
		if($check==null)
		{
			if($me_id!=$whom_id)
			{
				$sql="INSERT INTO `whom_i_vieweds`(`me_id`, `whom_id`, `count_view`, `date_view`) VALUES (".$me_id.",".$whom_id.",1,'".$string_date."')";
				$this->query($sql);
			}
		}else{
			$id=implode(reset($this->find('first',array('conditions'=>array('me_id'=>$me_id,'whom_id'=>$whom_id),'fields'=>'id'))));
			$sql1="UPDATE `whom_i_vieweds`SET `count_view`=count_view+1,`date_view`= '".$string_date."' where `id`=".$id."";
			$this->query($sql1);
		}
	}
}
