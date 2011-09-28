mkdir /dev/snd
mknod /dev/snd/controlC0 c 116 9
mknod /dev/snd/controlC1 c 116 6
mknod /dev/snd/pcmC0D0c c 116 8
mknod /dev/snd/pcmC1D0c c 116 5
mknod /dev/snd/pcmC0D0p c 116 7
mknod /dev/snd/pcmC1D0p c 116 4
mknod /dev/snd/seq c 116 3
mknod /dev/snd/timer c 116 2
chmod 660 /dev/snd/*
chown :audio /dev/snd/*
