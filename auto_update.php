<?php
 //$url = 'https://github.com/Fred89/bludit-plugins/releases/download/pluginsFilter1.0/plugins-filter.zip'; //zum testen


  $plugin_seite = 'https://plugins.bludit.com/de/';
  $theme_seite  = 'https://themes.bludit.com/de/';
  $bludit_seite = 'https://www.bludit.com/de/';

  $plugin_counter = 0;
  $theme_counter  = 0;
  $bludit_counter = 0;





    function delete_directory($dirname)
    {   if(is_dir($dirname)) $dir_handle = opendir($dirname);

        //Falls Verzeichnis nicht geoeffnet werden kann, mit Fehlermeldung terminieren
        if(!$dir_handle)
        { echo "Verzeichnis nicht gfunden! ({$dirname})";
          return  false;
        }

        while($file=readdir($dir_handle))
        {  if($file!="." && $file!="..")
            {  if(!is_dir($dirname."/".$file))
                { //Datei loeschen
                  @unlink($dirname."/".$file);
                }
                else
                { //Falls es sich um ein Verzeichnis handelt, "delete_directory" aufrufen
                  delete_directory($dirname.'/'.$file);
                }
              }
        }

        closedir($dir_handle);
        //Verzeichnis loeschen
        rmdir($dirname);
        return  true;
    }




 function copyFolder($source, $dest, &$statsCopyFolder,
    $recursive = false)
{

    if (!is_dir($dest))
    {
        mkdir($dest);
  }

    $handle = @opendir($source);

    if(!$handle)
        return false;

    while ($file = @readdir ($handle))
    {
        if (preg_match("/^\.{1,2}$/",$file))
        {
            continue;
        }

        if(!$recursive && $source != $source.$file."/")
        {
            if(is_dir($source.$file))
                continue;
        }

        if(is_dir($source.$file))
        {
            copyFolder($source.$file."/", $dest.$file."/",
                $statsCopyFolder, $recursive);

        }
        else
        {
            copy($source.$file, $dest.$file);
            @$statsCopyFolder['files']++;
            @$statsCopyFolder['bytes'] += filesize($source.$file);
        }
    }

    @closedir($handle);
}




 function download($url, $datei_name) //Url, Speicher Dateiname

 {

 // ===== Zip von Github downloaden - begin
 // === Datei downloaden - begin
 $datei = $url;
if ((function_exists('curl_version')) )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        //CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
    );     // Achtung mit SSL

    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    //echo $header;    echo 'AAA';
}

else if (file_get_contents(__FILE__) && ini_get('allow_url_fopen'))
{
    if (strpos($datei, 'https') === true)
    {      //echo 'CCC';
        $arrContextOptions=array(
      "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );
 $content =  file_get_contents($datei, false, stream_context_create($arrContextOptions));
    }  else  {

    $content = file_get_contents($datei); }
    //echo 'BBB';
}
else
{
    echo 'Error: This plugin does not work because the server settings are too strict. There are neither cUrl nor allow_url_fopen enabled / installed.';
    //echo 'Sie haben weder cURL installiert, noch allow_url_fopen aktiviert. Bitte aktivieren/installieren allow_url_fopen oder Curl!';
}
// === Datei downloaden - begin



  // === Datei speichern - begin
  $dat = fopen($datei_name,'w+');
  $schreiben = fwrite($dat,$content);
  fclose($dat);
  
  if (!$dat) { echo 'Datei &ouml;ffnen fehlgeschlagen'; }
  if (!$schreiben) { echo 'Datei schreiben fehlgeschlagen'; }
  // === Datei speichern - end

// ===== Zip von Github downloaden - begin
  } // plugin download






 function zip_entpacken($datei_name,$entpacken_ort)  //entpackt zip   dateiname= lschen.zip
 {
     // ===== Zip entpacken - begin
     $zip = new ZipArchive;
     $res = $zip->open($datei_name);
     if ($res === TRUE) {
         $zip->extractTo($entpacken_ort); // wohin soll es entpackt werden
         $zip->close();
         //echo 'ok';
     } else {
         echo 'Error: Plugin Unzip is failed';
     }
     // ===== Zip entpacken - begin


     } // zip entpacken




  // ======== START - begin
  // ======== START - begin
          

  // ===== Plugins downloaden und installieren - begin
  // Erstmal Plugin Seite herunterladen
  download($plugin_seite, 'lschen.txt'); //Url, Speicher Dateiname
  echo 'aaa';
  
  // Dann Zip Links finden
  $daten = file_get_contents("lschen.txt");
  //preg_match_all("!<a .*?href=\"([^\"]*\.zip)\"[^>]*>(.*?)</a>!", $daten, $found );  // Altes Muster
  preg_match_all("!<a .*?href=\"([^\"]*\#download)\"[^>]*>(.*?)</a>!", $daten, $found );  

  for ($i = 0; $i < count($found[1]); $i++) {
     // Unterseiten downloaden - start
     //echo $i.') '.$found[1][$i] . '<br />';
     download($found[1][$i], 'lschen_unterseite.txt');
          
           // Unterseiten durchsuchen nach Zips
           $daten2 = file_get_contents("lschen_unterseite.txt"); 
           preg_match_all("!<a .*?href=\"([^\"]*\.zip)\"[^>]*>(.*?)</a>!", $daten2, $found2 );
           for ($ib = 0; $ib < count($found2[1]); $ib++) {
                //echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$ib.') '.$found2[1][$ib] . '<br />';
                if ($ib == 0) {  // Nur den ersten Treffer (Ist meister der neuere). Sonst gibt es evtl. Crash mit alten Versionen
                  download($found2[1][$ib], 'lschen.zip');
                  zip_entpacken('lschen.zip',PATH_PLUGINS);
                  $plugin_counter = $plugin_counter + 1;
                }
           }           
}
   @unlink('lschen.txt');
   @unlink('lschen.zip');
   @unlink('lschen_unterseite.txt');
  // ===== Plugins downloaden und installieren - end
  
             


// ===== Themes downloaden und installieren - begin
  // Erstmal Themes Seite herunterladen
  download($theme_seite, 'lschen.txt'); //Url, Speicher Dateiname

  // Dann Zip Links finden
  $daten = file_get_contents("lschen.txt");
  //preg_match_all("!<a .*?href=\"([^\"]*\.zip)\"[^>]*>(.*?)</a>!", $daten, $found );  // Altes Muster
  preg_match_all("!<a .*?href=\"([^\"]*\#download)\"[^>]*>(.*?)</a>!", $daten, $found );

  for ($i = 0; $i < count($found[1]); $i++) {
     // Unterseiten downloaden - start
     //echo $i.') '.$found[1][$i] . '<br />';
     download($found[1][$i], 'lschen_unterseite.txt');

           // Unterseiten durchsuchen nach Zips
           $daten2 = file_get_contents("lschen_unterseite.txt");
           preg_match_all("!<a .*?href=\"([^\"]*\.zip)\"[^>]*>(.*?)</a>!", $daten2, $found2 );
           for ($ib = 0; $ib < count($found2[1]); $ib++) {
                //echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$ib.') '.$found2[1][$ib] . '<br />';
                if ($ib == 0) {  // Nur den ersten Treffer (Ist meister der neuere). Sonst gibt es evtl. Crash mit alten Versionen                  
                  download($found2[1][$ib], 'lschen.zip');
                  zip_entpacken('lschen.zip',PATH_THEMES);
                  $theme_counter = $theme_counter+1;
                }
           }
}
   
   @unlink('lschen.txt');
   @unlink('lschen.zip');
   @unlink('lschen_unterseite.txt');
  // ===== Themes downloaden und installieren - end





// ===== Bludit downloaden und installieren - begin
  // Erstmal Bludit herunterladen
  download($bludit_seite, 'lschen.txt'); //Url, Speicher Dateiname

  // Dann Zip Links finden
  $daten = file_get_contents("lschen.txt");
  preg_match_all("!<a .*?href=\"([^\"]*\.zip)\"[^>]*>(.*?)</a>!", $daten, $found );


  if (!file_exists("lschen_bludit_new") )   mkdir("lschen_bludit_new"); //Verzeichnis erstellen, indem Bludit entpackt werden soll - temporär
  for ($i = 0; $i < count($found[1]); $i++) {     // dann downloaden und entpacken
     //echo $found[1][$i] . '<br />';
     download($found[1][$i], 'lschen.zip');
     zip_entpacken('lschen.zip',PATH_ROOT."lschen_bludit_new");
     $bludit_counter = $bludit_counter+1;
}
   @unlink('lschen.txt');
   @unlink('lschen.zip');


  copyFolder(PATH_ROOT."lschen_bludit_new/".basename($found[1][0],".zip")."/", PATH_ROOT."/", $statsCopyFolder, $recursive = true);   //Jetzt in den Hauptordner kopieren

  //Dann wieder temporären Ordner löschen
  delete_directory(PATH_ROOT."lschen_bludit_new");

  // ===== Bludit downloaden und installieren - end


  // ====== Meldungen - start
   if ($theme_counter == 0) { echo '<br />Theme Error: Themes konnten nicht eingelesen werden.';} else {echo '<br />Themes updated: '.$theme_counter;}
   if ($plugin_counter == 0) { echo '<br />Plugin Error: Plugins konnten nicht eingelesen werden.';} else {echo '<br />Plugin updated: '.$plugin_counter;}
   if ($bludit_counter == 0) { echo '<br />Bludit Update Error: Bludit konnte nicht eingelesen werden.';} else {echo '<br />Bludit updated.';}
  // ====== Meldungen - end


   echo '<br />Bludit, Plugins and themes have been updated. When you see Errors or any problems, please write in Bludit Forum. <br /><br />';
?>

