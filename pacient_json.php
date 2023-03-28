<?php

$db_host = "localhost";
$db_name = "hospital";
$db_user = "root";
$db_pass = "antonia";

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);

$id_patient = $_GET['id_patient'];

// all the treatments for the patient
$stmt = $pdo->prepare("
    SELECT t.id_treatment, d.name as doctor_name, p.name as patient_name, t.details
    FROM treatments t
    JOIN doctors d ON t.id_doctor = d.id_doctor
    JOIN patients p ON t.id_patient = p.id_patient
    WHERE p.id_patient = :id_patient
");
$stmt->bindParam(':id_patient', $id_patient, PDO::PARAM_INT);

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$treatments = array();
foreach ($results as $row) {
  $id_treatment = $row['id_treatment'];
  $doctor_name = $row['doctor_name'];
  $patient_name = $row['patient_name'];
  $details = $row['details'];
  
  $treatments[] = array(
    'id' => $id_treatment,
    'doctor_name' => $doctor_name,
    'patient_name' => $patient_name,
    'details' => $details
  );
}

$json_data = array(
  'id_patient' => $id_patient,
  'treatments' => $treatments
);

header('Content-Type: application/json');
echo json_encode($json_data, JSON_PRETTY_PRINT);
