<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>@todo Information about the current user and most recent documents etc. will go here</p>

<?php
	if (Yii::app()->user->isGuest){
?>

<p><?php echo CHtml::link('Login', array('/site/login'));?>/<?php echo CHtml::link('Register', array('/site/login'));?> to begin working with documents</p>

<?php
	}
	
?>

