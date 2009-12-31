// * Freedom Fone's Monitor IVR (mi)
// * Alberto Escudero-Pascual aep@it46.se
// * December 2009
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
// * Version 1.2
//
var miIVR_Unique_ID = argv[0];
var miIVR_IVR_Name = argv[1]; 
var miIVR_IVR_Node_Digit = argv[2];
var miIVR_IVR_Node_Unique_ID = argv[3];
var miIVR_Caller_ID_Number = argv[4];
var miIVR_Destination_Number = argv[5];

// Enable/Disable Debug
var miDebug = true;

	    e = new Event("custom", "monitor_ivr");
	    e.addHeader("FF-IVR-Unique-ID",miIVR_Unique_ID);
	    e.addHeader("FF-IVR-IVR-Name",miIVR_IVR_Name);
	    e.addHeader("FF-IVR-IVR-Node-Digit",miIVR_IVR_Node_Digit);
	    e.addHeader("FF-IVR-IVR-Node-Unique-ID",miIVR_IVR_Node_Unique_ID);
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
