<?php
/*
 * validate data for the diner app
 */

//return true if food contains
//at least 3 characters
function validFood($food){
  return strlen(trim($food)) >= 3;
}