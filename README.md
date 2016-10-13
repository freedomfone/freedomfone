Freedom Fone
=============

All the documentation is available in the documentation folder

The most common technical questions we receive are:

Can I connect any SIP gateway to Freedom Fone?
------------------------------------------------

If you want to four incoming GSM channels you can consider
using a SIP based GSM gateway like the 2N Telecommunications Office Route.

Freedom Fone has left the internal extensions 1000 to 1019
with password 1234 pre-configured so you can register
any other external SIP gateways.

If I install Freedom Fone from the ISO, can you SSH to the machine?
---------------------------------------------------------------------

For security reasons the ISO distribution does not have the SSH
server activated, to activate the ssh server open a Terminal
and run the command:

```
dpkg-reconfigure openssh-server
```

The dpkg-reconfigure command will create unique
cryptographic keys for your server.

Are the any special settings I need to consider?
--------------------------------------------------

From version 1.6.5 you do not need to edit any configuration
files.

 - Freedom Fone tries to auto-detect your network configuration.
 - Freedom Fone runs DHCP client by default but it is highly recommended to fix
   a IP address in your installation. Consider fixing the IP of the machine
   editing the network configuration files /etc/network/interfaces and do not
   really in Ubuntu's Network Manager.

As the Audio files are streamed to the web browser, fixing an IP
address will ensure that streaming works smoothly.

Go to Dashboard > Settings and select the appropriate IP for
your setup.

Freedom Fone supports three different setups:

 - *Standalone*
 The audio files can only be played from the local machine:
 Select 127.0.0.1

 - *LAN setup*
 The audio files are available to any computer in your local
 network:
 Select your internal IP (typically 192.168.x.x or 10.x.x.x)

 - *WAN setup (public internet)*
 The audio files are available to any computer in the world!
 Select your external IP (autodetected) and make sure that
 your router is port forwarding port 80 to your internal IP address

Enjoy Freedom Fone!
