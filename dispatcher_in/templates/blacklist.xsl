<?xml version="1.0" ?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:output method="xml" indent="yes"/> 
 
<xsl:template match="/">

    <xsl:for-each select="event/headers[Event-Name='CHANNEL_STATE']">
 
      <xsl:if test="Channel-State='CS_NEW'">
        <Channel-State><xsl:value-of select="Channel-State"/></Channel-State>
      </xsl:if>

      <xsl:if test="Channel-State='CS_INIT'">
        <Channel-State><xsl:value-of select="Channel-State"/></Channel-State>
      </xsl:if>

      <xsl:if test="Channel-State='CS_EXECUTE'">
        <Channel-State><xsl:value-of select="Channel-State"/></Channel-State>
      </xsl:if>

      <xsl:if test="Channel-State='CS_HANGUP'">
        <Channel-State><xsl:value-of select="Channel-State"/></Channel-State>
      </xsl:if>

      <xsl:if test="Channel-State='CS_REPORTING'">
        <Channel-State><xsl:value-of select="Channel-State"/></Channel-State>
      </xsl:if>
    </xsl:for-each>
</xsl:template>
</xsl:stylesheet>
