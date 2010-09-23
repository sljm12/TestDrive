<div class="form">
<?php echo CHtml::beginForm(); ?>
 
    <div class="row">
        <?php echo CHtml::label('Identifier:', 'openid_identifier'); ?>
        <?php echo CHtml::textField('openid_identifier', '', array('size'=>40)); ?>
        <p class="hint">
            Hint: You may login with <tt>https://www.google.com/accounts/o8/id</tt>.
        </p>
    </div>
 
    <div class="row buttons">
        <?php echo CHtml::submitButton('Login'); ?>
    </div>
 
<?php echo CHtml::endForm(); ?>
</div><!-- form -->