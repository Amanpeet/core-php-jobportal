<?php
//get amounts
$all_amounts_sql   = "SELECT * FROM amounts ORDER BY aid ASC";
$all_amounts_query = mysqli_query($conn, $all_amounts_sql);

//fill 2d array
$amount_arr = array();
while ($all_amounts_row = mysqli_fetch_array($all_amounts_query)) {
  // echo $all_amounts_row['amt_title'].'<br>';
  $amount_arr[] = array(
    'amt_title' => $all_amounts_row['amt_title'],
    'amount' => $all_amounts_row['amount'],
  );
}

//search 2d array func
function searchAmount($amt_type){
  global $amount_arr;
  foreach ($amount_arr as $key => $val) {
    if ($val['amt_title'] === $amt_type) {
      return $val['amount'];
    }
  }
  return null;
}

//prices to variables
$employer_starter = searchAmount('employer_starter'); //for syntax
