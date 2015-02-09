<?php 
$friend= MooCore::getInstance()->getModel('Friend');
$friend_request = MooCore::getInstance()->getModel('FriendRequest');
?>
<script>
function respondRequest(id, status)
{

	jQuery.post('<?=$this->request->base?>/friends/ajax_respond', {id: id, status: status}, function(data){
		jQuery('#request_'+id).html(data);
	},location.reload(true));
	
	
}
</script>
<div style='background-color:white;border:1px solid #ccc;float:left; width:100%;'>
	 <div style='border-bottom:1px solid #ccc; padding-top:10px;padding-bottom:10px;padding-left:20px; background-color:#f6f6f6;width:100%; margin-bottome:10px;font-weight:300; font-size:22px'>
		 <table>
			 <tr>
				 <td >
				 	<span>Whom I Viewed</span>
				 </td>
			 </tr>
		 </table>		 
	 </div><br>
	<?php foreach($wivs as $wiv):?> 
					<div style='float: left;margin-left:14px;margin-right:5px;margin-bottom:15px;float:left;width:195px;min-height:80px;'>
		                <table style='border: 1px solid;display:block; padding:5px;height:80px; '>
			                <tr >              
			                    <td> 
			                		<?=$this->Moo->getUserAvatar($wiv['User'], 33, 'user_avatar_large')?>
			                     </td>      
			                    <td>
			                      	<table style='display: block; margin-left:5px;font-size:14px;'>
			                      		<tr style='font-size:14px;'><td><?=$this->Moo->getName($wiv['User'])?></td></tr>
			                      		<tr style='font-size:11px;'><td>
			                      		<?=$this->AppTime->timeAgoInWords($wiv['WhomIViewed']['date_view'],array('format' => 'F jS, Y', 'end' => '+1 year'))?><br>
	                      				<?=$wiv['WhomIViewed']['count_view'] ?> viewed</td></tr>	                      							                      		                      				
				                      			<?php				             
				                      			$uid1=$wiv['WhomIViewed']['me_id'];
				                      			$uid2=$wiv['WhomIViewed']['whom_id'];
				                      			$areFriends=$friend->areFriends($uid1,$uid2);
				                      			$request=$friend_request->getRequests( $uid1 );
				                      			if ( !$areFriends): ?>
				                      				<?php if($request==null):?>
				                      					<tr style='font-size:13px;'>
				                      						<td>
													            <a  href="<?=$this->request->base?>/friends/ajax_add/<?=$wiv['User']['id']?>" id="addFriend_<?=$wiv['User']['id']?>" data-target="#themeModal" data-toggle="modal"  title="<?php printf( __('Send %s a friend request'), h($wiv['User']['name']) )?>">
													                <i class="visible-xs visible-sm icon-user-add"></i><i class="hidden-xs hidden-sm"><?=__('Add as Friend')?></i>
													            </a>
													        </td>
													     <tr>
										            <?php endif; ?>
										            <?php if($request!=null):?>
										            <tr style='font-size:13px;'>
										            <td>
										            	<a href="javascript:void(0)" onclick="respondRequest(<?php echo reset(Hash::extract($request, '{n}.FriendRequest.id'))?>, 1)" ><?=__d('accept','Accept friend Request')?></a>
										            	</td></tr>
										            <?php endif; ?>
									            <?php endif; ?>
									            <?php if( $areFriends):?>
									            	<tr style='height: 18px;'></tr>
									            <?php endif;?>									            				                      	
			                      	</table>
			                    </td>
			                </tr>
		                </table>
	                </div>
	<?php endforeach;?>
	
</div>

