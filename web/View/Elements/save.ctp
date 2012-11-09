<?php
	echo $this->Form->end(__('Submit'));
	echo $this->Html->link(__("Cancel"), array('controller'=>$controller, 'action' => $action, $params));
?>