In /etc/apache2/envvars

```
export EXAMPLE="this is an example"
```

In /var/www/html/<your file>.php

```
<?php getenv('example') ?>

// if PHP7, maybe you will need
// to use $_SERVER[] or $_ENV[]
```
