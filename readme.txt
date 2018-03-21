Auto Update for Bludit, Plugins and Themes V1.1 03/18
=======================

BETA

Version:    1.1  21.03.2018
Autor:      Hertste, Germany, stefan.programmiert@web.de
Website:    Http://www.pc.hertste.de
Copyright:  2018 Stefan H.

Für Bludit Version 2.X

Installiert automatisch alle aktuellen Bludit Version, Plugins und Themes, die auf der Bludit Seite angeboten werden.

Fragen, Wünsche, Anregungen sind erwünscht




-----------------------------------------
Automatical English Translate see down!
-----------------------------------------

History
-------
Version
1.0         10.03.2018
1.1         21.03.2018   automatisches Updates für Bludit selbst hinzugefügt



ToDo / Geplant
--------------
- Spezifische Auswahl der Updates Bludit/Themes/Plugins
- Möglichkeit automatischer Updates in bestimmten Abständen
- Evtl. Prüfung von mehrfachplugins um Fehlermeldungen zu vermeiden
- Sprachübersetzungen
- Updatemöglichkeiten auch für andere Seiten, außerhalb der Bludit Hauptseite




Warnungen und Hinweiße
----------------------
Dieses Plugin aktualisiert und installiert alle Plugins und Themes von der Bludit Seite in Ihre Installation automatisch. Dabei überschreibt es evtl. ihr vorhandes Plugin und kann zu Datenverlusten führen.

Bitte machen Sie unbedingt ein Backup bevor Sie dieses Plugin starten!


Was tun bei Fatal Fehlermeldungen?
-----------------------------------
Wenn nach einem Update eine Fehlermeldung erscheint z. B.

Fatal error: Cannot declare class PluginLogoAndFooter, because the name is already in use in .../bl-plugins/logoandfooter-master/plugin.php on line 183

dann gibt es dieses Plugin genau zweimal. Das heißt, eines muss gelöscht werden - in diesem Beispiel der Ordner: bl-plugins/logoandfooter (Das ist auch meist der ältere Ordner!). In der Regel sind Verzeichnisse mit dem Wort "-master" direkt von der Bludit Seite (bzw. von Github). Während das andere Verzeichnis vermutlich aus einer manuellen Installation kommt. Optimalerweiße bleibt das "...-master Verzeichnis" erhalten, dann wird es zukunftig automatisch aktualisiert ohne Fehlermeldung.

Eine weitere Lösungsmöglichkeit ist, die plugin.php des Plugins manuel zu bearbeiten, und den Classennamen zu ändern, dann können beide Varianten zeitgleich verwendet werden.








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
