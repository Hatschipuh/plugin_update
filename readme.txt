Auto Update for  Plugins and Themes V1.0 03/18
=======================

BETA

Version:    1.0  10.03.2018
Autor:      Hertste, Germany, stefan.programmiert@web.de
Website:    Http://www.pc.hertste.de
Copyright:  2018 Stefan H.

F�r Bludit Version 2.X

Installiert automatisch alle aktuellen Plugins und Themes, die auf der Bludit Seite angeboten werden.

Fragen, W�nsche, Anregungen sind erw�nscht


-----------------------------------------
Automatical English Translate see down!
-----------------------------------------

Warnungen und Hinwei�e
----------------------
Dieses Plugin aktualisiert und installiert alle Plugins und Themes von der Bludit Seite in Ihre Installation automatisch. Dabei �berschreibt es evtl. ihr vorhandes Plugin und kann zu Datenverlusten f�hren. 

Bitte machen Sie unbedingt ein Backup bevor Sie dieses Plugin starten! 


Was tun bei Fatal Fehlermeldungen?
-----------------------------------
Wenn nach einem Update eine Fehlermeldung erscheint z. B.

Fatal error: Cannot declare class PluginLogoAndFooter, because the name is already in use in .../bl-plugins/logoandfooter-master/plugin.php on line 183

dann gibt es dieses Plugin genau zweimal. Das hei�t, eines muss gel�scht werden - in diesem Beispiel der Ordner: bl-plugins/logoandfooter (Das ist auch meist der �ltere Ordner!). In der Regel sind Verzeichnisse mit dem Wort "-master" direkt von der Bludit Seite (bzw. von Github). W�hrend das andere Verzeichnis vermutlich aus einer manuellen Installation kommt. Optimalerwei�e bleibt das "...-master Verzeichnis" erhalten, dann wird es zukunftig automatisch aktualisiert ohne Fehlermeldung.

Eine weitere L�sungsm�glichkeit ist, die plugin.php des Plugins manuel zu bearbeiten, und den Classennamen zu �ndern, dann k�nnen beide Varianten zeitgleich verwendet werden. 








Warnings and hints
----------------------
This plugin automatically updates and installs all plugins and themes from the Bludit page into your installation. It may overwrite your existing plugin and may lead to data loss.

Please make a backup before you start this plugin!


What to do with Fatal error messages?
-----------------------------------
If after an update an error message appears z. B.

Fatal error: Can not declare class PluginLogoAndFooter, because the name is already in use in ... / bl-plugins / logoandfooter-master / plugin.php on line 183

then there is this plugin exactly twice. That is, one must be deleted - in this example, the folder: bl-plugins / logoandfooter (This is usually the older folder!). As a rule, directories with the word "-master" are directly from the Bludit page (or from Github). While the other directory probably comes from a manual installation. Optimally, the "... master directory" is retained, then it will automatically be updated in the future without an error message.

Another solution is to edit the plugin.php of the plugin manually, and to change the class name, then both variants can be used at the same time.
