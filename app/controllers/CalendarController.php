<?php 
/**
 * Calendar Controller
 */

class CalendarController extends Controller {
    public function process(){
        $View = view('panel/calendar.php', $this->variables);
        $View->render();
    }
}