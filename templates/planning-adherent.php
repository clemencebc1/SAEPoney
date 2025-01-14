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
        <div id="calendar"></div>
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
                    events: 'php/utils/calendar-adherent.php', 
                    eventClick: function (info) {
                        let eventTitle = info.event.title || "(Pas de titre)";
                        let eventDate = info.event.start.toLocaleDateString('fr-FR');

                        let participation = confirm(`Souhaitez-vous participer à l'événement "${eventTitle}" prévu le ${eventDate} ?`);

                        if (participation) {
                           
                            alert(`Vous avez choisi de participer à l'événement "${eventTitle}".`);
                            
                        } else {
                            alert("Participation annulée.");
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