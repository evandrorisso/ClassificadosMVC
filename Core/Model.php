<?php

	Class model {

		protected $db;

		public function __construct(){

			global $db;

			$this->db = $db;

		}


	}


?>