<?php
return ['default'=>env('QUEUE_CONNECTION','sync'),'connections'=>['sync'=>['driver'=>'sync']],'failed'=>['driver'=>'database-uuids','table'=>'failed_jobs','database'=>null]];
