<?php

class profesorController extends Controller


{
    
    
        public function __construct()
        {
            parent::__construct();
    
        }
    
        public function index()
        {
            $this->_view->titulo = 'Profesor';
            $this->_view->renderizar('index');
    
    
        }
    
    }
    ?>