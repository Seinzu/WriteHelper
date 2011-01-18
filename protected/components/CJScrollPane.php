<?php

Yii::import('zii.widgets.jui.CJuiWidget');

class CJScrollPane extends CJuiWidget {
	
	public $url = '';
	
	public $id = '';
	
	public $text = '';
	
	public $items = array();
	
	public $options = array();
	
	public function run(){
		$id = !empty($this->id)? $this->id : $this->getId(true);
		
		$text = isset($this->options['text']) ? $this->options['text'] : '';
		$totalWidth = count($this->items) * 220;
		echo "<style>
	
	.scroll-pane { overflow: auto; width: 99%; float:left; }
	.scroll-content { width: {$totalWidth}px; float: left; }
	.scroll-content-item { width: 200px; height: 100px; float: left; margin: 10px; font-size: 3em; line-height: 96px; text-align: center; }
	* html .scroll-content-item { display: inline; } /* IE6 float double margin bug */
	.scroll-bar-wrap { clear: left; padding: 0 4px 0 2px; margin: 0 -1px -1px -1px; }
	.scroll-bar-wrap .ui-slider { background: none; border:0; height: 2em; margin: 0 auto;  }
	.scroll-bar-wrap .ui-handle-helper-parent { position: relative; width: 100%; height: 100%; margin: 0 auto; }
	.scroll-bar-wrap .ui-slider-handle { top:.2em; height: 1.5em; }
	.scroll-bar-wrap .ui-slider-handle .ui-icon { margin: -8px auto 0; position: relative; top: 50%; }
	</style>";
		echo "<div id={$id}>{$this->text}</div>";
		
		$options=empty($this->options) ? '' : CJavaScript::encode($this->options);
		echo "<div class='scroll-pane ui-widget ui-widget-header ui-corner-all'>";
		echo "<div class='scroll-content'>";
		if (!empty($this->items)){
			foreach ($this->items as $key=>$item){
				echo "<div class='scroll-content-item' id='{$key}'>{$item}</div>";
			}
		}
		echo "</div>"; // close .scroll-content
		echo "<div class='scroll-bar-wrap ui-widget-content ui-corner-bottom'>
				<div class='scroll-bar'></div>
			  </div>";
		echo "</div>"; // close .scroll-pane
		
		
	}
	
	/**
	 * Registers the core script files.
	 * This method overrides the parent implementation by registering the cookie plugin when cookie option is used.
	 */
	protected function registerCoreScripts(){
		parent::registerCoreScripts();
		$jscript = <<<EOF
		var scrollPane = $( ".scroll-pane" ),
			scrollContent = $( ".scroll-content" );
		var scrollbar = jQuery('.scroll-bar').slider({
			slide: function( event, ui ) {
				if ( scrollContent.width() > scrollPane.width() ) {
					scrollContent.css( "margin-left", Math.round(
						ui.value / 100 * ( scrollPane.width() - scrollContent.width() )
					) + "px" );
				} else {
					scrollContent.css( "margin-left", 0 );
				}
			}
		});
EOF;

		Yii::app()->getClientScript()->registerScript(__CLASS__ . '#' . $this->id, $jscript);
	}
	
}