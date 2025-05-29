#!/bin/sh
set -e

composer install

exec apache2-foreground