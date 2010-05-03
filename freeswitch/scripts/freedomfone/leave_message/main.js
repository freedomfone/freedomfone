// * file_name    - Leave a Message for Freedom Fone 
// * version      - 1.0.573 
 
// * ***** BEGIN LICENSE BLOCK *****
// * Version: MPL 1.1
// *
// * The contents of this file are subject to the Mozilla Public License Version
// * 1.1 (the "License"); you may not use this file except in compliance with
// * the License. You may obtain a copy of the License at
// * http://www.mozilla.org/MPL/
// *
// * Software distributed under the License is distributed on an "AS IS" basis,
// * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
// * for the specific language governing rights and limitations under the
// * License.
// *
// *
// * The Initial Developer of the Original Code is
// *   	Alberto Escudero-Pascual  <aep@it46.se>
// *
// * Contributor(s):
// *
// * 	Inspired in work and ideas from Joshua Engelbrecht, Mike
// * 	B. Murdock and Anthony Minessale II
// * ***** END LICENSE BLOCK *****



///////////////////////////////////////////
//// Leave-a-message for Quick Hangers ////
///////////////////////////////////////////
// 
// This second version of LAM (May 2010) includes a extended State Machine for the Quick Hangup State keeping
// backwards compatibility with early versions
//
// When the caller arrives to the STATE_RECORD an audio file starts to get recorded. In this state
// the caller can either hangup (quick hang) or play, delete, save the recording. DTMFs are used
// to feedback to the LAM state machine. Once the caller SAVEs the file, a .meta file is created.
// This .meta file triggers the audio converter daemon (iwatch) that is responsible to convert the WAV
// file to a MP3 File.
//
// In case that the caller hangs the phone (quick hang), the on_hangup function is responsible to 
// determine if there is an audio file available and if needs to be "deleteD" or "acceptED". If the 
// dialplan variable on_quick_hangup is set to "delete", the audio file is deleted and no meta file
// and event are triggered. If the variable on_quick_hangup is set to "accept", a .meta file is created
// and the event is triggered.
// 
// This logic can be modeled with three variables
// lmFilenameHangup.isFile: checks if the audio file exists
// lmMetaFile: checks if the meta file exists
// lmOnHangup: dialplan variable that indicates what to do if a quick hangup takes place (delete/accept)
//
// The states can be modeled as follows:
// A  	M	HD 	Prev		Next State 
// 1	1	X	GOODBYE 	Do nothing, event already triggered	
// 1	0	0	QUICKHANGUP 	Create meta and trigger event (META, EVENT)	
// 1	0	1	QUICKHANGUP 	Delete audio file	
// 0	X	X	QUICKHANGUP  	Do nothing, no audio file to work with
//
//
//
//
// Modifying behaviour of LAM from the dialplan
// We can set in the dialplan how to handle quick hangers that do not SAVE the file via DTMF
// <!--             <action application="set" data="on_quick_hangup=delete"/> --> 
//             <action application="set" data="on_quick_hangup=accept"/>  
//             <action application="javascript" data="freedomfone/leave_message2/main.js ${instance_id} ${on_quick_hangup}"/>




// Needed for the Beep(). Can we avoid it?
use("TeleTone");

// Allows to personalize TTS message in the Leave Message State Machine.
var lmId = argv[0];

// What to do after quick hangup if we have a file recorded but no DTMF received 
var lmOnHangup = argv[1];

// TTS texts are loaded here. File generated from GUI
//
//FIXME! We will love to do this reading a XML file and not a JS.
//
include("freedomfone/leave_message/" + lmId + "/conf/" + lmId + ".conf");
// We retrieve global variables as BaseDir and Domain Name
include("freedomfone/leave_message/" + lmId + "/conf/" + lmId + "_core.conf");

var lmDirRoot = new File(lmDirBaseDir  + "/freeswitch/scripts/freedomfone/leave_message/");
var lmDir = new File(lmDirRoot + "/" + lmId); 
var lmURI = lmURIRoot + "/freedomfone/leave_message/" + lmId + "/" + "messages/"; 

var lmWelcomeAudio = lmDir + "/audio_menu/lmWelcome.wav";
var lmInformAudio = lmDir + "/audio_menu/lmInform.wav";
var lmInvalidAudio = lmDir + "/audio_menu/lmInvalid.wav";
var lmSelectAudio = lmDir + "/audio_menu/lmSelect.wav";
var lmDeleteAudio = lmDir + "/audio_menu/lmDelete.wav";
var lmSaveAudio = lmDir + "/audio_menu/lmSave.wav";
var lmGoodbyeAudio = lmDir + "/audio_menu/lmGoodbye.wav";
var lmLongAudio = lmDir + "/audio_menu/lmLong.wav";

// Maximum recording length in seconds (2 minutes).
var lmMaxreclen = 120;

// Artificial silences for sleep session.execute. 
// FIXME! Play with this value and provide reference values
var lmSilenceTime = 2000;   

// This variable is used to prevent a DoS when callers block line
var lmLoop = 1;
var lmLoopmax = 4;

// Energy  level  audio  must  fall  below to  be  considered  silence
// (300-500), we  might like  to have higher  values for PSTN  and GSM
// lines in Africa
var lmSilencethreshold = 300;
   
// Amount of time in seconds caller must be silent to trigger detector.
var lmSilence = 300;

// Variable to monitor if the file has been recorded On Quick hangup
var lmOnQuickHangup = false;
var lmFinishDateExists = false;
   
// We defined our states here, useful for future checks
var STATE_ANSWER = 0; 
var STATE_ENTRY = 1;
var STATE_RECORD = 2;
var STATE_SELECT = 3;
var STATE_PLAY = 4;
var STATE_DELETE = 5;
var STATE_GOODBYE = 6;
var STATE_HANGUP = 7;
var STATE_QUICKHANGUP = 8;
var STATE_METAFILE = 9;
var STATE_EVENT = 10;
   
// We iniatilize the State to the Answer to Life, the Universe, and
// Everything!. Obviously this is State 42.
var lmState = 42;

// Enable/Disable Debug
var lmDebug = true;

// Boolean variable to provide feedback when a file is deleted
var lmDeleteFeedback = true;

// Boolean variable to track the creation of the metafile
var lmMetaFile = false;

// Session parameters 
var lm_uuid = session.uuid;
var lm_ani = session.ani;
var lm_ani2 = session.ani2;
var lm_caller_id_name = session.caller_id_name;
var lm_caller_id_num = session.caller_id_num;
var lm_destination = session.destination;
var lm_dialplan = session.dialplan;
var lm_name = session.name;
var lm_network_addr = session.network_addr;
var lm_state = session.state;
//Can we retrieve the local IP and autoconf the streaming address?
//var lm_localIP = session.getVariable("local_ip_v4");

// lmsm starts here!
session.answer();
// We decide which function will be trigger when a hangup takes place.
session.setHangupHook(lmHangup);

// When the session is ready we move from default state 42 to STATE_ANSWER.
if (session.ready()) {
	lmState = STATE_ANSWER;
	lm42Logger("STATE_ANSWER",lmState);
	lm42Logger("STATE_ANSWER",  lm_uuid + " " + lm_ani + " " + lm_dialplan + " " + lm_state + " " + lmOnHangup);   


// We  play  welcome message.  If  audio  file  is not  available,  we
// fallback to text to speech. Cepstral.

	lm42PlayFreedom(lmWelcomeAudio,lmWelcomeMessage);

// Every state jumps to a new state after evaluation the input In this
// case we  jump inconditonally to the next  state. We inconditionally
// we jump to the next STATE

	lmStateEntry(lmState);
} 


// The rest that follows are a bounch of functions to model each of
// the states (lmStateXXX) and a few (lm42XXXX) auxiliary functions.


/////////////////////////////////////////////////////////////////////
////////////////////      AUXILIARY FUNCTIONS      //////////////////
/////////////////////////////////////////////////////////////////////

// The most inportant function is the logger. Long life to printf in
// Javascript. 
function lm42Logger(lmDescriptor, lmMessage) {
    if (lmDebug) {
	console_log("\n");
	console_log(" ============================================================================ " +"\n");
	console_log(" [ " + lmDescriptor + " ] " + lmMessage +"\n");
	console_log(" ============================================================================ " +"\n");
	console_log("\n");
    }	
}

// This is the mother of the DTMF feedback for the lm42PlayFreedom function
function lm42FeedBackInput (session, type, digits, arg) {
    //Regular expression to match invalid digits
    var lmInvalidReg = new RegExp("[2-9]");
    
    if (digits.digit == "#") { return "record"; } 
    else if (digits.digit == "*") { return "play"; }
    else if (digits.digit == "0") { return "delete"; }
    else if (digits.digit == "1") { return "save"; }
    else if (lmInvalidReg.exec(digits.digit) != null) { return "invalid_digit"; }
    else { 
	return false;
    } 
}

// We play an audio file if exists, if not we use TTS with the speak macro
function lm42PlayFreedom(lmFeedbackAudio,lmFeedbackMessage) {
    var lmFeedbackAudioFile = new File(lmFeedbackAudio);
    if (lmFeedbackAudioFile.isFile) { session.streamFile(lmFeedbackAudio, lm42FeedBackInput); } 
    else { 
	session.sayPhrase("speak", lmFeedbackMessage, "en"); 
    }	
}

function lm42Beep () {
    var tts = new TeleTone(session);
    var BONG ="v=-7;%(100,0,941.0,1477.0);v=-7;>=2;+=.1;%(1000, 0, 640)";
    tts.generate(BONG);
}


/////////////////////////////////////////////////////////////////////
////////////////////     STATE MACHINE FUNCTIONS      ///////////////
/////////////////////////////////////////////////////////////////////

//We  play information  how to  use the  application and  jump  to the
//TmpRecord  (RECORD) State  We  always  verify that  we  come from  a
//predicted previous State to catch unpredicted state machine problems

function lmStateEntry(lmPreviousState) {
    if (lmPreviousState == STATE_ANSWER || lmPreviousState == STATE_DELETE || lmPreviousState == STATE_RECORD) {
	lmState = STATE_ENTRY;
	lm42Logger("STATE_ENTRY",lmState);
	lm42PlayFreedom(lmInformAudio,lmInformMessage);
	lmStateTmpRecord(lmState); } 
    else {
	lm42Logger("STATE_ENTRY","ERROR: This state should never happen!");
    }
} 

// We  delete the file  when prompted  or when  the user  hangs during
// recording and the variable lmOnHangup is set to delete
// The user can hangup after SAVE state, before GOODBYE 

function lmDeleteFile(lmPreviousState,lmFilenamePath) {
    if (lmPreviousState == STATE_RECORD || lmPreviousState == STATE_PLAY || lmPreviousState == STATE_SELECT) {
	lmState = STATE_DELETE;
	lm42Logger("STATE_DELETE",lmState);
	
        var lmDelFile = File(lmFilenamePath);
	if (lmDelFile.isFile) {
	    lmDelFile.remove();
	    lm42Logger("STATE_DELETE","Deleting File: " + lmFilenamePath); 
	    if (lmDeleteFeedback) { 
		lm42PlayFreedom(lmDeleteAudio,lmDeleteMessage); 
	    }
	    //We reset the flag to always feedback the Delete of a file
	    lmDeleteFeedback = true;
	    //Counting the number of loops, i.e. times we have deleted a file
	    lmLoop++;
		session.sleep(1000); 
		lm42Logger("STATE_LOOP","Loop number: " + lmLoop + " out of " +lmLoopmax);
	    if (lmLoop > lmLoopmax) {
		lm42Logger("STATE_LOOP","Maximum number of loops reached" );
		exit();
		}  
	    lmStateEntry(lmState);
	}  
    } 
    else {
	lm42Logger("STATE_DELETE","ERROR: This state should never happen!");
    }
}	


function lmStatePlay(lmPreviousState,lmPlayFilename) {
    if (lmPreviousState == STATE_RECORD || lmPreviousState == STATE_PLAY || lmPreviousState == STATE_SELECT) {
	lmState = STATE_PLAY;
	lm42Logger("STATE_PLAY",lmState);
	// Let us try to avoid those queued digits.
	session.flushDigits();
	
	// In the StatePlay we allow to interrupt the Play anytime and save the file
	var lmDTMF = session.streamFile(lmPlayFilename, lm42FeedBackInput, "", 0);
	
	// Let us log the DTMF tones here, they are returned by streamFile when the return != true
	lm42Logger("STATE_PLAY","DTMF Feedback is ++ "+lmDTMF+" ++");
	
	if ( lmDTMF == "record"  || lmDTMF == "play" ) { lmStatePlay(lmState,lmPlayFilename); }
	else if ( lmDTMF == "delete" ) { lmDeleteFile(lmState,lmPlayFilename); }	
	else if ( lmDTMF == "save" ) { lmStateSave(lmState); }
	else if ( lmDTMF == false || lmDTMF == "invalid_digit" ) { lmStateSelect(lmState,lmPlayFilename); }
    } 
    else {
	lm42Logger("STATE_PLAY","ERROR: This state should never happen!");		
    } 	
}


function lmStateSave(lmPreviousState) {
    if (lmPreviousState == STATE_RECORD || lmPreviousState == STATE_PLAY || lmPreviousState == STATE_SELECT) {
	lmState = STATE_GOODBYE;
	lmOnQuickHangup = false;
	lmCreateMetaFile();

	// We set MetaFile to true so user can hangup before Goodbye	
	lmMetaFile = true;
	lm42Logger("STATE_GOODBYE",lmState + " Sending file to Audio Conversion");
	
	// WARNING! We  should not hangup  inside of the script or we
	// can not  run another  applications called in  the dialplan
	// session.hangup();
	
	lmTriggerEvent();
			

	lm42Logger("STATE_GOODBYE",lmState + " Hej da");
	lm42PlayFreedom(lmSaveAudio,lmSaveMessage);
	lm42PlayFreedom(lmGoodbyeAudio,lmGoodbyeMessage);

	//We exit the script while keeping the session alive!
	//Code to integrate with IVR API goes here!
	exit(); 
	//session.execute("transfer",5000);  
  } 
    else {
	lm42Logger("STATE_GOODBYE","ERROR: This state should never happen!");
    }
}


function lmStateSelect(lmPreviousState,lmSelectTmpFilename) {
    if (lmPreviousState == STATE_RECORD || lmPreviousState == STATE_SELECT || lmPreviousState == STATE_PLAY || lmPreviousState == STATE_GOODBYE )  {
	lmState = STATE_SELECT;
	lm42Logger("STATE_SELECT",lmState);
	lm42PlayFreedom(lmSelectAudio,lmSelectMessage)
	lm42Beep();
	session.flushDigits();

	// We do not accept feedback during the Select Audio Information Message
	// We wait 10 seconds to collect feedback after the Beep
 
    	var lmDTMF2 = session.collectInput(lm42FeedBackInput,"",10000);
	lm42Logger("STATE_SELECT","DTMF Feedback is ++ "+lmDTMF2+" ++");
	
	if ( lmDTMF2 == "record"  || lmDTMF2 == "play" ) { lmStatePlay(lmState,lmSelectTmpFilename); }
	else if ( lmDTMF2 == "delete" ) { lmDeleteFile(lmState,lmSelectTmpFilename); }
	else if ( lmDTMF2 == "save" ) { lmStateSave(lmState); }
	else if ( lmDTMF2 == false || lmDTMF2 == "invalid_digit" ) { lmStateSelect(lmState, lmSelectTmpFilename); }
	else { lmStateSelect(lmState, lmSelectTmpFilename); }
	lm42Logger("STATE_SELECT","Looping becouse of lack of input");
    } 
    else {
	lm42Logger("STATE_SELECT","ERROR: This state should never happen! "+lmState);
    }	
}


function lmStateTmpRecord(lmPreviousState) {
    if (lmPreviousState == STATE_ENTRY || lmPreviousState == STATE_DELETE)  {
	lmState = STATE_RECORD;
	lm42Logger("STATE_RECORD",lmState);
	lmFinishDateExists = false;  
	lm42Beep(); 
       
	// Preparing the filename
      	var lmTmpFilename = lmDir + "/messages/" + lm_uuid + ".wav";
	lm42Logger("STATE_RECORD","Recording message: " + lmTmpFilename);

  
      	//FIXME! Do we need to check session.ready() or hangup is our 42 magic!

	// We create a timestamp to track the length of the recording
	lmStartDate=new Date();
	lm42Logger("STATE_RECORD","Start date: " + lmStartDate);

	// Record message and wait for DTMF feedback    
	session.flushDigits();
	var lmDTMF = session.recordFile(lmTmpFilename, lm42FeedBackInput, "", lmMaxreclen, lmSilencethreshold, lmSilence);
	lm42Logger("STATE_RECORD","DTMF Feedback is ++ "+lmDTMF+" ++");
	// If lmDTMF is something! we take the finish timestamp and set lmFinishDateExists=true
	if ( lmDTMF ) { 
	    lmFinishDate=new Date();  
	    lmFinishDateExists=true;  
	    lm42Logger("STATE_RECORD","Finish date: " + lmFinishDate); 
	}
	
	if ( lmDTMF == "record" ) { lmStateSelect(lmState,lmTmpFilename); }       
	else if ( lmDTMF == "save" ) { lmStateSave(lmState); }
	else if ( lmDTMF == "play" ) { lmStatePlay(lmState,lmTmpFilename); }
	else if ( lmDTMF == "delete")  { lmDeleteFile(lmState,lmTmpFilename); }
	else if ( lmDTMF == "invalid_digit" ) { 
	    // You press a wrong digit! We delete the file without audio feedback
	    // We set lmDeleteFeedback flag to false not to report the deletion.
	    // There are two types of deletion: the one selected via the TUI and the 
	    // one that is taken place when the state machine enters the state HANGUP
	    // or the length of the message is too long!
	    lm42PlayFreedom(lmInvalidAudio,lmInvalidMessage);
	    lmDeleteFeedback = false;	
	    lmDeleteFile(lmState,lmTmpFilename);
	    // Back to the starting point!
	    lmStateEntry(lmState);
	}
	else if ( lmDTMF == false ) {
	    //FIXME! Here we catch the Max recording length.
	    //FIXME! Include a time for the Silence period?
	    lm42PlayFreedom(lmLongAudio,lmLongMessage);
	    lmDeleteFeedback = false;	
	    lmDeleteFile(lmState,lmTmpFilename);
	    lmStateEntry(lmState);
       	}
    } 
    else { 
	lm42Logger("STATE_RECORD","ERROR: This state should never happen!");
    }	  
}	

/////////////////////////////////////////////////////////////////////
///////////////     STATE MACHINE CORE FUNCTIONS      ///////////////
/////////////////////////////////////////////////////////////////////

function lmCreateMetaFile() {
	var lmFd = new File(lmDir + "/messages/" + lm_uuid + ".meta");
	lmFd.open("write,create");
      	lmFd.writeln("InstanceID="+lmId);
       	lmFd.writeln("FileID="+lm_uuid);
      	lmFd.writeln("CallerID="+lm_caller_id_num);
       	lmFd.writeln("CallerName="+lm_caller_id_name);
      	lmFd.writeln("StartTime="+lmStartDate);
    	lmFd.writeln("StartTimeEpoch="+lmStartDate.getTime());
        lmFd.writeln("FinishTime="+lmFinishDate);
        lmFd.writeln("FinishTimeEpoch="+lmFinishDate.getTime());
        lmFd.writeln("OnQuickHangup="+lmOnQuickHangup);
	lm42Logger("STATE_METAFILE","From: " + lmState + " Creating meta file");
        lmFd.close;
}

function lmTriggerEvent() {
    lmEvent = new Event("custom", "leave_a_message");
    lmEvent.addHeader("FF-InstanceID",lmId);
    lmEvent.addHeader("FF-URI",lmURI);
    lmEvent.addHeader("FF-FileID",lm_uuid);
    lmEvent.addHeader("FF-CallerID",lm_caller_id_num);
    lmEvent.addHeader("FF-CallerName",lm_caller_id_name);
    lmEvent.addHeader("FF-StartTimeEpoch",lmStartDate.getTime());
    lmEvent.addHeader("FF-FinishTimeEpoch",lmFinishDate.getTime());
    lmEvent.addHeader("FF-OnQuickHangup",lmOnQuickHangup);
    //lmEvent.addBody(EVENT WITHOUT BODY);
    
    lmEvent.fire();
    lm42Logger("STATE_EVENT","From: " + lmState + " " + "Event for FileID: "+lm_uuid+" "+lmOnQuickHangup);
}

function lmHangup(hup_session, how) { 
    // The user has hangup, let us check if there is file recorded and if it has been accepted by DTMF
    var lmFilenameHangupPath = lmDir + "/messages/" + lm_uuid + ".wav";
    var lmFilenameHangup = File(lmFilenameHangupPath);
   
    


    // Do we have an audio file to work with at all? 
if (lmFilenameHangup.isFile) {
    		// Do we have a meta file? 
    		if (lmMetaFile == true) {
    		lmState = STATE_HANGUP;
    		lm42Logger("STATE_HANGUP",how + " " + hup_session.name + " " + hup_session.cause + "\n");    
		exit();	
		}	 
		else {
    		lmState = STATE_QUICKHANGUP;
    		lm42Logger("STATE_QUICKHANGUP",how + " " + hup_session.name + " " + hup_session.cause + "\n");    
    			// Should we delete the audio file of the quick hangers? 
			if (lmOnHangup == "delete") {
			lm42Logger("STATE_QUICKHANGUP","Deleting File: " + lmFilenameHangupPath);
			lmFilenameHangup.remove();
    			exit();
			} 
			else {
			// Default behaviour is to keep the file if variable is not set in dialplan
			// We do not have finish timestamp for this case so we create one now
			lmOnQuickHangup = true;
			if (lmFinishDateExists == false) { lmFinishDate=new Date(); }
            		
			lm42Logger("STATE_QUICKHANGUP","Finish date: " + lmFinishDate);
			lmCreateMetaFile();
			lmTriggerEvent();
    			exit();
			}
   		}
	} 
	else {
    		lmState = STATE_HANGUP;
    		lm42Logger("STATE_HANGUP",how + " " + hup_session.name + " " + hup_session.cause + "\n");    
    		exit();
	}
}	
