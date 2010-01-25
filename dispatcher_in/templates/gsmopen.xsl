<?xml version="1.0" ?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
<xsl:output method="xml" indent="yes"/> 
 
<xsl:template match="/">
       <event> 
        <Event-Name><xsl:value-of select="event/headers/Event-Name"/></Event-Name>
     <headers>
        <Event-Subclass><xsl:value-of select="event/headers/Event-Subclass"/></Event-Subclass>
        <Event-Date-Timestamp><xsl:value-of select="event/headers/Event-Date-Timestamp"/></Event-Date-Timestamp>
        <interface_name><xsl:value-of select="event/headers/interface_name"/></interface_name>
        <interface_id><xsl:value-of select="event/headers/interface_id"/></interface_id>
        <active><xsl:value-of select="event/headers/active"/></active>
        <not_registered><xsl:value-of select="event/headers/not_registered"/></not_registered>
        <home_network_registered><xsl:value-of select="event/headers/home_network_registered"/></home_network_registered>
        <roaming_registered><xsl:value-of select="event/headers/roaming_registered"/></roaming_registered>
        <got_signal><xsl:value-of select="event/headers/got_signal"/></got_signal>
        <running><xsl:value-of select="event/headers/running"/></running>
        <imei><xsl:value-of select="event/headers/imei"/></imei>
        <imsi><xsl:value-of select="event/headers/imsi"/></imsi>
        <controldev_dead><xsl:value-of select="event/headers/controldev_dead"/></controldev_dead>
        <controldevice_name><xsl:value-of select="event/headers/controldevice_name"/></controldevice_name>
        <no_sound><xsl:value-of select="event/headers/no_sound"/></no_sound>
        <playback_boost><xsl:value-of select="event/headers/playback_boost"/></playback_boost>
        <capture_boost><xsl:value-of select="event/headers/capture_boost"/></capture_boost>
        <ib_calls><xsl:value-of select="event/headers/ib_calls"/></ib_calls>
        <ob_calls><xsl:value-of select="event/headers/ob_calls"/></ob_calls>
        <ib_failed_calls><xsl:value-of select="event/headers/ib_failed_calls"/></ib_failed_calls>
        <ob_failed_calls><xsl:value-of select="event/headers/ob_failed_calls"/></ob_failed_calls>
        <interface_state><xsl:value-of select="event/headers/interface_state"/></interface_state>
        <phone_callflow><xsl:value-of select="event/headers/phone_callflow"/></phone_callflow>
        <during-call><xsl:value-of select="event/headers/during-call"/></during-call>
     </headers>
       </event> 
</xsl:template>
</xsl:stylesheet>
