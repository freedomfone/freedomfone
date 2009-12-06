MODNAME=mod_gsmopen
SVNDEF := -D'GSMOPEN_SVN_VERSION="$(shell svnversion -n .)"'
#LOCAL_CFLAGS += $(SVNDEF) -I/usr/src/gsmlib-1.10
LOCAL_CFLAGS += $(SVNDEF)
#LOCAL_LDFLAGS=-lasound -L/usr/src/gsmlib-1.10/gsmlib/.libs -lgsmme
LOCAL_LDFLAGS=-lasound -lgsmme
LOCAL_OBJS=gsmopen_protocol.o 
#OUR_OBJS += /usr/src/gsmlib-1.10/gsmlib/libgsmme.la
include $(BASE)/build/modmake.rules
