<?php

namespace App\Controllers;

class Pages extends BaseController
{
	public function index()
	{
	  $data = [
	    'title' => 'Home Page',
	 ];
	  return view('pages/home', $data);
	}
	
	public function about() 
	{
	  $data = [
	    'title' => 'Page Home About',
	 ];
	  return view('pages/about', $data);
	}
	
	public function contact()
	{
	  $data = [
	    "title"  => "Contact Us",
	    "alamat" => [
	      [
	      'no'     => '1',
	      'tipe'   => 'Rumah',
	      'alamat' => 'Jl. Abc No.8',
	      'kota'   => 'Jember',
	      ],
	      [
	      'no'     => '2',
	      'tipe'   => 'Kantor',
	      'alamat' => 'Jl. Kintil No.8',
	      'kota'   => 'Malang',
	      ],
	     ]
	   ];
	   
	   return view('pages/contact', $data);
	}
}
