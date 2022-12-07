#!/bin/bash
mysqldump -h $1 -u $2 -p$3 $4 | gzip -9 > $5
