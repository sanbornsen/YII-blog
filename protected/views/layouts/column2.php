<?php $this->beginContent('/layouts/main'); ?>
<div class="container">
	<div class="span-18">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-6 last">
	
		<div id="sidebar">
		<?php if(!Yii::app()->user->isGuest): ?>
		<p>Welcome
		<?php $user = User::model()->findByPk(Yii::app()->user->id); //echo Yii::app()->user->id;?> 
	    <h2><?php echo $user->username;?></h2>
		</p>
		<div>
		<p>
		<?php echo CHtml::link('Create Post',array('create'));?>
		</p>
		</div>
		<?php $this->widget('TagCloud', array(
			'maxTags'=>Yii::app()->params['tagCloudCount'],
		)); ?>
			
		<?php if(!Yii::app()->user->isGuest) $this->widget('RecentComments', array(
			'maxComments'=>Yii::app()->params['recentCommentCount'],
			)); ?>
		<?php endif ?>
		
		
 
		</div>
		
	</div>
</div>
<?php $this->endContent(); ?>