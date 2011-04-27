<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'userid'); ?>
		<?php echo $form->textField($model,'userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'openidurl'); ?>
		<?php echo $form->textField($model,'openidurl',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updatePref'); ?>
		<?php echo $form->textField($model,'updatePref'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'blogshopowner'); ?>
		<?php echo $form->textField($model,'blogshopowner'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receiveEmail'); ?>
		<?php echo $form->textField($model,'receiveEmail'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->