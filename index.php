<?php
include_once('admin/includes/conexao.php');
?>
<html lang="pt-br">

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário <?php echo date('Y'); ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/evo-calendar.min.css">
    <link rel="stylesheet" href="css/evo-calendar.royal-navy.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>

<body>

    <div class="hero">


        <div id="calendar"></div>
<a href="admin/" class="myButton">Login</a>

    </div>


    <!-- Add jQuery library (required) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>

    <script src="js/evo-calendar.min.js"></script>


    <script>
        // Initialize evo-calendar in your script file or an inline <script> tag
        $(document).ready(function() {
            $('#calendar').evoCalendar({
                theme: 'Royal Navy',
                language: 'pt',
                format: "MM dd, yyyy",
                titleFormat: "MM",



                calendarEvents: [
                    <?php

                    $sql = "select * from agenda order by id asc";
                    $stmt = $conectar->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $value) {
                    ?> {
                            id: "<?php echo htmlentities($value['id']) ?>",
                            name: "<?php echo htmlentities($value['name']) ?>",
                            date: ["<?php echo htmlentities($value['date']) ?>"], // Date range
                            description: "<?php echo htmlentities($value['description']) ?>", // Event description (optional)
                            type: "event",
                            color: "<?php echo htmlentities($value['color']) ?>" // Event custom color (optional)
                        },

                    <?php } ?> {
                        id:"event1",
                        name: "",
                        badge: "10h", // Event badge (optional)
                        date: ["1 apr,2022"], // Date range
                        description: "#", // Event description (optional)
                        type: "event",
                        color: "#63d867" // Event custom color (optional)
                    }
                ]
            })
        })
    </script>


</body>

</html>