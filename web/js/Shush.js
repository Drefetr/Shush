/**
 * Generates an alpha-numeric string of the specified length --
 * for use as a message key.
 */
function createMessageKey(messageKeyLength){
    var messageKey = "";
	
    while(messageKey.length < messageKeyLength && messageKeyLength > 0){
        var r = Math.random();
        messageKey += (r < 0.1 ? Math.floor(r * 100) : 
			String.fromCharCode(Math.floor(r * 26) + (r > 0.5 ? 97 : 65)));
    }
	
    return messageKey;
}