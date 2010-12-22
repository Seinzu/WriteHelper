<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Please report any bugs or suggest features at <a href='http://redmine.writehelper.net'>our redmine</a>.  The source code etc. can be found at <a href='http://github.com/SeinZu/WriteHelper'>GitHub</a></p>

<?php
	if (Yii::app()->user->isGuest){
?>

<p><?php echo CHtml::link('Login', array('/site/login'));?>/<?php echo CHtml::link('Register', array('/site/login'));?> to begin working with documents</p>

<?php
	}
	
?>

