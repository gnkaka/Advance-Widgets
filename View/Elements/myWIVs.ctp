<?php if(empty($num_item_show)) $num_item_show = 10;
	$wivs = $this->requestAction(
			"advance_widget/whom_i_vieweds/myWIVs/num_item_show:$num_item_show"
	);
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
<div class="box2">
    <h3><?=__d('WhomIViewed', 'Whom I Viewed');?></h3>
    <div class="box_content">
        <?php if($wivs != null):?>
            <?php foreach($wivs as $wiv):?>            
                <table width='100%'>
                <tr>              
                    <td width=45> 
                		<?=$this->Moo->getUserAvatar($wiv['User'], 33, 'user_avatar_large')?>
                     </td>      
                    <td>
                      	<table style='display: block;text-align:left; padding-left:5px;'>
                      		<tr style='font-size:12px;'><td><?=$this->Moo->getName($wiv['User'])?></td></tr>
                      		<tr style='font-size:11px;'><td>
                      		<?=$this->AppTime->timeAgoInWords($wiv['WhomIViewed']['date_view'],array('format' => 'F jS, Y', 'end' => '+1 year'))?><br>
                      		<?=$wiv['WhomIViewed']['count_view'] ?> viewed</td></tr>
                      		<tr>
	                      		<td>
	                      			<?php
	                      			$uid1=$wiv['WhomIViewed']['me_id'];
	                      			$uid2=$wiv['WhomIViewed']['whom_id'];
	                      			$areFriends=$friend->areFriends($uid1,$uid2);
	                      			$request=$friend_request->getRequests( $uid1 );
	                      			if ( !$areFriends): ?>
	                      				<?php if($request==null):?>
								            <a  href="<?=$this->request->base?>/friends/ajax_add/<?=$wiv['User']['id']?>" id="addFriend_<?=$wiv['User']['id']?>" data-target="#themeModal" data-toggle="modal"  title="<?php printf( __('Send %s a friend request'), h($wiv['User']['name']) )?>">
								                <i class="visible-xs visible-sm icon-user-add"></i><i class="hidden-xs hidden-sm"><?=__('Add as Friend')?></i>
								            </a>
							            <?php endif; ?>
							            <?php if($request!=null):?>
							            	<a href="javascript:void(0)" onclick="respondRequest(<?php echo reset(Hash::extract($request, '{n}.FriendRequest.id'))?>, 1)" ><?=__d('accept','Accept friend Request')?></a>
							            <?php endif; ?>
						            <?php endif; ?>
	                      		</td>
                      		</tr>
                      	</table>
                    </td>
                </tr>
                </table></br>
            <?php endforeach;?>
    		<?php echo $this->Html->link('View More','/advance_widget/whom_i_vieweds/index');?>
        <?php else:?>
            <?=__d('WhomIViewed', 'You not view anyone');?>
        <?php endif;?>
    </div>
</div>
