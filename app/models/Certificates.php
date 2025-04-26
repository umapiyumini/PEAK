<?php

class Certificates{
    use Model;
    protected $table = 'certificaterequest';

    public function viewAllCertificateRequests(){
        $query="SELECT * FROM $this->table c
                JOIN student ON student.registrationnumber= c.RegistrationNumber
                JOIN sport ON sport.sport_id= c.Sport
                JOIN user ON user.userid = c.UserID";
        return $this->query($query);        

    }

    public function getByID($certid) {
        $query="SELECT * FROM $this->table c
                JOIN student ON student.registrationnumber= c.RegistrationNumber
                JOIN sport ON sport.sport_id= c.Sport
                JOIN user ON user.userid = c.UserID
                WHERE RequestID = $certid";

                $params = [':certid' => $id];
                return $this->query($query)[0];
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
                'message' => "Certificate request " . ($action === 'approve' ? 'approved' : 'rejected') . " successfully"
            ];
        } else {
            return [
                'success' => false,
                'message' => "Failed to " . $action . " certificate request"
            ];
        }
    }

    public function markCertificateReady($id){
        
        $checkQuery = "SELECT status FROM $this->table WHERE RequestID = :id";
        $params = [':id' => $id];
        $currentStatus = $this->query($checkQuery, $params);
        
        if (!$currentStatus || empty($currentStatus[0]->status)){
            return [
                'success' => false,
                'message' => "Request not found"
            ];
        }
        
        if (strtolower($currentStatus[0]->status) !== 'accepted') {
            return [
                'success' => false,
                'message' => "Certificate must be approved first"
            ];
        }
        
        $updateQuery = "UPDATE $this->table SET status = 'Ready' WHERE RequestID = :id";
        $updateResult = $this->query($updateQuery, $params);
        
        if ($updateResult) {
            return [
                'success' => true,
                'message' => "Certificate marked as ready for collection"
            ];
        } else {
            return [
                'success' => false,
                'message' => "Failed to update certificate status"
            ];
        }
    }

  
}