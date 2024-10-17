#!/bin/bash

# Get the current date and time in the desired format
current_date_time=$(LC_TIME=en_US.UTF-8 date +"%d/%B/%y, %I:%M%p")

# Print the result
version=$current_date_time
echo "$version" > version.php
echo "version: ${version}"


path_to_copy="/opt/lampp/htdocs/pms"
sudo rm -rf "${path_to_copy}"
sudo cp -r /opt/lampp/htdocs/patient-management-solution "$path_to_copy"
sudo chmod -R 777 "$path_to_copy"
sudo rm -rf "${path_to_copy}/src/files/surgeries/"
sudo rm -rf "${path_to_copy}/.idea"
sudo rm -rf "${path_to_copy}/.git"