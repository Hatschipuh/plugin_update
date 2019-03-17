<?php
/*
Auto Update for  Plugins and Themes V1.0 03/18
=======================

Version:    2.0  10.03.2019
Autor:      Hertste, Germany, stefan.programmiert@web.de
Website:    Http://www.pc.hertste.de
Copyright:  2019 Stefan H.

Für Bludit Version 2.X and Version 3.X

Installiert automatisch alle aktuellen Plugins und Themes, die auf der Bludit Seite angeboten werden.

Fragen, Wünsche, Anregungen sind erwünscht
*/




class auto_update_for_plugin_and_themes2 extends Plugin {

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
		$html ='<label>Automatically installs all the latest Bludit Version, plugins and themes offered on the Bludit site. Warning: This overwrite your bludit directory, plugins directory and themes directory when exists.</label><br />';

        // === Ein- Ausschalten
		$html .= '<br /><div>';
		$html .= '<label>Automatically start</label><br>';
		$html .= '<label>If ON then the Bludit, plugins and themes are updated automatically when you call this page.</label><br />';
		$html .= '<select name="an_aus" style="width:100px">';
		$html .= '<option value="true" '.($this->getValue('an_aus')===true?'selected':'').'>On</option>';
		$html .= '<option value="false" '.($this->getValue('an_aus')===false?'selected':'').'>Off</option>';
		$html .= '</select> ';
		$html .= '</div><br />';
		
		
        // === Zählener an / aus
        if ($this->getValue('an_aus') == "1") { //eingeschaltet

        $html .= 'aaa';
           include("auto_update.php");
                     $html .= 'bbb';
        }







        
		return $html;
	}


   }

?>