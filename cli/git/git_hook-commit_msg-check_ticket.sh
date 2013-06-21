#!/bin/bash

echo " >>> Running pre-commit hook: search ticket link"

test "" != "$(grep '#' $1)" || {
	echo >&2 "Ticket number not found! Use \"#\", Luck!";
	exit 1
}