var sms = argv[0];
var sender = argv[1];
var receiver = argv[2];
var date = argv[3];

console_log(" [ " + sms + " ] " + sender +"\n");
    e = new Event("custom", "gammu");
    e.addHeader("proto","gammu");
    e.addHeader("FF-SMS-Sender-Number",sender);
    e.addHeader("login",receiver);
    e.addHeader("epoch",date);
    e.addBody(sms);
    e.fire();
