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

if [[ $(basename "$0" .sh) == 'yesno' ]]; then
    if yesno "Test bad timeout value? "; then
        yesno --timeout none "Hello? "
    fi
    if yesno "Test timeout without default value? "; then
        yesno --timeout 10 "Hello? "
    fi
    if yesno "Test bad default value? "; then
        yesno --default none "Hello? "
    fi

    if yesno "Yes or no? "; then
        echo "You answered yes"
    else
        echo "You answered no"
    fi
    if yesno --default yes "Yes or no (default yes) ? "; then
        echo "You answered yes"
    else
        echo "You answered no"
    fi
    if yesno --default no "Yes or no (default no) ? "; then
        echo "You answered yes"
    else
        echo "You answered no"
    fi
    if yesno --timeout 5 --default no "Yes or no (timeout 5, default no) ? "; then
        echo "You answered yes"
    else
        echo "You answered no"
    fi
    if yesno --timeout 5 --default yes "Yes or no (timeout 5, default yes) ? "; then
        echo "You answered yes"
    else
        echo "You answered no"
    fi
fi

