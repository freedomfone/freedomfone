// * Freedom Fone's Monitor IVR (mi)
// * Alberto Escudero-Pascual aep@it46.se
// * December 2009-2011
// * 
// * Version: MPL  1.1 The  contents of this  file are subject  to the
// * Mozilla Public  License Version 1.1  (the "License"); you  may not
// * use  this file  except in  compliance  with the  License. You  may
// * obtain  a  copy  of  the  License  at  http://www.mozilla.org/MPL/
// * Software distributed  under the License  is distributed on  an "AS
// * IS"  basis,  WITHOUT  WARRANTY  OF  ANY KIND,  either  express  or
// * implied.  See  the License  for  the  specific language  governing
// * rights and limitations under the License.  123
//
// * Version 2.0
// We extend the monitor event type to include the type of Service
// IVR XML sample
// <entry action="menu-exec-app" digits="1" param="javascript $${base_dir}/scripts/freedomfone/monitor_ivr/main.js ${uuid} 'IVR_Name_Text' 2 'Node_UniqueID_for_2' ${caller_id_number} ${destination_number}"/>   
// 



var miIVR_Unique_ID = argv[0];
var miIVR_IVR_Name = argv[1]; 
var miIVR_IVR_Node_Digit = argv[2];
var miIVR_IVR_Node_Unique_ID = argv[3];
var miIVR_IVR_Node_Service_ID = argv[4];
var miIVR_Caller_ID_Number = argv[5];
var miIVR_Destination_Number = argv[6];

// Enable/Disable Debug
var miDebug = true;

	    e = new Event("custom", "monitor_ivr");
//uuid
	    e.addHeader("FF-IVR-Unique-ID",miIVR_Unique_ID);
//text describing the IVR
	    e.addHeader("FF-IVR-IVR-Name",miIVR_IVR_Name);
//digit pressed
	    e.addHeader("FF-IVR-IVR-Node-Digit",miIVR_IVR_Node_Digit);
//unique id of the objected linked
	    e.addHeader("FF-IVR-IVR-Node-Unique-ID",miIVR_IVR_Node_Unique_ID);
//type of object - lam, ivr, node
	    e.addHeader("FF-IVR-IVR-Node-Service-ID",miIVR_IVR_Node_Service_ID);
	    e.addHeader("FF-IVR-Caller-ID-Number",miIVR_Caller_ID_Number);
	    e.addHeader("FF-IVR-Destination-Number",miIVR_Destination_Number);
	    e.fire();

	


if (miDebug) {
        console_log("\n");
        console_log(" ============================================================================ " +"\n");
        console_log(miIVR_Unique_ID + "|" + miIVR_IVR_Name + "|" + miIVR_IVR_Node_Digit + "|" + miIVR_IVR_Node_Unique_ID + "|" + miIVR_Caller_ID_Number + "|" + miIVR_Destination_Number +"\n");
        console_log(" ============================================================================ " +"\n");
        console_log("\n");
	    }   
