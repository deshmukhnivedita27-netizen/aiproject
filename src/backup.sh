cd /var/www/html/Mailer_V2/spark_n/
tar cvfz rosstanner0_sparkpost_backup.tar.gz open bounce
mv rosstanner0_sparkpost_backup.tar.gz /var/www/html/Mailer_V2/spark_n/rosstanner0_sparkpost_backup.tar.gz
curl -sS http://aps-ui.com/backup_sparkpost/bk.php >> /var/www/html/backup_sparkpost/stats.txt
