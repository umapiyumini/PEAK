<?php

class MedicalRequest{
    use Model;
    protected $errors;
    protected $table = 'medicalrequests';

    protected $allowedColumns = [
        'RequestID',
        'Name',
        'RegistrationID',
        'ReasonForMedical',
        'userid'
        
    ];

    public function validate($data){
        $this->errors = [];

        if(empty($data['Name'])){
            $this->errors['Name'] = 'Name is required';
        }

        if(empty($data['RegistrationID'])){
            $this->errors['RegistrationID'] = 'Registration ID is required';
        }

        if(empty($data['ReasonForMedical'])){
            $this->errors['ReasonForMedical'] = 'Reason for medical is required';
        }

        if(empty($data['userid'])){
            $this->errors['userid'] = 'Time Period is required';
        }

        return empty($this->errors);
    }

    public function viewAllMedicalRequests(){
        $query="SELECT * FROM $this->table m
                JOIN student ON student.registrationnumber= m.RegistrationID
                JOIN user ON user.userid = m.userid";
        return $this->query($query);        

    }


    public function handleAction($id, $action)
    {
        if (!in_array($action, ['approve', 'reject'])) {
            return ['success' => false, 'message' => 'Invalid action'];
        }
        
        $status = ($action === 'approve') ? 'Accepted' : 'Rejected';
        
        $query = "UPDATE $this->table SET status = :status WHERE RequestID = :id";
        $params = [':status' => $status, ':id' => $id];
        
        $result = $this->query($query, $params);
        
        if ($result) {
            return [
                'success' => true, 
                'message' => "medical request " . ($action === 'approve' ? 'approved' : 'rejected') . " successfully"
            ];
        } else {
            return [
                'success' => false,
                'message' => "Failed to " . $action . " medical request"
            ];
        }
    }

  
}