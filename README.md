# Shipnick

## Specification 
- Laravel Framework 8.83.27
- PHP v7.4
- Directory on server  = ```/home3/prosacgj/server20/shipnick.com/system```

## System Requirments
- php v7.4
- mysql >=v5.5

### Composer install
``` /c/wamp64/bin/php/php7.4.33/php composer.phar install```

### Artisan command
``` /c/wamp64/bin/php/php7.4.33/php artisan ```


### JOB managment 
#### Cleaning jobs from specific queue
- ```php artisan queue:clear --queue=order_status```

#### Start Scheduler to setup Jobs in queue as per conditions 
 - ``` php artisan schedule:run ```
 - Must be in crontab * * * * *

#### Running/setting specific Job queue 
 - ``` php artisan queue:work --queue=order_status --tries=3 --backoff=3 --stop-when-empty ```

### Cpanel Cronjobs 
``` * * * * * /usr/local/bin/php /home3/prosacgj/server20/shipnick.com/system/artisan queue:work --queue=order_status --tries=3 --backoff=3 --stop-when-empty >> /dev/null 2>&1 ```


 # Push Sashi's change from server
``` git add . && git commit -m "Shashi changes" ```

``` git push ```