<?xml version="1.0" ?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:output method="xml" indent="yes"/> 
 
<xsl:template match="/">
       <event> 
        <Event-Name><xsl:value-of select="event/headers/Event-Name"/></Event-Name>
     <headers>
        <Event-Subclass><xsl:value-of select="event/headers/Event-Subclass"/></Event-Subclass>
        <Event-Date-Timestamp><xsl:value-of select="event/headers/Event-Date-Timestamp"/></Event-Date-Timestamp>
	<FF-IVR-Unique-ID><xsl:value-of select="event/headers/FF-IVR-Unique-ID"/></FF-IVR-Unique-ID>
        <FF-IVR-IVR-Name><xsl:value-of select="event/headers/FF-IVR-IVR-Name"/></FF-IVR-IVR-Name>
        <FF-IVR-IVR-Node-Digit><xsl:value-of select="event/headers/FF-IVR-IVR-Node-Digit"/></FF-IVR-IVR-Node-Digit>
        <FF-IVR-IVR-Node-Unique-ID><xsl:value-of select="event/headers/FF-IVR-IVR-Node-Unique-ID"/></FF-IVR-IVR-Node-Unique-ID>
        <FF-IVR-Caller-ID-Number><xsl:value-of select="event/headers/FF-IVR-Caller-ID-Number"/></FF-IVR-Caller-ID-Number>
        <FF-IVR-Destination-Number><xsl:value-of select="event/headers/FF-IVR-Destination-Number"/></FF-IVR-Destination-Number>
     </headers>
       </event> 
</xsl:template>
</xsl:stylesheet>
