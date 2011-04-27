<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('userid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->userid), array('view', 'id'=>$data->userid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('openidurl')); ?>:</b>
	<?php echo CHtml::encode($data->openidurl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updatePref')); ?>:</b>
	<?php echo CHtml::encode($data->updatePref); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('blogshopowner')); ?>:</b>
	<?php echo CHtml::encode($data->blogshopowner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receiveEmail')); ?>:</b>
	<?php echo CHtml::encode($data->receiveEmail); ?>
	<br />


</div>