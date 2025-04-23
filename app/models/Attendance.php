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
            
                
                
                $sportIdQuery = "SELECT sport_id FROM sports_captain WHERE userid = :userid LIMIT 1";
                $sportResult = $this->query($sportIdQuery, ['userid' => $userId]);

        if (empty($sportResult)) {
            return ['dates' => [], 'records' => []];
        }

        $sportId = $sportResult[0]->sport_id;

        // Get all distinct dates for this sport
        $dateQuery = "SELECT DISTINCT date
                      FROM attendance
                      WHERE sport_id = :sport_id
                      ORDER BY date DESC";
        $dates = $this->query($dateQuery, ['sport_id' => $sportId]);

        if (empty($dates)) {
            return ['dates' => [], 'records' => []];
        }
            
        $dateList = array_column($dates, 'date'); 
        $placeholders = implode(',', array_fill(0, count($dateList), '?'));
        
        $attendanceQuery = "SELECT attendance.name, attendance.date, attendance.attendance
                            FROM attendance 
                            JOIN players AS player ON attendance.regno = player.regno
                            WHERE attendance.sport_id = ? AND attendance.date IN ($placeholders)
                            ORDER BY attendance.name, attendance.date";
        
        // Put sportId first, then dates
        $params = array_merge([$sportId], $dateList);
        $attendanceRecords = $this->query($attendanceQuery, $params);
        
                return ['dates' => $dateList, 'records' => $attendanceRecords];
            }
        }  
    

