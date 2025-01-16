<?php 
session_start();
require_once('php/autoloader.php');
Autoloader::register(); 
use utils\DBConnector;
use utils\UserTools;
UserTools::requireLogin();?>


<!DOCTYPE html>
<html lang="fr">
<?php include('global/head.php'); 
title_html('Planning adherent');
link_to_css('https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css');
link_to_css('static/planning.css');?>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<body>
    <?php include('global/header_connected.php'); ?>
    <main>
        <?php if (in_array('Exception', array_keys($_SESSION))){
            echo "<h2> Votre cours n'a pas pu être ajouté car". $_SESSION['Exception'] . "</h2>";
        }
        else {
            echo "<h2>Vous êtes inscrit</h2>";
        }
            ?>
        <div id="calendar">
    
        </div>
        <div id="legend">
            <h3>Légende des événements</h3>
            <ul>
                <li><span class="event-color" style="background-color: #00ff00;"></span> Cours non inscrit</li>
                <li><span class="event-color" style="background-color: #0000ff;"></span> Cours inscrit</li>
            </ul>
        </div>
        <!-- une partie du javascript a été généré par chatgpt -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let calendarEl = document.getElementById('calendar');
                
                let calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth', 
                    locale: 'fr',  
                    headerToolbar: {
                        left: 'prev,next today', 
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay' 
                    },             
                    eventSources: [
                        {
                        url: 'php/utils/calendar-noparticipation.php',
                    },
                    {
                        url: 'php/utils/calendar-adherent.php', 
                    }   
                        ],
                    eventClick: function (info) {
                    try {
                    let eventTitle = info.event.title || "(Pas de titre)";
                    let eventDate = info.event.start ? info.event.start.toLocaleDateString('fr-FR') : "(Date inconnue)";
                    let eventColor = info.event.backgroundColor|| 'default';
                    console.log("Couleur de l'événement :", info.event.color);
                    if (eventColor == 'green') {
                        let participation = confirm(`Souhaitez-vous participer à l'événement "${eventTitle}" prévu le ${eventDate} ?`);
        
                        if (participation) {
                            alert(`Vous avez choisi de participer à l'événement "${eventTitle}".`);
                            let form = document.createElement("form");
                            form.method = "POST";
                            form.action = "php/utils/participer.php";
                            let input = document.createElement("input");
                            input.type = "hidden";
                            input.name = 'IDSEANCE';
                            input.value = info.event.extendedProps.IDSEANCE;
                            form.appendChild(input);
                            let input2 = document.createElement("input");
                            input2.name = 'NUMCOURS';
                            input2.value = info.event.extendedProps.NUMCOURS;
                            form.appendChild(input2);
                            document.body.appendChild(form);
                            form.submit();
                        } 
                    } else {
                        alert("Vous participez déjà à l'évenement.");
                    }
                    } catch (error) {
                    console.error("Erreur dans eventClick:", error);
                    }
                }
                });
        
                calendar.render();
            });
            </script>

    </main>
    <?php include('global/footer.php'); ?>
</body>
</html>