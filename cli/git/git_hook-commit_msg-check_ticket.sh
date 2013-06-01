#!/bin/bash

echo " >>> Running pre-commit hook: search ticket link"

if [[ "$1" =~ '#' ]]
then
	exit 0;
else
	echo "Ticket number not found! Use \"#\", Luck!";
	exit 1;
fi