#!/bin/bash
##### -*- mode:shell-script; indent-tabs-mode:nil; sh-basic-offset:2 -*-
##### Author: Travis Cross <tc@traviscross.com>

mod_dir="../src/mod"
conf_dir="../conf"
fs_description="FreeSWITCH is a scalable open source cross-platform telephony platform designed to route and interconnect popular communication protocols using audio, video, text or any other form of media."
mod_build_depends="."
supported_distros="squeeze wheezy sid"
avoid_mods=(
  applications/mod_fax
  applications/mod_limit
  applications/mod_mongo
  applications/mod_mp4
  applications/mod_osp
  applications/mod_rad_auth
  applications/mod_skel
  applications/mod_soundtouch
#  asr_tts/mod_cepstral
  asr_tts/mod_flite
  codecs/mod_com_g729
  codecs/mod_ilbc
  codecs/mod_sangoma_codec
  codecs/mod_siren
  codecs/mod_skel_codec
  codecs/mod_voipcodecs
#  endpoints/mod_gsmopen
  endpoints/mod_h323
  endpoints/mod_khomp
  endpoints/mod_opal
  endpoints/mod_reference
  endpoints/mod_unicall
  formats/mod_shout
  languages/mod_managed
  languages/mod_yaml
#  languages/mod_spidermonkey
  sdk/autotools
  xml_int/mod_xml_ldap
)
avoid_mods_sid=(
  endpoints/mod_portaudio
  formats/mod_portaudio_stream
)
avoid_mods_wheezy=(
  endpoints/mod_portaudio
  formats/mod_portaudio_stream
)
avoid_mods_squeeze=(
  formats/mod_vlc
  languages/mod_managed
)

err () {
  echo "$0 error: $1" >&2
  exit 1
}

xread () {
  local xIFS="$IFS"
  IFS=''
  read $@
  local ret=$?
  IFS="$xIFS"
  return $ret
}

avoid_mod_filter () {
  local x="avoid_mods_$codename[@]"
  local -a mods=("${avoid_mods[@]}" "${!x}")
  for x in "${mods[@]}"; do
    if [ "$1" = "$x" ]; then
      [ "$2" = "show" ] && echo "excluding module $x" >&2
      return 1
    fi
  done
  return 0
}

modconf_filter () {
  while xread l; do
    if [ "$1" = "$l" ]; then
      [ "$2" = "show" ] && echo "including module $l" >&2
      return 0
    fi
  done < modules.conf
  return 1
}

mod_filter () {
  if test -f modules.conf; then
    modconf_filter $@
  else
    avoid_mod_filter $@
  fi
}

mod_filter_show () {
  mod_filter "$1" show
}

map_fs_modules () {
  local filterfn="$1" percatfns="$2" permodfns="$3"
  for x in $mod_dir/*; do
    if test -d $x; then
      category=${x##*/} category_path=$x
      for f in $percatfns; do $f; done
      for y in $x/*; do
        module_name=${y##*/} module_path=$y
        module=$category/$module_name
        if $filterfn $category/$module; then
          [ -f ${y}/module ] && . ${y}/module
          for f in $permodfns; do $f; done
        fi
        unset module_name module_path module
      done
      unset category category_path
    fi
  done
}

map_modules () {
  local filterfn="$1" percatfns="$2" permodfns="$3"
  for x in $parse_dir/*; do
    test -d $x || continue
    category=${x##*/} category_path=$x
    for f in $percatfns; do $f; done
    for y in $x/*; do
      test -f $y || continue
      module=${y##*/} module_path=$y
      $filterfn $category/$module || continue
      module="" category="" module_name=""
      section="" description="" long_description=""
      build_depends="" depends="" recommends="" suggests=""
      distro_conflicts=""
      distro_vars=""
      for x in $supported_distros; do
        distro_vars="$distro_vars build_depends_$x"
        eval build_depends_$x=""
      done
      . $y
      [ -n "$description" ] || description="$module_name"
      [ -n "$long_description" ] || description="Adds ${module_name}."
      for f in $permodfns; do $f; done
      unset \
        module module_name module_path \
        section description long_description \
        build_depends depends recommends suggests \
        distro_conflicts $distro_vars
    done
    unset category category_path
  done
}

map_confs () {
  local fs="$1"
  for x in $conf_dir/*; do
    test ! -d $x && continue
    conf=${x##*/} conf_dir=$x
    for f in $fs; do $f; done
    unset conf conf_dir
  done
}

print_source_control () {
cat <<EOF
Source: freeswitch
Section: comm
Priority: optional
Maintainer: Travis Cross <tc@traviscross.com>
Build-Depends:
# for debian
 debhelper (>= 8.0.0),
# bootstrapping
 automake (>= 1.9), autoconf, libtool,
# core build
 dpkg-dev (>= 1.15.8.12), gcc (>= 4:4.4.5) , g++ (>= 4:4.4.5),
 libc6-dev (>= 2.11.3), make (>= 3.81),
 wget, pkg-config,
# configure options
 libssl-dev, unixodbc-dev,
 libncurses5-dev, libjpeg62-dev,
 python-dev, erlang-dev,
# documentation
 doxygen,
# for APR (not essential for build)
 uuid-dev, libexpat1-dev, libgdbm-dev, libdb-dev,
# used by many modules
 bison, zlib1g-dev,
# module build-depends
 $(debian_wrap "${mod_build_depends}")
Standards-Version: 3.9.3
Homepage: http://freeswitch.org/
Vcs-Git: git://git.freeswitch.org/freeswitch
Vcs-Browser: http://git.freeswitch.org/git/freeswitch/

EOF
}

print_core_control () {
cat <<EOF
Package: freeswitch
Architecture: any
Depends: \${shlibs:Depends}, \${perl:Depends}, \${misc:Depends},
 libfreeswitch1 (= \${binary:Version})
Recommends:
Suggests: freeswitch-dbg
Description: Cross-Platform Scalable Multi-Protocol Soft Switch
 $(debian_wrap "${fs_description}")
 .
 This package contains the FreeSWITCH core.

Package: libfreeswitch1
Architecture: any
Depends: \${shlibs:Depends}, \${misc:Depends}
Recommends:
Suggests: libfreeswitch1-dbg
Description: Cross-Platform Scalable Multi-Protocol Soft Switch
 $(debian_wrap "${fs_description}")
 .
 This package contains the FreeSWITCH core library.

Package: freeswitch-meta-bare
Architecture: any
Depends: \${misc:Depends}, freeswitch (= \${binary:Version})
Recommends:
 freeswitch-doc (= \${binary:Version}),
 freeswitch-mod-commands (= \${binary:Version}),
 freeswitch-init (= \${binary:Version}),
 freeswitch-music (= \${binary:Version}),
 freeswitch-sounds (= \${binary:Version})
Suggests:
Description: Cross-Platform Scalable Multi-Protocol Soft Switch
 $(debian_wrap "${fs_description}")
 .
 This is a metapackage which depends on the packages needed for a very
 bare FreeSWITCH install.

Package: freeswitch-meta-default
Architecture: any
Depends: \${misc:Depends}, freeswitch (= \${binary:Version}),
 freeswitch-mod-commands (= \${binary:Version}),
 freeswitch-mod-conference (= \${binary:Version}),
 freeswitch-mod-db (= \${binary:Version}),
 freeswitch-mod-dptools (= \${binary:Version}),
 freeswitch-mod-fifo (= \${binary:Version}),
 freeswitch-mod-hash (= \${binary:Version}),
 freeswitch-mod-spandsp (= \${binary:Version}),
 freeswitch-mod-voicemail (= \${binary:Version}),
 freeswitch-mod-dialplan-xml (= \${binary:Version}),
 freeswitch-mod-loopback (= \${binary:Version}),
 freeswitch-mod-sofia (= \${binary:Version}),
 freeswitch-mod-local-stream (= \${binary:Version}),
 freeswitch-mod-native-file (= \${binary:Version}),
 freeswitch-mod-tone-stream (= \${binary:Version}),
 freeswitch-mod-lua (= \${binary:Version}),
 freeswitch-mod-console (= \${binary:Version}),
 freeswitch-mod-say-en (= \${binary:Version})
Recommends:
 freeswitch-init (= \${binary:Version}),
 freeswitch-meta-codecs (= \${binary:Version}),
 freeswitch-music (= \${binary:Version}),
 freeswitch-sounds (= \${binary:Version})
Suggests:
 freeswitch-mod-cidlookup (= \${binary:Version}),
 freeswitch-mod-curl (= \${binary:Version}),
 freeswitch-mod-directory (= \${binary:Version}),
 freeswitch-mod-enum (= \${binary:Version}),
 freeswitch-mod-spy (= \${binary:Version}),
 freeswitch-mod-valet-parking (= \${binary:Version})
Description: Cross-Platform Scalable Multi-Protocol Soft Switch
 $(debian_wrap "${fs_description}")
 .
 This is a metapackage which depends on the packages needed for a
 reasonably basic FreeSWITCH install.

Package: freeswitch-meta-vanilla
Architecture: any
Depends: \${misc:Depends}, freeswitch (= \${binary:Version}),
 freeswitch-mod-console (= \${binary:Version}),
 freeswitch-mod-logfile (= \${binary:Version}),
 freeswitch-mod-enum (= \${binary:Version}),
 freeswitch-mod-cdr-csv (= \${binary:Version}),
 freeswitch-mod-event-socket (= \${binary:Version}),
 freeswitch-mod-sofia (= \${binary:Version}),
 freeswitch-mod-loopback (= \${binary:Version}),
 freeswitch-mod-commands (= \${binary:Version}),
 freeswitch-mod-conference (= \${binary:Version}),
 freeswitch-mod-db (= \${binary:Version}),
 freeswitch-mod-dptools (= \${binary:Version}),
 freeswitch-mod-expr (= \${binary:Version}),
 freeswitch-mod-fifo (= \${binary:Version}),
 freeswitch-mod-hash (= \${binary:Version}),
 freeswitch-mod-voicemail (= \${binary:Version}),
 freeswitch-mod-esf (= \${binary:Version}),
 freeswitch-mod-fsv (= \${binary:Version}),
 freeswitch-mod-cluechoo (= \${binary:Version}),
 freeswitch-mod-valet-parking (= \${binary:Version}),
 freeswitch-mod-httapi (= \${binary:Version}),
 freeswitch-mod-dialplan-xml (= \${binary:Version}),
 freeswitch-mod-dialplan-asterisk (= \${binary:Version}),
 freeswitch-mod-spandsp (= \${binary:Version}),
 freeswitch-mod-g723-1 (= \${binary:Version}),
 freeswitch-mod-g729 (= \${binary:Version}),
 freeswitch-mod-amr (= \${binary:Version}),
 freeswitch-mod-speex (= \${binary:Version}),
 freeswitch-mod-h26x (= \${binary:Version}),
 freeswitch-mod-sndfile (= \${binary:Version}),
 freeswitch-mod-native-file (= \${binary:Version}),
 freeswitch-mod-local-stream (= \${binary:Version}),
 freeswitch-mod-tone-stream (= \${binary:Version}),
 freeswitch-mod-lua (= \${binary:Version}),
 freeswitch-mod-say-en (= \${binary:Version}),
Recommends:
 freeswitch-init (= \${binary:Version}),
 freeswitch-music (= \${binary:Version}),
 freeswitch-sounds (= \${binary:Version}),
 freeswitch-conf-vanilla (= \${binary:Version}),
Suggests:
 freeswitch-mod-spidermonkey (= \${binary:Version}),
Description: Cross-Platform Scalable Multi-Protocol Soft Switch
 $(debian_wrap "${fs_description}")
 .
 This is a metapackage which depends on the packages needed for
 running the FreeSWITCH vanilla example configuration.

Package: freeswitch-meta-codecs
Architecture: any
Depends: \${misc:Depends}, freeswitch (= \${binary:Version}),
 freeswitch-mod-amr (= \${binary:Version}),
 freeswitch-mod-amrwb (= \${binary:Version}),
 freeswitch-mod-bv (= \${binary:Version}),
 freeswitch-mod-celt (= \${binary:Version}),
 freeswitch-mod-codec2 (= \${binary:Version}),
 freeswitch-mod-g723-1 (= \${binary:Version}),
 freeswitch-mod-g729 (= \${binary:Version}),
 freeswitch-mod-h26x (= \${binary:Version}),
 freeswitch-mod-mp4v (= \${binary:Version}),
 freeswitch-mod-opus (= \${binary:Version}),
 freeswitch-mod-silk (= \${binary:Version}),
 freeswitch-mod-spandsp (= \${binary:Version}),
 freeswitch-mod-speex (= \${binary:Version}),
 freeswitch-mod-theora (= \${binary:Version})
Suggests:
 freeswitch-mod-ilbc (= \${binary:Version}),
 freeswitch-mod-siren (= \${binary:Version})
Description: Cross-Platform Scalable Multi-Protocol Soft Switch
 $(debian_wrap "${fs_description}")
 .
 This is a metapackage which depends on the packages needed to install
 most FreeSWITCH codecs.

Package: freeswitch-dbg
Section: debug
Priority: extra
Architecture: any
Depends: \${misc:Depends}, freeswitch (= \${binary:Version})
Description: debugging symbols for FreeSWITCH
 $(debian_wrap "${fs_description}")
 .
 This package contains debugging symbols for FreeSWITCH.

Package: libfreeswitch1-dbg
Section: debug
Priority: extra
Architecture: any
Depends: \${misc:Depends}, libfreeswitch1 (= \${binary:Version})
Description: debugging symbols for FreeSWITCH
 $(debian_wrap "${fs_description}")
 .
 This package contains debugging symbols for libfreeswitch1.

Package: libfreeswitch-dev
Section: libdevel
Architecture: any
Depends: \${misc:Depends}, freeswitch
Description: development libraries and header files for FreeSWITCH
 $(debian_wrap "${fs_description}")
 .
 This package contains include files for FreeSWITCH.

Package: freeswitch-doc
Section: doc
Architecture: all
Depends: \${misc:Depends}
Description: documentation for FreeSWITCH
 $(debian_wrap "${fs_description}")
 .
 This package contains Doxygen-produce documentation for FreeSWITCH.
 It may be an empty package at the moment.

Package: freeswitch-init
Architecture: all
Depends: \${misc:Depends},
 freeswitch-sysvinit (= \${binary:Version}),
 freeswitch-systemd (= \${binary:Version})
Description: FreeSWITCH startup configuration
 $(debian_wrap "${fs_description}")
 .
 This is a metapackage which depends on the default system startup
 packages for FreeSWITCH.

Package: freeswitch-sysvinit
Architecture: all
Depends: \${misc:Depends}, lsb-base (>= 3.0-6)
Description: FreeSWITCH SysV init script
 $(debian_wrap "${fs_description}")
 .
 This package contains the SysV init script for FreeSWITCH.

Package: freeswitch-systemd
Architecture: all
Depends: \${misc:Depends}
Description: FreeSWITCH systemd configuration
 $(debian_wrap "${fs_description}")
 .
 This package contains the systemd configuration for FreeSWITCH.

## misc

## sounds

Package: freeswitch-music
Architecture: all
Depends: \${misc:Depends},
 freeswitch-music-default (>= 1.0.8)
Description: Music on hold audio for FreeSWITCH
 $(debian_wrap "${fs_description}")
 .
 This is a metapackage which depends on the default music on hold
 packages for FreeSWITCH.

Package: freeswitch-sounds
Architecture: all
Depends: \${misc:Depends},
 freeswitch-sounds-en (= \${binary:Version})
Description: Sounds for FreeSWITCH
 $(debian_wrap "${fs_description}")
 .
 This is a metapackage which depends on the default sound packages for
 FreeSWITCH.

Package: freeswitch-sounds-en
Architecture: all
Depends: \${misc:Depends},
 freeswitch-sounds-en-us (= \${binary:Version})
Description: English sounds for FreeSWITCH
 $(debian_wrap "${fs_description}")
 .
 This is a metapackage which depends on the default English sound
 packages for FreeSWITCH.

Package: freeswitch-sounds-en-us
Architecture: all
Depends: \${misc:Depends},
 freeswitch-sounds-en-us-callie (>= 1.0.18)
Description: US English sounds for FreeSWITCH
 $(debian_wrap "${fs_description}")
 .
 This is a metapackage which depends on the default US/English sound
 packages for FreeSWITCH.

EOF
}

print_mod_control () {
  local m_section="${section:-comm}"
  cat <<EOF
Package: freeswitch-${module_name//_/-}
Section: ${m_section}
Architecture: any
$(debian_wrap "Depends: \${shlibs:Depends}, \${misc:Depends}, freeswitch, ${depends}")
$(debian_wrap "Recommends: ${recommends}")
$(debian_wrap "Suggests: freeswitch-${module_name//_/-}-dbg, ${suggests}")
Description: ${description} for FreeSWITCH
 $(debian_wrap "${fs_description}")
 .
 $(debian_wrap "This package contains ${module_name} for FreeSWITCH.")
 .
 $(debian_wrap "${long_description}")

Package: freeswitch-${module_name//_/-}-dbg
Section: debug
Priority: extra
Architecture: any
Depends: \${misc:Depends},
 freeswitch-${module_name//_/-} (= \${binary:Version})
Description: ${description} for FreeSWITCH (debug)
 $(debian_wrap "${fs_description}")
 .
 $(debian_wrap "This package contains debugging symbols for ${module_name} for FreeSWITCH.")
 .
 $(debian_wrap "${long_description}")

EOF
}

print_spidermonkey_control() {
  local m_section="${section:-comm}"
  cat <<EOF
Package: freeswitch-${module_name//_/-}
Section: ${m_section}
Architecture: any
$(debian_wrap "Depends: \${shlibs:Depends}, \${misc:Depends}, freeswitch, ${depends}")
$(debian_wrap "Recommends: ${recommends}")
$(debian_wrap "Suggests: freeswitch-${module_name//_/-}-dbg, ${suggests}")
Description: ${description} for FreeSWITCH
 $(debian_wrap "${fs_description}")
 .
 $(debian_wrap "This package contains ${module_name} for FreeSWITCH.")
 .
 $(debian_wrap "${long_description}")

Package: freeswitch-${module_name//_/-}-dbg
Section: debug
Priority: extra
Architecture: any
Depends: \${misc:Depends},
 freeswitch-${module_name//_/-} (= \${binary:Version})
Description: ${description} for FreeSWITCH (debug)
 $(debian_wrap "${fs_description}")
 .
 $(debian_wrap "This package contains debugging symbols for ${module_name} for FreeSWITCH.")
 .
 $(debian_wrap "${long_description}")

Package: libctb
Architecture: any
Depends: \${shlibs:Depends}, \${misc:Depends}
Recommends:
Description: Cross-Platform Scalable Multi-Protocol Soft Switch
 $(debian_wrap "${fs_description}")
 .
 This package contains the FreeSWITCH ctb library required by mod_gsmopen.


Package: libjs1
Architecture: any
Depends: \${shlibs:Depends}, \${misc:Depends}
Recommends:
Description: Cross-Platform Scalable Multi-Protocol Soft Switch
 $(debian_wrap "${fs_description}")
 .
 This package contains the FreeSWITCH js library required by mod_spidermonkey.

EOF
}

print_mod_install () {
  cat <<EOF
/usr/lib/freeswitch/mod/${1}.so
EOF
}

print_spidermonkey_install () {
  cat <<EOF
/usr/lib/freeswitch/mod/mod_spidermonkey.so
/usr/lib/freeswitch/mod/mod_spidermonkey_core_db.so
/usr/lib/freeswitch/mod/mod_spidermonkey_curl.so
/usr/lib/freeswitch/mod/mod_spidermonkey_socket.so
/usr/lib/freeswitch/mod/mod_spidermonkey_teletone.so
EOF
}


print_long_filename_override () {
  local p="$1"
  cat <<EOF
# The long file names are caused by appending the nightly information.
# Since one of these packages will never end up on a Debian CD, the
# related problems with long file names will never come up here.
${p}: package-has-long-file-name *

EOF
}

print_gpl_openssl_override () {
  local p="$1"
  cat <<EOF
# We're definitely not doing this.  Nothing in FreeSWITCH has a more
# restrictive license than LGPL or MPL.
${p}: possible-gpl-code-linked-with-openssl

EOF
}

print_itp_override () {
  local p="$1"
  cat <<EOF
# We're not in Debian (yet) so we don't have an ITP bug to close.
${p}: new-package-should-close-itp-bug

EOF
}

print_common_overrides () {
  print_long_filename_override "$1"
}

print_mod_overrides () {
  print_common_overrides "$1"
  print_gpl_openssl_override "$1"
}

print_conf_overrides () {
  print_common_overrides "$1"
}

print_conf_control () {
  cat <<EOF
Package: freeswitch-conf-${conf//_/-}
Architecture: all
Depends: \${misc:Depends}
Description: FreeSWITCH ${conf} configuration
 $(debian_wrap "${fs_description}")
 .
 $(debian_wrap "This package contains the ${conf} configuration for FreeSWITCH.")

EOF
}

print_conf_install () {
  cat <<EOF
conf/${conf} /usr/share/freeswitch/conf
EOF
}

print_edit_warning () {
  echo "#### Do not edit!  This file is auto-generated from debian/bootstrap.sh."; echo
}

gencontrol_per_mod () {
  if [ $module_name = "mod_spidermonkey" ]; then
      print_spidermonkey_control "$module_name" "$description" "$long_description" >> control
  else
      print_mod_control "$module_name" "$description" "$long_description" >> control
  fi
 }

gencontrol_per_cat () {
  (echo "## mod/$category"; echo) >> control
}

geninstall_per_mod () {
  local f=freeswitch-${module_name//_/-}.install
  if [ $module_name = "mod_spidermonkey" ]; then
      (print_edit_warning; print_spidermonkey_install ) > $f
  else
      (print_edit_warning; print_mod_install "$module_name") > $f
  fi
  test -f $f.tmpl && cat $f.tmpl >> $f
}

genoverrides_per_mod () {
  local f=freeswitch-${module_name//_/-}.lintian-overrides
  (print_edit_warning; print_mod_overrides freeswitch-${module_name//_/-}) > $f
  test -f $f.tmpl && cat $f.tmpl >> $f
}

genmodules_per_cat () {
  echo "## $category" >> modules_.conf
}

genmodules_per_mod () {
  echo "$module" >> modules_.conf
}

genconf () {
  print_conf_control >> control
  local p=freeswitch-conf-${conf//_/-}
  local f=$p.install
  (print_edit_warning; print_conf_install) > $f
  test -f $f.tmpl && cat $f.tmpl >> $f
  local f=$p.lintian-overrides
  (print_edit_warning; print_conf_overrides "$p") > $f
  test -f $f.tmpl && cat $f.tmpl >> $f
}

accumulate_build_depends () {
  local x=""
  if [ -n "$(eval echo \$build_depends_$codename)" ]; then
    x="$(eval echo \$build_depends_$codename)"
  else
    x="${build_depends}"
  fi
  if [ -n "$x" ]; then
    if [ ! "$mod_build_depends" = "." ]; then
      mod_build_depends="${mod_build_depends}, ${x}"
    else
      mod_build_depends="${x}"
    fi
  fi
}

genmodctl_new_mod () {
  grep -e "^Module: ${module}$" control-modules >/dev/null && return 0
  cat <<EOF
Module: $module
Description: $description
 $long_description
EOF
  echo
}

genmodctl_new_cat () {
  grep -e "^## mod/${category}$" control-modules >/dev/null && return 0
  cat <<EOF
## mod/$category

EOF
}

pre_parse_mod_control () {
  local fl=true ll_nl=false ll_descr=false
  while xread l; do
    if [ -z "$l" ]; then
      # is newline
      if ! $ll_nl && ! $fl; then
        echo
      fi
      ll_nl=true
      continue
    elif [ -z "${l##\#*}" ]; then
      # is comment
      continue
    elif [ -z "${l## *}" ]; then
      # is continuation line
      if ! $ll_descr; then
        echo -n "$l"
      else
        echo -n "Long-Description: $(echo "$l" | sed -e 's/^ *//')"
      fi
    else
      # is header line
      $fl || echo
      if [ "${l%%:*}" = "Description" ]; then
        ll_descr=true
        echo "Description: ${l#*: }"
        continue
      else
        echo -n "$l"
      fi
    fi
    fl=false ll_nl=false ll_descr=false
  done < control-modules
}

var_escape () {
  (echo -n \'; echo -n "$1" | sed -e "s/'/'\\\\''/g"; echo -n \')
}

parse_mod_control () {
  pre_parse_mod_control > control-modules.preparse
  local category=""
  local module_name=""
  rm -rf $parse_dir
  while xread l; do
    if [ -z "$l" ]; then
      # is newline
      continue
    fi
    local header="${l%%:*}"
    local value="${l#*: }"
    if [ "$header" = "Module" ]; then
      category="${value%%/*}"
      module_name="${value#*/}"
      mkdir -p $parse_dir/$category
      (echo "module=$(var_escape "$value")"; \
        echo "category=$(var_escape "$category")"; \
        echo "module_name=$(var_escape "$module_name")"; \
        ) >> $parse_dir/$category/$module_name
    else
      ([ -n "$category" ] && [ -n "$module_name" ]) \
        || err "unexpected header $header"
      local var_name="$(echo "$header" | sed -e 's/-/_/g' | tr '[A-Z]' '[a-z]')"
      echo "${var_name}=$(var_escape "$value")" >> $parse_dir/$category/$module_name
    fi
  done < control-modules.preparse
}

debian_wrap () {
  local fl=true
  echo "$1" | fold -s -w 69 | while xread l; do
    local v="$(echo "$l" | sed -e 's/ *$//g')"
    if $fl; then
      fl=false
      echo "$v"
    else
      echo " $v"
    fi
  done
}

genmodctl_cat () {
  (echo "## mod/$category"; echo)
}

genmodctl_mod () {
  echo "Module: $module"
  [ -n "$section" ] && echo "Section: $section"
  echo "Description: $description"
  echo "$long_description" | fold -s -w 69 | while xread l; do
    local v="$(echo "$l" | sed -e 's/ *$//g')"
    echo " $v"
  done
  [ -n "$build_depends" ] && debian_wrap "Build-Depends: $build_depends"
  for x in $supported_distros; do
    [ -n "$(eval echo \$build_depends_$x)" ] \
      && debian_wrap "Build-Depends-$x: $(eval echo \$build_depends_$x)"
  done
  [ -n "$depends" ] && debian_wrap "Depends: $depends"
  [ -n "$reccomends" ] && debian_wrap "Recommends: $recommends"
  [ -n "$suggests" ] && debian_wrap "Suggests: $suggests"
  [ -n "$distro_conflicts" ] && debian_wrap "Distro-Conflicts: $distro_conflicts"
  echo
}

codename="sid"
while getopts "c:" o; do
  case "$o" in
    c) codename="$OPTARG" ;;
  esac
done
shift $(($OPTIND-1))

echo "Bootstrapping debian/ for ${codename}" >&2
echo >&2
echo "Please wait, this takes a few seconds..." >&2

echo "Adding any new modules to control-modules..." >&2
parse_dir=control-modules.parse
map_fs_modules ':' 'genmodctl_new_cat' 'genmodctl_new_mod' >> control-modules
echo "Parsing control-modules..." >&2
parse_mod_control
echo "Displaying includes/excludes..." >&2
map_modules 'mod_filter_show' '' ''
echo "Generating control-modules.gen as sanity check..." >&2
(echo "# -*- mode:debian-control -*-"; \
  echo "##### Author: Travis Cross <tc@traviscross.com>"; echo; \
  map_modules ':' 'genmodctl_cat' 'genmodctl_mod' \
  ) > control-modules.gen

echo "Accumulating build dependencies from modules..." >&2
map_modules 'mod_filter' '' 'accumulate_build_depends'
echo "Generating debian/..." >&2
> control
(print_edit_warning; print_source_control; print_core_control) >> control
echo "Generating debian/ (conf)..." >&2
(echo "### conf"; echo) >> control
map_confs 'genconf'
echo "Generating debian/ (modules)..." >&2
(echo "### modules"; echo) >> control
print_edit_warning > modules_.conf
map_modules "mod_filter" \
  "gencontrol_per_cat genmodules_per_cat" \
  "gencontrol_per_mod geninstall_per_mod genoverrides_per_mod genmodules_per_mod"

echo "Generating additional lintian overrides..." >&2
grep -e '^Package:' control | while xread l; do
  m="${l#*: }"
  f=$m.lintian-overrides
  [ -s $f ] || print_edit_warning >> $f
  if ! grep -e 'package-has-long-file-name' $f >/dev/null; then
    print_long_filename_override "$m" >> $f
  fi
  if ! grep -e 'new-package-should-close-itp-bug' $f >/dev/null; then
    print_itp_override "$m" >> $f
  fi
done
for p in freeswitch libfreeswitch1; do
  f=$p.lintian-overrides
  [ -s $f ] || print_edit_warning >> $f
  print_gpl_openssl_override "$p" >> $f
done

echo "Cleaning up..." >&2
rm -f control-modules.preparse
rm -rf control-modules.parse
diff control-modules control-modules.gen >/dev/null && rm -f control-modules.gen

echo "Done bootstrapping debian/" >&2
touch .stamp-bootstrap
