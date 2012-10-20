#autoreconf -fi (for yam)
rm -Rf debian/libjs1-dbg/usr/lib/debug
rm -Rf debian/libctb-dbg/usr/lib/debug
export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/usr/lib/i386-linux-gnu/
dpkg-buildpackage -b
