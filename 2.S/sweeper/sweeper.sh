#!/bin/bash
#


#####################################################################
# Print warning message.

function warning()
{
    echo "$*" >&2
}

#####################################################################
# Print error message and exit.

function error()
{
    echo "$*" >&2
    exit 1
}


#####################################################################
# Ask yesno question.
#
# Usage: yesno OPTIONS QUESTION
#
#   Options:
#     --timeout N    Timeout if no input seen in N seconds.
#     --default ANS  Use ANS as the default answer on timeout or
#                    if an empty answer is provided.
#
# Exit status is the answer.

function yesno()
{
    local ans
    local ok=0
    local timeout=0
    local default
    local t

    while [[ "$1" ]]
    do
        case "$1" in
        --default)
            shift
            default=$1
            if [[ ! "$default" ]]; then error "Missing default value"; fi
            t=$(tr '[:upper:]' '[:lower:]' <<<$default)

            if [[ "$t" != 'y'  &&  "$t" != 'yes'  &&  "$t" != 'n'  &&  "$t" != 'no' ]]; then
                error "Illegal default answer: $default"
            fi
            default=$t
            shift
            ;;

        --timeout)
            shift
            timeout=$1
            if [[ ! "$timeout" ]]; then error "Missing timeout value"; fi
            if [[ ! "$timeout" =~ ^[0-9][0-9]*$ ]]; then error "Illegal timeout value: $timeout"; fi
            shift
            ;;

        -*)
            error "Unrecognized option: $1"
            ;;

        *)
            break
            ;;
        esac
    done

    if [[ $timeout -ne 0  &&  ! "$default" ]]; then
        error "Non-zero timeout requires a default answer"
    fi

    if [[ ! "$*" ]]; then error "Missing question"; fi

    while [[ $ok -eq 0 ]]
    do
        if [[ $timeout -ne 0 ]]; then
            if ! read -t $timeout -p "$*" ans; then
                ans=$default
            else
                # Turn off timeout if answer entered.
                timeout=0
                if [[ ! "$ans" ]]; then ans=$default; fi
            fi
        else
            read -p "$*" ans
            if [[ ! "$ans" ]]; then
                ans=$default
            else
                ans=$(tr '[:upper:]' '[:lower:]' <<<$ans)
            fi 
        fi

        if [[ "$ans" == 'y'  ||  "$ans" == 'yes'  ||  "$ans" == 'n'  ||  "$ans" == 'no' ]]; then
            ok=1
        fi

        if [[ $ok -eq 0 ]]; then warning "Valid answers are: yes y no n"; fi
    done
    [[ "$ans" = "y" || "$ans" == "yes" ]]
}

BASE=/opt/freedomfone/
# Questions start here
    
    echo "Do you want to disable syslog messages and internal mail notification when an audio message arrives (default: no)?"
    if yesno --default no ">> "; then
        cp $BASE/sweeper/iwatch/iwatch.xml.sec $BASE/audio_bot/iwatch/iwatch.xml 
	/etc/init.d/iwatch restart
    	echo "  *** DONE SEC ***"
    else
        cp $BASE/sweeper/iwatch/iwatch.xml.orig $BASE/audio_bot/iwatch/iwatch.xml 
	/etc/init.d/iwatch restart
    	echo "  *** DONE ***"
    fi


####
    echo "Do you want to disable Web server logs of the visitors to the website (default: no)?"
    if yesno --default no ">> "; then
        cp $BASE/sweeper/apache2/freedomfone.sec /etc/apache2/sites-enabled/freedomfone
        /etc/init.d/apache2 restart 
    	echo "  *** DONE SEC ***"
    else
        cp $BASE/sweeper/apache2/freedomfone.orig /etc/apache2/sites-enabled/freedomfone
        /etc/init.d/apache2 restart 
    	echo "  *** DONE ***"
    fi

####
    echo "Do you want to disable telephony logs (default: no)?"
    if yesno --default no ">> "; then
       cp $BASE/sweeper/freeswitch/logfile.conf.xml.sec /opt/freeswitch/conf/autoload_configs/logfile.conf.xml
       /etc/init.d/freeswitch stop
       /etc/init.d/dispatcher_in stop
       su - root  /etc/init.d/freeswitch start
       /etc/init.d/dispatcher_in start
    	echo "  *** DONE SEC ***"
    else
       cp $BASE/sweeper/freeswitch/logfile.conf.xml.orig /opt/freeswitch/conf/autoload_configs/logfile.conf.xml
       /etc/init.d/freeswitch stop
       /etc/init.d/dispatcher_in stop
       su - root  /etc/init.d/freeswitch start
       /etc/init.d/dispatcher_in start
    	echo "  *** DONE ***"
    fi
####
    echo "Do you want to delete all existing logs (default: no)?"
    if yesno --default no ">> "; then
	delete_logs
    else
        echo "  *** DONE ***";
    fi


function delete_logs() {

       /etc/init.d/freeswitch stop
       /etc/init.d/dispatcher_in stop
       /etc/init.d/apache2 stop
       echo "WARNING! All logs will be deleted. Press any key to continue or CTRL-C to Abort" 
       read 
       rm -Rf /opt/freedomfone/*.log
       /etc/init.d/dispatcher_in start
       /etc/init.d/apache2 start
       su - root  /etc/init.d/freeswitch start

}
