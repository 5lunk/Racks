#!/bin/sh

MYPY_LOG="${BASE_APP_DIR}${LOGS_PATH}mypy_$(date +'%Y-%m-%d_%I-%M-%S').log"
touch $MYPY_LOG &&
chmod 666 $MYPY_LOG &&
mypy ./mainapp > $MYPY_LOG 2>&1 &&

exec "$@"