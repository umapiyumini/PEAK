<?php

class Attendance{
    use Model;
    protected $table = 'attendance';
    protected $allowcolumns = [
        'date',
        'regno',
        'attendance',
        'spor_id'
    ];

              public function getatteandancebysport() {
                $userId = $this->getUserId();
                if (!$userId) {
                    die("User ID not found in session.");
                }
            
                
                $dateQuery = "SELECT DISTINCT date
                              FROM attendance
                              WHERE sport_id = (SELECT sport_id FROM sport_captain WHERE userid = :userid)
                              ORDER BY date DESC 
                              LIMIT 4";
            
                $dates = $this->query($dateQuery, ['userid' => $userId]);
            
                if (empty($dates)) {
                    return ['dates' => [], 'records' => []]; 
                }
            
                $dateList = array_column($dates, 'date'); 
            
                
                $placeholders = implode(',', array_fill(0, count($dateList), '?'));
            
                $attendanceQuery = "SELECT attendance.name, attendance.date, attendance.attendance
                                    FROM attendance 
                                    JOIN players AS player ON attendance.regno = player.regno
                                    WHERE attendance.date IN ($placeholders)
                                    ORDER BY attendance.name, attendance.date";
            
                $attendanceRecords = $this->query($attendanceQuery, $dateList);
            
                return ['dates' => $dateList, 'records' => $attendanceRecords];
            }
        }  
    

