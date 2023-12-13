<?php

namespace App\Models;

use CodeIgniter\Model;

class MovieModel extends Model
{
    protected $table = 'movies';
    protected $primaryKey = 'movieId';

    public function getDataMovie()
    {
        return $this->findAll();
    }
}
