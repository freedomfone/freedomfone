var sms = argv[0];
var sender = argv[1];
var receiver = argv[2];
var date = argv[3];

console_log(" [ " + sms + " ] " + sender +"\n");
    e = new Event("custom", "officeroute");
    e.addHeader("FF-SMS-Sender-Number",sender);
    e.addHeader("FF-SMS-Receiver-Number",receiver);
    e.addHeader("proto","officeroute");
    e.addHeader("epoch",date);
    e.addBody(sms);
    e.fire();
