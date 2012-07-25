<?xml version="1.0" ?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:output method="xml" indent="yes"/> 
 
<xsl:template match="/">
       <event> 
        <Event-Name><xsl:value-of select="event/headers/Event-Name"/></Event-Name>
     <headers>
        <FreeSWITCH-IPv4><xsl:value-of select="event/headers/FreeSWITCH-IPv4"/></FreeSWITCH-IPv4>
        <Event-Date-Timestamp><xsl:value-of select="event/headers/Event-Date-Timestamp"/></Event-Date-Timestamp>
        <Channel-State><xsl:value-of select="event/headers/Channel-State"/></Channel-State>
        <Channel-State-Number><xsl:value-of select="event/headers/Channel-State-Number"/></Channel-State-Number>
        <Unique-ID><xsl:value-of select="event/headers/Unique-ID"/></Unique-ID>
        <Caller-Caller-ID-Name><xsl:value-of select="event/headers/Caller-Caller-ID-Name"/></Caller-Caller-ID-Name>
        <Caller-Caller-ID-Number><xsl:value-of select="event/headers/Caller-Caller-ID-Number"/></Caller-Caller-ID-Number>
        <Caller-Destination-Number><xsl:value-of select="event/headers/Caller-Destination-Number"/></Caller-Destination-Number>
        <Caller-Unique-ID><xsl:value-of select="event/headers/Caller-Unique-ID"/></Caller-Unique-ID>
        <Answer-State><xsl:value-of select="event/headers/Answer-State"/></Answer-State>
        <Channel-Name><xsl:value-of select="event/headers/Channel-Name"/></Channel-Name>
     </headers>
       </event> 
</xsl:template>
</xsl:stylesheet>
