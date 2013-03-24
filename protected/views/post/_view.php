
<?php
/* @var $this PostController */
/* @var $data Post */
?>

	<div class="view">

	<div class="title">
		<h2><?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?></h2>
	</div>
	<div class="author">
		<?php $user = User::model();?>
		<table align = 'left'>
		<td>
		<?php echo CHtml::image(Yii::app()->baseUrl .'/images/'.$data->author->image, $user->id,array("class" => "clickme", "width"=>"50", "height"=>"50")); ?>
		</td>
		<td align="left">
		posted by <?php echo $data->author->username . ' on ' . date('F j, Y',$data->create_time);?>
		<div class="content">
		<b>
		<?php
			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			echo $data->content;
			$this->endWidget();
		?>
		</b>
	</div>
	</td>
	</table>
		
		
	</div>
	<?php 
		$user_posted = $data->author_id;
		$user_on = Yii::app()->user->id;
		if ($user_posted == $user_on):?>
		   <?php echo CHtml::linkButton('Delete',array(
			'submit'=>array('post/delete','id'=>$data->id),
			'confirm'=>"Are you sure to delete this post?",
			)); ?>
		   

			<?php echo CHtml::linkButton('Edit',array(
			'submit'=>array('post/update','id'=>$data->id),
			
			)); ?>
		   <?php endif ?>
	
	<div class="nav">
		<b>Tags:</b>
		<?php echo implode(', ', $data->tagLinks); ?>
		<br/>
		<?php echo CHtml::link("Comments ({$data->commentCount})",$data->url.'#comments'); ?> |
		Last updated on <?php echo date('F j, Y',$data->update_time); ?>
	</div>

</div>