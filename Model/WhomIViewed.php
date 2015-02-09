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
				$this->set(array('me_id'=>$me_id,'whom_id'=>$whom_id,'count_view'=>1,'date_view'=>$string_date));
				$this->save();
			}
		}else{
			$id=implode(reset($this->find('first',array('conditions'=>array('me_id'=>$me_id,'whom_id'=>$whom_id),'fields'=>'id'))));
			$count_view=implode(reset($this->find('first',array('conditions'=>array('id'=>$id),'fields'=>'count_view'))));
			$this->id=$id;
			$this->set(array('count_view'=>$count_view+1,'date_view'=>$string_date));
			$this->save();
		}
	}
}
