<?php

date_default_timezone_set('UTC');
setlocale(LC_ALL, 'en_US');

// get the year and number of week from the query string and sanitize it
$year  = filter_input(INPUT_GET, 'year', FILTER_VALIDATE_INT);
$month = filter_input(INPUT_GET, 'month', FILTER_VALIDATE_INT);

// initialize the calendar object
$calendar = new calendar();

// get the current month object by year and number of month
$currentMonth = $calendar->month($year, $month);

// get the previous and next month for pagination
$prevMonth = $currentMonth->prev();
$nextMonth = $currentMonth->next();

// generate the URLs for pagination
$prevMonthURL = sprintf('?year=%s&month=%s', $prevMonth->year()->int(), $prevMonth->int());
$nextMonthURL = sprintf('?year=%s&month=%s', $nextMonth->year()->int(), $nextMonth->int());

?>

<section class="month">

  <h2>
    <a class="arrow" href="<?php echo $prevMonthURL ?>">&larr;</a> 
    <?php echo $currentMonth->name() ?> <a href="year.php?year=<?php echo $currentMonth->year()->int() ?>"><?php echo $currentMonth->year()->int() ?></a>
    <a class="arrow" href="<?php echo $nextMonthURL ?>">&rarr;</a>
  </h2>
  
  <table>
    <!-- Wochentage -->
    <tr>
      <?php foreach($currentMonth->weeks()->first()->days() as $weekDay): ?>
      <th><?php echo $weekDay->shortname() ?></th>
      <?php endforeach ?>
    </tr>

    <!-- Einzelne Tage -->
    <?php foreach($currentMonth->weeks(6) as $week): ?>
    
    <tr>  
      <?php foreach($week->days() as $day): ?>

      <!-- Tage außerhalb des Monats grau. Aktueller Tag fett -->
      <td
      
        <?php if($day->month() != $currentMonth) echo ' class="inactive"' ?>>
        <?php echo ($day->isToday()) ? '<strong>' . $day->int() . '</strong>' : $day->int() ?>
        
        <!-- Check ob Ordner exisitiert -->
        <?php if(site()->find('testgk/year-' . $year . '/day-' . $currentMonth . '-' . $day->int())){
            //  check ob tag im aktuellen monat ist
                if($day->month() == $currentMonth) { 
                    // events in struktur
                    $events = page('testgk/year-' . $year . '/day-' . $currentMonth . '-' . $day->int())->events()->toStructure();
                    //  events darstellen
                    foreach($events as $event){
                        // für jedes event eigenes div erstellen
                        echo '<div class="eventcontainer event" >' . $event->hour()->html() . '</div>';
                    }
                 }
            }
        ?>
        <?php endforeach ?>
      </td>
      <?php endforeach ?>
    </tr>
  </table>

</section>