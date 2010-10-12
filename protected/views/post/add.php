<style type="text/css">
	.category_label{
		display:block;
	}
	.category_input{
		width:10px;			
		vertical-align:bottom;
	}
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-add-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo Yii::app()->user->id; ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url'); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textArea($model,'remarks'); ?>
		<?php echo $form->error($model,'remarks'); ?>
	</div>
	

	<?php 
		for($i=0;$i<sizeof($categories);$i++){
			$category=$categories[$i];
			//echo CHtml::label($category->name,$category->name);
			//echo CHtml::checkBox($category->id);
			echo <<<BLOCK
				<label class="category_label" for="$category->name">
					<input class="category_input" id="$category->id" type="checkbox" value="1" name="$category->id"/>
					$category->name
				</label>
BLOCK;
		}
	?>
<!--
	Click are calculated internally and not shown	
	<div class="row">
		<?php echo $form->labelEx($model,'clicks'); ?>
		<?php echo $form->textField($model,'clicks'); ?>
		<?php echo $form->error($model,'clicks'); ?>
	</div>
-->

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
