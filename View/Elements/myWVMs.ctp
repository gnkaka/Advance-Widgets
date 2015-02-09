<?php if(empty($num_item_show)) $num_item_show = 10;
	$wvms = $this->requestAction(
			"advance_widget/who_viewed_mes/myWVMs/num_item_show:$num_item_show"
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

    <h3><?=__d('WhoViewedMe', 'Who Viewed Me');?></h3>
    <div class="box_content">
        <?php if($wvms != null):?>
            <?php foreach($wvms as $wvm):?>            
                <table width='100%'>
                <tr>              
                    <td width=45> 
                		<?=$this->Moo->getUserAvatar($wvm['User'], 33, 'user_avatar_large')?>
                     </td>      
                    <td>
                      	<table style='display: block;text-align:left; padding-left:5px;'>
                      		<tr style='font-size:12px;'><td><?=$this->Moo->getName($wvm['User'])?></td></tr>
                      		<tr style='font-size:11px;'><td>
                      		<?=$this->AppTime->timeAgoInWords($wvm['WhoViewedMe']['date_view'],array('format' => 'F jS, Y', 'end' => '+1 year'))?><br>
                      		<?=$wvm['WhoViewedMe']['count_view'] ?> viewed</td></tr>
                      		<tr>
	                      		<td>
	                      			<?php
	                      			$uid1=$wvm['WhoViewedMe']['view_user'];
	                      			$uid2=$wvm['WhoViewedMe']['user_view'];
	                      			$areFriends=$friend->areFriends($uid1,$uid2);
	                      			$request=$friend_request->getRequests( $uid1 );
	                      			if ( !$areFriends): ?>
	                      				<?php if($request==null):?>
								            <a  href="<?=$this->request->base?>/friends/ajax_add/<?=$wvm['User']['id']?>" id="addFriend_<?=$wvm['User']['id']?>" data-target="#themeModal" data-toggle="modal"  title="<?php printf( __('Send %s a friend request'), h($wvm['User']['name']) )?>">
								                <i class="visible-xs visible-sm icon-user-add"></i><i class="hidden-xs hidden-sm"><?=__('Add as Friend')?></i>
								            </a>
							            <?php endif; ?>
							            <?php if($request!=null):?>
							            	<a href="javascript:void(0)" onclick="respondRequest(<?php echo reset(Hash::extract($request, '{n}.FriendRequest.id'))?>, 1)" ><?=__('accept','Accept friend Request')?></a>
							            <?php endif; ?>
						            <?php endif; ?>
	                      		</td>
                      		</tr>
                      	</table>
                    </td>
                </tr>
                </table></br>
            <?php endforeach;?>
    		<?php echo $this->Html->link('View More','/advance_widget/who_viewed_mes/index');?>
        <?php else:?>
            <?=__d('WhoViewedMe', 'Nobody view you');?>
        <?php endif;?>
    </div>
</div>
