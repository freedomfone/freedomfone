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
// * Version 1.1
//
var miIVR_UUID = argv[0];
var miIVR_Name = argv[1]; // One Word
var miIVR_CallerID = argv[2];
var miIVR_Destination_Number = argv[3];
var miIVR_Node_Option = argv[4];
var miIVR_Node_Tag = argv[5];

// Enable/Disable Debug
var miDebug = true;

	    e = new Event("custom", "monitor_ivr");
	    e.addHeader("FF-IVR-UUID",miIVR_UUID);
	    e.addHeader("FF-IVR-Name",miIVR_Name);
	    e.addHeader("FF-IVR-CallerID",miIVR_CallerID);
	    e.addHeader("FF-IVR-Destination-Number",miIVR_Destination_Number);
	    e.addHeader("FF-IVR-Node-Option",miIVR_Node_Option);
	    e.addHeader("FF-IVR-Node-Tag",miIVR_Node_Tag);
	    e.fire();
	


if (miDebug) {
        console_log("\n");
        console_log(" ============================================================================ " +"\n");
        console_log(miIVR_UUID + "|" + miIVR_Name + "|" + miIVR_CallerID + "|" + miIVR_Destination_Number + "|" + miIVR_Node_Option + "|" + miIVR_Node_Tag +"\n");
        console_log(" ============================================================================ " +"\n");
        console_log("\n");
    }   
