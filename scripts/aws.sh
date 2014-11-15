#!/bin/bash
## 
## Questo script prepara il sistema Docker per AWS
##

# PATH: Nessuna assunzione deve essere fatta. Gaia su /var/www/
# USER: Questo script viene eseguito da 'root'

cp /var/www/core/conf/sample/*.php /var/www/core/conf/
cp -f /var/www/core/conf/sample/aws-eb/* /var/www/core/conf/
