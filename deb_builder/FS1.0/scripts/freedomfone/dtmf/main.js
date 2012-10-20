var allDigits = "";
var exit = false;

function onDtmf( session, type, digits, arg ) {
       if ( digits.digit == "#" ) {
       exit = true;
       return allDigits;
       }
       else {
       		allDigits += digits.digit;
       		return arg;
       }
}

if ( session.ready( ) ) {
session.answer( );
session.streamFile( "sounds/message.wav", onDtmf, false );
	if ( ! exit ) {
        session.collectInput( onDtmf, true, 20000 );
}
console_log( "info", "+++ digits are " + allDigits + "\n" );
        session.hangup( );
}
