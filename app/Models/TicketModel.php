<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $table = 'ticket';
    protected $primaryKey = 'ticketId';
    protected $allowedFields = ['movieId', 'movieName', 'date', 'time', 'seats', 'price'];

    public function getDataTicket()
    {
        return $this->findAll();
    }
}
