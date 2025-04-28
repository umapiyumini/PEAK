    <?php

    class Certificaterequest{
        use Model;
        public $errors;
        protected $table = 'certificaterequest';

        protected $allowedColumns = [
            'RequestID',
            'tournament',
            'RegistrationNumber',
            'Year',
            'Sport',
            'date',
            'UserID',
            'status'
            
            
        ];

        public function validate($data){
            $this->errors = [];

            if(empty($data['tournament'])){
                $this->errors['tournament'] = 'Tournament is required';
            }

            if(empty($data['Year'])){
                $this->errors['Year'] = 'Year is required';
            }

            if(empty($data['Sport'])){
                $this->errors['Sport'] = 'Sport is required';
            }

            

            //var_dump($this->errors);
            return empty($this->errors);
        }

    
    }