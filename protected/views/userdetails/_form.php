<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'userdetails-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
<!--
	<div class="row">
		<?php echo $form->labelEx($model,'openidurl'); ?>
		<?php echo $form->textField($model,'openidurl',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'openidurl'); ?>
	</div>
-->
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updatePref'); ?>
		<?php echo $form->checkBox($model,'updatePref'); ?>
		<?php echo $form->error($model,'updatePref'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'blogshopowner'); ?>
		<?php echo $form->checkBox($model,'blogshopowner'); ?>
		<?php echo $form->error($model,'blogshopowner'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'receiveEmail'); ?>
		<?php echo $form->checkBox($model,'receiveEmail'); ?>
		<?php echo $form->error($model,'receiveEmail'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
