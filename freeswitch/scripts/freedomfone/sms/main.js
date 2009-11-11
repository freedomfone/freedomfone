var sms = argv[0];
var sender = argv[1];
var receiver = argv[2];
    e = new Event("custom", "message");
    e.addHeader("FF-SMS-Sender-Number",sender);
    e.addHeader("FF-SMS-Receiver-Number",receiver);
    e.addBody(sms);
    e.fire();

