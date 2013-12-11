var sms = argv[0];
var sender = argv[1];
var receiver = argv[2];
var hw_unit = argv[3];
var date = argv[4];

console_log(" [ " + sms + " ] " + sender +"\n");
    e = new Event("custom", "officeroute");
    e.addHeader("FF-SMS-Sender-Number",sender);
    e.addHeader("FF-SMS-Receiver-Number",receiver);
    e.addHeader("FF-Hardware-Unit",hw_unit);
    e.addHeader("proto","GSM");
    e.addHeader("epoch",date);
    e.addBody(sms);
    e.fire();
