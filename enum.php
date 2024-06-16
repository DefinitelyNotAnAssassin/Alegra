<?php

enum ProjectStatus: int {
    case PENDING = 0;
    case STARTED = 1;
    case IN_PROGRESS = 2;
    case CANCELLED = 3;
    case DONE = 5;
}

enum TaskStatus: int {
    case PENDING = 1;
    case IN_PROGRESS = 2;
    case DONE = 3;
}

enum ProjectStatusColor: string {
    case PENDING = '#f8ce2c';
    case STARTED = '#6aa338';
    case IN_PROGRESS = '#17a9d6';
    case CANCELLED = '#f00b2c';
    case DONE = '#339057'; 
}

?>

