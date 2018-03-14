<?php
/*
Auto Update for  Plugins and Themes V1.0 03/18
=======================

Version:    1.0  10.03.2018
Autor:      Hertste, Germany, stefan.programmiert@web.de
Website:    Http://www.pc.hertste.de
Copyright:  2018 Stefan H.

Für Bludit Version 2.X

Installiert automatisch alle aktuellen Plugins und Themes, die auf der Bludit Seite angeboten werden.

Fragen, Wünsche, Anregungen sind erwünscht
*/




class auto_update_for_plugin_and_themes extends Plugin {

	public function init()
	{
		// Fields and default values for the database of this plugin
		$this->dbFields = array(
		    'nullen'=>False,
		    'an_aus'=>False
		);
	}






	// Method called on the settings of the plugin on the admin area
	public function form()
	{
		global $Language;
		//$html = $Language->get('installation').'<br /><br />';  //nicht notwendig?!
		$html ='<label>Automatically installs all the latest plugins and themes offered on the Bludit site. Warning: This overwrite your plugins/themes when exists.</label><br />';
 
 
        // === Zählener an / aus
        if ($this->getValue('an_aus') == "1") { //eingeschaltet
           
           include("auto_update.php");
           
        } 

 
                   
        // === Ein- Ausschalten
		$html .= '<br /><div>';
		$html .= '<label>Automatically start</label><br>';
		$html .= '<label>If ON then the plugins and themes are updated automatically when you call this page.</label><br />';
		$html .= '<select name="an_aus" style="width:100px">';
		$html .= '<option value="true" '.($this->getValue('an_aus')===true?'selected':'').'>On</option>';
		$html .= '<option value="false" '.($this->getValue('an_aus')===false?'selected':'').'>Off</option>';
		$html .= '</select> ';
		$html .= '</div><br />';

        	


		return $html;
	}


   }

?>