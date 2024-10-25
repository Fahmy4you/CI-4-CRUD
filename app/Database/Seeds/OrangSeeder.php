<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use CodeIgniter\I18n\Time;

class OrangSeeder extends Seeder
{
  public function run()
  {
    $data = [
      [
        'nama'        => 'Fbaz',
        'alamat'      => 'Jl. FbazGans No.7',
        'created_at'  => Time::now(),
        'updated_at'  => Time::now(),
      ],
      [
        'nama'        => 'Jefri',
        'alamat'      => 'Jl. Jefri No.3',
        'created_at'  => Time::now(),
        'updated_at'  => Time::now(),
      ],
      [
        'nama'        => 'Cooky',
        'alamat'      => 'Jl. Cooky No.4',
        'created_at'  => Time::now(),
        'updated_at'  => Time::now(),
      ],
    ];

    // Simple Queries
    /*
    $this->db->query(
      "INSERT INTO orang (nama, alamat, created_at, updated_at) VALUES(:nama:, :alamat:, :created_at:, :updated_at:)",
      $data
      );
      */

    // Using Query Builder
    // $this->db->table('orang')->insert($data); // Hanya Bisa Insert 1 Data Aja
    $this->db->table('orang')->insertBatch($data);
  }
}