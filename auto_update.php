<?php


 //$url = 'https://github.com/Fred89/bludit-plugins/releases/download/pluginsFilter1.0/plugins-filter.zip'; //zum testen
 
 
  $plugin_seite = 'https://plugins.bludit.com/de/';
  $theme_seite  = 'https://themes.bludit.com/de/';
 
 
 
 
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
  fwrite($dat,$content);
  fclose($dat);
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
  
  // Dann Zip Links finden   
  $daten = file_get_contents("lschen.txt");
  preg_match_all("!<a .*?href=\"([^\"]*\.zip)\"[^>]*>(.*?)</a>!", $daten, $found );
  
  for ($i = 1; $i < count($found[1]); $i++) {
     //echo $found[1][$i] . '<br />';
     download($found[1][$i], 'lschen.zip');
     zip_entpacken('lschen.zip',PATH_PLUGINS);
}     
   @unlink('lschen.txt');
   @unlink('lschen.zip');  
  // ===== Plugins downloaden und installieren - end   
 
 
  
// ===== Themes downloaden und installieren - begin
  // Erstmal Plugin Seite herunterladen
  download($theme_seite, 'lschen.txt'); //Url, Speicher Dateiname

  // Dann Zip Links finden
  $daten = file_get_contents("lschen.txt");
  preg_match_all("!<a .*?href=\"([^\"]*\.zip)\"[^>]*>(.*?)</a>!", $daten, $found );

  for ($i = 1; $i < count($found[1]); $i++) {
     //echo $found[1][$i] . '<br />';
     download($found[1][$i], 'lschen.zip');
     zip_entpacken('lschen.zip',PATH_THEMES);
}
   @unlink('lschen.txt');
   @unlink('lschen.zip');
  // ===== Themes downloaden und installieren - end  
     
   echo '<br />Plugin and themes have been updated. When you see Errors, please write in Bludit Forum. <br /><br />';  
?>



