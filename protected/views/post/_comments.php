<?php
$rev=array_reverse($comments);
foreach($rev as $comment): ?>
<div class="comment" id="c<?php echo $comment->id; ?>">

	

	<div class="author"> 
		<?php $user = User::model()->findByPk($comment->author);?>
		<h6><?php echo CHtml::image(Yii::app()->baseUrl .'/images/'.$user->image, $user->id,array("class" => "clickme", "width"=>"20", "height"=>"20")); ?>
		<?php echo $user->username." ";?>says:</h6>
		
	</div>

	<div class="time">
		<?php echo date('F j, Y \a\t h:i a',$comment->create_time); ?>
	</div>

	<div class="content">
		<b><?php echo nl2br(CHtml::encode($comment->content)); ?></b>
	</div>
	<?php $user_posted = $post->author_id;
		   $user_on = Yii::app()->user->id;
		   $user_commented = $comment->author;
		   //echo $user_posted;
		   //echo $user_on;
		   if ($user_posted == $user_on || $user_on == $user_commented):?>
		   <?php echo CHtml::linkButton('Delete',array(
			'submit'=>array('comment/delete','id'=>$comment->id),
			'confirm'=>"Are you sure to delete this post?",
			)); ?>
			
			<?php echo CHtml::linkButton('Edit',array(
			'submit'=>array('comment/update','id'=>$comment->id),
			
			)); ?>
		   <?php endif ?>
	

</div><!-- comment -->
</br>
<?php endforeach; ?>