<?php

##############################################################################################################################
#
# Version: 	3.0.0
# Datum: 	07.01.2018
# veröffentlicht in: http://plugins.loxberry.de/
# 
# Change History:
# ----------------------------------------------------------------------------------------------------------------------------
# 1.0.0		Initiales Release des Plugin (Stable Version)
# 1.0.1		[Feature] Online Provider Amazon Polly hinzugefügt
# 			[Feature] Offline Engine Pico2Wave hinzugefügt
#			[Bugfix] ivona_tts.php: Großschreibung der Endung .MP3 in .mp3 geändert. Problem trat außer bei PLAY:3 und PLAY:5 bei allen anderen Modellen auf
#			[Bugfix] MP3path in der Config auf Kleinschreibung korrigiert (wird per Installationsscript korrigiert)
#					 Beim Abspielen von gespeicherten MP3 Files gabe es Probleme dass das angegebene File nicht gefunden wurde.
# 			[Feature] Online Provider responsiveVoice hinzugefügt
#			[Feature] Für Non-LoxBerry User besteht nun die Möglichkeit in ihrer Config die pws: für Wunderground anzugeben
# 1.0.2		[Bugfix] Fehlernachricht an Loxone und Zurücksetzen des Fehlers korrigiert. Funktion war nicht aktiv.
#			[Bugfix] UDP-Port für Inbound Daten korrigiert. Skript nimmt jetzt UDP-Port aus der Plugin Config statt der MS Config.
# 1.0.3     [Bugfix] Support für XAMPP Windows hinzugefügt
#			[Feature] Online Provider Google hinzugefügt
#			[Bugfix] Korrektur bei Einzel T2S aus Gruppe heraus
# 1.0.4		[New] Datei grouping.php hinzugefügt
#			[New] Datei helper.php hinzugefügt
#			[New] Datei text2speech.php hinzugefügt
#			[Bugfix] Support für Stereopaar hinzugefügt
#			[Feature] Neue Funktion createstereopair die aus zwei gleichen Modellen ein Stereopaar erstellt. Die zone=<DEINE ZONE> 
#					  ist dann der Raumname des neuen Paares
#			[Feature] Neue Funktion seperatestereopair die ein bestehendes Stereopaar wieder trennt
#			[Feature] delcoord --> Subfunction für Gruppenmanagement (RinconID von Member)
# 1.0.5		[Feature] playmode ist in case insensitive nutzbar
#			[Bugfix] Funktion Softstop überarbeitet. Es wird solange gespielt bis die Lautstärke 0 ist, dann Pause betätigt
#					 und die Lautstärke wieder auf den Wert vor Softstop angehoben.
# 1.0.6		[Bugfix] network.php geändert - Fehler beim Scannen der Zonen bei Neuinstallation korrigiert
# 2.0.0		[Feature] Parameter rampto für Radiosender hinzugefügt
#			[Feature] Neuer Text Eingangsparameter für Lox Daten Übertragung hinzugefügt (Radio=1 oder Playlist=2)
#					  Neuer UDP Parameter für Lox Daten Übertragung hinzugefügt (Single Zone=1, Master=3 oder Member=3)
#			[Bugfix] addmember/removemember gefixt um mehr als eine Zone zum Master hinzuzufügen
#			[Bugfix] Fehlermeldung an Loxone Text Eingangsverbinder falls ein Fehler im Sonos Plugin auftrat
#			[Bugfix] Die Eingangsverbindung zu Loxone wurde optimiert, es wird nur noch MINISERVER1 mit lokaler IP unterstützt.
#			[Feature] zusätzliche Parameter radio&radio=SENDER und playlist&playlist=NAME DER PLAYLISTE (gilt für Zone als auch für Gruppe)
#			[Feature] vereinfachte T2S Durchsage mit parameter 'say'. Es gibt keine Differenzierung mehr zwischen Gruppen- oder Einzel-
#			          durchsage. (Details siehe Wiki)
#			[Feature] Multilinguale Sprachansagen für alle Engines hinzugefügt (Details siehe Wiki).
#					  AWS Polly SDK nicht mehr notwendig
#			[Bugfix] Komplette Überarbeitung der Gruppenfunktionen bzw. Gruppendurchsagen
# 2.0.1		[Bugfix] nextradio optimiert um Änderungen von Sonos zu korrigieren (siehe Wiki)
#			[Bugfix] Korrektur der Lautstärke bei Gruppendurchsage
#			[Bugfix] Sonos Ansage optimiert: Bei Playliste Titel und Interpret Ansage, bei Radio Sender Ansage
#			[Feature] Pollenflug Ansage (Quelle: Deutscher Wetterdienst)
#			[Feature] Wetterhinweis bzw. Wetterwarnung Ansage (Quelle: Deutscher Wetterdienst)
# 			[Bugfix] T2S Engine Ivona entfernt da Service zum 30.06.2017 eingestellt wird.
# 2.0.2		[Bugfix] Pollen und Wetterwarnung Ansage korrigiert. Es werden jetzt jeweils Ansagen getätigt.
# 2.0.3		[Bugfix] Es wird nur angesagt falls eine Wetterwarnung vorliegt.
#			[Bugfix] Umlaute bei Nutzung von VoiceRSS korrigiert
# 			[Feature] Auswahlmöglichkeit des Miniservers für die Schnittstelle zu Loxone in der Config einstellbar
#			[Bugfix] Datenübertragung bei Standardbefehlen optimiert
#			[Bugfix] Gruppenmanagement optmiert
#			[Feature] Möglichkeit der gleichzeitigen Gruppierung bei der Auswahl von Radio bzw. Playlisten
# 2.0.4		[Bugfix] Broadcast IP beim Scannen hinzugefügt
#			[Bugfix] Sortierfunktion der Zonen korrigiert	
# 2.0.5		[Feature] Möglichkeit zum Abspielen von T2S im batch modus (siehe Wiki)
#			[Bugfix] Fehler Meldungen auf der Config Seite gefixt
#			[Bugfix] Sortierfunktion der Zonen wieder entfernt, Config konnte nicht gespeichert werden.	
# 2.0.6		[Bugfix] Fehler bei Play() korrigiert
#			[Bugfix] Fehler bei Zonen Scan in Verbindung mit Stereopaaren behoben
# 2.0.7		[Bugfix] Fehler bei Wetterwarnungen und Orten die Umlaute enthalten korrigiert
#			[Feature] Neue Funktion alarmoff um alle Sonos Alarme/Wecker auszuschalten
#			[Feature] Neue Funktion alarmon um alle Sonos Alarme/Wecker wieder gemäß Ursprungszustand wieder einzuschalten
# 2.0.8		[Bugfix] Korrektur Wetterwarnung bei Gruppendurchsage bzw. Stadt/Gemeinde mit Sonderzeichen
#			[Feature] Time-to-destination-speech --> Ansage der ca. Fahrzeit von Standort zu einem Ziel (Google Maps)
#			[Feature] Klickfunktion zapzone um sich durch die Sonos Komponenten zu zappen, falls aktuell keine Zone
#					  spielt wird weiter durch die Radio Favoriten gezappt.
#			[Feature] Fehler Mitteilung an MS nur noch wenn Sonos FEHLER auftrat (keine WARNUNG und keine INFO mehr)
#			[Bugfix] Rückbau des Broadcast Scans bei Ersteinrichtung, Protokollierung hinzugefügt.
#			[Feature] Ansage des Radiosenders bei nextradio oder zapzone (siehe Wiki)
# 2.0.9		[Bugfix] Re-Gruppierung nach Einzelansage korrigiert
#			[Feature] Neues Addon zur Ansage eines Abfallkalenders.
#			[Feature] Neue Funktion (aus der Kategorie Spaß) say&witz = gibt einen Zufallswitz aus
#			[Feature] Neue Funktion (aus der Kategorie Spaß) say&bauernregel = gibt die Bauernregel für den jeweiligen Tag aus
# 2.1.0		[Feature] Prüfung auf gültige LoxBerry Version hinzugefügt
#			[Feature] Prüfung auf korrekt beendete Plugin Installation hinzugefügt
#			[Feature] Auswahl des LineIn Einganges bei PLAY:5, CONNECT und CONNECT:AMP wird unterstützt.
#			[Feature] Angabe des Parameters standardvolume bei Gruppenauswahl für Playlist oder Radiosender wird jetzt unterstützt.
#					  Es werden je Zone in der Gruppe die in der Config hinterlegten Sonos Volumen Einstellungen übernommen.
#			[Feature] Bei der Abfallkalender Durchsage werden jetzt auch 2 Termine an einem Tag berücksichtigt
#			[Bugfix] Optimierung der Wiederherstellung von Zonen Status nach erfolgter Einzeldurchsage wobei sich die Zone vorher in einer Gruppe befand
#			[Feature] Unterstützung beim Scan für Sonos PLAYBASE und PLAY:1 mit Alexa wurde hinzugefügt.
#			[Feature] Das Error LogFile ist über die LoxBerry Sonos Konfiguration errreichbar
#			[Bugfix] Optimierung der Zonen Scan Funktion um Doppelscans zu verhindern
#			[Bugfix] Beim Modell CONNECT kann die Lautstärke variabel oder festeingestellt sein, was eine T2S Ansage verhindert
#					 Während einer T2S wird die Lautstärke temporär auf variabel gesetzt, dann wieder auf festeingestellt.
#			[Bugfix] Bei Gruppennachrichten konnte der Parameter volume genutzt werden, wurde jetzt ersetzt durch groupvolume
#			[Bugfix] Problem bei T2S auf PLAYBAR wenn diese im TV Modus ist behoben
# 2.1.1		[Feature] Alle Dateien im "mp3" Verzeichnis werden vom Script jetzt automatisch auf Rechte 0644 gesetzt
#			[Bugfix] Problem bei T2S auf PLAYBAR wenn diese im TV Modus ist behoben
#			[Bugfix] Bei der Ansage des Müllkalenders wurde u.U. nichts angesagt wenn der erste vom CALDav Plugin ausgegebene Termin -1 ist.
#		 	[Feature] Bei Befehlen an eine Zone welche Member einer Gruppe ist wird jetzt automatisch der Master ermittelt
#					  dies gilt aber nur für folgende Befehle: play, stop, pause, next, previous, toggle, rewind, seek
#			[Feature] bei ...messageid=..." können jetzt auch nicht numerische MP3 files (z.B. mein_sonos_gong) genutzt werden.
# 2.1.2		[Feature] Debugging tool added
#			[Bugfix] Korrektur beim Laden einer Playliste wenn vorher Radio/TV lief oder Mute EIN war
#			[Bugfix] Korrektur der Lautstärkeregelung/Anpassung bei Gruppendurchsagen
#			[Bugfix] Scan Zonen Funktion von LoxBerry auch für Non-LoxBerry Versionen aktualisiert und beide optimiert (Trennung von Gruppen vorm 
#					 Speichern der Config)
#			[Bugfix] Englische Version der GUI aktualisiert
# 2.1.3		[Feature] Möglichkeit des Abspielens von Spotify, Amazon, Napster und Apple Playlisten/Alben (Details siehe Wiki)
#			[Feature] Möglichkeit des Abspielens von lokalen Track's (NAS, USB-Sticks, Laufwerken, Remote PCs) -> Details siehe Wiki
#			[Feature] Prüfung bei Gruppenfunktionen ob die angesprochene Zone (zone=...) auch der Master ist, falls nicht ermitelt das System den Master
#			[Bugfix] Korrektur bei T2S wenn Playliste im Shufflemodus läuft
#			[Feature] Funktion 'nextpush'. PL läuft -> next track, Ende PL -> 1st track, Radio -> nextradio im Loop, leer -> nextradio im Loop
#			[Feature] Funktion 'next' und 'previous' optimiert. next - (letzter Track -> Track #1), 'previous - (erster Track -> letzter Track)
# 2.1.4		[Bugfix] Funktion 'radio' (radioplaylist, groupradioplaylist) korrigiert. Bei input quelle SPDIF (Playbar, Playbase) 
#					 wurde kein Radiosender geladen.
#			[Bugfix] Korrektur der Zonen Scan Funktion (temporäre Datei wird nicht mehr gelöscht)
#			[Bugfix] Korrektur der Zonen Scan Funktion nach Update Sonos auf 8.1
#			[Bugfix] Korrektur bei Einzel T2S an Master einer Gruppe. Nach Durchsage wurde Urprungszustand nicht mehr wiederhergestellt
#			[Bugfix] Erweiterung der TransportSettings (shuffle, repeat, etc.)
# 2.1.5		[Bugfix] Korrektur der Zonen Scanfunktion für Nicht LoxBerry Nutzer
#			[Feature] Neue Funktion zum Laden und Abspielen von Sonos Playlisten per Zufallsgenerator. Es könne auch Exceptions angegeben werden (siehe Wiki)
#			[Feature] Neue Funktion zum Laden und Abspielen von Sonos Radiosender per Zufallsgenerator. Es könne auch Exceptions angegeben werden (siehe Wiki)
#			[Feature] Aktualisierte Funktion um user-spezifische Playlisten zu laden (gilt nur für Spotify)
# 2.1.6		[Bugfix] Fehler bei Non LoxBerry beseitigt, es wurde versucht eine LoxBerry Berechtigung zu setzen
#			[Bugfix] SHUFFLE Wiedergabe wird jetzt nach erfolgter T2S korrekt weitergespielt
# 2.1.7		Allgemeine Struktur überarbeitet und LoxBeryy 0.3.x Konpatibilität hergestellt
#			Unterstützung für Non-LoxBerry User entfernt
#			[Bugfix] Stabilere Scan Funktion nach Sonos Playern
#			[Feature] Vicki als Stimme für Polly hinzugefügt	
#			[Feature] Funktion batch optmiert um numerische, gespeicherte MP3 files aus dem tts/mp3 Verzeichnis zu inkludieren
# 3.0.0
#
#
######## Script Code (ab hier bitte nichts ändern) ###################################

ini_set('max_execution_time', 120); 							// Max. Skriptlaufzeit auf 120 Sekunden

include("system/PHPSonos.php");
include("system/Tracks.php");
include("system/Loxone.php");
include("Grouping.php");
include("Helper.php");
include("Alarm.php");
include("Playlist.php");
include("Queue.php");
include("Info.php");
include("Play_T2S.php");
include("Radio.php");
include("Restore_T2S.php");
include("Save_T2S.php");
include("Speaker.php");
#require_once('system/function.debug.php');
include('system/debug.php');

// setze korrekte Zeitzone
date_default_timezone_set(date("e"));
echo "<PRE>"; 

# prepare variables
$home = $lbhomedir;
$hostname = gethostname();									// hostname LoxBerry
$myIP = $_SERVER["SERVER_ADDR"];								// get IP of LoxBerry
$syntax = $_SERVER['REQUEST_URI'];								// get syntax
$psubfolder = $lbpplugindir;									// get pluginfolder
$lbversion = LBSystem::lbversion();								// get LoxBerry Version
$path = LBSCONFIGDIR; 											// get path to general.cfg
$myFolder = "$lbpconfigdir";									// get config folder
$myMessagepath = "//$myIP/sonos_tts/";							// get T2S folder to play
#$myMessagepath = "//$hostname/loxberry/data/plugins/tts";		// get T2S folder to play
$MessageStorepath = "$lbpdatadir/tts/";							// get T2S folder to store
$pathlanguagefile = "$lbphtmldir/voice_engines/langfiles/";		// get languagefiles
$logpath = "$lbplogdir/$psubfolder";							// get log folder
$templatepath = "$lbptemplatedir";								// get templatedir
$t2s_text_stand = "t2s-text_en.ini";							// T2S text Standardfile

 
# create entry in logfile of called syntax
LOGGING("called syntax: ".$myIP."".$syntax,5);


#-- Start Preparation ------------------------------------------------------------------
	
	// Parsen der Konfigurationsdatei sonos.cfg
	if (!file_exists($myFolder.'/sonos.cfg')) {
		LOGGING('The file sonos.cfg could not be opened, please try again!', 4);
	} else {
		$tmpsonos = parse_ini_file($myFolder.'/sonos.cfg', TRUE);
	}
	// Parsen der Sonos Zonen Konfigurationsdatei player.cfg
	if (!file_exists($myFolder.'/player.cfg')) {
		LOGGING('The file player.cfg  could not be opened, please try again!', 4);
	} else {
		$tmpplayer = parse_ini_file($myFolder.'/player.cfg', true);
	}
	$player = ($tmpplayer['SONOSZONEN']);
	foreach ($player as $zonen => $key) {
		$sonosnet[$zonen] = explode(',', $key[0]);
	} 
	$sonoszonen['sonoszonen'] = $sonosnet;
	// finale config für das Script
	$config = array_merge($sonoszonen, $tmpsonos);
		
	// Umbennennen des ursprünglichen Array Keys
	$config['SYSTEM']['messageStorePath'] = $MessageStorepath;

	// Übernahme und Deklaration von Variablen aus der Konfiguration
	$sonoszonen = $config['sonoszonen'];

	// prüft den Onlinestatus jeder Zone
	foreach($sonoszonen as $zonen => $ip) {
		$port = 1400;
		$timeout = 3;
		$handle = @stream_socket_client("$ip[0]:$port", $errno, $errstr, $timeout);
		if($handle) {
			$sonoszone[$zonen] = $ip;
			fclose($handle);
		}
	}
	$sonoszone;
	
#$sonoszone = $sonoszonen;
#print_r($sonoszone);
#print_r($config);
#exit;


# select langauge file for text-to-speech
$t2s_langfile = "t2s-text_".substr($config['TTS']['messageLang'],0,2).".ini";				// language file for text-speech

# checking size of LoxBerry logfile
check_size_logfile();

#-- End Preparation ---------------------------------------------------------------------


#-- Start allgemeiner Teil ----------------------------------------------------------------------

$valid_playmodes = array("NORMAL","REPEAT_ALL","REPEAT_ONE","SHUFFLE_NOREPEAT","SHUFFLE","SHUFFLE_REPEAT_ONE");

# Start des eigentlichen Srcipts
if(isset($_GET['volume']) && is_numeric($_GET['volume']) && $_GET['volume'] >= 0 && $_GET['volume'] <= 100) {
	$volume = $_GET['volume'];
	$master = $_GET['zone'];
	// prüft auf Max. Lautstärke und korrigiert diese ggf.
	if($volume >= $config['sonoszonen'][$master][5]) {
		$volume = $config['sonoszonen'][$master][5];
	} else {
		$volume = $_GET['volume'];
	}
} else {
	$master = $_GET['zone'];
	$sonos = new PHPSonos($sonoszonen[$master][0]);
	$tmp_vol = $sonos->GetVolume();
	if ($tmp_vol >= $config['sonoszonen'][$master][5]) {
		$volume = $config['sonoszonen'][$master][5];
	}
	$volume = $config['sonoszonen'][$master][4];
}

if(isset($_GET['playmode'])) { 
	$playmode = preg_replace("/[^a-zA-Z0-9_]+/", "", strtoupper($_GET['playmode']));
	if (in_array($playmode, $valid_playmodes)) {
		$sonos = new PHPSonos($sonoszone[$master][0]);
		$sonos->SetQueue("x-rincon-queue:".$sonoszone[$master][1]."#0");
		$sonos->SetPlayMode($playmode);
	}  else {
		LOGGING('incorrect PlayMode selected. Please correct!', 4);
	}
}    

if(isset($_GET['rampto'])) {
		switch($_GET['rampto'])	{
			case 'sleep';
				$config['TTS']['rampto'] = "SLEEP_TIMER_RAMP_TYPE";
				break;
			case 'alarm';
				$config['TTS']['rampto'] = "ALARM_RAMP_TYPE";
				break;
			case 'auto';
				$config['TTS']['rampto'] = "AUTOPLAY_RAMP_TYPE";
				break;
		}
	} else {
		switch($config['TTS']['rampto']) {
			case 'sleep';
				$config['TTS']['rampto'] = "SLEEP_TIMER_RAMP_TYPE";
				break;
			case 'alarm';
				$config['TTS']['rampto'] = "ALARM_RAMP_TYPE";
				break;
			case 'auto';
				$config['TTS']['rampto'] = "AUTOPLAY_RAMP_TYPE";
				break;
		}
	}

if(array_key_exists($_GET['zone'], $sonoszone)){ 
	$master = $_GET['zone'];
	$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
	switch($_GET['action'])	{
		case 'play';
			$posinfo = $sonos->GetPositionInfo();
			if(!empty($posinfo['TrackURI'])) {
				if($sonos->GetVolume() <= $config['TTS']['volrampto']) {
					$sonos->RampToVolume($config['TTS']['rampto'], $volume);
					if($config['LOXONE']['LoxDaten'] == 1) {
						sendUDPdata();
					}
					checkifmaster($master);
					$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
					$sonos->Play();
				} else {
					if($config['LOXONE']['LoxDaten'] == 1) {
						sendUDPdata();
					}
					checkifmaster($master);
					$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
					$sonos->Play();
				}
			} else {
				LOGGING("No tracks in play list to play.", 4);
			}
		break;
		
		
		case 'pause';
			checkifmaster($master);
			$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
			$sonos->Pause();
		break;
		
				
		case 'next';
			$titelgesammt = $sonos->GetPositionInfo();
			$titelaktuel = $titelgesammt["Track"];
			$playlistgesammt = count($sonos->GetCurrentPlaylist());
			if (($titelaktuel < $playlistgesammt) or (substr($titelgesammt["TrackURI"], 0, 9) == "x-rincon:")) {
				checkifmaster($master);
				$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
				$sonos->Next();
			} else {
				checkifmaster($master);
				$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
				$sonos->SetTrack("1");
			}
		break;
		
		
		case 'previous';
			$titelgesammt = $sonos->GetPositionInfo();
			$titelaktuel = $titelgesammt["Track"];
			$playlistgesammt = count($sonos->GetCurrentPlaylist());
			if ($titelaktuel <> '1') {
				checkifmaster($master);
				$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
				$sonos->Previous();
			} else {
				checkifmaster($master);
				$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
				$sonos->SetTrack("$playlistgesammt");
			}
		break; 
		
			
		case 'rewind':
				checkifmaster($master);
				$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
				$sonos->Rewind();
		break;
		
		
		case 'mute';
			if($_GET['mute'] == 'false') {
				$sonos->SetMute(false);
			}
			else if($_GET['mute'] == 'true') {
				$sonos->SetMute(true);
			} else {
				LOGGING('Wrong Mute Parameter selected. Please correct', 4);
			}       
		break;
		
		
		case 'telefonmute';
			if($_GET['mute'] == 'false') {
				 $MuteStat = $sonos->GetMute();
				 if($MuteStat == 'true') {
					$SaveVol = $sonos->GetVolume();
					$sonos->SetVolume(5);
					$sonos->SetMute(false);
					$sonos->RampToVolume("ALARM_RAMP_TYPE", $SaveVol);
				}
			}
			else if($_GET['mute'] == 'true') {
				 $sonos->SetMute(true);
				 $SaveVol = $sonos->GetVolume();
				 $sonos->SetVolume($SaveVol);
			}
		break;
		
		
		case 'stop';
			checkifmaster($master);
			$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
			$sonos->Stop();
		break; 
		
			
		case 'stopall';
			foreach ($sonoszonen as $zone => $player) {
				$sonos = new PHPSonos($sonoszonen[$zone][0]);
				$sonos->Stop();
			}	
		break; 
		

		case 'softstop':
			$save_vol_stop = $sonos->GetVolume();
			$sonos->RampToVolume("SLEEP_TIMER_RAMP_TYPE", "0");
			while ($sonos->GetVolume() > 0) {
				sleep('1');
			}
			checkifmaster($master);
			$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
			$sonos->Stop();
			$sonos->SetVolume($save_vol_stop);
		break; 
		
		  
		case 'toggle':
			if($sonos->GetTransportInfo() == 1)  {
				checkifmaster($master);
				$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
				$sonos->Stop();
			} else {
				checkifmaster($master);
				$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
				$sonos->Play();
			}
		break; 
		
					
		case 'playmode';
			// see valid_playmodes under Configuratio section for a list of valid modes
			if (in_array($playmode, $valid_playmodes)) {
				$sonos->SetPlayMode($playmode);
			} else {
				LOGGING('Wrong PlayMode Parameter selected. Please correct', 4);
			}    
		break; 
		
	  
		case 'crossfade':
			if((is_numeric($_GET['crossfade'])) && ($_GET['crossfade'] == 0) || ($_GET['crossfade'] == 1)) { 
				$crossfade = $_GET['crossfade'];
			} else {
				LOGGING("Wrong Crossfade entered -> 0 = off / 1 = on", 4);
			}
				$sonos->SetCrossfadeMode($crossfade);
		break; 
		
		  
		case 'remove':
			if(is_numeric($_GET['remove'])) {
				checkifmaster($master);
				$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
				$sonos->RemoveFromQueue($_GET['remove']);
			} 
		break; 
		
		
		case 'playqueue':
			$titelgesammt = $sonos->GetPositionInfo();
			$titelaktuel = $titelgesammt["Track"];
			$playlistgesammt = count($sonos->GetCurrentPlaylist());
						
			if ($titelaktuel < $playlistgesammt) {
			$sonos->SetQueue("x-rincon-queue:" . trim($sonoszone[$master][1]) . "#0");
				if($sonos->GetVolume() <= $config['TTS']['volrampto'])	{
					$sonos->RampToVolume($config['TTS']['rampto'], $volume);
					$sonos->Play();
				} else{
					$sonos->Play();
				}
			} else {
				LOGGING("No tracks in Playlist to play.", 5);
			}
		break;
		
		
		case 'clearqueue':
			$sonos->SetQueue("x-rincon-queue:" . trim($sonoszone[$master][1]) . "#0");
			checkifmaster($master);
			$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
			$sonos->ClearQueue();
		break;
		
		  
		case 'volume':
			if(isset($volume)) {
				$sonos->SetVolume($volume);
				if($config['LOXONE']['LoxDaten'] == 1) {
					sendUDPdata();
				}
			} else {
				LOGGING('Wrong range of values for the volume been entered, only 0-100 is permitted', 4);
			}
		break; 
		
		  
		case 'volumeup': 
			$volume = $sonos->GetVolume();
			if($volume < 100) {
				$volume = $volume + $config['MP3']['volumeup'];
				$sonos->SetVolume($volume);
				if($config['LOXONE']['LoxDaten'] == 1) {
					sendUDPdata();
				}
			}      
		break;
		
			
		case 'volumedown':
			$volume = $sonos->GetVolume();
			if($volume > 0) {
				$volume = $volume - $config['MP3']['volumedown'];
				$sonos->SetVolume($volume);
				if($config['LOXONE']['LoxDaten'] == 1) {
					sendUDPdata();
				}
			}
		break;
		
			
		case 'setloudness':
			if(($_GET['loudness'] == 1) || ($_GET['loudness'] == 0)) {
				$loud = $_GET['loudness'];
				$sonos->SetLoudness($loud);
			} else {
				LOGGING('Wrong LoudnessMode selected', 5);
			}    
		break;
		
		
		case 'settreble':
			$Treble = $_GET['treble'];
			$sonos->SetTreble($Treble);
		break;
		
		
		case 'setbass':
			$Bass = $_GET['bass'];
			$sonos->SetBass($Bass);
		break;	
		
		
		case 'setbass':
			$Bass = $_GET['bass'];
			$sonos->SetBass($Bass);
		break;
		

		case 'addmember':
			addmember();
		break;

		
		case 'removemember':
			removemember();
		break;
		
		
		case 'nextpush':
			checkifmaster($master);
			$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
			$posinfo = $sonos->GetPositionInfo();
			$duration = $posinfo['duration'];
			$state = $posinfo['TrackURI'];
			// Nichts läuft
			((empty($state)) and empty($duration)) ? nextradio() : '';
			// TV / Radio läuft
			((!empty($state)) and empty($duration)) ? nextradio() : '';
			// Playliste läuft
			((!empty($state)) and !empty($duration)) ? next_dynamic() : '';
		break;
		
		
		case 'nextradio':
			checkifmaster($master);
			$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos IP Adresse
			nextradio();
		break;
		
							  
		case 'sonosplaylist':
			playlist();
		break;
		
		  
		case 'groupsonosplaylist':
			AddMemberTo();
			playlist();
		break;
		

		case 'radioplaylist':
			radio();
		break;
		
		
		case 'groupradioplaylist': 
			AddMemberTo();
			radio();
		break;
		
		
		case 'radio': 
			AddMemberTo();
			radio();
		break;
		
		
		case 'playlist':
			AddMemberTo();
			playlist();
		break;
		
			
		case 'info':
			info();
		break;
      
    
	case 'cover':
		cover();
	break;   
		
		
	case 'title':
		title();
	break;   
			 
		
	case 'artist':
		artist();
	break;   
		
			 
	case 'album':
		album();
	break;

		
	case 'titelinfo':
		titelinfo();
	break;
	

	case 'sendgroupmessage':
		global $sonos, $coord, $text, $member, $master, $zone, $messageid, $logging, $words, $voice, $accesskey, $secretkey, $rampsleep, $config, $save_status, $mute, $membermaster, $groupvol, $checkgroup;
		#$time_start = microtime(true);
		sendgroupmessage();
	break;
		
		
	case 'sendmessage':
		global $text, $coord, $master, $messageid, $logging, $words, $voice, $config, $actual, $player, $volume, $coord, $time_start;
		#$time_start = microtime(true);
		sendmessage();
	break;
	
			
	case 'say':
		#$time_start = microtime(true);
		say();
	break;
		
			
	case 'group':
		group_all();
	break;
	
		
	case 'ungroup':
		ungroup_all();
	break;
	

	case 'getsonosinfo':
		sendUDPdata();
		sendTEXTdata();
	break; 
	
	
	# Debug Bereich ------------------------------------------------------

		case 'checksonos':
			if($debug == 1) { 
				echo '<PRE>';
				echo 'Test GetMediaInfo()';
				echo '<br>';
				print_r($sonos->GetMediaInfo());
				echo '<br><br>';
				echo 'Test GetPositionInfo()';
				echo '<br>';
				print_r($sonos->GetPositionInfo());
				echo '<br><br>';
				echo 'Test GetTransportSettings()';
				echo '<br>';
				print_r($sonos->GetTransportSettings());
				echo '<br><br>';
				echo 'Test GetTransportInfo()';
				echo '<br>';
				print_r($sonos->GetTransportInfo());
				echo '<br><br>';
				echo 'Test GetZoneAttributes()';
				echo '<br>';
				print_r($sonos->GetZoneAttributes());
				echo '<br><br>';
				echo 'Test GetZoneGroupAttributes()';
				echo '<br>';
				print_r($sonos->GetZoneGroupAttributes());
				echo '<br><br>';
			}
		break;
		
			
		case 'getzonestatus':
			getZoneStatus($master);
		break;
			

		case 'getmediainfo':
			echo '</PRE>';
			print_r($sonos->GetMediaInfo());
		break;
		

		case 'getmute':
			echo '<PRE>';
			print_r($sonos->GetMute());
		break;


		case 'getpositioninfo':
			echo '<PRE>';
			print_r($sonos->GetPositionInfo());
		break; 
		

		case 'gettransportsettings':
			echo '<PRE>';
			print_r($sonos->GetTransportSettings());
		break; 
		
		  
		case 'gettransportinfo':
			# 1 = PLAYING
			# 2 = PAUSED_PLAYBACK
			# 3 = STOPPED

				echo '<PRE>';
					print_r($sonos->GetTransportInfo());
				echo '</PRE>';
			break;        
		
		case 'getradiotimegetnowplaying':
			echo '<PRE>';
			$radio = $sonos->RadiotimeGetNowPlaying();
			print_r($radio);
		break;

		  
		case 'getvolume':
			echo '<PRE>';
			print_r($sonos->GetVolume());
		break;
			
		
		case 'getuser':
			echo '<PRE>';
			echo get_current_user();
		break;	
		
		  
		case 'masterplayer':
			Global $zone, $master;	
			foreach ($sonoszone as $player => $ip) {
				$sonos = new PHPSonos($ip[0]); //Slave Sonos ZP IPAddress
				$temp = $sonos->GetPositionInfo($ip);
				foreach ($sonoszone as $masterplayer => $ip) {
					# hinzugefügt am 18.01 weil Fehler bei Gruppierung auflösen
					$masterrincon = substr($temp["TrackURI"], 9, 24);
					if(trim($sonoszone[$masterplayer][1]) == $masterrincon) {
						echo "<br>" . $player . " -> ";
						echo "Master des Players: " . $masterplayer;
					}
				}
				$masterrincon = "";
			}
			return $player;
			return $masterplayer;
		break;
		
			
		case 'radiourl':
			$GetPositionInfo = $sonos->GetPositionInfo();
			echo "Die Radio URL lautet: " . $GetPositionInfo["URI"];
		break;
		
		
		case 'becomegroupcoordinator':
			echo '<PRE>';
			$sonos->BecomeCoordinatorOfStandaloneGroup();
			echo '</PRE>';
		break;
		
		
		case 'getgroupmute':
			$GetGroupMute = $sonos->GetGroupMute();
		break;
		
		
		case 'setgroupmute':
			if(($_GET['mute'] == 1) || ($_GET['mute'] == 0)) {
				$mute = $_GET['mute'];
				$sonos->SetGroupMute($mute);
			} else {
				echo "Der Mute Mode ist unbekannt";
			}
		break;
		

		case 'getgroupvolume':
			$sonos->SnapshotGroupVolume();
			$GetGroupVolume = $sonos->GetGroupVolume();
			print_r($GetGroupVolume);
		break;
		
		
		case 'setgroupvolume':
			$GroupVolume = $_GET['volume'];
			$sonos->SnapshotGroupVolume();
			$GroupVolume = $sonos->SetGroupVolume($GroupVolume);
		break;
		
		
		case 'setrelativegroupvolume':
			$sonos->SnapshotGroupVolume();
			$RelativeGroupVolume = $_GET['volume'];
			$RelativeGroupVolume = $sonos->SetRelativeGroupVolume($RelativeGroupVolume);
		break;
		
		
		case 'snapshotgroupvolume':
			$SnapshotGroupVolume = $sonos->SnapshotGroupVolume();
		break;
		
		
		case 'groupmanagement':
			$sonos = new PHPSonos($sonoszone[$master][0]);
			$ip = $sonoszone[$master][0];
			$SubscribeZPGroupManagement = $sonos->SubscribeZPGroupManagement('http://'.$ip.':6666');
		break;
		
		
		case 'sleeptimer':
			sleeptimer();
		break;
		

		case 'getsonosplaylists':
			echo '<PRE>';
			print_r($sonos->GetSonosPlaylists());
		break;
		
			
		case 'getaudioinputattributes':	
			echo '<PRE>';
			print_r($sonos->GetAudioInputAttributes());
		break;
		
		
		case 'getzoneattributes':
			echo '<PRE>';
			print_r($sonos->GetZoneAttributes());
		break;
		
		
		case 'getzonegroupattributes':
			echo '<PRE>';
			print_r($sonos->GetZoneGroupAttributes());
		break;
		
		
		case 'getcurrenttransportactions':
			echo '<PRE>';
			print_r($sonos->GetCurrentTransportActions());
		break;
		
		
		case 'getcurrentplaylist':
			echo '<PRE>';
			print_r($sonos->GetCurrentPlaylist());
		break;
		
		
		case 'getimportedplaylists':
			echo '<PRE>';
			print_r($sonos->GetImportedPlaylists());
		break;
		
		
		case 'listalarms':
			echo '<PRE>';
			print_r($sonos->ListAlarms());
		break;
		
		
		case 'alarmoff':
			turn_off_alarms();
		break;
		
		
		case 'alarmon':
			restore_alarms();
		break;
		
		
		case 'getledstate':
			echo '<PRE>';
			die ($sonos->GetLEDState());
		break;
		
		
		case 'setledstate':
			echo '<PRE>';
			if(($_GET['state'] == "On") || ($_GET['state'] == "Off")) {
				$state = $_GET['state'];
				$sonos->SetLEDState($state);
			} else {
				LOGGING('Please correct input. Only On or off is allowed', 4);
				echo '</PRE>';
			}
		break;
		
		
		#case 'getinvisible':
			#echo '<PRE>';
			#		print_r($sonos->GetInvisible());
			#echo '</PRE>';
		#break;
				
		
		case 'getcurrentplaylist':
			echo '<PRE>';
			print_r($sonos->GetCurrentPlaylist());
		break;
		
		
		case 'getloudness':
			echo '<PRE>';
			print_r($sonos->GetLoudness());
		break;
		
		
		case 'gettreble':
			echo '<PRE>';
			print_r($sonos->GetTreble());
		break;
		
					
		case 'getbass':
			echo '</PRE>';
			print_r($sonos->GetBass());
		break;
		
		
		case 'clearlox': // Loxone Fehlerhinweis zurücksetzen
			clear_error();
		break;
		
		
		case 'zapzone':
			zapzone();
		break;
		
		
		case 'delsonosplaylist':
			$sonos->DelSonosPlaylist('SQ:96');
		break;
		
				
		case 'createstereopair':
			CreateStereoPair();
		break;
		
		
		case 'seperatestereopair':
			SeperateStereoPair();
		break;
		
		
		case 'getroomcoordinator':
			getRoomCoordinator($master);
		break;
		
			
		case 'delcoord':
			$to = $_GET['to'];
			$newzone = $sonoszone[$to][1];
			$sonos->DelegateGroupCoordinationTo($newzone, 1);
		break;
		
		
		case 'favoriten':
			GetSonosFavorites();
		break;
		
		
		case 'delmp3':
			delmp3();
		break;
		
		
		case 'getpluginfolder':
			getPluginFolder();
		break;
		
		
		case 'networkstatus';
			networkstatus();
		break;  
		
		
		case 'getloxonedata':
			getLoxoneData();
		break;
		
		
		case 'getplayerlist':
			getPlayerList();
		break;
		
		
		case 'grouping':
			Group($master);
		break;
		
		
		case 'getgroups':
			getGroups();
		break;
		
		
		case 'getgroup':
			getGroup();
		break;
		
		
		case 'save':
			saveZonesStatus();
		break;
		
		
		case 'say':
			say();
		break;
		
		
		case 'addzones':
			addZones();
		break;
		
		
		case 'playbatch':
			t2s_playbatch();
		break;
		
		
		case 'alarmstop':
			$sonos->Stop();
			if(isset($_GET['member'])) {
				restoreGroupZone();
			} else {
				restoreSingleZone();
			}
		break;
		
		
		case 'zapzones':
			zapzone();
		break;
		
		
		case 'calendar':
			include_once("addon/calendar.php");
			muellkalender();
		break;
		
		
		case 'linein':
			LineIn();
		break;
		
		
		case 'playfile':
			PlayAudioFile();
		break;
		
		
		case 'checkifmaster':
			checkifmaster($master);
		break;
		
		
		case 'volmode':
			$uuid = $sonoszone[$master][1];
			$test = $sonos->GetVolumeMode($uuid);
			var_dump($test);
		break;
		
		
		case 'spotify':
			require_once("services/Spotify.php");
			AddSpotify();
		break;	
		
		
		case 'amazon':
			require_once("services/Amazon.php");
			AddAmazon();
		break;
		
		
		case 'google':
			require_once("services/Google.php");
			AddGoogle();
		break;	
		
		
		case 'apple':
			require_once("services/Apple.php");
			AddApple();
		break;	
		
		
		case 'napster':
			require_once("services/Napster.php");
			AddNapster();
		break;	
		
		
		case 'track':
			require_once("services/Local_Track.php");
			AddTrack();
		break;	
		
		
		case 'randomplaylist':
			random_playlist();
		break;
		
		
		case 'randomradio':
			random_radio();
		break;
		
		
		case 'getzoneinfo':
			$GetZoneInfo = $sonos->GetzoneInfo();
			echo '<PRE>';
			echo "Technische Details der ausgewaehlten Zone: " . $master;
			echo '<PRE>';
			echo '<PRE>';
			echo "IP Adresse: " . substr($GetZoneInfo['IPAddress'], 0, 30);
			echo '<PRE>';
			echo "Serial Number: " . substr($GetZoneInfo['SerialNumber'], 0, 50);
			echo '<PRE>';
			echo "Software Version: " . substr($GetZoneInfo['SoftwareVersion'], 0, 30);
			echo '<PRE>';
			echo "Hardware Version: " . substr($GetZoneInfo['HardwareVersion'], 0, 30);
			echo '<PRE>';
			echo "MAC Adresse: " . substr($GetZoneInfo['MACAddress'], 0, 30);
			echo '<PRE>';
			echo '<PRE>';
			echo "RinconID: " . trim($sonoszone[$master][1]);
		break;
		  
		default:
		   LOGGING("This command is not known. <br>index.php?zone=SONOSPLAYER&action=FUNCTION&VALUE=Option", 4);
		} 
	} else 	{
	LOGGING("The Zone ".$master." is not available or offline. Please check and if necessary add in the Config the zone", 4);
}

# Funktionen für Skripte ------------------------------------------------------

 
/**
/* Funktion : delmp3 --> löscht die hash5 codierten MP3 Dateien aus dem Verzeichnis 'messageStorePath'
/*
/* @param:  nichts
/* @return: nichts
**/
 function delmp3() {
	global $config, $debug;
	
	# http://www.php-space.info/php-tutorials/75-datei,nach,alter,loeschen.html	
	$dir = $config['SYSTEM']['messageStorePath'];
    $folder = dir($dir);
	$store = '-'.$config['MP3']['MP3store'].' days';
	while ($dateiname = $folder->read()) {
	    if (filetype($dir.$dateiname) != "dir") {
            if (strtotime($store) > @filemtime($dir.$dateiname)) {
					if (strlen($dateiname) == 36) {
						if (@unlink($dir.$dateiname) != false)
							echo $dateiname.' has been deleted<br>';
						else
							echo $dateiname.' could not be deleted<br>';
					}
			}
        }
    }
	if($debug == 1) { 
		echo "<br>All files according to the criteria were successfully deleted";
	}
    $folder->close();
    exit; 	 
 }
 

/**
/* Funktion : SetGroupVolume --> setzt Volume für eine Gruppe
/*
/* @param: 	Volume
/* @return: 
**/	
function SetGroupVolume($groupvolume) {
	global $sonos, $sonoszone, $master;
	$sonos = new PHPSonos($sonoszone[$master][0]); 
	$sonos->SnapshotGroupVolume();
	#$GroupVolume = $_GET['volume'];
	$GroupVolume = $sonos->SetGroupVolume($groupvolume);
 }

/**
/* Funktion : SetRelativeGroupVolume --> setzt relative Volume für eine Gruppe
/*
/* @param: 	Volume
/* @return: 
**/	
function SetRelativeGroupVolume($volume) {
	global $sonos;
	$sonos->SnapshotGroupVolume();
	$RelativeGroupVolume = $_GET['volume'];
	$RelativeGroupVolume = $sonos->SetRelativeGroupVolume($RelativeGroupVolume);
}

/**
/* Funktion : SnapshotGroupVolume --> ermittelt das prozentuale Volume Verhältnis der einzelnen Zonen
/* einer Gruppe (nur vor SetGroupVolume oder SetRelativeGroupVolume nutzen)
/*
/* @return: Volume Verhältnis
**/	
function SnapshotGroupVolume() {
	global $sonos;
	$SnapshotGroupVolume = $sonos->SnapshotGroupVolume();
	return $SnapshotGroupVolume;
}

/**
/* Funktion : SetGroupMute --> setzt alle Zonen einer Gruppe auf Mute/Unmute
/* einer Gruppe
/*
/* @param: 	MUTE or UNMUTE
/* @return: 
**/	
 function SetGroupMute($mute) {
	global $sonos;
		$sonos->SetGroupMute($mute);
 }


/** NICHT LIVE **
*
* Funktion : 	GetSonosFavorites --> lädt die Sonos Favoriten in die Queue (kein Radio)
*
* @param: empty
* @return: Favoriten in der Queue
**/

function GetSonosFavorites() {
	global $sonoszone, $master;
	
	$sonos = new PHPSonos($sonoszone[$master][0]); //Sonos ZP lox_ipesse 
	$browselist = $sonos->GetSonosFavorites("FV:2","c"); 
	print_r($browselist);
	$posinfo = $sonos->GetPositionInfo();
	#echo $uri = $posinfo['TrackURI'];
	#echo '<br>';
	#echo $meta = $posinfo['TrackMetaData'];
	

	#$finalstring = urldecode($scope);
	#$sonos->AddFavToQueue($uri, $meta);	
	#exit;
	foreach ($browselist as $favorite) {
		$scope = $favorite['res'];
		if ((substr($scope,0,11) != "x-sonosapi-") and (substr($scope,0,11) != "x-rincon-cp")) {
			$finalstring = urldecode($scope);
			$track = $favorite['res'];
			$title = $favorite['title'];
			$artist = $favorite['artist'];
			$metadata = '<DIDL-Lite xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:upnp="urn:schemas-upnp-org:metadata-1-0/upnp/" xmlns:r="urn:schemas-rinconnetworks-com:metadata-1-0/" xmlns="urn:schemas-upnp-org:metadata-1-0/DIDL-Lite/"><item id="-1" parentID="-1" restricted="true"><res protocolInfo="sonos.com-http:*:audio/mpeg:*>'.$track.'</res><r:streamContent></r:streamContent><upnp:albumArtURI></upnp:albumArtURI><dc:title>'.$title.'</dc:title><upnp:class>object.item.audioItem.musicTrack</upnp:class><dc:creator>'.$artist.'</dc:creator></item></DIDL-Lite>';
			#$metadata = '<DIDL-Lite xmlns:dc=http://purl.org/dc/elements/1.1/ xmlns:upnp=urn:schemas-upnp-org:metadata-1-0/upnp/ xmlns:r=urn:schemas-rinconnetworks-com:metadata-1-0/ xmlns=urn:schemas-upnp-org:metadata-1-0/DIDL-Lite/item id=-1; parentID=-1; restricted=truedc:title'.$title.'/dc:titleupnp:classobject.item.audioItem.musicTrack.#editorialViewTracks.sonos-favorite/upnp:classdesc id=cdudn nameSpace=urn:schemas-rinconnetworks-com:metadata-1-0/SA_RINCON40967_X_#Svc40967-0-Token/desc/item/DIDL-Lite>';
			$sonos->AddFavToQueue($finalstring, $metadata);
			try {
			#$sonos->AddToQueue($track);	
			} catch (Exception $e) {
#			LOGGING("The connection to Loxone could not be initiated!", 5);	
		}	
		}
	}
	#$sonos->Play();
}
?>

