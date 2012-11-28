<?xml version="1.0" ?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:output method="xml" indent="yes"/> 
 
<xsl:template match="event">
       <event> <xsl:apply-templates select="headers"/> </event>


</xsl:template>
 
<xsl:template match="headers">
        <Event-Name><xsl:value-of select="Event-Name"/></Event-Name>

     <headers>
        <Event-Subclass><xsl:value-of select="Event-Subclass"/></Event-Subclass>
        <FreeSWITCH-IPv4><xsl:value-of select="FreeSWITCH-IPv4"/></FreeSWITCH-IPv4>
        <Event-Date-Timestamp><xsl:value-of select="Event-Date-Timestamp"/></Event-Date-Timestamp>
        <FF-URI><xsl:value-of select="FF-URI"/></FF-URI>
        <FF-InstanceID><xsl:value-of select="FF-InstanceID"/></FF-InstanceID>
        <FF-FileID><xsl:value-of select="FF-FileID"/></FF-FileID>
	<FF-CallerID><xsl:value-of select="FF-CallerID"/></FF-CallerID>
	<FF-CallerName><xsl:value-of select="FF-CallerName"/></FF-CallerName>
	<FF-OnQuickHangup><xsl:value-of select="FF-OnQuickHangup"/></FF-OnQuickHangup>
	<FF-StartTimeEpoch><xsl:value-of select="FF-StartTimeEpoch"/></FF-StartTimeEpoch>
	<FF-FinishTimeEpoch><xsl:value-of select="FF-FinishTimeEpoch"/></FF-FinishTimeEpoch>
     </headers>
</xsl:template>


</xsl:stylesheet>
