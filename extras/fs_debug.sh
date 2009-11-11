
Linux dell5150c 2.6.24-24-generic #1 SMP Sat Aug 22 01:06:14 UTC 2009 i686 GNU/Linux

== Log Output ==
2009-09-24 09:48:41.607208 [DEBUG] sofia.c:2169 tls-sip-port [5081]
2009-09-24 09:48:41.607236 [DEBUG] sofia.c:2169 tls-cert-dir [/usr/local/freeswitch/conf/ssl]
2009-09-24 09:48:41.607267 [DEBUG] sofia.c:2169 tls-version [tlsv1]
2009-09-24 09:48:41.607392 [NOTICE] sofia_reg.c:2080 Added gateway 'example.com' to profile 'external'
2009-09-24 09:48:41.607525 [DEBUG] sofia.c:822 Creating agent for external
2009-09-24 09:48:41.610991 [NOTICE] sofia.c:2877 Started Profile external [sofia_reg_external]
2009-09-24 09:48:41.611042 [DEBUG] sofia.c:2169 debug [0]
2009-09-24 09:48:41.611069 [DEBUG] sofia.c:2169 sip-trace [no]
2009-09-24 09:48:41.611104 [DEBUG] sofia.c:2169 context [public]
2009-09-24 09:48:41.611133 [DEBUG] sofia.c:2169 rfc2833-pt [101]
2009-09-24 09:48:41.611160 [DEBUG] sofia.c:2169 sip-port [5060]
2009-09-24 09:48:41.611196 [DEBUG] sofia.c:2169 dialplan [XML]
2009-09-24 09:48:41.611224 [DEBUG] sofia.c:2169 dtmf-duration [100]
2009-09-24 09:48:41.611253 [DEBUG] sofia.c:2605 Duration out of bounds, using default of 2000!
2009-09-24 09:48:41.611279 [DEBUG] sofia.c:2169 codec-prefs [G7221@32000h,G7221@16000h,G722,PCMU,PCMA,GSM]
2009-09-24 09:48:41.611310 [DEBUG] sofia.c:2169 use-rtp-timer [true]
2009-09-24 09:48:41.611339 [DEBUG] sofia.c:2169 rtp-timer-name [soft]
2009-09-24 09:48:41.611366 [DEBUG] sofia.c:2169 rtp-ip [::1]
2009-09-24 09:48:41.611392 [DEBUG] sofia.c:2169 sip-ip [::1]
2009-09-24 09:48:41.611419 [DEBUG] sofia.c:2169 hold-music [local_stream://moh]
2009-09-24 09:48:41.611446 [DEBUG] sofia.c:2169 apply-inbound-acl [domains]
2009-09-24 09:48:41.611475 [DEBUG] sofia.c:2169 record-template [/usr/local/freeswitch/recordings/${caller_id_number}.${strftime(%Y-%m-%d-%H-%M-%S)}.wav]
2009-09-24 09:48:41.611502 [DEBUG] sofia.c:2169 manage-presence [true]
2009-09-24 09:48:41.611529 [DEBUG] sofia.c:2169 inbound-codec-negotiation [generous]
2009-09-24 09:48:41.611556 [DEBUG] sofia.c:2169 tls [false]
2009-09-24 09:48:41.611584 [DEBUG] sofia.c:2169 tls-bind-params [transport=tls]
2009-09-24 09:48:41.611613 [DEBUG] sofia.c:2169 tls-sip-port [5061]
2009-09-24 09:48:41.611642 [DEBUG] sofia.c:2169 tls-cert-dir [/usr/local/freeswitch/conf/ssl]
2009-09-24 09:48:41.611671 [DEBUG] sofia.c:2169 tls-version [tlsv1]
2009-09-24 09:48:41.611722 [DEBUG] sofia.c:2169 nonce-ttl [60]
2009-09-24 09:48:41.611751 [DEBUG] sofia.c:2169 auth-calls [true]
2009-09-24 09:48:41.611779 [DEBUG] sofia.c:2169 auth-all-packets [false]
2009-09-24 09:48:41.611808 [DEBUG] sofia.c:2169 rtp-timeout-sec [300]
2009-09-24 09:48:41.611914 [DEBUG] sofia.c:2169 rtp-hold-timeout-sec [1800]
2009-09-24 09:48:41.611944 [DEBUG] sofia.c:2169 force-register-domain [192.168.46.15]
2009-09-24 09:48:41.611972 [DEBUG] sofia.c:2169 force-register-db-domain [192.168.46.15]
2009-09-24 09:48:41.612074 [DEBUG] sofia.c:822 Creating agent for internal-ipv6
2009-09-24 09:48:41.615712 [NOTICE] sofia.c:2877 Started Profile internal-ipv6 [sofia_reg_internal-ipv6]
2009-09-24 09:48:41.615807 [DEBUG] sofia.c:2169 debug [0]
2009-09-24 09:48:41.615839 [DEBUG] sofia.c:2169 sip-trace [no]
2009-09-24 09:48:41.615882 [DEBUG] sofia.c:2169 context [public]
2009-09-24 09:48:41.615912 [DEBUG] sofia.c:2169 rfc2833-pt [101]
2009-09-24 09:48:41.615938 [DEBUG] sofia.c:2169 sip-port [5060]
2009-09-24 09:48:41.615964 [DEBUG] sofia.c:2169 dialplan [XML]
2009-09-24 09:48:41.615993 [DEBUG] sofia.c:2169 dtmf-duration [100]
2009-09-24 09:48:41.616022 [DEBUG] sofia.c:2605 Duration out of bounds, using default of 2000!
2009-09-24 09:48:41.616049 [DEBUG] sofia.c:2169 codec-prefs [GSM,PCMU]
2009-09-24 09:48:41.616078 [DEBUG] sofia.c:2169 rtp-timer-name [soft]
2009-09-24 09:48:41.616106 [DEBUG] sofia.c:2169 rtp-ip [192.168.46.15]
2009-09-24 09:48:41.616133 [DEBUG] sofia.c:2169 sip-ip [192.168.46.15]
2009-09-24 09:48:41.616161 [DEBUG] sofia.c:2169 hold-music [local_stream://moh]
2009-09-24 09:48:41.616188 [DEBUG] sofia.c:2169 apply-nat-acl [nat.auto]
2009-09-24 09:48:41.616219 [DEBUG] sofia.c:2169 apply-inbound-acl [domains]
2009-09-24 09:48:41.616249 [DEBUG] sofia.c:2169 local-network-acl [localnet.auto]
2009-09-24 09:48:41.616276 [DEBUG] sofia.c:2169 record-template [/usr/local/freeswitch/recordings/${caller_id_number}.${target_domain}.${strftime(%Y-%m-%d-%H-%M-%S)}.wav]
2009-09-24 09:48:41.616303 [DEBUG] sofia.c:2169 manage-presence [true]
2009-09-24 09:48:41.616330 [DEBUG] sofia.c:2169 inbound-codec-negotiation [generous]
2009-09-24 09:48:41.616358 [DEBUG] sofia.c:2169 tls [false]
2009-09-24 09:48:41.616387 [DEBUG] sofia.c:2169 tls-bind-params [transport=tls]
2009-09-24 09:48:41.616415 [DEBUG] sofia.c:2169 tls-sip-port [5061]
2009-09-24 09:48:41.616444 [DEBUG] sofia.c:2169 tls-cert-dir [/usr/local/freeswitch/conf/ssl]
2009-09-24 09:48:41.616473 [DEBUG] sofia.c:2169 tls-version [tlsv1]
2009-09-24 09:48:41.616502 [DEBUG] sofia.c:2169 accept-blind-reg [true]
2009-09-24 09:48:41.616531 [DEBUG] sofia.c:2169 accept-blind-auth [true]
2009-09-24 09:48:41.616559 [DEBUG] sofia.c:2169 suppress-cng [true]
2009-09-24 09:48:41.616587 [DEBUG] sofia.c:2169 nonce-ttl [60]
2009-09-24 09:48:41.616615 [DEBUG] sofia.c:2169 disable-transcoding [false]
2009-09-24 09:48:41.616643 [DEBUG] sofia.c:2169 auth-calls [false]
2009-09-24 09:48:41.616671 [DEBUG] sofia.c:2169 inbound-reg-force-matching-username [true]
2009-09-24 09:48:41.616700 [DEBUG] sofia.c:2169 auth-all-packets [false]
2009-09-24 09:48:41.616728 [DEBUG] sofia.c:2169 ext-rtp-ip [auto]
2009-09-24 09:48:41.616757 [DEBUG] sofia.c:2169 ext-sip-ip [auto]
2009-09-24 09:48:41.616785 [DEBUG] sofia.c:2169 rtp-timeout-sec [300]
2009-09-24 09:48:41.616813 [DEBUG] sofia.c:2169 rtp-hold-timeout-sec [1800]
2009-09-24 09:48:41.616841 [DEBUG] sofia.c:2169 force-register-domain [192.168.46.15]
2009-09-24 09:48:41.616870 [DEBUG] sofia.c:2169 force-register-db-domain [192.168.46.15]
2009-09-24 09:48:41.616899 [DEBUG] sofia.c:2169 challenge-realm [auto_from]
2009-09-24 09:48:41.616991 [NOTICE] sofia.c:1524 Adding Alias [192.168.46.15] for profile [internal]
2009-09-24 09:48:41.617134 [DEBUG] sofia.c:822 Creating agent for internal
2009-09-24 09:48:41.617405 [DEBUG] sofia.c:878 Created agent for internal-ipv6
2009-09-24 09:48:41.617616 [DEBUG] sofia.c:915 Set params for internal-ipv6
2009-09-24 09:48:41.617732 [DEBUG] sofia.c:936 Activated db for internal-ipv6
2009-09-24 09:48:41.618288 [NOTICE] sofia.c:2877 Started Profile internal [sofia_reg_internal]
2009-09-24 09:48:41.619742 [DEBUG] mod_sofia.c:3378 Waiting for profiles to start
2009-09-24 09:48:41.619775 [DEBUG] sofia.c:963 Starting thread for internal-ipv6
2009-09-24 09:48:41.627428 [DEBUG] sofia.c:878 Created agent for external
2009-09-24 09:48:41.627654 [DEBUG] sofia.c:915 Set params for external
2009-09-24 09:48:41.627668 [DEBUG] sofia.c:936 Activated db for external
2009-09-24 09:48:41.627727 [DEBUG] sofia.c:963 Starting thread for external
2009-09-24 09:48:41.667876 [DEBUG] sofia.c:878 Created agent for internal
2009-09-24 09:48:41.668154 [DEBUG] sofia.c:915 Set params for internal
2009-09-24 09:48:41.668167 [DEBUG] sofia.c:936 Activated db for internal
2009-09-24 09:48:41.669855 [DEBUG] sofia.c:963 Starting thread for internal
2009-09-24 09:48:43.135798 [NOTICE] switch_loadable_module.c:142 Adding Endpoint 'sofia'
2009-09-24 09:48:43.135851 [NOTICE] switch_loadable_module.c:270 Adding API Function 'sofia'
2009-09-24 09:48:43.135899 [NOTICE] switch_loadable_module.c:270 Adding API Function 'sofia_gateway_data'
2009-09-24 09:48:43.135946 [NOTICE] switch_loadable_module.c:270 Adding API Function 'sofia_contact'
2009-09-24 09:48:43.135996 [NOTICE] switch_loadable_module.c:375 Adding Chat interface 'sip'
2009-09-24 09:48:43.136038 [NOTICE] switch_loadable_module.c:419 Adding Management interface 'mod_sofia' OID[.1.3.6.1.4.1.27880.1]
2009-09-24 09:48:43.136361 [NOTICE] switch_loadable_module.c:142 Adding Endpoint 'loopback'
2009-09-24 09:48:43.269611 [NOTICE] switch_loadable_module.c:270 Adding API Function 'group_call'
2009-09-24 09:48:43.269672 [NOTICE] switch_loadable_module.c:270 Adding API Function 'in_group'
2009-09-24 09:48:43.269721 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_flush_dtmf'
2009-09-24 09:48:43.269763 [NOTICE] switch_loadable_module.c:270 Adding API Function 'md5'
2009-09-24 09:48:43.269804 [NOTICE] switch_loadable_module.c:270 Adding API Function 'hupall'
2009-09-24 09:48:43.269843 [NOTICE] switch_loadable_module.c:270 Adding API Function 'strftime_tz'
2009-09-24 09:48:43.269886 [NOTICE] switch_loadable_module.c:270 Adding API Function 'originate'
2009-09-24 09:48:43.269931 [NOTICE] switch_loadable_module.c:270 Adding API Function 'tone_detect'
2009-09-24 09:48:43.269978 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_kill'
2009-09-24 09:48:43.270021 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_park'
2009-09-24 09:48:43.270064 [NOTICE] switch_loadable_module.c:270 Adding API Function 'reloadacl'
2009-09-24 09:48:43.270103 [NOTICE] switch_loadable_module.c:270 Adding API Function 'reloadxml'
2009-09-24 09:48:43.270144 [NOTICE] switch_loadable_module.c:270 Adding API Function 'unload'
2009-09-24 09:48:43.270188 [NOTICE] switch_loadable_module.c:270 Adding API Function 'reload'
2009-09-24 09:48:43.270231 [NOTICE] switch_loadable_module.c:270 Adding API Function 'load'
2009-09-24 09:48:43.270272 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_transfer'
2009-09-24 09:48:43.270312 [NOTICE] switch_loadable_module.c:270 Adding API Function 'pause'
2009-09-24 09:48:43.270352 [NOTICE] switch_loadable_module.c:270 Adding API Function 'break'
2009-09-24 09:48:43.270391 [NOTICE] switch_loadable_module.c:270 Adding API Function 'show'
2009-09-24 09:48:43.270437 [NOTICE] switch_loadable_module.c:270 Adding API Function 'complete'
2009-09-24 09:48:43.270481 [NOTICE] switch_loadable_module.c:270 Adding API Function 'alias'
2009-09-24 09:48:43.270520 [NOTICE] switch_loadable_module.c:270 Adding API Function 'status'
2009-09-24 09:48:43.270563 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_session_heartbeat'
2009-09-24 09:48:43.270616 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_bridge'
2009-09-24 09:48:43.270669 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_setvar'
2009-09-24 09:48:43.270743 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_setvar_multi'
2009-09-24 09:48:43.270789 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_getvar'
2009-09-24 09:48:43.270830 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_exists'
2009-09-24 09:48:43.270861 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_dump'
2009-09-24 09:48:43.270900 [NOTICE] switch_loadable_module.c:270 Adding API Function 'global_setvar'
2009-09-24 09:48:43.270949 [NOTICE] switch_loadable_module.c:270 Adding API Function 'global_getvar'
2009-09-24 09:48:43.270992 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_displace'
2009-09-24 09:48:43.271036 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_record'
2009-09-24 09:48:43.271076 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_broadcast'
2009-09-24 09:48:43.271125 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_hold'
2009-09-24 09:48:43.271163 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_display'
2009-09-24 09:48:43.271205 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_media'
2009-09-24 09:48:43.271240 [NOTICE] switch_loadable_module.c:270 Adding API Function 'fsctl'
2009-09-24 09:48:43.271279 [NOTICE] switch_loadable_module.c:270 Adding API Function 'help'
2009-09-24 09:48:43.271334 [NOTICE] switch_loadable_module.c:270 Adding API Function 'version'
2009-09-24 09:48:43.271374 [NOTICE] switch_loadable_module.c:270 Adding API Function 'sched_hangup'
2009-09-24 09:48:43.271411 [NOTICE] switch_loadable_module.c:270 Adding API Function 'sched_broadcast'
2009-09-24 09:48:43.271455 [NOTICE] switch_loadable_module.c:270 Adding API Function 'sched_transfer'
2009-09-24 09:48:43.271496 [NOTICE] switch_loadable_module.c:270 Adding API Function 'create_uuid'
2009-09-24 09:48:43.271535 [NOTICE] switch_loadable_module.c:270 Adding API Function 'sched_api'
2009-09-24 09:48:43.271577 [NOTICE] switch_loadable_module.c:270 Adding API Function 'unsched_api'
2009-09-24 09:48:43.271621 [NOTICE] switch_loadable_module.c:270 Adding API Function 'bgapi'
2009-09-24 09:48:43.271663 [NOTICE] switch_loadable_module.c:270 Adding API Function 'sched_del'
2009-09-24 09:48:43.271706 [NOTICE] switch_loadable_module.c:270 Adding API Function 'xml_wrap'
2009-09-24 09:48:43.271745 [NOTICE] switch_loadable_module.c:270 Adding API Function 'is_lan_addr'
2009-09-24 09:48:43.271791 [NOTICE] switch_loadable_module.c:270 Adding API Function 'cond'
2009-09-24 09:48:43.271872 [NOTICE] switch_loadable_module.c:270 Adding API Function 'regex'
2009-09-24 09:48:43.271936 [NOTICE] switch_loadable_module.c:270 Adding API Function 'acl'
2009-09-24 09:48:43.271999 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_chat'
2009-09-24 09:48:43.272061 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_deflect'
2009-09-24 09:48:43.272123 [NOTICE] switch_loadable_module.c:270 Adding API Function 'find_user_xml'
2009-09-24 09:48:43.272187 [NOTICE] switch_loadable_module.c:270 Adding API Function 'user_exists'
2009-09-24 09:48:43.272262 [NOTICE] switch_loadable_module.c:270 Adding API Function 'xml_locate'
2009-09-24 09:48:43.272323 [NOTICE] switch_loadable_module.c:270 Adding API Function 'user_data'
2009-09-24 09:48:43.272384 [NOTICE] switch_loadable_module.c:270 Adding API Function 'url_encode'
2009-09-24 09:48:43.272448 [NOTICE] switch_loadable_module.c:270 Adding API Function 'url_decode'
2009-09-24 09:48:43.272510 [NOTICE] switch_loadable_module.c:270 Adding API Function 'module_exists'
2009-09-24 09:48:43.272574 [NOTICE] switch_loadable_module.c:270 Adding API Function 'domain_exists'
2009-09-24 09:48:43.272638 [NOTICE] switch_loadable_module.c:270 Adding API Function 'uuid_send_dtmf'
2009-09-24 09:48:43.272701 [NOTICE] switch_loadable_module.c:270 Adding API Function 'eval'
2009-09-24 09:48:43.272763 [NOTICE] switch_loadable_module.c:270 Adding API Function 'expand'
2009-09-24 09:48:43.272825 [NOTICE] switch_loadable_module.c:270 Adding API Function 'echo'
2009-09-24 09:48:43.272886 [NOTICE] switch_loadable_module.c:270 Adding API Function 'stun'
2009-09-24 09:48:43.272948 [NOTICE] switch_loadable_module.c:270 Adding API Function 'system'
2009-09-24 09:48:43.273031 [NOTICE] switch_loadable_module.c:270 Adding API Function 'bg_system'
2009-09-24 09:48:43.273094 [NOTICE] switch_loadable_module.c:270 Adding API Function 'time_test'
2009-09-24 09:48:43.273156 [NOTICE] switch_loadable_module.c:270 Adding API Function 'nat_map'
2009-09-24 09:48:43.273218 [NOTICE] switch_loadable_module.c:270 Adding API Function 'host_lookup'
2009-09-24 09:48:43.288059 [NOTICE] switch_loadable_module.c:248 Adding Application 'conference'
2009-09-24 09:48:43.288129 [NOTICE] switch_loadable_module.c:248 Adding Application 'conference_set_auto_outcall'
2009-09-24 09:48:43.288233 [NOTICE] switch_loadable_module.c:270 Adding API Function 'conference'
2009-09-24 09:48:43.288299 [NOTICE] switch_loadable_module.c:375 Adding Chat interface 'conf'
2009-09-24 09:48:43.288745 [NOTICE] switch_loadable_module.c:142 Adding Endpoint 'error'
2009-09-24 09:48:43.288809 [NOTICE] switch_loadable_module.c:142 Adding Endpoint 'group'
2009-09-24 09:48:43.288873 [NOTICE] switch_loadable_module.c:142 Adding Endpoint 'user'
2009-09-24 09:48:43.288930 [NOTICE] switch_loadable_module.c:208 Adding Dialplan 'inline'
2009-09-24 09:48:43.288988 [NOTICE] switch_loadable_module.c:248 Adding Application 'privacy'
2009-09-24 09:48:43.289050 [NOTICE] switch_loadable_module.c:248 Adding Application 'flush_dtmf'
2009-09-24 09:48:43.289108 [NOTICE] switch_loadable_module.c:248 Adding Application 'hold'
2009-09-24 09:48:43.289165 [NOTICE] switch_loadable_module.c:248 Adding Application 'unhold'
2009-09-24 09:48:43.289226 [NOTICE] switch_loadable_module.c:248 Adding Application 'transfer'
2009-09-24 09:48:43.289286 [NOTICE] switch_loadable_module.c:248 Adding Application 'check_acl'
2009-09-24 09:48:43.289344 [NOTICE] switch_loadable_module.c:248 Adding Application 'verbose_events'
2009-09-24 09:48:43.289407 [NOTICE] switch_loadable_module.c:248 Adding Application 'sleep'
2009-09-24 09:48:43.289465 [NOTICE] switch_loadable_module.c:248 Adding Application 'delay_echo'
2009-09-24 09:48:43.289523 [NOTICE] switch_loadable_module.c:248 Adding Application 'strftime'
2009-09-24 09:48:43.289591 [NOTICE] switch_loadable_module.c:248 Adding Application 'phrase'
2009-09-24 09:48:43.289650 [NOTICE] switch_loadable_module.c:248 Adding Application 'eval'
2009-09-24 09:48:43.289708 [NOTICE] switch_loadable_module.c:248 Adding Application 'pre_answer'
2009-09-24 09:48:43.289777 [NOTICE] switch_loadable_module.c:248 Adding Application 'answer'
2009-09-24 09:48:43.289838 [NOTICE] switch_loadable_module.c:248 Adding Application 'hangup'
2009-09-24 09:48:43.289896 [NOTICE] switch_loadable_module.c:248 Adding Application 'set_name'
2009-09-24 09:48:43.289952 [NOTICE] switch_loadable_module.c:248 Adding Application 'presence'
2009-09-24 09:48:43.290019 [NOTICE] switch_loadable_module.c:248 Adding Application 'log'
2009-09-24 09:48:43.290077 [NOTICE] switch_loadable_module.c:248 Adding Application 'info'
2009-09-24 09:48:43.290134 [NOTICE] switch_loadable_module.c:248 Adding Application 'event'
2009-09-24 09:48:43.290201 [NOTICE] switch_loadable_module.c:248 Adding Application 'sound_test'
2009-09-24 09:48:43.290258 [NOTICE] switch_loadable_module.c:248 Adding Application 'export'
2009-09-24 09:48:43.290316 [NOTICE] switch_loadable_module.c:248 Adding Application 'set'
2009-09-24 09:48:43.290382 [NOTICE] switch_loadable_module.c:248 Adding Application 'set_global'
2009-09-24 09:48:43.290441 [NOTICE] switch_loadable_module.c:248 Adding Application 'set_profile_var'
2009-09-24 09:48:43.290501 [NOTICE] switch_loadable_module.c:248 Adding Application 'unset'
2009-09-24 09:48:43.290568 [NOTICE] switch_loadable_module.c:248 Adding Application 'ring_ready'
2009-09-24 09:48:43.290626 [NOTICE] switch_loadable_module.c:248 Adding Application 'remove_bugs'
2009-09-24 09:48:43.290684 [NOTICE] switch_loadable_module.c:248 Adding Application 'break'
2009-09-24 09:48:43.290790 [NOTICE] switch_loadable_module.c:248 Adding Application 'detect_speech'
2009-09-24 09:48:43.290851 [NOTICE] switch_loadable_module.c:248 Adding Application 'ivr'
2009-09-24 09:48:43.290929 [NOTICE] switch_loadable_module.c:248 Adding Application 'redirect'
2009-09-24 09:48:43.290997 [NOTICE] switch_loadable_module.c:248 Adding Application 'send_display'
2009-09-24 09:48:43.291055 [NOTICE] switch_loadable_module.c:248 Adding Application 'respond'
2009-09-24 09:48:43.291112 [NOTICE] switch_loadable_module.c:248 Adding Application 'deflect'
2009-09-24 09:48:43.291179 [NOTICE] switch_loadable_module.c:248 Adding Application 'queue_dtmf'
2009-09-24 09:48:43.291238 [NOTICE] switch_loadable_module.c:248 Adding Application 'send_dtmf'
2009-09-24 09:48:43.291295 [NOTICE] switch_loadable_module.c:248 Adding Application 'sched_hangup'
2009-09-24 09:48:43.291361 [NOTICE] switch_loadable_module.c:248 Adding Application 'sched_broadcast'
2009-09-24 09:48:43.291421 [NOTICE] switch_loadable_module.c:248 Adding Application 'sched_transfer'
2009-09-24 09:48:43.291480 [NOTICE] switch_loadable_module.c:248 Adding Application 'execute_extension'
2009-09-24 09:48:43.291548 [NOTICE] switch_loadable_module.c:248 Adding Application 'sched_heartbeat'
2009-09-24 09:48:43.291609 [NOTICE] switch_loadable_module.c:248 Adding Application 'enable_heartbeat'
2009-09-24 09:48:43.291688 [NOTICE] switch_loadable_module.c:248 Adding Application 'mkdir'
2009-09-24 09:48:43.291751 [NOTICE] switch_loadable_module.c:248 Adding Application 'soft_hold'
2009-09-24 09:48:43.291815 [NOTICE] switch_loadable_module.c:248 Adding Application 'bind_meta_app'
2009-09-24 09:48:43.291880 [NOTICE] switch_loadable_module.c:248 Adding Application 'unbind_meta_app'
2009-09-24 09:48:43.291944 [NOTICE] switch_loadable_module.c:248 Adding Application 'intercept'
2009-09-24 09:48:43.292008 [NOTICE] switch_loadable_module.c:248 Adding Application 'eavesdrop'
2009-09-24 09:48:43.292072 [NOTICE] switch_loadable_module.c:248 Adding Application 'three_way'
2009-09-24 09:48:43.292133 [NOTICE] switch_loadable_module.c:248 Adding Application 'set_user'
2009-09-24 09:48:43.292193 [NOTICE] switch_loadable_module.c:248 Adding Application 'stop_dtmf'
2009-09-24 09:48:43.292260 [NOTICE] switch_loadable_module.c:248 Adding Application 'start_dtmf'
2009-09-24 09:48:43.292328 [NOTICE] switch_loadable_module.c:248 Adding Application 'stop_dtmf_generate'
2009-09-24 09:48:43.292399 [NOTICE] switch_loadable_module.c:248 Adding Application 'start_dtmf_generate'
2009-09-24 09:48:43.292466 [NOTICE] switch_loadable_module.c:248 Adding Application 'stop_tone_detect'
2009-09-24 09:48:43.292528 [NOTICE] switch_loadable_module.c:248 Adding Application 'fax_detect'
2009-09-24 09:48:43.292584 [NOTICE] switch_loadable_module.c:248 Adding Application 'tone_detect'
2009-09-24 09:48:43.292640 [NOTICE] switch_loadable_module.c:248 Adding Application 'echo'
2009-09-24 09:48:43.292713 [NOTICE] switch_loadable_module.c:248 Adding Application 'park'
2009-09-24 09:48:43.292775 [NOTICE] switch_loadable_module.c:248 Adding Application 'park_state'
2009-09-24 09:48:43.292884 [NOTICE] switch_loadable_module.c:248 Adding Application 'gentones'
2009-09-24 09:48:43.292945 [NOTICE] switch_loadable_module.c:248 Adding Application 'playback'
2009-09-24 09:48:43.293007 [NOTICE] switch_loadable_module.c:248 Adding Application 'att_xfer'
2009-09-24 09:48:43.293068 [NOTICE] switch_loadable_module.c:248 Adding Application 'read'
2009-09-24 09:48:43.293129 [NOTICE] switch_loadable_module.c:248 Adding Application 'play_and_get_digits'
2009-09-24 09:48:43.293192 [NOTICE] switch_loadable_module.c:248 Adding Application 'stop_record_session'
2009-09-24 09:48:43.293262 [NOTICE] switch_loadable_module.c:248 Adding Application 'record_session'
2009-09-24 09:48:43.293324 [NOTICE] switch_loadable_module.c:248 Adding Application 'record'
2009-09-24 09:48:43.293385 [NOTICE] switch_loadable_module.c:248 Adding Application 'stop_displace_session'
2009-09-24 09:48:43.293448 [NOTICE] switch_loadable_module.c:248 Adding Application 'displace_session'
2009-09-24 09:48:43.293512 [NOTICE] switch_loadable_module.c:248 Adding Application 'speak'
2009-09-24 09:48:43.293573 [NOTICE] switch_loadable_module.c:248 Adding Application 'clear_speech_cache'
2009-09-24 09:48:43.293651 [NOTICE] switch_loadable_module.c:248 Adding Application 'bridge'
2009-09-24 09:48:43.293712 [NOTICE] switch_loadable_module.c:248 Adding Application 'system'
2009-09-24 09:48:43.293773 [NOTICE] switch_loadable_module.c:248 Adding Application 'say'
2009-09-24 09:48:43.293835 [NOTICE] switch_loadable_module.c:248 Adding Application 'wait_for_silence'
2009-09-24 09:48:43.293898 [NOTICE] switch_loadable_module.c:270 Adding API Function 'strepoch'
2009-09-24 09:48:43.293960 [NOTICE] switch_loadable_module.c:270 Adding API Function 'chat'
2009-09-24 09:48:43.294022 [NOTICE] switch_loadable_module.c:270 Adding API Function 'strftime'
2009-09-24 09:48:43.294084 [NOTICE] switch_loadable_module.c:270 Adding API Function 'presence'
2009-09-24 09:48:43.294145 [NOTICE] switch_loadable_module.c:375 Adding Chat interface 'event'
2009-09-24 09:48:43.294206 [NOTICE] switch_loadable_module.c:375 Adding Chat interface 'api'
2009-09-24 09:48:43.294471 [NOTICE] switch_loadable_module.c:270 Adding API Function 'expr'
2009-09-24 09:48:43.355245 [INFO] mod_fifo.c:2023 cool_fifo@192.168.46.15 configured
2009-09-24 09:48:43.355394 [NOTICE] switch_loadable_module.c:248 Adding Application 'fifo'
2009-09-24 09:48:43.355480 [NOTICE] switch_loadable_module.c:270 Adding API Function 'fifo'
2009-09-24 09:48:43.355547 [NOTICE] switch_loadable_module.c:270 Adding API Function 'fifo_member'
2009-09-24 09:48:43.355612 [NOTICE] switch_loadable_module.c:270 Adding API Function 'fifo_add_outbound'
2009-09-24 09:48:43.389392 [INFO] mod_voicemail.c:766 Added Profile default
2009-09-24 09:48:43.389487 [NOTICE] switch_loadable_module.c:248 Adding Application 'voicemail'
2009-09-24 09:48:43.389564 [NOTICE] switch_loadable_module.c:270 Adding API Function 'voicemail'
2009-09-24 09:48:43.389637 [NOTICE] switch_loadable_module.c:270 Adding API Function 'voicemail_inject'
2009-09-24 09:48:43.389703 [NOTICE] switch_loadable_module.c:270 Adding API Function 'vm_boxcount'
2009-09-24 09:48:43.443226 [NOTICE] switch_loadable_module.c:248 Adding Application 'limit'
2009-09-24 09:48:43.443309 [NOTICE] switch_loadable_module.c:248 Adding Application 'limit_execute'
2009-09-24 09:48:43.443384 [NOTICE] switch_loadable_module.c:248 Adding Application 'limit_hash'
2009-09-24 09:48:43.443456 [NOTICE] switch_loadable_module.c:248 Adding Application 'limit_hash_execute'
2009-09-24 09:48:43.443520 [NOTICE] switch_loadable_module.c:248 Adding Application 'limit_memcache'
2009-09-24 09:48:43.443583 [NOTICE] switch_loadable_module.c:248 Adding Application 'limit_memcache_execute'
2009-09-24 09:48:43.443645 [NOTICE] switch_loadable_module.c:248 Adding Application 'db'
2009-09-24 09:48:43.443709 [NOTICE] switch_loadable_module.c:248 Adding Application 'hash'
2009-09-24 09:48:43.443777 [NOTICE] switch_loadable_module.c:248 Adding Application 'group'
2009-09-24 09:48:43.443841 [NOTICE] switch_loadable_module.c:270 Adding API Function 'limit_hash_usage'
2009-09-24 09:48:43.443905 [NOTICE] switch_loadable_module.c:270 Adding API Function 'limit_memcache_usage'
2009-09-24 09:48:43.443969 [NOTICE] switch_loadable_module.c:270 Adding API Function 'limit_usage'
2009-09-24 09:48:43.444030 [NOTICE] switch_loadable_module.c:270 Adding API Function 'db'
2009-09-24 09:48:43.444092 [NOTICE] switch_loadable_module.c:270 Adding API Function 'hash'
2009-09-24 09:48:43.444153 [NOTICE] switch_loadable_module.c:270 Adding API Function 'group'
2009-09-24 09:48:43.444478 [NOTICE] switch_loadable_module.c:248 Adding Application 'esf_page_group'
2009-09-24 09:48:43.444720 [NOTICE] switch_loadable_module.c:248 Adding Application 'play_fsv'
2009-09-24 09:48:43.444788 [NOTICE] switch_loadable_module.c:248 Adding Application 'record_fsv'
2009-09-24 09:48:43.445007 [NOTICE] mod_cluechoo.c:83 Hello World!
2009-09-24 09:48:43.445062 [NOTICE] switch_loadable_module.c:248 Adding Application 'cluechoo'
2009-09-24 09:48:43.445127 [NOTICE] switch_loadable_module.c:270 Adding API Function 'cluechoo'
2009-09-24 09:48:43.445374 [NOTICE] switch_loadable_module.c:208 Adding Dialplan 'XML'
2009-09-24 09:48:43.445659 [NOTICE] switch_loadable_module.c:142 Adding Endpoint 'SIP'
2009-09-24 09:48:43.445725 [NOTICE] switch_loadable_module.c:142 Adding Endpoint 'IAX2'
2009-09-24 09:48:43.445787 [NOTICE] switch_loadable_module.c:208 Adding Dialplan 'asterisk'
2009-09-24 09:48:43.445849 [NOTICE] switch_loadable_module.c:248 Adding Application 'Dial'
2009-09-24 09:48:43.445911 [NOTICE] switch_loadable_module.c:248 Adding Application 'Goto'
2009-09-24 09:48:43.445974 [NOTICE] switch_loadable_module.c:248 Adding Application 'AvoidingDeadlock'
2009-09-24 09:48:43.446311 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 16000hz 10ms
2009-09-24 09:48:43.446343 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 16000hz 20ms
2009-09-24 09:48:43.446371 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 16000hz 30ms
2009-09-24 09:48:43.446398 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 16000hz 40ms
2009-09-24 09:48:43.446425 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 16000hz 50ms
2009-09-24 09:48:43.446452 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 16000hz 60ms
2009-09-24 09:48:43.446479 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 8000hz 10ms
2009-09-24 09:48:43.446505 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 8000hz 20ms
2009-09-24 09:48:43.446532 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 8000hz 30ms
2009-09-24 09:48:43.446559 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 8000hz 40ms
2009-09-24 09:48:43.446585 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 8000hz 50ms
2009-09-24 09:48:43.446612 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 8000hz 60ms
2009-09-24 09:48:43.446638 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 8000hz 70ms
2009-09-24 09:48:43.446665 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 8000hz 80ms
2009-09-24 09:48:43.446692 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 8000hz 90ms
2009-09-24 09:48:43.446727 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 8000hz 100ms
2009-09-24 09:48:43.446754 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 8000hz 110ms
2009-09-24 09:48:43.446781 [NOTICE] switch_loadable_module.c:182 Adding Codec 'DVI4' (ADPCM (IMA)) 8000hz 120ms
2009-09-24 09:48:43.446847 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-16' (G.726 16k (AAL2)) 8000hz 10ms
2009-09-24 09:48:43.446876 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-16' (G.726 16k (AAL2)) 8000hz 20ms
2009-09-24 09:48:43.446903 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-16' (G.726 16k (AAL2)) 8000hz 30ms
2009-09-24 09:48:43.446930 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-16' (G.726 16k (AAL2)) 8000hz 40ms
2009-09-24 09:48:43.446957 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-16' (G.726 16k (AAL2)) 8000hz 50ms
2009-09-24 09:48:43.446983 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-16' (G.726 16k (AAL2)) 8000hz 60ms
2009-09-24 09:48:43.447010 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-16' (G.726 16k (AAL2)) 8000hz 70ms
2009-09-24 09:48:43.447037 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-16' (G.726 16k (AAL2)) 8000hz 80ms
2009-09-24 09:48:43.447064 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-16' (G.726 16k (AAL2)) 8000hz 90ms
2009-09-24 09:48:43.447091 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-16' (G.726 16k (AAL2)) 8000hz 100ms
2009-09-24 09:48:43.447118 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-16' (G.726 16k (AAL2)) 8000hz 110ms
2009-09-24 09:48:43.447144 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-16' (G.726 16k (AAL2)) 8000hz 120ms
2009-09-24 09:48:43.447224 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-16' (G.726 16k) 8000hz 10ms
2009-09-24 09:48:43.447253 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-16' (G.726 16k) 8000hz 20ms
2009-09-24 09:48:43.447281 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-16' (G.726 16k) 8000hz 30ms
2009-09-24 09:48:43.447308 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-16' (G.726 16k) 8000hz 40ms
2009-09-24 09:48:43.447334 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-16' (G.726 16k) 8000hz 50ms
2009-09-24 09:48:43.447361 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-16' (G.726 16k) 8000hz 60ms
2009-09-24 09:48:43.447387 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-16' (G.726 16k) 8000hz 70ms
2009-09-24 09:48:43.447414 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-16' (G.726 16k) 8000hz 80ms
2009-09-24 09:48:43.447440 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-16' (G.726 16k) 8000hz 90ms
2009-09-24 09:48:43.447467 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-16' (G.726 16k) 8000hz 100ms
2009-09-24 09:48:43.447494 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-16' (G.726 16k) 8000hz 110ms
2009-09-24 09:48:43.447520 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-16' (G.726 16k) 8000hz 120ms
2009-09-24 09:48:43.447583 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-24' (G.726 24k (AAL2)) 8000hz 10ms
2009-09-24 09:48:43.447613 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-24' (G.726 24k (AAL2)) 8000hz 20ms
2009-09-24 09:48:43.447640 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-24' (G.726 24k (AAL2)) 8000hz 30ms
2009-09-24 09:48:43.447667 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-24' (G.726 24k (AAL2)) 8000hz 40ms
2009-09-24 09:48:43.447694 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-24' (G.726 24k (AAL2)) 8000hz 50ms
2009-09-24 09:48:43.447722 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-24' (G.726 24k (AAL2)) 8000hz 60ms
2009-09-24 09:48:43.447749 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-24' (G.726 24k (AAL2)) 8000hz 70ms
2009-09-24 09:48:43.447776 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-24' (G.726 24k (AAL2)) 8000hz 80ms
2009-09-24 09:48:43.447802 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-24' (G.726 24k (AAL2)) 8000hz 90ms
2009-09-24 09:48:43.447829 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-24' (G.726 24k (AAL2)) 8000hz 100ms
2009-09-24 09:48:43.447856 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-24' (G.726 24k (AAL2)) 8000hz 110ms
2009-09-24 09:48:43.447882 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-24' (G.726 24k (AAL2)) 8000hz 120ms
2009-09-24 09:48:43.447944 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-24' (G.726 24k) 8000hz 10ms
2009-09-24 09:48:43.447973 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-24' (G.726 24k) 8000hz 20ms
2009-09-24 09:48:43.448000 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-24' (G.726 24k) 8000hz 30ms
2009-09-24 09:48:43.448027 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-24' (G.726 24k) 8000hz 40ms
2009-09-24 09:48:43.448054 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-24' (G.726 24k) 8000hz 50ms
2009-09-24 09:48:43.448081 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-24' (G.726 24k) 8000hz 60ms
2009-09-24 09:48:43.448107 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-24' (G.726 24k) 8000hz 70ms
2009-09-24 09:48:43.448133 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-24' (G.726 24k) 8000hz 80ms
2009-09-24 09:48:43.448160 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-24' (G.726 24k) 8000hz 90ms
2009-09-24 09:48:43.448187 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-24' (G.726 24k) 8000hz 100ms
2009-09-24 09:48:43.448214 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-24' (G.726 24k) 8000hz 110ms
2009-09-24 09:48:43.448240 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-24' (G.726 24k) 8000hz 120ms
2009-09-24 09:48:43.448318 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-32' (G.726 32k (AAL2)) 8000hz 10ms
2009-09-24 09:48:43.448346 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-32' (G.726 32k (AAL2)) 8000hz 20ms
2009-09-24 09:48:43.448373 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-32' (G.726 32k (AAL2)) 8000hz 30ms
2009-09-24 09:48:43.448400 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-32' (G.726 32k (AAL2)) 8000hz 40ms
2009-09-24 09:48:43.448427 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-32' (G.726 32k (AAL2)) 8000hz 50ms
2009-09-24 09:48:43.448453 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-32' (G.726 32k (AAL2)) 8000hz 60ms
2009-09-24 09:48:43.448480 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-32' (G.726 32k (AAL2)) 8000hz 70ms
2009-09-24 09:48:43.448507 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-32' (G.726 32k (AAL2)) 8000hz 80ms
2009-09-24 09:48:43.448533 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-32' (G.726 32k (AAL2)) 8000hz 90ms
2009-09-24 09:48:43.448560 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-32' (G.726 32k (AAL2)) 8000hz 100ms
2009-09-24 09:48:43.448587 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-32' (G.726 32k (AAL2)) 8000hz 110ms
2009-09-24 09:48:43.448614 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-32' (G.726 32k (AAL2)) 8000hz 120ms
2009-09-24 09:48:43.448675 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-32' (G.726 32k) 8000hz 10ms
2009-09-24 09:48:43.448703 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-32' (G.726 32k) 8000hz 20ms
2009-09-24 09:48:43.448730 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-32' (G.726 32k) 8000hz 30ms
2009-09-24 09:48:43.448756 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-32' (G.726 32k) 8000hz 40ms
2009-09-24 09:48:43.448783 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-32' (G.726 32k) 8000hz 50ms
2009-09-24 09:48:43.448809 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-32' (G.726 32k) 8000hz 60ms
2009-09-24 09:48:43.448836 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-32' (G.726 32k) 8000hz 70ms
2009-09-24 09:48:43.448862 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-32' (G.726 32k) 8000hz 80ms
2009-09-24 09:48:43.448889 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-32' (G.726 32k) 8000hz 90ms
2009-09-24 09:48:43.448915 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-32' (G.726 32k) 8000hz 100ms
2009-09-24 09:48:43.448942 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-32' (G.726 32k) 8000hz 110ms
2009-09-24 09:48:43.448968 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-32' (G.726 32k) 8000hz 120ms
2009-09-24 09:48:43.449030 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-40' (G.726 40k (AAL2)) 8000hz 10ms
2009-09-24 09:48:43.449058 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-40' (G.726 40k (AAL2)) 8000hz 20ms
2009-09-24 09:48:43.449085 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-40' (G.726 40k (AAL2)) 8000hz 30ms
2009-09-24 09:48:43.449112 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-40' (G.726 40k (AAL2)) 8000hz 40ms
2009-09-24 09:48:43.449138 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-40' (G.726 40k (AAL2)) 8000hz 50ms
2009-09-24 09:48:43.449165 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-40' (G.726 40k (AAL2)) 8000hz 60ms
2009-09-24 09:48:43.449191 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-40' (G.726 40k (AAL2)) 8000hz 70ms
2009-09-24 09:48:43.449218 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-40' (G.726 40k (AAL2)) 8000hz 80ms
2009-09-24 09:48:43.449245 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-40' (G.726 40k (AAL2)) 8000hz 90ms
2009-09-24 09:48:43.449271 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-40' (G.726 40k (AAL2)) 8000hz 100ms
2009-09-24 09:48:43.449310 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-40' (G.726 40k (AAL2)) 8000hz 110ms
2009-09-24 09:48:43.449337 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AAL2-G726-40' (G.726 40k (AAL2)) 8000hz 120ms
2009-09-24 09:48:43.449398 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-40' (G.726 40k) 8000hz 10ms
2009-09-24 09:48:43.449427 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-40' (G.726 40k) 8000hz 20ms
2009-09-24 09:48:43.449454 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-40' (G.726 40k) 8000hz 30ms
2009-09-24 09:48:43.449481 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-40' (G.726 40k) 8000hz 40ms
2009-09-24 09:48:43.449507 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-40' (G.726 40k) 8000hz 50ms
2009-09-24 09:48:43.449534 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-40' (G.726 40k) 8000hz 60ms
2009-09-24 09:48:43.449560 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-40' (G.726 40k) 8000hz 70ms
2009-09-24 09:48:43.449587 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-40' (G.726 40k) 8000hz 80ms
2009-09-24 09:48:43.449614 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-40' (G.726 40k) 8000hz 90ms
2009-09-24 09:48:43.449641 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-40' (G.726 40k) 8000hz 100ms
2009-09-24 09:48:43.449668 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-40' (G.726 40k) 8000hz 110ms
2009-09-24 09:48:43.449694 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G726-40' (G.726 40k) 8000hz 120ms
2009-09-24 09:48:43.449755 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G722' (G.722) 16000hz 10ms
2009-09-24 09:48:43.449784 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G722' (G.722) 16000hz 20ms
2009-09-24 09:48:43.449811 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G722' (G.722) 16000hz 30ms
2009-09-24 09:48:43.449838 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G722' (G.722) 16000hz 40ms
2009-09-24 09:48:43.449865 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G722' (G.722) 16000hz 50ms
2009-09-24 09:48:43.449891 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G722' (G.722) 16000hz 60ms
2009-09-24 09:48:43.449952 [NOTICE] switch_loadable_module.c:182 Adding Codec 'GSM' (GSM) 8000hz 20ms
2009-09-24 09:48:43.449980 [NOTICE] switch_loadable_module.c:182 Adding Codec 'GSM' (GSM) 8000hz 40ms
2009-09-24 09:48:43.450007 [NOTICE] switch_loadable_module.c:182 Adding Codec 'GSM' (GSM) 8000hz 60ms
2009-09-24 09:48:43.450034 [NOTICE] switch_loadable_module.c:182 Adding Codec 'GSM' (GSM) 8000hz 80ms
2009-09-24 09:48:43.450060 [NOTICE] switch_loadable_module.c:182 Adding Codec 'GSM' (GSM) 8000hz 100ms
2009-09-24 09:48:43.450086 [NOTICE] switch_loadable_module.c:182 Adding Codec 'GSM' (GSM) 8000hz 120ms
2009-09-24 09:48:43.450147 [NOTICE] switch_loadable_module.c:182 Adding Codec 'LPC' (LPC-10) 8000hz 90ms
2009-09-24 09:48:43.450377 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G723' (G.723.1 6.3k) 8000hz 120ms
2009-09-24 09:48:43.450408 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G723' (G.723.1 6.3k) 8000hz 90ms
2009-09-24 09:48:43.450436 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G723' (G.723.1 6.3k) 8000hz 60ms
2009-09-24 09:48:43.450464 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G723' (G.723.1 6.3k) 8000hz 30ms
2009-09-24 09:48:43.450680 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G729' (G.729) 8000hz 10ms
2009-09-24 09:48:43.450719 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G729' (G.729) 8000hz 20ms
2009-09-24 09:48:43.450747 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G729' (G.729) 8000hz 30ms
2009-09-24 09:48:43.450773 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G729' (G.729) 8000hz 40ms
2009-09-24 09:48:43.450800 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G729' (G.729) 8000hz 50ms
2009-09-24 09:48:43.450826 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G729' (G.729) 8000hz 60ms
2009-09-24 09:48:43.450869 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G729' (G.729) 8000hz 70ms
2009-09-24 09:48:43.450896 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G729' (G.729) 8000hz 80ms
2009-09-24 09:48:43.450922 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G729' (G.729) 8000hz 90ms
2009-09-24 09:48:43.450948 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G729' (G.729) 8000hz 100ms
2009-09-24 09:48:43.450974 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G729' (G.729) 8000hz 110ms
2009-09-24 09:48:43.451001 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G729' (G.729) 8000hz 120ms
2009-09-24 09:48:43.451216 [NOTICE] switch_loadable_module.c:182 Adding Codec 'AMR' (AMR) 8000hz 20ms
2009-09-24 09:48:43.451502 [NOTICE] switch_loadable_module.c:182 Adding Codec 'iLBC' (iLBC) 8000hz 30ms
2009-09-24 09:48:43.451531 [NOTICE] switch_loadable_module.c:182 Adding Codec 'iLBC' (iLBC) 8000hz 20ms
2009-09-24 09:48:43.451799 [NOTICE] switch_loadable_module.c:182 Adding Codec 'SPEEX' (Speex) 32000hz 20ms
2009-09-24 09:48:43.451829 [NOTICE] switch_loadable_module.c:182 Adding Codec 'SPEEX' (Speex) 16000hz 20ms
2009-09-24 09:48:43.451857 [NOTICE] switch_loadable_module.c:182 Adding Codec 'SPEEX' (Speex) 8000hz 20ms
2009-09-24 09:48:43.452077 [NOTICE] switch_loadable_module.c:182 Adding Codec 'H264' (H.264 Video (passthru)) 90000hz 0ms
2009-09-24 09:48:43.452145 [NOTICE] switch_loadable_module.c:182 Adding Codec 'H263' (H.263 Video (passthru)) 90000hz 0ms
2009-09-24 09:48:43.452209 [NOTICE] switch_loadable_module.c:182 Adding Codec 'H263-1998' (H.263+ Video (passthru)) 90000hz 0ms
2009-09-24 09:48:43.452273 [NOTICE] switch_loadable_module.c:182 Adding Codec 'H263-2000' (H.263++ Video (passthru)) 90000hz 0ms
2009-09-24 09:48:43.452336 [NOTICE] switch_loadable_module.c:182 Adding Codec 'H261' (H.261 Video (passthru)) 90000hz 0ms
2009-09-24 09:48:43.452567 [INFO] mod_siren.c:141 Audio coding: ITU-T Rec. G.722.1, licensed from Polycom(R)
2009-09-24 09:48:43.452598 [INFO] mod_siren.c:142 Audio coding: ITU-T Rec. G.722.1 Annex C, licensed from Polycom(R)
2009-09-24 09:48:43.452656 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G7221' (Polycom(R) G722.1/G722.1C) 32000hz 20ms
2009-09-24 09:48:43.452684 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G7221' (Polycom(R) G722.1/G722.1C) 32000hz 40ms
2009-09-24 09:48:43.452712 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G7221' (Polycom(R) G722.1/G722.1C) 32000hz 60ms
2009-09-24 09:48:43.452739 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G7221' (Polycom(R) G722.1/G722.1C) 16000hz 20ms
2009-09-24 09:48:43.452765 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G7221' (Polycom(R) G722.1/G722.1C) 16000hz 40ms
2009-09-24 09:48:43.452792 [NOTICE] switch_loadable_module.c:182 Adding Codec 'G7221' (Polycom(R) G722.1/G722.1C) 16000hz 60ms
2009-09-24 09:48:43.453178 [INFO] mod_sndfile.c:331 
LibSndFile Version : libsndfile-1.0.19 Supported Formats
================================================================================
AIFF (Apple/SGI)  (extension "aiff")
AU (Sun/NeXT)  (extension "au")
AVR (Audio Visual Research)  (extension "avr")
CAF (Apple Core Audio File)  (extension "caf")
HTK (HMM Tool Kit)  (extension "htk")
IFF (Amiga IFF/SVX8/SV16)  (extension "iff")
MAT4 (GNU Octave 2.0 / Matlab 4.2)  (extension "mat")
MAT5 (GNU Octave 2.1 / Matlab 5.0)  (extension "mat")
PAF (Ensoniq PARIS)  (extension "paf")
PVF (Portable Voice Format)  (extension "pvf")
RAW (header-less)  (extension "raw")
SD2 (Sound Designer II)  (extension "sd2")
SDS (Midi Sample Dump Standard)  (extension "sds")
SF (Berkeley/IRCAM/CARL)  (extension "sf")
VOC (Creative Labs)  (extension "voc")
W64 (SoundFoundry WAVE 64)  (extension "w64")
WAV (Microsoft)  (extension "wav")
WAV (NIST Sphere)  (extension "wav")
WAVEX (Microsoft)  (extension "wav")
WVE (Psion Series 3)  (extension "wve")
XI (FastTracker 2)  (extension "xi")
================================================================================
2009-09-24 09:48:43.453758 [NOTICE] switch_loadable_module.c:294 Adding File Format 'aiff'
2009-09-24 09:48:43.453843 [NOTICE] switch_loadable_module.c:294 Adding File Format 'au'
2009-09-24 09:48:43.453904 [NOTICE] switch_loadable_module.c:294 Adding File Format 'avr'
2009-09-24 09:48:43.453964 [NOTICE] switch_loadable_module.c:294 Adding File Format 'caf'
2009-09-24 09:48:43.454024 [NOTICE] switch_loadable_module.c:294 Adding File Format 'htk'
2009-09-24 09:48:43.454083 [NOTICE] switch_loadable_module.c:294 Adding File Format 'iff'
2009-09-24 09:48:43.454142 [NOTICE] switch_loadable_module.c:294 Adding File Format 'mat'
2009-09-24 09:48:43.454201 [NOTICE] switch_loadable_module.c:294 Adding File Format 'paf'
2009-09-24 09:48:43.454260 [NOTICE] switch_loadable_module.c:294 Adding File Format 'pvf'
2009-09-24 09:48:43.454321 [NOTICE] switch_loadable_module.c:294 Adding File Format 'raw'
2009-09-24 09:48:43.454382 [NOTICE] switch_loadable_module.c:294 Adding File Format 'sd2'
2009-09-24 09:48:43.454441 [NOTICE] switch_loadable_module.c:294 Adding File Format 'sds'
2009-09-24 09:48:43.454499 [NOTICE] switch_loadable_module.c:294 Adding File Format 'sf'
2009-09-24 09:48:43.454558 [NOTICE] switch_loadable_module.c:294 Adding File Format 'voc'
2009-09-24 09:48:43.454617 [NOTICE] switch_loadable_module.c:294 Adding File Format 'w64'
2009-09-24 09:48:43.454676 [NOTICE] switch_loadable_module.c:294 Adding File Format 'wav'
2009-09-24 09:48:43.454744 [NOTICE] switch_loadable_module.c:294 Adding File Format 'wve'
2009-09-24 09:48:43.454804 [NOTICE] switch_loadable_module.c:294 Adding File Format 'xi'
2009-09-24 09:48:43.454865 [NOTICE] switch_loadable_module.c:294 Adding File Format 'r8'
2009-09-24 09:48:43.454925 [NOTICE] switch_loadable_module.c:294 Adding File Format 'r16'
2009-09-24 09:48:43.454984 [NOTICE] switch_loadable_module.c:294 Adding File Format 'r24'
2009-09-24 09:48:43.455044 [NOTICE] switch_loadable_module.c:294 Adding File Format 'r32'
2009-09-24 09:48:43.455102 [NOTICE] switch_loadable_module.c:294 Adding File Format 'gsm'
2009-09-24 09:48:43.455160 [NOTICE] switch_loadable_module.c:294 Adding File Format 'ul'
2009-09-24 09:48:43.455219 [NOTICE] switch_loadable_module.c:294 Adding File Format 'al'
2009-09-24 09:48:43.455282 [NOTICE] switch_loadable_module.c:294 Adding File Format 'adpcm'
2009-09-24 09:48:43.455513 [NOTICE] switch_loadable_module.c:294 Adding File Format 'G7221'
2009-09-24 09:48:43.455578 [NOTICE] switch_loadable_module.c:294 Adding File Format 'H263'
2009-09-24 09:48:43.455639 [NOTICE] switch_loadable_module.c:294 Adding File Format 'AMR'
2009-09-24 09:48:43.455698 [NOTICE] switch_loadable_module.c:294 Adding File Format 'H263-1998'
2009-09-24 09:48:43.455784 [NOTICE] switch_loadable_module.c:294 Adding File Format 'SPEEX'
2009-09-24 09:48:43.455843 [NOTICE] switch_loadable_module.c:294 Adding File Format 'G729'
2009-09-24 09:48:43.455906 [NOTICE] switch_loadable_module.c:294 Adding File Format 'G723'
2009-09-24 09:48:43.455969 [NOTICE] switch_loadable_module.c:294 Adding File Format 'LPC'
2009-09-24 09:48:43.456030 [NOTICE] switch_loadable_module.c:294 Adding File Format 'G726-16'
2009-09-24 09:48:43.456091 [NOTICE] switch_loadable_module.c:294 Adding File Format 'H261'
2009-09-24 09:48:43.456151 [NOTICE] switch_loadable_module.c:294 Adding File Format 'AAL2-G726-16'
2009-09-24 09:48:43.456211 [NOTICE] switch_loadable_module.c:294 Adding File Format 'PCMA'
2009-09-24 09:48:43.456271 [NOTICE] switch_loadable_module.c:294 Adding File Format 'DVI4'
2009-09-24 09:48:43.456330 [NOTICE] switch_loadable_module.c:294 Adding File Format 'G726-24'
2009-09-24 09:48:43.456390 [NOTICE] switch_loadable_module.c:294 Adding File Format 'PCMU'
2009-09-24 09:48:43.456449 [NOTICE] switch_loadable_module.c:294 Adding File Format 'L16'
2009-09-24 09:48:43.456508 [NOTICE] switch_loadable_module.c:294 Adding File Format 'iLBC'
2009-09-24 09:48:43.456566 [NOTICE] switch_loadable_module.c:294 Adding File Format 'PROXY'
2009-09-24 09:48:43.456625 [NOTICE] switch_loadable_module.c:294 Adding File Format 'PROXY-VID'
2009-09-24 09:48:43.456688 [NOTICE] switch_loadable_module.c:294 Adding File Format 'AAL2-G726-24'
2009-09-24 09:48:43.456763 [NOTICE] switch_loadable_module.c:294 Adding File Format 'AAL2-G726-32'
2009-09-24 09:48:43.456822 [NOTICE] switch_loadable_module.c:294 Adding File Format 'H263-2000'
2009-09-24 09:48:43.456881 [NOTICE] switch_loadable_module.c:294 Adding File Format 'H264'
2009-09-24 09:48:43.456940 [NOTICE] switch_loadable_module.c:294 Adding File Format 'G726-32'
2009-09-24 09:48:43.456999 [NOTICE] switch_loadable_module.c:294 Adding File Format 'G722'
2009-09-24 09:48:43.457057 [NOTICE] switch_loadable_module.c:294 Adding File Format 'AAL2-G726-40'
2009-09-24 09:48:43.457116 [NOTICE] switch_loadable_module.c:294 Adding File Format 'G726-40'
2009-09-24 09:48:43.457176 [NOTICE] switch_loadable_module.c:294 Adding File Format 'GSM'
2009-09-24 09:48:43.472548 [NOTICE] switch_loadable_module.c:270 Adding API Function 'stop_local_stream'
2009-09-24 09:48:43.472634 [NOTICE] switch_loadable_module.c:270 Adding API Function 'start_local_stream'
2009-09-24 09:48:43.472704 [NOTICE] switch_loadable_module.c:270 Adding API Function 'show_local_stream'
2009-09-24 09:48:43.472770 [NOTICE] switch_loadable_module.c:294 Adding File Format 'local_stream'
2009-09-24 09:48:43.473059 [NOTICE] switch_loadable_module.c:294 Adding File Format 'tone_stream'
2009-09-24 09:48:43.473124 [NOTICE] switch_loadable_module.c:294 Adding File Format 'silence_stream'
2009-09-24 09:48:43.473341 [NOTICE] switch_loadable_module.c:294 Adding File Format 'file_string'
2009-09-24 09:48:43.476750 [DEBUG] switch_loadable_module.c:832 Loading module with global namespace at request of module
2009-09-24 09:48:43.491614 [NOTICE] switch_loadable_module.c:248 Adding Application 'javascript'
2009-09-24 09:48:43.491698 [NOTICE] switch_loadable_module.c:270 Adding API Function 'jsrun'
2009-09-24 09:48:43.491771 [NOTICE] switch_loadable_module.c:270 Adding API Function 'jsapi'
2009-09-24 09:48:43.492716 [DEBUG] switch_loadable_module.c:832 Loading module with global namespace at request of module
2009-09-24 09:48:43.507074 [NOTICE] switch_loadable_module.c:248 Adding Application 'lua'
2009-09-24 09:48:43.507158 [NOTICE] switch_loadable_module.c:270 Adding API Function 'luarun'
2009-09-24 09:48:43.507223 [NOTICE] switch_loadable_module.c:270 Adding API Function 'lua'
2009-09-24 09:48:43.511356 [DEBUG] switch_loadable_module.c:832 Loading module with global namespace at request of module
2009-09-24 09:48:43.512474 [NOTICE] switch_loadable_module.c:315 Adding Speech interface 'cepstral'
2009-09-24 09:48:43.512763 [NOTICE] switch_loadable_module.c:395 Adding Say interface 'en'
2009-09-24 09:48:43.513035 [NOTICE] switch_loadable_module.c:395 Adding Say interface 'ru'
2009-09-24 09:48:43.528081 [NOTICE] switch_core.c:910 Created ip list rfc1918.auto default (deny)
2009-09-24 09:48:43.528144 [NOTICE] switch_core.c:918 Created ip list wan.auto default (allow)
2009-09-24 09:48:43.528175 [NOTICE] switch_core.c:926 Created ip list nat.auto default (deny)
2009-09-24 09:48:43.528205 [NOTICE] switch_core.c:928 Adding 192.168.46.15/255.255.255.0 (deny) to list nat.auto
2009-09-24 09:48:43.528237 [NOTICE] switch_core.c:938 Created ip list loopback.auto default (deny)
2009-09-24 09:48:43.528266 [NOTICE] switch_core.c:944 Created ip list localnet.auto default (deny)
2009-09-24 09:48:43.528292 [NOTICE] switch_core.c:947 Adding 192.168.46.15/255.255.255.0 (allow) to list localnet.auto
2009-09-24 09:48:43.538709 [DEBUG] mod_event_socket.c:2303 Socket up listening on 127.0.0.1:8021
2009-09-24 09:48:43.542711 [NOTICE] switch_core.c:1078 Adding 192.168.42.0/24 (deny) to list lan
2009-09-24 09:48:43.542711 [NOTICE] switch_core.c:1078 Adding 192.168.42.42/32 (allow) to list lan
2009-09-24 09:48:43.542711 [NOTICE] switch_core.c:1059 Adding 192.0.2.0/24 (allow) [brian@192.168.46.15] to list domains
2009-09-24 09:48:43.542711 [NOTICE] switch_core.c:1078 Adding 192.168.46.0/24 (allow) to list domains
2009-09-24 09:49:16.179733 [NOTICE] switch_channel.c:613 New Channel sofia/internal/1001@192.168.46.15 [c2300c8a-a8de-11de-a85d-73431ec84ca4]
2009-09-24 09:49:16.183725 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_NEW
2009-09-24 09:49:16.183725 [DEBUG] switch_core_state_machine.c:404 (sofia/internal/1001@192.168.46.15) State NEW
2009-09-24 09:49:16.183725 [DEBUG] sofia.c:3334 Channel sofia/internal/1001@192.168.46.15 entering state [received][100]
2009-09-24 09:49:16.183725 [DEBUG] sofia.c:3341 Remote SDP:
v=0
o=- 22896919 22896919 IN IP4 192.168.46.105
s=-
c=IN IP4 192.168.46.105
t=0 0
m=audio 16416 RTP/AVP 0 2 4 8 18 96 97 98 100 101
a=rtpmap:0 PCMU/8000
a=rtpmap:2 G726-32/8000
a=rtpmap:4 G723/8000
a=rtpmap:8 PCMA/8000
a=rtpmap:18 G729a/8000
a=rtpmap:96 G726-40/8000
a=rtpmap:97 G726-24/8000
a=rtpmap:98 G726-16/8000
a=rtpmap:100 NSE/8000
a=rtpmap:101 telephone-event/8000
a=fmtp:101 0-15
a=ptime:30

2009-09-24 09:49:16.183725 [DEBUG] sofia_glue.c:3136 Audio Codec Compare [PCMU:0:8000:30]/[GSM:3:8000:20]
2009-09-24 09:49:16.183725 [DEBUG] sofia_glue.c:3136 Audio Codec Compare [PCMU:0:8000:30]/[PCMU:0:8000:20]
2009-09-24 09:49:16.183725 [DEBUG] sofia_glue.c:3184 Substituting codec PCMU@30i@8000h
2009-09-24 09:49:16.183725 [DEBUG] sofia_glue.c:2094 Set Codec sofia/internal/1001@192.168.46.15 PCMU/8000 30 ms 240 samples
2009-09-24 09:49:16.183725 [DEBUG] sofia_glue.c:3096 Set 2833 dtmf payload to 101
2009-09-24 09:49:16.183725 [DEBUG] sofia.c:3502 (sofia/internal/1001@192.168.46.15) State Change CS_NEW -> CS_INIT
2009-09-24 09:49:16.183725 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:49:16.188737 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_INIT
2009-09-24 09:49:16.188737 [DEBUG] switch_core_state_machine.c:422 (sofia/internal/1001@192.168.46.15) State INIT
2009-09-24 09:49:16.188737 [DEBUG] mod_sofia.c:83 sofia/internal/1001@192.168.46.15 SOFIA INIT
2009-09-24 09:49:16.188737 [DEBUG] mod_sofia.c:111 (sofia/internal/1001@192.168.46.15) State Change CS_INIT -> CS_ROUTING
2009-09-24 09:49:16.188737 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:49:16.188737 [DEBUG] switch_core_state_machine.c:422 (sofia/internal/1001@192.168.46.15) State INIT going to sleep
2009-09-24 09:49:16.188737 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_ROUTING
2009-09-24 09:49:16.188737 [DEBUG] switch_core_state_machine.c:425 (sofia/internal/1001@192.168.46.15) State ROUTING
2009-09-24 09:49:16.188737 [DEBUG] mod_sofia.c:130 sofia/internal/1001@192.168.46.15 SOFIA ROUTING
2009-09-24 09:49:16.188737 [DEBUG] switch_core_state_machine.c:78 sofia/internal/1001@192.168.46.15 Standard ROUTING
2009-09-24 09:49:16.188737 [INFO] mod_dialplan_xml.c:391 Processing 1001->3000 in context public
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9000] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9000] destination_number(3000) =~ /^9000$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9001] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9001] destination_number(3000) =~ /^9001$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9002] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9002] destination_number(3000) =~ /^9002$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9004] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9004] destination_number(3000) =~ /^9004$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9005] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9005] destination_number(3000) =~ /^9005$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9006] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9006] destination_number(3000) =~ /^9006$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9008] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9008] destination_number(3000) =~ /^9008$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9009] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9009] destination_number(3000) =~ /^9009$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->2000] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [2000] destination_number(3000) =~ /^2000$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->ticklemaster] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (PASS) [ticklemaster] destination_number(3000) =~ /^3000$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (PASS) [ticklemaster] caller_id_number(1001) =~ /^(10[01][0-9])$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 Action ring_ready() 
Dialplan: sofia/internal/1001@192.168.46.15 Action set(incoming_media=sip) 
Dialplan: sofia/internal/1001@192.168.46.15 Action set(instance_id=100) 
Dialplan: sofia/internal/1001@192.168.46.15 Action javascript(freedomfone/tickle/main.js ${instance_id} ${incoming_media}) 
2009-09-24 09:49:16.207737 [DEBUG] switch_core_state_machine.c:114 (sofia/internal/1001@192.168.46.15) State Change CS_ROUTING -> CS_EXECUTE
2009-09-24 09:49:16.207737 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:49:16.207737 [DEBUG] switch_core_state_machine.c:425 (sofia/internal/1001@192.168.46.15) State ROUTING going to sleep
2009-09-24 09:49:16.207737 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_EXECUTE
2009-09-24 09:49:16.207737 [DEBUG] switch_core_state_machine.c:432 (sofia/internal/1001@192.168.46.15) State EXECUTE
2009-09-24 09:49:16.207737 [DEBUG] mod_sofia.c:173 sofia/internal/1001@192.168.46.15 SOFIA EXECUTE
2009-09-24 09:49:16.207737 [DEBUG] switch_core_state_machine.c:151 sofia/internal/1001@192.168.46.15 Standard EXECUTE
EXECUTE sofia/internal/1001@192.168.46.15 ring_ready()
2009-09-24 09:49:16.207737 [DEBUG] mod_dptools.c:415 sofia/internal/1001@192.168.46.15 receive message [RINGING]
2009-09-24 09:49:16.207737 [NOTICE] mod_sofia.c:1443 Ring-Ready sofia/internal/1001@192.168.46.15!
2009-09-24 09:49:16.207737 [DEBUG] switch_core_session.c:630 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:49:16.207737 [NOTICE] mod_dptools.c:415 Ring Ready sofia/internal/1001@192.168.46.15!
EXECUTE sofia/internal/1001@192.168.46.15 set(incoming_media=sip)
2009-09-24 09:49:16.207737 [DEBUG] mod_dptools.c:748 sofia/internal/1001@192.168.46.15 SET [incoming_media]=[sip]
EXECUTE sofia/internal/1001@192.168.46.15 set(instance_id=100)
2009-09-24 09:49:16.207737 [DEBUG] mod_dptools.c:748 sofia/internal/1001@192.168.46.15 SET [instance_id]=[100]
EXECUTE sofia/internal/1001@192.168.46.15 javascript(freedomfone/tickle/main.js 100 sip)
2009-09-24 09:49:16.212742 [DEBUG] sofia.c:3334 Channel sofia/internal/1001@192.168.46.15 entering state [early][180]
2009-09-24 09:49:16.215775 [DEBUG] main.js:69 
2009-09-24 09:49:16.215775 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:49:16.215775 [DEBUG] main.js:69  [ STATE_TICKLE_IN ]  1001 Destination number sip

2009-09-24 09:49:16.215775 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:49:16.215775 [DEBUG] main.js:69 
EXECUTE sofia/internal/1001@192.168.46.15 sleep(10000)
2009-09-24 09:49:18.875706 [DEBUG] sofia.c:3334 Channel sofia/internal/1001@192.168.46.15 entering state [terminated][487]
2009-09-24 09:49:18.875706 [NOTICE] sofia.c:3900 Hangup sofia/internal/1001@192.168.46.15 [CS_EXECUTE] [ORIGINATOR_CANCEL]
2009-09-24 09:49:18.875706 [DEBUG] switch_channel.c:1726 Send signal sofia/internal/1001@192.168.46.15 [KILL]
2009-09-24 09:49:18.875706 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:49:18.875706 [DEBUG] switch_core_state_machine.c:533 thread mismatch skipping state handler.
2009-09-24 09:49:26.215708 [DEBUG] main.js:69 
2009-09-24 09:49:26.215708 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:49:26.215708 [DEBUG] main.js:69  [ STATE_HANGUP ] hangup sofia/internal/1001@192.168.46.15 ORIGINATOR_CANCEL

2009-09-24 09:49:26.215708 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:49:26.215708 [DEBUG] main.js:69 
2009-09-24 09:49:26.215708 [DEBUG] main.js:69 
2009-09-24 09:49:26.215708 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:49:26.215708 [DEBUG] main.js:69  [ STATE_ESL_EVENT ] 1001

2009-09-24 09:49:26.215708 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:49:26.215708 [DEBUG] main.js:69 
2009-09-24 09:49:26.215708 [DEBUG] main.js:69 
2009-09-24 09:49:26.215708 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:49:26.215708 [DEBUG] main.js:69  [ STATE_TICKLE_OUT ]  1001

2009-09-24 09:49:26.215708 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:49:26.215708 [DEBUG] main.js:69 
2009-09-24 09:49:26.215708 [DEBUG] switch_core_state_machine.c:432 (sofia/internal/1001@192.168.46.15) State EXECUTE going to sleep
2009-09-24 09:49:26.215708 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_HANGUP
2009-09-24 09:49:26.215708 [DEBUG] switch_core_state_machine.c:560 (sofia/internal/1001@192.168.46.15) State HANGUP
2009-09-24 09:49:26.215708 [DEBUG] mod_sofia.c:306 sofia/internal/1001@192.168.46.15 Overriding SIP cause 487 with 487 from the other leg
2009-09-24 09:49:26.215708 [DEBUG] mod_sofia.c:338 Channel sofia/internal/1001@192.168.46.15 hanging up, cause: ORIGINATOR_CANCEL
2009-09-24 09:49:26.215708 [DEBUG] switch_core_state_machine.c:46 sofia/internal/1001@192.168.46.15 Standard HANGUP, cause: ORIGINATOR_CANCEL
2009-09-24 09:49:26.215708 [DEBUG] switch_core_state_machine.c:560 (sofia/internal/1001@192.168.46.15) State HANGUP going to sleep
2009-09-24 09:49:26.215708 [DEBUG] switch_core_state_machine.c:417 (sofia/internal/1001@192.168.46.15) State Change CS_HANGUP -> CS_REPORTING
2009-09-24 09:49:26.215708 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:49:26.215708 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_REPORTING
2009-09-24 09:49:26.215708 [DEBUG] switch_core_state_machine.c:651 (sofia/internal/1001@192.168.46.15) State REPORTING
2009-09-24 09:49:26.215708 [DEBUG] switch_core_state_machine.c:53 sofia/internal/1001@192.168.46.15 Standard REPORTING, cause: ORIGINATOR_CANCEL
2009-09-24 09:49:26.215708 [DEBUG] switch_core_state_machine.c:651 (sofia/internal/1001@192.168.46.15) State REPORTING going to sleep
2009-09-24 09:49:26.215708 [DEBUG] switch_core_state_machine.c:411 (sofia/internal/1001@192.168.46.15) State Change CS_REPORTING -> CS_DESTROY
2009-09-24 09:49:26.215708 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:49:26.215708 [DEBUG] switch_core_session.c:1069 Session 1 (sofia/internal/1001@192.168.46.15) Locked, Waiting on external entities
2009-09-24 09:49:26.215708 [NOTICE] switch_core_session.c:1087 Session 1 (sofia/internal/1001@192.168.46.15) Ended
2009-09-24 09:49:26.215708 [NOTICE] switch_core_session.c:1089 Close Channel sofia/internal/1001@192.168.46.15 [CS_DESTROY]
2009-09-24 09:49:26.215708 [DEBUG] switch_core_state_machine.c:497 (sofia/internal/1001@192.168.46.15) Running State Change CS_DESTROY
2009-09-24 09:49:26.215708 [DEBUG] switch_core_state_machine.c:508 (sofia/internal/1001@192.168.46.15) State DESTROY
2009-09-24 09:49:26.215708 [DEBUG] mod_sofia.c:255 sofia/internal/1001@192.168.46.15 SOFIA DESTROY
2009-09-24 09:49:26.215708 [DEBUG] switch_core_state_machine.c:60 sofia/internal/1001@192.168.46.15 Standard DESTROY
2009-09-24 09:49:26.215708 [DEBUG] switch_core_state_machine.c:508 (sofia/internal/1001@192.168.46.15) State DESTROY going to sleep
2009-09-24 09:50:56.391728 [NOTICE] switch_channel.c:613 New Channel sofia/internal/1001@192.168.46.15 [fdeb3b5a-a8de-11de-a85d-73431ec84ca4]
2009-09-24 09:50:56.397451 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_NEW
2009-09-24 09:50:56.397451 [DEBUG] switch_core_state_machine.c:404 (sofia/internal/1001@192.168.46.15) State NEW
2009-09-24 09:50:56.397451 [DEBUG] sofia.c:3334 Channel sofia/internal/1001@192.168.46.15 entering state [received][100]
2009-09-24 09:50:56.397451 [DEBUG] sofia.c:3341 Remote SDP:
v=0
o=- 22906940 22906940 IN IP4 192.168.46.105
s=-
c=IN IP4 192.168.46.105
t=0 0
m=audio 16418 RTP/AVP 0 2 4 8 18 96 97 98 100 101
a=rtpmap:0 PCMU/8000
a=rtpmap:2 G726-32/8000
a=rtpmap:4 G723/8000
a=rtpmap:8 PCMA/8000
a=rtpmap:18 G729a/8000
a=rtpmap:96 G726-40/8000
a=rtpmap:97 G726-24/8000
a=rtpmap:98 G726-16/8000
a=rtpmap:100 NSE/8000
a=rtpmap:101 telephone-event/8000
a=fmtp:101 0-15
a=ptime:30

2009-09-24 09:50:56.397451 [DEBUG] sofia_glue.c:3136 Audio Codec Compare [PCMU:0:8000:30]/[GSM:3:8000:20]
2009-09-24 09:50:56.397451 [DEBUG] sofia_glue.c:3136 Audio Codec Compare [PCMU:0:8000:30]/[PCMU:0:8000:20]
2009-09-24 09:50:56.397451 [DEBUG] sofia_glue.c:3184 Substituting codec PCMU@30i@8000h
2009-09-24 09:50:56.397451 [DEBUG] sofia_glue.c:2094 Set Codec sofia/internal/1001@192.168.46.15 PCMU/8000 30 ms 240 samples
2009-09-24 09:50:56.397451 [DEBUG] sofia_glue.c:3096 Set 2833 dtmf payload to 101
2009-09-24 09:50:56.397451 [DEBUG] sofia.c:3502 (sofia/internal/1001@192.168.46.15) State Change CS_NEW -> CS_INIT
2009-09-24 09:50:56.397451 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:50:56.397451 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_INIT
2009-09-24 09:50:56.397451 [DEBUG] switch_core_state_machine.c:422 (sofia/internal/1001@192.168.46.15) State INIT
2009-09-24 09:50:56.397451 [DEBUG] mod_sofia.c:83 sofia/internal/1001@192.168.46.15 SOFIA INIT
2009-09-24 09:50:56.397451 [DEBUG] mod_sofia.c:111 (sofia/internal/1001@192.168.46.15) State Change CS_INIT -> CS_ROUTING
2009-09-24 09:50:56.397451 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:50:56.397451 [DEBUG] switch_core_state_machine.c:422 (sofia/internal/1001@192.168.46.15) State INIT going to sleep
2009-09-24 09:50:56.397451 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_ROUTING
2009-09-24 09:50:56.397451 [DEBUG] switch_core_state_machine.c:425 (sofia/internal/1001@192.168.46.15) State ROUTING
2009-09-24 09:50:56.397451 [DEBUG] mod_sofia.c:130 sofia/internal/1001@192.168.46.15 SOFIA ROUTING
2009-09-24 09:50:56.397451 [DEBUG] switch_core_state_machine.c:78 sofia/internal/1001@192.168.46.15 Standard ROUTING
2009-09-24 09:50:56.397451 [INFO] mod_dialplan_xml.c:391 Processing 1001->3000 in context public
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9000] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9000] destination_number(3000) =~ /^9000$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9001] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9001] destination_number(3000) =~ /^9001$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9002] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9002] destination_number(3000) =~ /^9002$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9004] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9004] destination_number(3000) =~ /^9004$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9005] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9005] destination_number(3000) =~ /^9005$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9006] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9006] destination_number(3000) =~ /^9006$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9008] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9008] destination_number(3000) =~ /^9008$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9009] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9009] destination_number(3000) =~ /^9009$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->2000] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [2000] destination_number(3000) =~ /^2000$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->ticklemaster] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (PASS) [ticklemaster] destination_number(3000) =~ /^3000$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (PASS) [ticklemaster] caller_id_number(1001) =~ /^(10[01][0-9])$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 Action ring_ready() 
Dialplan: sofia/internal/1001@192.168.46.15 Action set(incoming_media=sip) 
Dialplan: sofia/internal/1001@192.168.46.15 Action set(instance_id=100) 
Dialplan: sofia/internal/1001@192.168.46.15 Action javascript(freedomfone/tickle/main.js ${instance_id} ${incoming_media}) 
2009-09-24 09:50:56.416023 [DEBUG] switch_core_state_machine.c:114 (sofia/internal/1001@192.168.46.15) State Change CS_ROUTING -> CS_EXECUTE
2009-09-24 09:50:56.416023 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:50:56.416023 [DEBUG] switch_core_state_machine.c:425 (sofia/internal/1001@192.168.46.15) State ROUTING going to sleep
2009-09-24 09:50:56.416023 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_EXECUTE
2009-09-24 09:50:56.416023 [DEBUG] switch_core_state_machine.c:432 (sofia/internal/1001@192.168.46.15) State EXECUTE
2009-09-24 09:50:56.416023 [DEBUG] mod_sofia.c:173 sofia/internal/1001@192.168.46.15 SOFIA EXECUTE
2009-09-24 09:50:56.416023 [DEBUG] switch_core_state_machine.c:151 sofia/internal/1001@192.168.46.15 Standard EXECUTE
EXECUTE sofia/internal/1001@192.168.46.15 ring_ready()
2009-09-24 09:50:56.416023 [DEBUG] mod_dptools.c:415 sofia/internal/1001@192.168.46.15 receive message [RINGING]
2009-09-24 09:50:56.416023 [NOTICE] mod_sofia.c:1443 Ring-Ready sofia/internal/1001@192.168.46.15!
2009-09-24 09:50:56.416023 [DEBUG] switch_core_session.c:630 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:50:56.416023 [NOTICE] mod_dptools.c:415 Ring Ready sofia/internal/1001@192.168.46.15!
EXECUTE sofia/internal/1001@192.168.46.15 set(incoming_media=sip)
2009-09-24 09:50:56.416023 [DEBUG] mod_dptools.c:748 sofia/internal/1001@192.168.46.15 SET [incoming_media]=[sip]
EXECUTE sofia/internal/1001@192.168.46.15 set(instance_id=100)
2009-09-24 09:50:56.416023 [DEBUG] mod_dptools.c:748 sofia/internal/1001@192.168.46.15 SET [instance_id]=[100]
EXECUTE sofia/internal/1001@192.168.46.15 javascript(freedomfone/tickle/main.js 100 sip)
2009-09-24 09:50:56.419802 [DEBUG] main.js:69 
2009-09-24 09:50:56.419802 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:50:56.419802 [DEBUG] main.js:69  [ STATE_TICKLE_IN ]  1001 Destination number sip

2009-09-24 09:50:56.419802 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:50:56.419802 [DEBUG] main.js:69 
EXECUTE sofia/internal/1001@192.168.46.15 sleep(10000)
2009-09-24 09:50:56.424029 [DEBUG] sofia.c:3334 Channel sofia/internal/1001@192.168.46.15 entering state [early][180]
2009-09-24 09:50:58.847728 [DEBUG] sofia.c:3334 Channel sofia/internal/1001@192.168.46.15 entering state [terminated][487]
2009-09-24 09:50:58.847728 [NOTICE] sofia.c:3900 Hangup sofia/internal/1001@192.168.46.15 [CS_EXECUTE] [ORIGINATOR_CANCEL]
2009-09-24 09:50:58.847728 [DEBUG] switch_channel.c:1726 Send signal sofia/internal/1001@192.168.46.15 [KILL]
2009-09-24 09:50:58.847728 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:50:58.847728 [DEBUG] switch_core_state_machine.c:533 thread mismatch skipping state handler.
2009-09-24 09:51:06.419723 [DEBUG] main.js:69 
2009-09-24 09:51:06.419723 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:51:06.419723 [DEBUG] main.js:69  [ STATE_HANGUP ] hangup sofia/internal/1001@192.168.46.15 ORIGINATOR_CANCEL

2009-09-24 09:51:06.419723 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:51:06.419723 [DEBUG] main.js:69 
2009-09-24 09:51:06.419723 [DEBUG] main.js:69 
2009-09-24 09:51:06.419723 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:51:06.419723 [DEBUG] main.js:69  [ STATE_ESL_EVENT ] 1001

2009-09-24 09:51:06.419723 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:51:06.419723 [DEBUG] main.js:69 
2009-09-24 09:51:06.419723 [DEBUG] main.js:69 
2009-09-24 09:51:06.419723 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:51:06.419723 [DEBUG] main.js:69  [ STATE_TICKLE_OUT ]  1001

2009-09-24 09:51:06.419723 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:51:06.419723 [DEBUG] main.js:69 
2009-09-24 09:51:06.423716 [DEBUG] switch_core_state_machine.c:432 (sofia/internal/1001@192.168.46.15) State EXECUTE going to sleep
2009-09-24 09:51:06.423716 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_HANGUP
2009-09-24 09:51:06.423716 [DEBUG] switch_core_state_machine.c:560 (sofia/internal/1001@192.168.46.15) State HANGUP
2009-09-24 09:51:06.423716 [DEBUG] mod_sofia.c:306 sofia/internal/1001@192.168.46.15 Overriding SIP cause 487 with 487 from the other leg
2009-09-24 09:51:06.423716 [DEBUG] mod_sofia.c:338 Channel sofia/internal/1001@192.168.46.15 hanging up, cause: ORIGINATOR_CANCEL
2009-09-24 09:51:06.423716 [DEBUG] switch_core_state_machine.c:46 sofia/internal/1001@192.168.46.15 Standard HANGUP, cause: ORIGINATOR_CANCEL
2009-09-24 09:51:06.423716 [DEBUG] switch_core_state_machine.c:560 (sofia/internal/1001@192.168.46.15) State HANGUP going to sleep
2009-09-24 09:51:06.423716 [DEBUG] switch_core_state_machine.c:417 (sofia/internal/1001@192.168.46.15) State Change CS_HANGUP -> CS_REPORTING
2009-09-24 09:51:06.423716 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:51:06.423716 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_REPORTING
2009-09-24 09:51:06.423716 [DEBUG] switch_core_state_machine.c:651 (sofia/internal/1001@192.168.46.15) State REPORTING
2009-09-24 09:51:06.443726 [DEBUG] switch_core_state_machine.c:53 sofia/internal/1001@192.168.46.15 Standard REPORTING, cause: ORIGINATOR_CANCEL
2009-09-24 09:51:06.443726 [DEBUG] switch_core_state_machine.c:651 (sofia/internal/1001@192.168.46.15) State REPORTING going to sleep
2009-09-24 09:51:06.443726 [DEBUG] switch_core_state_machine.c:411 (sofia/internal/1001@192.168.46.15) State Change CS_REPORTING -> CS_DESTROY
2009-09-24 09:51:06.443726 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:51:06.443726 [DEBUG] switch_core_session.c:1069 Session 2 (sofia/internal/1001@192.168.46.15) Locked, Waiting on external entities
2009-09-24 09:51:06.443726 [NOTICE] switch_core_session.c:1087 Session 2 (sofia/internal/1001@192.168.46.15) Ended
2009-09-24 09:51:06.443726 [NOTICE] switch_core_session.c:1089 Close Channel sofia/internal/1001@192.168.46.15 [CS_DESTROY]
2009-09-24 09:51:06.443726 [DEBUG] switch_core_state_machine.c:497 (sofia/internal/1001@192.168.46.15) Running State Change CS_DESTROY
2009-09-24 09:51:06.443726 [DEBUG] switch_core_state_machine.c:508 (sofia/internal/1001@192.168.46.15) State DESTROY
2009-09-24 09:51:06.443726 [DEBUG] mod_sofia.c:255 sofia/internal/1001@192.168.46.15 SOFIA DESTROY
2009-09-24 09:51:06.443726 [DEBUG] switch_core_state_machine.c:60 sofia/internal/1001@192.168.46.15 Standard DESTROY
2009-09-24 09:51:06.443726 [DEBUG] switch_core_state_machine.c:508 (sofia/internal/1001@192.168.46.15) State DESTROY going to sleep
2009-09-24 09:51:46.442708 [NOTICE] switch_channel.c:613 New Channel sofia/internal/1001@192.168.46.15 [1bc029b0-a8df-11de-a85d-73431ec84ca4]
2009-09-24 09:51:46.442708 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_NEW
2009-09-24 09:51:46.442708 [DEBUG] switch_core_state_machine.c:404 (sofia/internal/1001@192.168.46.15) State NEW
2009-09-24 09:51:46.442708 [DEBUG] sofia.c:3334 Channel sofia/internal/1001@192.168.46.15 entering state [received][100]
2009-09-24 09:51:46.442708 [DEBUG] sofia.c:3341 Remote SDP:
v=0
o=- 22911945 22911945 IN IP4 192.168.46.105
s=-
c=IN IP4 192.168.46.105
t=0 0
m=audio 16420 RTP/AVP 0 2 4 8 18 96 97 98 100 101
a=rtpmap:0 PCMU/8000
a=rtpmap:2 G726-32/8000
a=rtpmap:4 G723/8000
a=rtpmap:8 PCMA/8000
a=rtpmap:18 G729a/8000
a=rtpmap:96 G726-40/8000
a=rtpmap:97 G726-24/8000
a=rtpmap:98 G726-16/8000
a=rtpmap:100 NSE/8000
a=rtpmap:101 telephone-event/8000
a=fmtp:101 0-15
a=ptime:30

2009-09-24 09:51:46.442708 [DEBUG] sofia_glue.c:3136 Audio Codec Compare [PCMU:0:8000:30]/[GSM:3:8000:20]
2009-09-24 09:51:46.442708 [DEBUG] sofia_glue.c:3136 Audio Codec Compare [PCMU:0:8000:30]/[PCMU:0:8000:20]
2009-09-24 09:51:46.442708 [DEBUG] sofia_glue.c:3184 Substituting codec PCMU@30i@8000h
2009-09-24 09:51:46.442708 [DEBUG] sofia_glue.c:2094 Set Codec sofia/internal/1001@192.168.46.15 PCMU/8000 30 ms 240 samples
2009-09-24 09:51:46.446805 [DEBUG] sofia_glue.c:3096 Set 2833 dtmf payload to 101
2009-09-24 09:51:46.446805 [DEBUG] sofia.c:3502 (sofia/internal/1001@192.168.46.15) State Change CS_NEW -> CS_INIT
2009-09-24 09:51:46.446805 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:51:46.446805 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_INIT
2009-09-24 09:51:46.446805 [DEBUG] switch_core_state_machine.c:422 (sofia/internal/1001@192.168.46.15) State INIT
2009-09-24 09:51:46.446805 [DEBUG] mod_sofia.c:83 sofia/internal/1001@192.168.46.15 SOFIA INIT
2009-09-24 09:51:46.446805 [DEBUG] mod_sofia.c:111 (sofia/internal/1001@192.168.46.15) State Change CS_INIT -> CS_ROUTING
2009-09-24 09:51:46.446805 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:51:46.446805 [DEBUG] switch_core_state_machine.c:422 (sofia/internal/1001@192.168.46.15) State INIT going to sleep
2009-09-24 09:51:46.446805 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_ROUTING
2009-09-24 09:51:46.446805 [DEBUG] switch_core_state_machine.c:425 (sofia/internal/1001@192.168.46.15) State ROUTING
2009-09-24 09:51:46.446805 [DEBUG] mod_sofia.c:130 sofia/internal/1001@192.168.46.15 SOFIA ROUTING
2009-09-24 09:51:46.446805 [DEBUG] switch_core_state_machine.c:78 sofia/internal/1001@192.168.46.15 Standard ROUTING
2009-09-24 09:51:46.446805 [INFO] mod_dialplan_xml.c:391 Processing 1001->3000 in context public
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9000] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9000] destination_number(3000) =~ /^9000$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9001] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9001] destination_number(3000) =~ /^9001$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9002] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9002] destination_number(3000) =~ /^9002$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9004] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9004] destination_number(3000) =~ /^9004$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9005] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9005] destination_number(3000) =~ /^9005$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9006] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9006] destination_number(3000) =~ /^9006$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9008] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9008] destination_number(3000) =~ /^9008$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->9009] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [9009] destination_number(3000) =~ /^9009$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->2000] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (FAIL) [2000] destination_number(3000) =~ /^2000$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 parsing [public->ticklemaster] continue=false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (PASS) [ticklemaster] destination_number(3000) =~ /^3000$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 Regex (PASS) [ticklemaster] caller_id_number(1001) =~ /^(10[01][0-9])$/ break=on-false
Dialplan: sofia/internal/1001@192.168.46.15 Action ring_ready() 
Dialplan: sofia/internal/1001@192.168.46.15 Action set(incoming_media=sip) 
Dialplan: sofia/internal/1001@192.168.46.15 Action set(instance_id=100) 
Dialplan: sofia/internal/1001@192.168.46.15 Action javascript(freedomfone/tickle/main.js ${instance_id} ${incoming_media}) 
2009-09-24 09:51:46.462778 [DEBUG] switch_core_state_machine.c:114 (sofia/internal/1001@192.168.46.15) State Change CS_ROUTING -> CS_EXECUTE
2009-09-24 09:51:46.462778 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:51:46.462778 [DEBUG] switch_core_state_machine.c:425 (sofia/internal/1001@192.168.46.15) State ROUTING going to sleep
2009-09-24 09:51:46.462778 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_EXECUTE
2009-09-24 09:51:46.462778 [DEBUG] switch_core_state_machine.c:432 (sofia/internal/1001@192.168.46.15) State EXECUTE
2009-09-24 09:51:46.462778 [DEBUG] mod_sofia.c:173 sofia/internal/1001@192.168.46.15 SOFIA EXECUTE
2009-09-24 09:51:46.462778 [DEBUG] switch_core_state_machine.c:151 sofia/internal/1001@192.168.46.15 Standard EXECUTE
EXECUTE sofia/internal/1001@192.168.46.15 ring_ready()
2009-09-24 09:51:46.462778 [DEBUG] mod_dptools.c:415 sofia/internal/1001@192.168.46.15 receive message [RINGING]
2009-09-24 09:51:46.462778 [NOTICE] mod_sofia.c:1443 Ring-Ready sofia/internal/1001@192.168.46.15!
2009-09-24 09:51:46.462778 [DEBUG] switch_core_session.c:630 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:51:46.462778 [NOTICE] mod_dptools.c:415 Ring Ready sofia/internal/1001@192.168.46.15!
EXECUTE sofia/internal/1001@192.168.46.15 set(incoming_media=sip)
2009-09-24 09:51:46.462778 [DEBUG] mod_dptools.c:748 sofia/internal/1001@192.168.46.15 SET [incoming_media]=[sip]
EXECUTE sofia/internal/1001@192.168.46.15 set(instance_id=100)
2009-09-24 09:51:46.462778 [DEBUG] sofia.c:3334 Channel sofia/internal/1001@192.168.46.15 entering state [early][180]
2009-09-24 09:51:46.462778 [DEBUG] mod_dptools.c:748 sofia/internal/1001@192.168.46.15 SET [instance_id]=[100]
EXECUTE sofia/internal/1001@192.168.46.15 javascript(freedomfone/tickle/main.js 100 sip)
2009-09-24 09:51:46.467013 [DEBUG] main.js:69 
2009-09-24 09:51:46.467013 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:51:46.467013 [DEBUG] main.js:69  [ STATE_TICKLE_IN ]  1001 Destination number sip

2009-09-24 09:51:46.467013 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:51:46.467013 [DEBUG] main.js:69 
EXECUTE sofia/internal/1001@192.168.46.15 sleep(10000)
2009-09-24 09:51:48.798732 [DEBUG] sofia.c:3334 Channel sofia/internal/1001@192.168.46.15 entering state [terminated][487]
2009-09-24 09:51:48.798732 [NOTICE] sofia.c:3900 Hangup sofia/internal/1001@192.168.46.15 [CS_EXECUTE] [ORIGINATOR_CANCEL]
2009-09-24 09:51:48.798732 [DEBUG] switch_channel.c:1726 Send signal sofia/internal/1001@192.168.46.15 [KILL]
2009-09-24 09:51:48.798732 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:51:48.798732 [DEBUG] switch_core_state_machine.c:533 thread mismatch skipping state handler.
2009-09-24 09:51:56.467970 [DEBUG] main.js:69 
2009-09-24 09:51:56.467970 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:51:56.467970 [DEBUG] main.js:69  [ STATE_HANGUP ] hangup sofia/internal/1001@192.168.46.15 ORIGINATOR_CANCEL

2009-09-24 09:51:56.467970 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:51:56.467970 [DEBUG] main.js:69 
2009-09-24 09:51:56.467970 [DEBUG] main.js:69 
2009-09-24 09:51:56.467970 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:51:56.467970 [DEBUG] main.js:69  [ STATE_ESL_EVENT ] 1001

2009-09-24 09:51:56.467970 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:51:56.467970 [DEBUG] main.js:69 
2009-09-24 09:51:56.467970 [DEBUG] main.js:69 
2009-09-24 09:51:56.467970 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:51:56.467970 [DEBUG] main.js:69  [ STATE_TICKLE_OUT ]  1001

2009-09-24 09:51:56.467970 [DEBUG] main.js:69  ========================================================== 
2009-09-24 09:51:56.467970 [DEBUG] main.js:69 
2009-09-24 09:51:56.467970 [DEBUG] switch_core_state_machine.c:432 (sofia/internal/1001@192.168.46.15) State EXECUTE going to sleep
2009-09-24 09:51:56.467970 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_HANGUP
2009-09-24 09:51:56.467970 [DEBUG] switch_core_state_machine.c:560 (sofia/internal/1001@192.168.46.15) State HANGUP
2009-09-24 09:51:56.467970 [DEBUG] mod_sofia.c:306 sofia/internal/1001@192.168.46.15 Overriding SIP cause 487 with 487 from the other leg
2009-09-24 09:51:56.467970 [DEBUG] mod_sofia.c:338 Channel sofia/internal/1001@192.168.46.15 hanging up, cause: ORIGINATOR_CANCEL
2009-09-24 09:51:56.467970 [DEBUG] switch_core_state_machine.c:46 sofia/internal/1001@192.168.46.15 Standard HANGUP, cause: ORIGINATOR_CANCEL
2009-09-24 09:51:56.467970 [DEBUG] switch_core_state_machine.c:560 (sofia/internal/1001@192.168.46.15) State HANGUP going to sleep
2009-09-24 09:51:56.467970 [DEBUG] switch_core_state_machine.c:417 (sofia/internal/1001@192.168.46.15) State Change CS_HANGUP -> CS_REPORTING
2009-09-24 09:51:56.467970 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:51:56.467970 [DEBUG] switch_core_state_machine.c:398 (sofia/internal/1001@192.168.46.15) Running State Change CS_REPORTING
2009-09-24 09:51:56.467970 [DEBUG] switch_core_state_machine.c:651 (sofia/internal/1001@192.168.46.15) State REPORTING
2009-09-24 09:51:56.467970 [DEBUG] switch_core_state_machine.c:53 sofia/internal/1001@192.168.46.15 Standard REPORTING, cause: ORIGINATOR_CANCEL
2009-09-24 09:51:56.467970 [DEBUG] switch_core_state_machine.c:651 (sofia/internal/1001@192.168.46.15) State REPORTING going to sleep
2009-09-24 09:51:56.467970 [DEBUG] switch_core_state_machine.c:411 (sofia/internal/1001@192.168.46.15) State Change CS_REPORTING -> CS_DESTROY
2009-09-24 09:51:56.467970 [DEBUG] switch_core_session.c:932 Send signal sofia/internal/1001@192.168.46.15 [BREAK]
2009-09-24 09:51:56.467970 [DEBUG] switch_core_session.c:1069 Session 3 (sofia/internal/1001@192.168.46.15) Locked, Waiting on external entities
2009-09-24 09:51:56.467970 [NOTICE] switch_core_session.c:1087 Session 3 (sofia/internal/1001@192.168.46.15) Ended
2009-09-24 09:51:56.467970 [NOTICE] switch_core_session.c:1089 Close Channel sofia/internal/1001@192.168.46.15 [CS_DESTROY]
2009-09-24 09:51:56.467970 [DEBUG] switch_core_state_machine.c:497 (sofia/internal/1001@192.168.46.15) Running State Change CS_DESTROY
2009-09-24 09:51:56.467970 [DEBUG] switch_core_state_machine.c:508 (sofia/internal/1001@192.168.46.15) State DESTROY
2009-09-24 09:51:56.467970 [DEBUG] mod_sofia.c:255 sofia/internal/1001@192.168.46.15 SOFIA DESTROY
2009-09-24 09:51:56.467970 [DEBUG] switch_core_state_machine.c:60 sofia/internal/1001@192.168.46.15 Standard DESTROY
2009-09-24 09:51:56.467970 [DEBUG] switch_core_state_machine.c:508 (sofia/internal/1001@192.168.46.15) State DESTROY going to sleep
2009-09-24 09:52:36.506720 [DEBUG] switch_nat.c:284 got UPnP keep alive packet: 
NOTIFY * HTTP/1.1
Host: 239.255.255.250:1900
NT:urn:schemas-upnp-org:service:WANIPConnection:1
NTS: ssdp:alive
USN:uuid:33333333-%04x-c0a8-2e010002cfab67::urn:schemas-upnp-org:service:WANIPConnection:1
Location:http://192.168.46.1:8080/DeviceDescription.xml
Cache-Control:max-age=480, no-cache="Ext"
Server:Allegro-Software-RomUpnp/4.07 UPnP/1.0 IGD/1.00




== GDB Output ==
===================== Start of gdb bt ========================
Core was generated by `/usr/local/freeswitch/bin/freeswitch -nc'.
Program terminated with signal 11, Segmentation fault.
[New process 6751]
[New process 7474]
[New process 7266]
[New process 6941]
[New process 6777]
[New process 6776]
[New process 6774]
[New process 6773]
[New process 6772]
[New process 6771]
[New process 6770]
[New process 6769]
[New process 6768]
[New process 6767]
[New process 6766]
[New process 6765]
[New process 6764]
[New process 6763]
[New process 6762]
[New process 6761]
[New process 6760]
[New process 6759]
[New process 6756]
[New process 6755]
[New process 6754]
[New process 6753]
[New process 6752]
[New process 6750]
[New process 6749]
#0  0xb7ab84ac in free () from /lib/tls/i686/cmov/libc.so.6
#0  0xb7ab84ac in free () from /lib/tls/i686/cmov/libc.so.6
#1  0xb7e0b368 in switch_event_destroy (event=0xb776a3a4) at src/switch_event.c:847
#2  0xb7e0db99 in switch_event_deliver (event=0xb776a3a4) at src/switch_event.c:355
#3  0xb7e0de25 in switch_event_dispatch_thread (thread=0x8069700, obj=0xb77ccad8) at src/switch_event.c:257
#4  0xb7e68d86 in dummy_worker (opaque=0x8069700) at threadproc/unix/thread.c:138
#5  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#6  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
===================== Start of gdb bt full ========================
Core was generated by `/usr/local/freeswitch/bin/freeswitch -nc'.
Program terminated with signal 11, Segmentation fault.
[New process 6751]
[New process 7474]
[New process 7266]
[New process 6941]
[New process 6777]
[New process 6776]
[New process 6774]
[New process 6773]
[New process 6772]
[New process 6771]
[New process 6770]
[New process 6769]
[New process 6768]
[New process 6767]
[New process 6766]
[New process 6765]
[New process 6764]
[New process 6763]
[New process 6762]
[New process 6761]
[New process 6760]
[New process 6759]
[New process 6756]
[New process 6755]
[New process 6754]
[New process 6753]
[New process 6752]
[New process 6750]
[New process 6749]
#0  0xb7ab84ac in free () from /lib/tls/i686/cmov/libc.so.6
#0  0xb7ab84ac in free () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#1  0xb7e0b368 in switch_event_destroy (event=0xb776a3a4) at src/switch_event.c:847
	ep = (switch_event_t *) 0xb6b73090
	hp = (switch_event_header_t *) 0xb6b753d8
#2  0xb7e0db99 in switch_event_deliver (event=0xb776a3a4) at src/switch_event.c:355
	e = SWITCH_EVENT_ALL
	node = (switch_event_node_t *) 0x0
#3  0xb7e0de25 in switch_event_dispatch_thread (thread=0x8069700, obj=0xb77ccad8) at src/switch_event.c:257
	pop = (void *) 0xb6b73090
	event = (switch_event_t *) 0xb6b73090
	my_id = 0
	__func__ = "switch_event_dispatch_thread"
#4  0xb7e68d86 in dummy_worker (opaque=0x8069700) at threadproc/unix/thread.c:138
No locals.
#5  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#6  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
===================== Start of gdb thread apply all bt ========================
Core was generated by `/usr/local/freeswitch/bin/freeswitch -nc'.
Program terminated with signal 11, Segmentation fault.
[New process 6751]
[New process 7474]
[New process 7266]
[New process 6941]
[New process 6777]
[New process 6776]
[New process 6774]
[New process 6773]
[New process 6772]
[New process 6771]
[New process 6770]
[New process 6769]
[New process 6768]
[New process 6767]
[New process 6766]
[New process 6765]
[New process 6764]
[New process 6763]
[New process 6762]
[New process 6761]
[New process 6760]
[New process 6759]
[New process 6756]
[New process 6755]
[New process 6754]
[New process 6753]
[New process 6752]
[New process 6750]
[New process 6749]
#0  0xb7ab84ac in free () from /lib/tls/i686/cmov/libc.so.6

Thread 29 (process 6749):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
#2  0xb7e6a929 in apr_sleep (t=1000000) at time/unix/time.c:246
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
#4  0xb7dfb674 in switch_core_runtime_loop (bg=1) at src/switch_core.c:695
#5  0x0804a8eb in main (argc=2, argv=) at src/switch.c:753

Thread 28 (process 6750):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
#2  0xb7e6a929 in apr_sleep (t=100000) at time/unix/time.c:246
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
#4  0xb7de8516 in pool_thread (thread=0xb7900da8, obj=0x0) at src/switch_core_memory.c:531
#5  0xb7e68d86 in dummy_worker (opaque=0xb7900da8) at threadproc/unix/thread.c:138
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 27 (process 6752):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7d56aa5 in pthread_cond_wait@@GLIBC_2.3.2 () from /lib/tls/i686/cmov/libpthread.so.0
#2  0xb7e62c4a in apr_thread_cond_wait (cond=0x805f950, mutex=0x805f920) at locks/unix/thread_cond.c:68
#3  0xb7e5978b in apr_queue_pop (queue=0x805f8f0, data=0xb772e3a8) at misc/apr_queue.c:276
#4  0xb7dd62d4 in switch_queue_pop (queue=0x805f8f0, data=0xb772e3a8) at src/switch_apr.c:907
#5  0xb7e0d0b0 in switch_event_thread (thread=0x8069720, obj=0x805f8f0) at src/switch_event.c:291
#6  0xb7e68d86 in dummy_worker (opaque=0x8069720) at threadproc/unix/thread.c:138
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 26 (process 6753):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7d56aa5 in pthread_cond_wait@@GLIBC_2.3.2 () from /lib/tls/i686/cmov/libpthread.so.0
#2  0xb7e62c4a in apr_thread_cond_wait (cond=0xb7892b38, mutex=0xb7892b08) at locks/unix/thread_cond.c:68
#3  0xb7e5978b in apr_queue_pop (queue=0xb7892ad8, data=0xb76f23a8) at misc/apr_queue.c:276
#4  0xb7dd62d4 in switch_queue_pop (queue=0xb7892ad8, data=0xb76f23a8) at src/switch_apr.c:907
#5  0xb7e0d0b0 in switch_event_thread (thread=0x8069740, obj=0xb7892ad8) at src/switch_event.c:291
#6  0xb7e68d86 in dummy_worker (opaque=0x8069740) at threadproc/unix/thread.c:138
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 25 (process 6754):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7d56aa5 in pthread_cond_wait@@GLIBC_2.3.2 () from /lib/tls/i686/cmov/libpthread.so.0
#2  0xb7e62c4a in apr_thread_cond_wait (cond=0xb782fb38, mutex=0xb782fb08) at locks/unix/thread_cond.c:68
#3  0xb7e5978b in apr_queue_pop (queue=0xb782fad8, data=0xb76b63a8) at misc/apr_queue.c:276
#4  0xb7dd62d4 in switch_queue_pop (queue=0xb782fad8, data=0xb76b63a8) at src/switch_apr.c:907
#5  0xb7e0d0b0 in switch_event_thread (thread=0x8069760, obj=0xb782fad8) at src/switch_event.c:291
#6  0xb7e68d86 in dummy_worker (opaque=0x8069760) at threadproc/unix/thread.c:138
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 24 (process 6755):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
#2  0xb7e6a929 in apr_sleep (t=5000000) at time/unix/time.c:246
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
#4  0xb7e3c22a in switch_nat_multicast_runtime (thread=0xb77cce50, obj=0x0) at src/switch_nat.c:268
#5  0xb7e68d86 in dummy_worker (opaque=0xb77cce50) at threadproc/unix/thread.c:138
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 23 (process 6756):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7d56aa5 in pthread_cond_wait@@GLIBC_2.3.2 () from /lib/tls/i686/cmov/libpthread.so.0
#2  0xb7e62c4a in apr_thread_cond_wait (cond=0xb77ccf08, mutex=0xb77cced8) at locks/unix/thread_cond.c:68
#3  0xb7e5978b in apr_queue_pop (queue=0xb77ccea8, data=0xb75a63a8) at misc/apr_queue.c:276
#4  0xb7dd62d4 in switch_queue_pop (queue=0xb77ccea8, data=0xb75a63a8) at src/switch_apr.c:907
#5  0xb7e3d334 in log_thread (t=0xb7608ae0, obj=0x0) at src/switch_log.c:288
#6  0xb7e68d86 in dummy_worker (opaque=0xb7608ae0) at threadproc/unix/thread.c:138
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 22 (process 6759):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
#2  0xb7e6a929 in apr_sleep (t=1000) at time/unix/time.c:246
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
#4  0xb7ded2bb in switch_core_sql_thread (thread=0xb748eae8, obj=0x0) at src/switch_core_sqldb.c:220
#5  0xb7e68d86 in dummy_worker (opaque=0xb748eae8) at threadproc/unix/thread.c:138
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 21 (process 6760):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
#2  0xb7e6a929 in apr_sleep (t=500000) at time/unix/time.c:246
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
#4  0xb7e00134 in switch_scheduler_task_thread (thread=0x80d97e0, obj=0x0) at src/switch_scheduler.c:171
#5  0xb7e68d86 in dummy_worker (opaque=0x80d97e0) at threadproc/unix/thread.c:138
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 20 (process 6761):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b20676 in epoll_wait () from /lib/tls/i686/cmov/libc.so.6
#2  0xb73506ad in su_epoll_port_wait_events (self=0x80f16b8, tout=1000) at su_epoll_port.c:495
#3  0xb7359735 in su_base_port_step (self=0x80f16b8, tout=1000) at su_base_port.c:467
#4  0xb735e96d in su_port_step (self=0x80f16b8, tout=1000) at su_port.h:340
#5  0xb735e93d in su_root_step (self=0x80f76b0, tout=1000) at su_root.c:858
#6  0xb72849b6 in sofia_profile_thread_run (thread=0x81066c8, obj=0x8105988) at sofia.c:973
#7  0xb7e68d86 in dummy_worker (opaque=0x81066c8) at threadproc/unix/thread.c:138
#8  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#9  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 19 (process 6762):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b20676 in epoll_wait () from /lib/tls/i686/cmov/libc.so.6
#2  0xb73506ad in su_epoll_port_wait_events (self=0x80f5908, tout=1000) at su_epoll_port.c:495
#3  0xb7359735 in su_base_port_step (self=0x80f5908, tout=1000) at su_base_port.c:467
#4  0xb735e96d in su_port_step (self=0x80f5908, tout=1000) at su_port.h:340
#5  0xb735e93d in su_root_step (self=0x80f5a58, tout=1000) at su_root.c:858
#6  0xb72849b6 in sofia_profile_thread_run (thread=0x8110d50, obj=0x81102d0) at sofia.c:973
#7  0xb7e68d86 in dummy_worker (opaque=0x8110d50) at threadproc/unix/thread.c:138
#8  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#9  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 18 (process 6763):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b20676 in epoll_wait () from /lib/tls/i686/cmov/libc.so.6
#2  0xb73506ad in su_epoll_port_wait_events (self=0x810ee90, tout=1000) at su_epoll_port.c:495
#3  0xb73595e4 in su_base_port_run (self=0x810ee90) at su_base_port.c:349
#4  0xb735e847 in su_port_run (self=0x810ee90) at su_port.h:326
#5  0xb735e824 in su_root_run (self=0x81167a0) at su_root.c:819
#6  0xb735d0b6 in su_pthread_port_clone_main (varg=0xb71a8048) at su_pthread_port.c:324
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 17 (process 6764):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b20676 in epoll_wait () from /lib/tls/i686/cmov/libc.so.6
#2  0xb73506ad in su_epoll_port_wait_events (self=0x810af10, tout=1000) at su_epoll_port.c:495
#3  0xb7359735 in su_base_port_step (self=0x810af10, tout=1000) at su_base_port.c:467
#4  0xb735e96d in su_port_step (self=0x810af10, tout=1000) at su_port.h:340
#5  0xb735e93d in su_root_step (self=0x80f7170, tout=1000) at su_root.c:858
#6  0xb72849b6 in sofia_profile_thread_run (thread=0x81199e8, obj=0x8118ea0) at sofia.c:973
#7  0xb7e68d86 in dummy_worker (opaque=0x81199e8) at threadproc/unix/thread.c:138
#8  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#9  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 16 (process 6765):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
#2  0xb7e6a929 in apr_sleep (t=1000) at time/unix/time.c:246
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
#4  0xb7272643 in sofia_profile_worker_thread_run (thread=0x8110e30, obj=0x81102d0) at sofia.c:763
#5  0xb7e68d86 in dummy_worker (opaque=0x8110e30) at threadproc/unix/thread.c:138
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 15 (process 6766):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b20676 in epoll_wait () from /lib/tls/i686/cmov/libc.so.6
#2  0xb73506ad in su_epoll_port_wait_events (self=0x8122380, tout=1000) at su_epoll_port.c:495
#3  0xb73595e4 in su_base_port_run (self=0x8122380) at su_base_port.c:349
#4  0xb735e847 in su_port_run (self=0x8122380) at su_port.h:326
#5  0xb735e824 in su_root_run (self=0x811e1d0) at su_root.c:819
#6  0xb735d0b6 in su_pthread_port_clone_main (varg=0xb71e4048) at su_pthread_port.c:324
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 14 (process 6767):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
#2  0xb7e6a929 in apr_sleep (t=1000) at time/unix/time.c:246
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
#4  0xb7272643 in sofia_profile_worker_thread_run (thread=0x81067a8, obj=0x8105988) at sofia.c:763
#5  0xb7e68d86 in dummy_worker (opaque=0x81067a8) at threadproc/unix/thread.c:138
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 13 (process 6768):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b20676 in epoll_wait () from /lib/tls/i686/cmov/libc.so.6
#2  0xb73506ad in su_epoll_port_wait_events (self=0x811d9f0, tout=1000) at su_epoll_port.c:495
#3  0xb73595e4 in su_base_port_run (self=0x811d9f0) at su_base_port.c:349
#4  0xb735e847 in su_port_run (self=0x811d9f0) at su_port.h:326
#5  0xb735e824 in su_root_run (self=0x81244c0) at su_root.c:819
#6  0xb735d0b6 in su_pthread_port_clone_main (varg=0xb712f048) at su_pthread_port.c:324
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 12 (process 6769):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
#2  0xb7e6a929 in apr_sleep (t=1000) at time/unix/time.c:246
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
#4  0xb7272643 in sofia_profile_worker_thread_run (thread=0x8119ac8, obj=0x8118ea0) at sofia.c:763
#5  0xb7e68d86 in dummy_worker (opaque=0x8119ac8) at threadproc/unix/thread.c:138
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 11 (process 6770):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
#2  0xb7e6a929 in apr_sleep (t=100000) at time/unix/time.c:246
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
#4  0xb729b08a in sofia_presence_event_thread_run (thread=0x8103d40, obj=0x0) at sofia_presence.c:709
#5  0xb7e68d86 in dummy_worker (opaque=0x8103d40) at threadproc/unix/thread.c:138
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 10 (process 6771):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
#2  0xb7e6a929 in apr_sleep (t=1000000) at time/unix/time.c:246
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
#4  0xb6e9e68c in ?? () from /usr/local/freeswitch/mod/mod_fifo.so
#5  0xb7e68d86 in dummy_worker (opaque=0x8141190) at threadproc/unix/thread.c:138
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 9 (process 6772):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7d56aa5 in pthread_cond_wait@@GLIBC_2.3.2 () from /lib/tls/i686/cmov/libpthread.so.0
#2  0xb7e62c4a in apr_thread_cond_wait (cond=0x80df9b8, mutex=0x80df988) at locks/unix/thread_cond.c:68
#3  0xb7dd73a4 in switch_thread_cond_wait (cond=0x80df9b8, mutex=0x80df988) at src/switch_apr.c:363
#4  0xb7e45de6 in timer_next (timer=0xb67840fc) at src/switch_time.c:340
#5  0xb7de576c in switch_core_timer_next (timer=0x10553d) at src/switch_core_timer.c:76
#6  0xb6c068be in ?? () from /usr/local/freeswitch/mod/mod_local_stream.so
#7  0xb7e68d86 in dummy_worker (opaque=0xb6b112e0) at threadproc/unix/thread.c:138
#8  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#9  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 8 (process 6773):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7d56aa5 in pthread_cond_wait@@GLIBC_2.3.2 () from /lib/tls/i686/cmov/libpthread.so.0
#2  0xb7e62c4a in apr_thread_cond_wait (cond=0x80df9b8, mutex=0x80df988) at locks/unix/thread_cond.c:68
#3  0xb7dd73a4 in switch_thread_cond_wait (cond=0x80df9b8, mutex=0x80df988) at src/switch_apr.c:363
#4  0xb7e45de6 in timer_next (timer=0xb67480fc) at src/switch_time.c:340
#5  0xb7de576c in switch_core_timer_next (timer=0x10553e) at src/switch_core_timer.c:76
#6  0xb6c068be in ?? () from /usr/local/freeswitch/mod/mod_local_stream.so
#7  0xb7e68d86 in dummy_worker (opaque=0xb6b15ec8) at threadproc/unix/thread.c:138
#8  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#9  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 7 (process 6774):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7d56aa5 in pthread_cond_wait@@GLIBC_2.3.2 () from /lib/tls/i686/cmov/libpthread.so.0
#2  0xb7e62c4a in apr_thread_cond_wait (cond=0x80df9b8, mutex=0x80df988) at locks/unix/thread_cond.c:68
#3  0xb7dd73a4 in switch_thread_cond_wait (cond=0x80df9b8, mutex=0x80df988) at src/switch_apr.c:363
#4  0xb7e45de6 in timer_next (timer=0xb670c0fc) at src/switch_time.c:340
#5  0xb7de576c in switch_core_timer_next (timer=0x10553f) at src/switch_core_timer.c:76
#6  0xb6c068be in ?? () from /usr/local/freeswitch/mod/mod_local_stream.so
#7  0xb7e68d86 in dummy_worker (opaque=0xb6b19ed8) at threadproc/unix/thread.c:138
#8  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#9  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 6 (process 6776):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
#2  0xb7e6a929 in apr_sleep (t=1000) at time/unix/time.c:246
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
#4  0xb7e47665 in softtimer_runtime () at src/switch_time.c:464
#5  0xb7e06ab3 in switch_loadable_module_exec (thread=0x80de5f8, obj=0x80de3e8) at src/switch_loadable_module.c:94
#6  0xb7e68d86 in dummy_worker (opaque=0x80de5f8) at threadproc/unix/thread.c:138
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 5 (process 6777):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7d59bb8 in accept () from /lib/tls/i686/cmov/libpthread.so.0
#2  0xb7e67a8f in apr_socket_accept (new=0xb646634c, sock=0x81c45f8, connection_context=0x8525830) at network_io/unix/sockets.c:187
#3  0xb7dd6a3b in switch_socket_accept (new_sock=0xb646634c, sock=0x81c45f8, pool=0x8525830) at src/switch_apr.c:668
#4  0xb73e84ec in mod_event_socket_runtime () at mod_event_socket.c:2324
#5  0xb7e06ab3 in switch_loadable_module_exec (thread=0x80de860, obj=0x80de650) at src/switch_loadable_module.c:94
#6  0xb7e68d86 in dummy_worker (opaque=0x80de860) at threadproc/unix/thread.c:138
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 4 (process 6941):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
#2  0xb7e6a929 in apr_sleep (t=1000) at time/unix/time.c:246
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
#4  0xb73e71c2 in read_packet (listener=0x81cb640, event=0xb6363b3c, timeout=0) at mod_event_socket.c:1255
#5  0xb73ec804 in ?? () from /usr/local/freeswitch/mod/mod_event_socket.so
#6  0xb7e68d86 in dummy_worker (opaque=0x8494300) at threadproc/unix/thread.c:138
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 3 (process 7266):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
#2  0xb7e6a929 in apr_sleep (t=1000) at time/unix/time.c:246
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
#4  0xb73e71c2 in read_packet (listener=0x82702c0, event=0xb6327b3c, timeout=0) at mod_event_socket.c:1255
#5  0xb73ec804 in ?? () from /usr/local/freeswitch/mod/mod_event_socket.so
#6  0xb7e68d86 in dummy_worker (opaque=0x864a350) at threadproc/unix/thread.c:138
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 2 (process 7474):
#0  0xb7f5e410 in __kernel_vsyscall ()
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
#2  0xb7e6a929 in apr_sleep (t=1000) at time/unix/time.c:246
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
#4  0xb73e71c2 in read_packet (listener=0x838fa08, event=0xb6429b3c, timeout=0) at mod_event_socket.c:1255
#5  0xb73ec804 in ?? () from /usr/local/freeswitch/mod/mod_event_socket.so
#6  0xb7e68d86 in dummy_worker (opaque=0x87ae380) at threadproc/unix/thread.c:138
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6

Thread 1 (process 6751):
#0  0xb7ab84ac in free () from /lib/tls/i686/cmov/libc.so.6
#1  0xb7e0b368 in switch_event_destroy (event=0xb776a3a4) at src/switch_event.c:847
#2  0xb7e0db99 in switch_event_deliver (event=0xb776a3a4) at src/switch_event.c:355
#3  0xb7e0de25 in switch_event_dispatch_thread (thread=0x8069700, obj=0xb77ccad8) at src/switch_event.c:257
#4  0xb7e68d86 in dummy_worker (opaque=0x8069700) at threadproc/unix/thread.c:138
#5  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
#6  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
===================== Start of gdb thread apply all bt full ========================
Core was generated by `/usr/local/freeswitch/bin/freeswitch -nc'.
Program terminated with signal 11, Segmentation fault.
[New process 6751]
[New process 7474]
[New process 7266]
[New process 6941]
[New process 6777]
[New process 6776]
[New process 6774]
[New process 6773]
[New process 6772]
[New process 6771]
[New process 6770]
[New process 6769]
[New process 6768]
[New process 6767]
[New process 6766]
[New process 6765]
[New process 6764]
[New process 6763]
[New process 6762]
[New process 6761]
[New process 6760]
[New process 6759]
[New process 6756]
[New process 6755]
[New process 6754]
[New process 6753]
[New process 6752]
[New process 6750]
[New process 6749]
#0  0xb7ab84ac in free () from /lib/tls/i686/cmov/libc.so.6

Thread 29 (process 6749):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb7e6a929 in apr_sleep (t=1000000) at time/unix/time.c:246
	tv = {tv_sec = 0, tv_usec = 468000}
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
No locals.
#4  0xb7dfb674 in switch_core_runtime_loop (bg=1) at src/switch_core.c:695
No locals.
#5  0x0804a8eb in main (argc=2, argv=) at src/switch.c:753
	pid_path = "/usr/local/freeswitch/log/freeswitch.pid", '\0' <repeats 215 times>
	pid_buffer = "6749", '\0' <repeats 27 times>
	old_pid_buffer = "6607", '\0' <repeats 27 times>
	pid_len = 4
	old_pid_len = 4
	err = 0xb7ef241e "Success"
	nf = 0
	runas_user = 0x0
	runas_group = 0x0
	nc = 1
	pid = 6749
	x = 2
	opts = <value optimized out>
	opts_str = '\0' <repeats 1023 times>
	local_argv = {0xbfe61920 "/usr/local/freeswitch/bin/freeswitch", 0xbfe61945 "-nc", 0x0 <repeats 1022 times>}
	arg_argv = {0x0 <repeats 128 times>}
	alt_dirs = 0
	known_opt = 1
	high_prio = 0
	flags = 129
	ret = <value optimized out>
	destroy_status = <value optimized out>
	fd = (switch_file_t *) 0x8053dc0
	pool = (switch_memory_pool_t *) 0x8053cf8
	rlp = {rlim_cur = 245760, rlim_max = 245760}
	waste = 0
	__PRETTY_FUNCTION__ = "main"

Thread 28 (process 6750):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb7e6a929 in apr_sleep (t=100000) at time/unix/time.c:246
	tv = {tv_sec = 0, tv_usec = 16000}
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
No locals.
#4  0xb7de8516 in pool_thread (thread=0xb7900da8, obj=0x0) at src/switch_core_memory.c:531
No locals.
#5  0xb7e68d86 in dummy_worker (opaque=0xb7900da8) at threadproc/unix/thread.c:138
No locals.
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 27 (process 6752):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7d56aa5 in pthread_cond_wait@@GLIBC_2.3.2 () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#2  0xb7e62c4a in apr_thread_cond_wait (cond=0x805f950, mutex=0x805f920) at locks/unix/thread_cond.c:68
	rv = -512
#3  0xb7e5978b in apr_queue_pop (queue=0x805f8f0, data=0xb772e3a8) at misc/apr_queue.c:276
	rv = 0
#4  0xb7dd62d4 in switch_queue_pop (queue=0x805f8f0, data=0xb772e3a8) at src/switch_apr.c:907
No locals.
#5  0xb7e0d0b0 in switch_event_thread (thread=0x8069720, obj=0x805f8f0) at src/switch_event.c:291
	pop = (void *) 0x0
	index = 0
	my_id = 0
	__func__ = "switch_event_thread"
#6  0xb7e68d86 in dummy_worker (opaque=0x8069720) at threadproc/unix/thread.c:138
No locals.
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 26 (process 6753):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7d56aa5 in pthread_cond_wait@@GLIBC_2.3.2 () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#2  0xb7e62c4a in apr_thread_cond_wait (cond=0xb7892b38, mutex=0xb7892b08) at locks/unix/thread_cond.c:68
	rv = -512
#3  0xb7e5978b in apr_queue_pop (queue=0xb7892ad8, data=0xb76f23a8) at misc/apr_queue.c:276
	rv = 0
#4  0xb7dd62d4 in switch_queue_pop (queue=0xb7892ad8, data=0xb76f23a8) at src/switch_apr.c:907
No locals.
#5  0xb7e0d0b0 in switch_event_thread (thread=0x8069740, obj=0xb7892ad8) at src/switch_event.c:291
	pop = (void *) 0x0
	index = 0
	my_id = 1
	__func__ = "switch_event_thread"
#6  0xb7e68d86 in dummy_worker (opaque=0x8069740) at threadproc/unix/thread.c:138
No locals.
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 25 (process 6754):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7d56aa5 in pthread_cond_wait@@GLIBC_2.3.2 () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#2  0xb7e62c4a in apr_thread_cond_wait (cond=0xb782fb38, mutex=0xb782fb08) at locks/unix/thread_cond.c:68
	rv = -512
#3  0xb7e5978b in apr_queue_pop (queue=0xb782fad8, data=0xb76b63a8) at misc/apr_queue.c:276
	rv = 0
#4  0xb7dd62d4 in switch_queue_pop (queue=0xb782fad8, data=0xb76b63a8) at src/switch_apr.c:907
No locals.
#5  0xb7e0d0b0 in switch_event_thread (thread=0x8069760, obj=0xb782fad8) at src/switch_event.c:291
	pop = (void *) 0x0
	index = 0
	my_id = 2
	__func__ = "switch_event_thread"
#6  0xb7e68d86 in dummy_worker (opaque=0x8069760) at threadproc/unix/thread.c:138
No locals.
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 24 (process 6755):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb7e6a929 in apr_sleep (t=5000000) at time/unix/time.c:246
	tv = {tv_sec = 3, tv_usec = 560000}
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
No locals.
#4  0xb7e3c22a in switch_nat_multicast_runtime (thread=0xb77cce50, obj=0x0) at src/switch_nat.c:268
	len = 0
	status = 4294966782
	newip = "83.59.37.53\000\000\000\000"
	pos = 0x80af707 ""
	event = (switch_event_t *) 0x0
	__func__ = "switch_nat_multicast_runtime"
	__PRETTY_FUNCTION__ = "switch_nat_multicast_runtime"
#5  0xb7e68d86 in dummy_worker (opaque=0xb77cce50) at threadproc/unix/thread.c:138
No locals.
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 23 (process 6756):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7d56aa5 in pthread_cond_wait@@GLIBC_2.3.2 () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#2  0xb7e62c4a in apr_thread_cond_wait (cond=0xb77ccf08, mutex=0xb77cced8) at locks/unix/thread_cond.c:68
	rv = -512
#3  0xb7e5978b in apr_queue_pop (queue=0xb77ccea8, data=0xb75a63a8) at misc/apr_queue.c:276
	rv = 0
#4  0xb7dd62d4 in switch_queue_pop (queue=0xb77ccea8, data=0xb75a63a8) at src/switch_apr.c:907
No locals.
#5  0xb7e3d334 in log_thread (t=0xb7608ae0, obj=0x0) at src/switch_log.c:288
	pop = (void *) 0x0
	node = (switch_log_node_t *) 0x0
	binding = (switch_log_binding_t *) 0x0
	__func__ = "log_thread"
#6  0xb7e68d86 in dummy_worker (opaque=0xb7608ae0) at threadproc/unix/thread.c:138
No locals.
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 22 (process 6759):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb7e6a929 in apr_sleep (t=1000) at time/unix/time.c:246
	tv = {tv_sec = 0, tv_usec = 1000}
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
No locals.
#4  0xb7ded2bb in switch_core_sql_thread (thread=0xb748eae8, obj=0x0) at src/switch_core_sqldb.c:220
	pop = (void *) 0xb6d50f70
	itterations = 0
	trans = 0 '\0'
	nothing_in_queue = 1 '\001'
	len = 0
	sql_len = 65536
	sqlbuf = 0x80c96c8 ""
	newlen = <value optimized out>
	lc = 0
	__PRETTY_FUNCTION__ = "switch_core_sql_thread"
	__func__ = "switch_core_sql_thread"
#5  0xb7e68d86 in dummy_worker (opaque=0xb748eae8) at threadproc/unix/thread.c:138
No locals.
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 21 (process 6760):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb7e6a929 in apr_sleep (t=500000) at time/unix/time.c:246
	tv = {tv_sec = 0, tv_usec = 32000}
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
No locals.
#4  0xb7e00134 in switch_scheduler_task_thread (thread=0x80d97e0, obj=0x0) at src/switch_scheduler.c:171
	__func__ = "switch_scheduler_task_thread"
#5  0xb7e68d86 in dummy_worker (opaque=0x80d97e0) at threadproc/unix/thread.c:138
No locals.
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 20 (process 6761):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b20676 in epoll_wait () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb73506ad in su_epoll_port_wait_events (self=0x80f16b8, tout=1000) at su_epoll_port.c:495
	j = 811705
	n = -832200264
	events = 0
	index = 135206584
	version = 1
	M = 4
	ev = 0xb71e4080
	__PRETTY_FUNCTION__ = "su_epoll_port_wait_events"
#3  0xb7359735 in su_base_port_step (self=0x80f16b8, tout=1000) at su_base_port.c:467
	now = {tv_sec = 3462767032, tv_usec = 811705}
	__PRETTY_FUNCTION__ = "su_base_port_step"
#4  0xb735e96d in su_port_step (self=0x80f16b8, tout=1000) at su_port.h:340
	base = (su_virtual_port_t *) 0x80f16b8
#5  0xb735e93d in su_root_step (self=0x80f76b0, tout=1000) at su_root.c:858
	__PRETTY_FUNCTION__ = "su_root_step"
#6  0xb72849b6 in sofia_profile_thread_run (thread=0x81066c8, obj=0x8105988) at sofia.c:973
	pool = <value optimized out>
	node = <value optimized out>
	s_event = (switch_event_t *) 0x0
	sanity = <value optimized out>
	worker_thread = (switch_thread_t *) 0x81067a8
	st = SWITCH_STATUS_SUCCESS
	__func__ = "sofia_profile_thread_run"
	__PRETTY_FUNCTION__ = "sofia_profile_thread_run"
#7  0xb7e68d86 in dummy_worker (opaque=0x81066c8) at threadproc/unix/thread.c:138
No locals.
#8  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#9  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 19 (process 6762):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b20676 in epoll_wait () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb73506ad in su_epoll_port_wait_events (self=0x80f5908, tout=1000) at su_epoll_port.c:495
	j = 799705
	n = -832200264
	events = 0
	index = 135223560
	version = 1
	M = 4
	ev = 0xb71a8080
	__PRETTY_FUNCTION__ = "su_epoll_port_wait_events"
#3  0xb7359735 in su_base_port_step (self=0x80f5908, tout=1000) at su_base_port.c:467
	now = {tv_sec = 3462767032, tv_usec = 799705}
	__PRETTY_FUNCTION__ = "su_base_port_step"
#4  0xb735e96d in su_port_step (self=0x80f5908, tout=1000) at su_port.h:340
	base = (su_virtual_port_t *) 0x80f5908
#5  0xb735e93d in su_root_step (self=0x80f5a58, tout=1000) at su_root.c:858
	__PRETTY_FUNCTION__ = "su_root_step"
#6  0xb72849b6 in sofia_profile_thread_run (thread=0x8110d50, obj=0x81102d0) at sofia.c:973
	pool = <value optimized out>
	node = <value optimized out>
	s_event = (switch_event_t *) 0x0
	sanity = <value optimized out>
	worker_thread = (switch_thread_t *) 0x8110e30
	st = SWITCH_STATUS_SUCCESS
	__func__ = "sofia_profile_thread_run"
	__PRETTY_FUNCTION__ = "sofia_profile_thread_run"
#7  0xb7e68d86 in dummy_worker (opaque=0x8110d50) at threadproc/unix/thread.c:138
No locals.
#8  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#9  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 18 (process 6763):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b20676 in epoll_wait () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb73506ad in su_epoll_port_wait_events (self=0x810ee90, tout=1000) at su_epoll_port.c:495
	j = 135358408
	n = -1221491805
	events = 0
	index = 1000
	version = 3
	M = 4
	ev = 0xb716c270
	__PRETTY_FUNCTION__ = "su_epoll_port_wait_events"
#3  0xb73595e4 in su_base_port_run (self=0x810ee90) at su_base_port.c:349
	tout = 1000
	tout2 = 0
	__PRETTY_FUNCTION__ = "su_base_port_run"
#4  0xb735e847 in su_port_run (self=0x810ee90) at su_port.h:326
	base = (su_virtual_port_t *) 0x810ee90
#5  0xb735e824 in su_root_run (self=0x81167a0) at su_root.c:819
	__PRETTY_FUNCTION__ = "su_root_run"
#6  0xb735d0b6 in su_pthread_port_clone_main (varg=0xb71a8048) at su_pthread_port.c:324
	arg = (struct clone_args *) 0x0
	task = {{sut_port = 0x810ee90, sut_root = 0x81167a0}}
	zap = 1
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 17 (process 6764):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b20676 in epoll_wait () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb73506ad in su_epoll_port_wait_events (self=0x810af10, tout=1000) at su_epoll_port.c:495
	j = 886729
	n = -832200264
	events = 0
	index = 135311120
	version = 1
	M = 4
	ev = 0xb712f080
	__PRETTY_FUNCTION__ = "su_epoll_port_wait_events"
#3  0xb7359735 in su_base_port_step (self=0x810af10, tout=1000) at su_base_port.c:467
	now = {tv_sec = 3462767032, tv_usec = 886729}
	__PRETTY_FUNCTION__ = "su_base_port_step"
#4  0xb735e96d in su_port_step (self=0x810af10, tout=1000) at su_port.h:340
	base = (su_virtual_port_t *) 0x810af10
#5  0xb735e93d in su_root_step (self=0x80f7170, tout=1000) at su_root.c:858
	__PRETTY_FUNCTION__ = "su_root_step"
#6  0xb72849b6 in sofia_profile_thread_run (thread=0x81199e8, obj=0x8118ea0) at sofia.c:973
	pool = <value optimized out>
	node = <value optimized out>
	s_event = (switch_event_t *) 0x0
	sanity = <value optimized out>
	worker_thread = (switch_thread_t *) 0x8119ac8
	st = SWITCH_STATUS_SUCCESS
	__func__ = "sofia_profile_thread_run"
	__PRETTY_FUNCTION__ = "sofia_profile_thread_run"
#7  0xb7e68d86 in dummy_worker (opaque=0x81199e8) at threadproc/unix/thread.c:138
No locals.
#8  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#9  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 16 (process 6765):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb7e6a929 in apr_sleep (t=1000) at time/unix/time.c:246
	tv = {tv_sec = 0, tv_usec = 0}
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
No locals.
#4  0xb7272643 in sofia_profile_worker_thread_run (thread=0x8110e30, obj=0x81102d0) at sofia.c:763
	ireg_loops = 12
	gateway_loops = 0
	loops = 63
	qsize = 4294966782
	pop = (void *) 0x0
	__PRETTY_FUNCTION__ = "sofia_profile_worker_thread_run"
#5  0xb7e68d86 in dummy_worker (opaque=0x8110e30) at threadproc/unix/thread.c:138
No locals.
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 15 (process 6766):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b20676 in epoll_wait () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb73506ad in su_epoll_port_wait_events (self=0x8122380, tout=1000) at su_epoll_port.c:495
	j = 135389736
	n = -1221491805
	events = 0
	index = 1000
	version = 3
	M = 4
	ev = 0xb7085270
	__PRETTY_FUNCTION__ = "su_epoll_port_wait_events"
#3  0xb73595e4 in su_base_port_run (self=0x8122380) at su_base_port.c:349
	tout = 1000
	tout2 = 0
	__PRETTY_FUNCTION__ = "su_base_port_run"
#4  0xb735e847 in su_port_run (self=0x8122380) at su_port.h:326
	base = (su_virtual_port_t *) 0x8122380
#5  0xb735e824 in su_root_run (self=0x811e1d0) at su_root.c:819
	__PRETTY_FUNCTION__ = "su_root_run"
#6  0xb735d0b6 in su_pthread_port_clone_main (varg=0xb71e4048) at su_pthread_port.c:324
	arg = (struct clone_args *) 0x0
	task = {{sut_port = 0x8122380, sut_root = 0x811e1d0}}
	zap = 1
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 14 (process 6767):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb7e6a929 in apr_sleep (t=1000) at time/unix/time.c:246
	tv = {tv_sec = 0, tv_usec = 0}
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
No locals.
#4  0xb7272643 in sofia_profile_worker_thread_run (thread=0x81067a8, obj=0x8105988) at sofia.c:763
	ireg_loops = 12
	gateway_loops = 0
	loops = 83
	qsize = 4294966782
	pop = (void *) 0x0
	__PRETTY_FUNCTION__ = "sofia_profile_worker_thread_run"
#5  0xb7e68d86 in dummy_worker (opaque=0x81067a8) at threadproc/unix/thread.c:138
No locals.
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 13 (process 6768):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b20676 in epoll_wait () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb73506ad in su_epoll_port_wait_events (self=0x811d9f0, tout=1000) at su_epoll_port.c:495
	j = 135395336
	n = -1221491805
	events = 0
	index = 1000
	version = 3
	M = 4
	ev = 0xb6fdb270
	__PRETTY_FUNCTION__ = "su_epoll_port_wait_events"
#3  0xb73595e4 in su_base_port_run (self=0x811d9f0) at su_base_port.c:349
	tout = 1000
	tout2 = 0
	__PRETTY_FUNCTION__ = "su_base_port_run"
#4  0xb735e847 in su_port_run (self=0x811d9f0) at su_port.h:326
	base = (su_virtual_port_t *) 0x811d9f0
#5  0xb735e824 in su_root_run (self=0x81244c0) at su_root.c:819
	__PRETTY_FUNCTION__ = "su_root_run"
#6  0xb735d0b6 in su_pthread_port_clone_main (varg=0xb712f048) at su_pthread_port.c:324
	arg = (struct clone_args *) 0x0
	task = {{sut_port = 0x811d9f0, sut_root = 0x81244c0}}
	zap = 1
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 12 (process 6769):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb7e6a929 in apr_sleep (t=1000) at time/unix/time.c:246
	tv = {tv_sec = 0, tv_usec = 0}
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
No locals.
#4  0xb7272643 in sofia_profile_worker_thread_run (thread=0x8119ac8, obj=0x8118ea0) at sofia.c:763
	ireg_loops = 8
	gateway_loops = 0
	loops = 86
	qsize = 4294966782
	pop = (void *) 0xb6b00a70
	__PRETTY_FUNCTION__ = "sofia_profile_worker_thread_run"
#5  0xb7e68d86 in dummy_worker (opaque=0x8119ac8) at threadproc/unix/thread.c:138
No locals.
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 11 (process 6770):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb7e6a929 in apr_sleep (t=100000) at time/unix/time.c:246
	tv = {tv_sec = 0, tv_usec = 56000}
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
No locals.
#4  0xb729b08a in sofia_presence_event_thread_run (thread=0x8103d40, obj=0x0) at sofia_presence.c:709
	count = 0
	pop = (void *) 0xb6d48918
	__func__ = "sofia_presence_event_thread_run"
#5  0xb7e68d86 in dummy_worker (opaque=0x8103d40) at threadproc/unix/thread.c:138
No locals.
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 10 (process 6771):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb7e6a929 in apr_sleep (t=1000000) at time/unix/time.c:246
	tv = {tv_sec = 0, tv_usec = 268000}
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
No locals.
#4  0xb6e9e68c in ?? () from /usr/local/freeswitch/mod/mod_fifo.so
No locals.
#5  0xb7e68d86 in dummy_worker (opaque=0x8141190) at threadproc/unix/thread.c:138
No locals.
#6  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#7  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 9 (process 6772):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7d56aa5 in pthread_cond_wait@@GLIBC_2.3.2 () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#2  0xb7e62c4a in apr_thread_cond_wait (cond=0x80df9b8, mutex=0x80df988) at locks/unix/thread_cond.c:68
	rv = -512
#3  0xb7dd73a4 in switch_thread_cond_wait (cond=0x80df9b8, mutex=0x80df988) at src/switch_apr.c:363
No locals.
#4  0xb7e45de6 in timer_next (timer=0xb67840fc) at src/switch_time.c:340
	private_info = (timer_private_t *) 0xb6b12028
	cond_index = 20
#5  0xb7de576c in switch_core_timer_next (timer=0x10553d) at src/switch_core_timer.c:76
	__func__ = "switch_core_timer_next"
#6  0xb6c068be in ?? () from /usr/local/freeswitch/mod/mod_local_stream.so
No locals.
#7  0xb7e68d86 in dummy_worker (opaque=0xb6b112e0) at threadproc/unix/thread.c:138
No locals.
#8  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#9  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 8 (process 6773):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7d56aa5 in pthread_cond_wait@@GLIBC_2.3.2 () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#2  0xb7e62c4a in apr_thread_cond_wait (cond=0x80df9b8, mutex=0x80df988) at locks/unix/thread_cond.c:68
	rv = -512
#3  0xb7dd73a4 in switch_thread_cond_wait (cond=0x80df9b8, mutex=0x80df988) at src/switch_apr.c:363
No locals.
#4  0xb7e45de6 in timer_next (timer=0xb67480fc) at src/switch_time.c:340
	private_info = (timer_private_t *) 0xb6b17080
	cond_index = 20
#5  0xb7de576c in switch_core_timer_next (timer=0x10553e) at src/switch_core_timer.c:76
	__func__ = "switch_core_timer_next"
#6  0xb6c068be in ?? () from /usr/local/freeswitch/mod/mod_local_stream.so
No locals.
#7  0xb7e68d86 in dummy_worker (opaque=0xb6b15ec8) at threadproc/unix/thread.c:138
No locals.
#8  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#9  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 7 (process 6774):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7d56aa5 in pthread_cond_wait@@GLIBC_2.3.2 () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#2  0xb7e62c4a in apr_thread_cond_wait (cond=0x80df9b8, mutex=0x80df988) at locks/unix/thread_cond.c:68
	rv = -512
#3  0xb7dd73a4 in switch_thread_cond_wait (cond=0x80df9b8, mutex=0x80df988) at src/switch_apr.c:363
No locals.
#4  0xb7e45de6 in timer_next (timer=0xb670c0fc) at src/switch_time.c:340
	private_info = (timer_private_t *) 0xb6b1b940
	cond_index = 20
#5  0xb7de576c in switch_core_timer_next (timer=0x10553f) at src/switch_core_timer.c:76
	__func__ = "switch_core_timer_next"
#6  0xb6c068be in ?? () from /usr/local/freeswitch/mod/mod_local_stream.so
No locals.
#7  0xb7e68d86 in dummy_worker (opaque=0xb6b19ed8) at threadproc/unix/thread.c:138
No locals.
#8  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#9  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 6 (process 6776):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb7e6a929 in apr_sleep (t=1000) at time/unix/time.c:246
	tv = {tv_sec = 0, tv_usec = 0}
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
No locals.
#4  0xb7e47665 in softtimer_runtime () at src/switch_time.c:464
	current_ms = 2571
	x = <value optimized out>
	tick = 571
	ts = 1253778233199729
	last = 1253778233195731
	fwd_errs = 0
	rev_errs = 0
	__func__ = "softtimer_runtime"
#5  0xb7e06ab3 in switch_loadable_module_exec (thread=0x80de5f8, obj=0x80de3e8) at src/switch_loadable_module.c:94
	status = <value optimized out>
	module = (switch_loadable_module_t *) 0x80df920
	__PRETTY_FUNCTION__ = "switch_loadable_module_exec"
	__func__ = "switch_loadable_module_exec"
#6  0xb7e68d86 in dummy_worker (opaque=0x80de5f8) at threadproc/unix/thread.c:138
No locals.
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 5 (process 6777):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7d59bb8 in accept () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#2  0xb7e67a8f in apr_socket_accept (new=0xb646634c, sock=0x81c45f8, connection_context=0x8525830) at network_io/unix/sockets.c:187
No locals.
#3  0xb7dd6a3b in switch_socket_accept (new_sock=0xb646634c, sock=0x81c45f8, pool=0x8525830) at src/switch_apr.c:668
No locals.
#4  0xb73e84ec in mod_event_socket_runtime () at mod_event_socket.c:2324
	pool = (switch_memory_pool_t *) 0x81c44b8
	listener_pool = (switch_memory_pool_t *) 0x8525830
	rv = <value optimized out>
	sa = (switch_sockaddr_t *) 0x81c4540
	inbound_socket = (switch_socket_t *) 0x85258b8
	listener = <value optimized out>
	x = <value optimized out>
	__func__ = "mod_event_socket_runtime"
#5  0xb7e06ab3 in switch_loadable_module_exec (thread=0x80de860, obj=0x80de650) at src/switch_loadable_module.c:94
	status = <value optimized out>
	module = (switch_loadable_module_t *) 0x8101bd8
	__PRETTY_FUNCTION__ = "switch_loadable_module_exec"
	__func__ = "switch_loadable_module_exec"
#6  0xb7e68d86 in dummy_worker (opaque=0x80de860) at threadproc/unix/thread.c:138
No locals.
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 4 (process 6941):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb7e6a929 in apr_sleep (t=1000) at time/unix/time.c:246
	tv = {tv_sec = 0, tv_usec = 1000}
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
No locals.
#4  0xb73e71c2 in read_packet (listener=0x81cb640, event=0xb6363b3c, timeout=0) at mod_event_socket.c:1255
	do_sleep = 1 '\001'
	mlen = 0
	bytes = 0
	mbuf = '\0' <repeats 2047 times>
	buf = "Content-Type: log/data\nContent-Length: 107\nLog-Level: 7\nText-Channel: 0\nLog-File: switch_core_state_machine.c\nLog-Func: switch_core_session_hangup_state\nLog-Line: 533\nUser-Data: fbb3b26e-a8dd-11de-b00"...
	len = 107
	status = SWITCH_STATUS_BREAK
	count = <value optimized out>
	start = 1253775330
	pop = (void *) 0xb6d5ba88
	ptr = 0xb6362c38 ""
	crcount = 0 '\0'
	channel = (switch_channel_t *) 0x0
	clen = <value optimized out>
	__func__ = "read_packet"
	__PRETTY_FUNCTION__ = "read_packet"
#5  0xb73ec804 in ?? () from /usr/local/freeswitch/mod/mod_event_socket.so
No locals.
#6  0xb7e68d86 in dummy_worker (opaque=0x8494300) at threadproc/unix/thread.c:138
No locals.
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 3 (process 7266):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb7e6a929 in apr_sleep (t=1000) at time/unix/time.c:246
	tv = {tv_sec = 0, tv_usec = 1000}
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
No locals.
#4  0xb73e71c2 in read_packet (listener=0x82702c0, event=0xb6327b3c, timeout=0) at mod_event_socket.c:1255
	do_sleep = 1 '\001'
	mlen = 0
	bytes = 0
	mbuf = '\0' <repeats 2047 times>
	buf = "Content-Type: log/data\nContent-Length: 107\nLog-Level: 7\nText-Channel: 0\nLog-File: switch_core_state_machine.c\nLog-Func: switch_core_session_hangup_state\nLog-Line: 533\nUser-Data: fbb3b26e-a8dd-11de-b00"...
	len = 107
	status = SWITCH_STATUS_BREAK
	count = <value optimized out>
	start = 1253777990
	pop = (void *) 0xb6d5b540
	ptr = 0xb6326c38 ""
	crcount = 0 '\0'
	channel = (switch_channel_t *) 0x0
	clen = <value optimized out>
	__func__ = "read_packet"
	__PRETTY_FUNCTION__ = "read_packet"
#5  0xb73ec804 in ?? () from /usr/local/freeswitch/mod/mod_event_socket.so
No locals.
#6  0xb7e68d86 in dummy_worker (opaque=0x864a350) at threadproc/unix/thread.c:138
No locals.
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 2 (process 7474):
#0  0xb7f5e410 in __kernel_vsyscall ()
No symbol table info available.
#1  0xb7b18881 in select () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#2  0xb7e6a929 in apr_sleep (t=1000) at time/unix/time.c:246
	tv = {tv_sec = 0, tv_usec = 1000}
#3  0xb7e45b5e in do_sleep (t=4294966782) at src/switch_time.c:109
No locals.
#4  0xb73e71c2 in read_packet (listener=0x838fa08, event=0xb6429b3c, timeout=0) at mod_event_socket.c:1255
	do_sleep = 1 '\001'
	mlen = 0
	bytes = 0
	mbuf = '\0' <repeats 2047 times>
	buf = '\0' <repeats 1023 times>
	len = 614
	status = SWITCH_STATUS_BREAK
	count = <value optimized out>
	start = 1253778200
	pop = (void *) 0xb6d48918
	ptr = 0xb6428c38 ""
	crcount = 0 '\0'
	channel = (switch_channel_t *) 0x0
	clen = <value optimized out>
	__func__ = "read_packet"
	__PRETTY_FUNCTION__ = "read_packet"
#5  0xb73ec804 in ?? () from /usr/local/freeswitch/mod/mod_event_socket.so
No locals.
#6  0xb7e68d86 in dummy_worker (opaque=0x87ae380) at threadproc/unix/thread.c:138
No locals.
#7  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#8  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.

Thread 1 (process 6751):
#0  0xb7ab84ac in free () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
#1  0xb7e0b368 in switch_event_destroy (event=0xb776a3a4) at src/switch_event.c:847
	ep = (switch_event_t *) 0xb6b73090
	hp = (switch_event_header_t *) 0xb6b753d8
#2  0xb7e0db99 in switch_event_deliver (event=0xb776a3a4) at src/switch_event.c:355
	e = SWITCH_EVENT_ALL
	node = (switch_event_node_t *) 0x0
#3  0xb7e0de25 in switch_event_dispatch_thread (thread=0x8069700, obj=0xb77ccad8) at src/switch_event.c:257
	pop = (void *) 0xb6b73090
	event = (switch_event_t *) 0xb6b73090
	my_id = 0
	__func__ = "switch_event_dispatch_thread"
#4  0xb7e68d86 in dummy_worker (opaque=0x8069700) at threadproc/unix/thread.c:138
No locals.
#5  0xb7d524fb in start_thread () from /lib/tls/i686/cmov/libpthread.so.0
No symbol table info available.
#6  0xb7b1fe5e in clone () from /lib/tls/i686/cmov/libc.so.6
No symbol table info available.
