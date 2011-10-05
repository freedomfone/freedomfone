#!/bin/bash
/usr/bin/find /opt/freedomfone/freeswitch/scripts/ .  -type f \( -name '*.mp3' -o -name '*.mp3' \) -exec /opt/freedomfone/sweeper/sweeper_audio_metadata.sh {} \;
