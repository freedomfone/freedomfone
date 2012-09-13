
// * Tickle State Machine for the Freedom Fone 
// * The script receives the call and captures the CallerID
// * a CUSTOM event is generated to the dispatcher 
// *
// * Written by: Alberto Escudero-Pascual
// * Revision: September  2009 
//
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


var tmWait = 7000; // 10 seconds to stop tickling and 10 seconds to call back
var tmDebug = true;
var tmMedia = argv[1]; // Parameters comes from dialplan app call 
var tmId = argv[0]; // Instance of tickle

//We define the hangup function 
session.setHangupHook(tmHangup);

function tmHangup(hup_session, how) {
        tm42Logger("STATE_HANGUP",how + " " + hup_session.name + " " + hup_session.cause + "\n");
	tmFinishDate=new Date();
	tmTriggerEvent();
	exit();

}
if (session.ready()) {
	//We catch the Start Time 
	tmStartDate=new Date();
	//We catch the caller_id
    	caller_id_num = session.caller_id_num;
	tm42Logger("STATE_TICKLE_IN"," " + caller_id_num + " Destination number " + tmMedia + "\n");   

	//How long we want to wait to accept the tickle
	session.execute("sleep",tmWait);
	
	tm42Logger("STATE_TICKLE_OUT"," " + caller_id_num + "\n");   
	exit();
	}
        


//We notify our dispatcher about the call 
function tmTriggerEvent() {
    	tmEvent = new Event("custom", "tickle");
    	tmEvent.addHeader("FF-InstanceID",tmId);
    	tmEvent.addHeader("FF-CallerID",session.caller_id_num);
    	tmEvent.addHeader("FF-CallerName",session.caller_id_name);
    	tmEvent.addHeader("FF-To",tmMedia);
    	tmEvent.addHeader("FF-StartTimeEpoch",tmStartDate.getTime());
    	tmEvent.addHeader("FF-FinishTimeEpoch",tmFinishDate.getTime());
    	tmEvent.addHeader("FF-Type","tickle");
    	tmEvent.fire();
       	tm42Logger("STATE_ESL_EVENT", caller_id_num + "\n");
}


function tm42Logger(tmDescriptor, tmMessage) {
	if (tmDebug) {
		console_log("\n");
		console_log(" ========================================================== " +"\n");
        	console_log(" [ " + tmDescriptor + " ] " + tmMessage +"\n");
        	console_log(" ========================================================== " +"\n");
		console_log("\n");
	}
}
