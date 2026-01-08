#!/bin/sh
set -e

: "${SLEEP_SECONDS:=10}"
: "${MYSQL_HOST:=dockerdb}"
: "${MYSQL_USER:=root}"
: "${MYSQL_PASSWORD:=pass}"
: "${MYSQL_DATABASE:=testdb}"

echo "[backup] Iniciando ciclo (cada ${SLEEP_SECONDS}s) contra ${MYSQL_HOST}/${MYSQL_DATABASE}"

while true; do
  TS=$(date +%F-%H%M%S)
  FILE="/backups/backup-$TS.sql"
  echo "[backup] Generando $FILE ..."
  mariadb-dump -h "$MYSQL_HOST" -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" --databases "$MYSQL_DATABASE" --skip-ssl > "$FILE"
  echo "[backup] OK -> $FILE"
  sleep "${SLEEP_SECONDS}"
done