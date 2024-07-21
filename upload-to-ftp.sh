#!/bin/bash

# FTP server details
FTP_SERVER="files.000webhost.com"
FTP_USERNAME="shakibulalam01"
FTP_PASSWORD="Shakibul@1"
LOCAL_DIR="/opt/lampp/htdocs/patient-management-solution"
REMOTE_DIR="public_html/"

# Function to upload files
upload_file() {
  local file=$1
  ftp -inv $FTP_SERVER <<EOF
user $FTP_USERNAME $FTP_PASSWORD
put $file $REMOTE_DIR/$(basename $file)
bye
EOF
}

# Find and upload changed files
find $LOCAL_DIR -type f -newermt "$(date -d '1 day ago' '+%Y-%m-%d %H:%M:%S')" | while read file; do
  upload_file $file
done
