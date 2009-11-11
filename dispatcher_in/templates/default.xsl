<?xml version="1.0" ?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:output method="xml" indent="yes"/> 
 
<xsl:template match="ff-event">
       <ff-event> <xsl:apply-templates select="fields"/> </ff-event>


</xsl:template>
 
<xsl:template match="fields">
        <Event-Name><xsl:value-of select="Event-Name"/></Event-Name>


     <fields>
        <Event-Subclass><xsl:value-of select="Event-Subclass"/></Event-Subclass>
        <FreeSWITCH-IPv4><xsl:value-of select="FreeSWITCH-IPv4"/></FreeSWITCH-IPv4>
        <Event-Date-Timestamp><xsl:value-of select="Event-Date-Timestamp"/></Event-Date-Timestamp>
        <Body><xsl:value-of select="Body"/></Body>
     </fields>
</xsl:template>


</xsl:stylesheet>

