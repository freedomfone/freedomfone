MODNAME=mod_gsmopen
SVNDEF := -D'GSMOPEN_SVN_VERSION="$(shell svnversion -n .)"'
#LOCAL_CFLAGS += $(SVNDEF) -I/usr/src/gsmlib-1.10
LOCAL_CFLAGS += $(SVNDEF) -I$(BASE)/libs/spandsp/src -I$(BASE)/libs/tiff-3.8.2/libtiff
#LOCAL_LDFLAGS=-lasound -L/usr/src/gsmlib-1.10/gsmlib/.libs -lgsmme
LOCAL_LDFLAGS=-L$(BASE)/libs/spandsp/src -lasound -lgsmme -lspandsp
LOCAL_OBJS=gsmopen_protocol.o 
#OUR_OBJS += /usr/src/gsmlib-1.10/gsmlib/libgsmme.la
include $(BASE)/build/modmake.rules
