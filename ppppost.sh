BOTNAME="@selfportrait"
BASE=~/selfportrait
export SELFPORTRAIT_TEMPDIR="${BASE}/tmp"

log()
{
	LOGS="${BASE}/logs"
	LOGFILE="`date '+%Y-%m-%d'`.txt"
	MESSAGE=$1

	mkdir -p $LOGS
	echo "`date`  ${MESSAGE}" >> "${LOGS}/${LOGFILE}"
}

# Generate
GENERATED=$(/usr/bin/env php ${BASE}/src/generate.php)

if [ $? -eq 0 ]; then
	RESULT=$(/usr/bin/env ppppost to $BOTNAME --images "${SELFPORTRAIT_TEMPDIR}/portrait.png")

	# Error While Posting
	if [ $? -ne 0 ]; then
		log "${RESULT}"
		exit 1
	fi

# Error While Generating
else
	log "${GENERATED}"
	exit 1
fi
