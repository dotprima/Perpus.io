<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	public $users = [
		'name'         => 'required|min_length[5]',
		'email'       => 'required|valid_email',
		'address'       => 'required|min_length[5]',
		'phone'       => 'required|min_length[5]',
		'nik'       => 'required|integer|min_length[5]',
	];

	public $buku = [
		'judul' => 'required|min_length[5]',
        'tahun' => 'required|integer|min_length[4]|max_length[4]',
        'penulis' => 'required|min_length[5]',
        'penerbit' => 'required|min_length[5]',
        'stock' => 'required|integer|min_length[1]',
        'url' => 'required|min_length[5]',
        'harga' => 'required|integer|min_length[2]',
	];

	 
	

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
}