<?php

namespace App\Http\Enum;

enum TransactionStatus {
    case WAITING_CONFIRMATION;
    case CONFIRMED;
    case PICK_UP_PROCESS;
    case WAITING_FOR_SERVICE;
    case SERVICE_PROCESS;
    case WAITING_COURIER_FOR_SENDING_BACK_TO_CUSTOMER;
    case DONE;
}
