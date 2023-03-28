# Hospital 

## [HOST](http://hospital1.epizy.com/)

## JSON
### The doctors and the associated patients

 http://hospital1.epizy.com/doctor_json.php
 
### All the treatments applied to a patient

 http://hospital1.epizy.com/pacient_json.php?id_patient=13

## USER

### ADMIN  

 &emsp;&emsp; password: admin  
    
### DOCTOR  

&emsp;ex:

  &emsp;&emsp; mail: ionescumihai@yahoo.com
  
  &emsp;&emsp; password: ionescumihai
  
### ASSISTANT

&emsp; ex:

  &emsp;&emsp; mail: chivustefan@yahoo.com
  
  &emsp;&emsp; password: chivustefan
  
  
  ## CODE
  
  "index.php" - alegem ce tip de user(admin, doctor, assistant) folosim
  
  "admin_login.php,assistant_login.php,doctor_login.php" - dupa ce am ales tipul de user putem intra in cont, in cazul administratorului doar cu parola, in cazul celorlalti cu email si parola.
  
  "admin.php,doctor.php,assistant.php" - dupa ce am intrat in cont in functie de tipul de user putem realiza diferite actiuni:
  
1. admin : adaug doctori/asistenti/pacienti, sterg doctori/asistenti/pacienti, vad informatiile despre doctori/asistenti/pacienti/tratamente.
           
2. doctor : adaug tratamente (daca numele pacientului introdus exista deja in baza de date se realizeaza doar inserarea in tabela "treatments", altfel intai se adauga pacientul in tabela "patients") si vizualizez tratamentele pacientilor mei
           
3. asistent : pot doar sa vizualizez tratamentele pacientilor care mi-au fost atribuiti
           
           
           
"man_assistant.php,man_doctor.php,man_patient.php" - administratorul poate vizualiza si adauga pacienti/doctori/asistenti
   
   "man_treatments.php" - administratorul poate vizualiza tratamentele atribuite de doctori pacientilor lor
   
   "update_man_assistant.php,update_man_doctor.php,update_man_patients.php" - administratorul poate schimba datele salvate in tabelele `doctors`, `patients`, `assistants`   
   
   
   
   
