<?php

include"includes/db_connect.inc.php";

if(isset($_POST['student_id'])){
    $student_id = $_POST['student_id'];

    $sql = "SELECT * from `student` WHERE `studentid` = '$student_id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        $student_blood = $row['studentbloodgroup'];
    }

    $listBlood = array(
        'O+',
        'O-',
        'A+',
        'A-',
        'B+',
        'B-',
        'AB+',
        'AB-'
    );
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <select name="student_blood_edit" id="student_blood_edit_2" required>
        <option value="" disabled>Select Group</option>
        <?php    
        foreach($listBlood as $blood)
        {
            $selected = '';
            if($blood == $student_blood)
            {
                $selected = 'selected="selected"';
            }

            echo '<option '.$selected.'>'.$blood.'</option>';
        }
        ?>
    </select>
</body>
</html>