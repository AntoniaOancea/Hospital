<?php

//connect to db
$db_host = "localhost";
$db_name = "hospital";
$db_user = "root";
$db_pass = "antonia";

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);

$stmt = $pdo->prepare("
    SELECT d.name as doctor_name, p.name as patient_name, t.details
    FROM doctors d
    JOIN treatments t ON t.id_doctor = d.id_doctor
    JOIN patients p ON t.id_patient = p.id_patient
");

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// organize data
$doctors = array();
$patients = array();
foreach ($results as $row) {
  $doctor_name = $row['doctor_name'];
  $patient_name = $row['patient_name'];
  $details = $row['details'];
  
  // add the doctor to the list of doctors (if they're not already in it)
  $doctor_index = array_search($doctor_name, array_column($doctors, 'name'));
  if ($doctor_index === false) {
    $doctors[] = array(
      'name' => $doctor_name,
      'patients' => array()
    );
    $doctor_index = count($doctors) - 1;
  }
  
  // add the patient to the list of patients (if they're not already in it)
  $patient_index = array_search($patient_name, array_column($patients, 'name'));
  if ($patient_index === false) {
    $patients[] = array(
      'name' => $patient_name,
      'details' => $details
    );
    $patient_index = count($patients) - 1;
  }
  
  // associate the patient with the doctor
  $doctors[$doctor_index]['patients'][] = &$patients[$patient_index];
}

$active_treatment_doctors = count($doctors);
$active_treatment_patients = count($patients);

$all_doctors_stmt = $pdo->prepare("SELECT COUNT(*) FROM doctors");
$all_doctors_stmt->execute();
$all_doctors = $all_doctors_stmt->fetchColumn();

$all_patients_stmt = $pdo->prepare("SELECT COUNT(*) FROM patients");
$all_patients_stmt->execute();
$all_patients = $all_patients_stmt->fetchColumn();

$json_data = array(
  'doctors' => $doctors,
  'statistics' => array(
    'active_treatment_doctors' => $active_treatment_doctors,
    'active_treatment_patients' => $active_treatment_patients,
    'all_doctors' => $all_doctors,
    'all_patients' => $all_patients
  )
);

header('Content-Type: application/json');
echo json_encode($json_data, JSON_PRETTY_PRINT);

$json_data = json_encode($json_data, JSON_PRETTY_PRINT);
file_put_contents('doctors_patients.json', $json_data);