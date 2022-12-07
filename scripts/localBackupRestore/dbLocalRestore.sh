#!/bin/bash
mysqladmin -h $1 -u $2 -p$3 drop $4 -f 2>/dev/null || true
mysqladmin -h $1 -u $2 -p$3 create $4 -f 2>/dev/null || true

zcat $1 | mysql -h $2 -u$3 -p$4 $5
