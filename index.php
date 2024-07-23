<?php
$apiUrl='https://v6.exchangerate-api.com/v6/6abccfdcb535dc1af18d6720/codes';
$data = json_decode(file_get_contents($apiUrl));
// echo $data['supported_codes'];

//conversion


if(isset($_GET['from_currency'])){
  $from_currency=$_GET['from_currency'];
  $to_currency = $_GET['to_currency'];
  $convertion_amount= $_GET['amount'];

  //converted data
  $coverted_data = json_decode(file_get_contents("https://v6.exchangerate-api.com/v6/6abccfdcb535dc1af18d6720/pair/$from_currency/$to_currency/$convertion_amount"));

  // print_r($coverted_data);
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Currency Exchange</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body class="flex align-items-center flex-row min-h-screen justify-center items-center bg-[url('./asset/background.png')] bg-cover">

  <main class="bg-slate-50 p-6 rounded-md">

    <h2 class="text-lg font-bold text-center">Currancy Exchager</h2>

    <form>

      <div class="flex flex-row mt-5" >
      <div>
          <label for="from_currency" class="block text-sm font-medium leading-6 text-gray-900">From</label>
            <select id="from_currency" name="from_currency" class="h-full rounded-md border-indigo-300 border-2 bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
            <option>Select Currency </option>
              <?php

              if(isset($data-> supported_codes) && is_array($data-> supported_codes)){
                foreach($data->supported_codes as $codes){
                  $selected = ($from_currency === $codes[0]) ? 'selected' : '';
                  echo "<option value='$codes[0]'  $selected >$codes[1]</option> ";
                }
              }
              ?>
            </select>
        </div>

        <div class="w-6 py-4">
          <img src="./asset/reverse.png" class="w-100" alt="">
        </div>

          <div>
              <label for="to_currency" class="block text-sm font-medium leading-6 text-gray-900">to</label>
              <select id="to_currency" name="to_currency" class="h-full rounded-md border-indigo-300 border-2 bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
              <option>Select Currency </option>
              <?php
                  if(isset($data-> supported_codes) && is_array($data-> supported_codes)){
                    foreach($data->supported_codes as $codes){
                      $selected = ($to_currency === $codes[0]) ? 'selected' : '';
                      echo "<option value='$codes[0]' $selected >$codes[1]</option> ";
                    }
                  }
                  ?>
              </select>
          </div>
  </div>
  <div class="mt-9">
    <label for="" class="block text-sm font-medium leading-6 text-gray-900">Amount</label>

    <input type="number" name='amount' class="block w-full rounded-md border-0 p-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Enter your amount" value='<?php if(isset($_GET['amount'])){ echo  $_GET['amount'];} ?>' >

  </div>

          <div>
              <button class=" my-3 py-2 px-5 bg-violet-500 text-white font-semibold rounded-full shadow-md hover:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-400 focus:ring-opacity-75">
                  Convert
              </button>
          </div>
    </form>
      <?php
      if(isset($coverted_data)){  ?>
        
    <div class="rounded w-56 h-30 bg-slate-200 p-4">
      <p class="font-bold text-xl">Result : </p>
      <div>
        <p><b>1</b> <?php echo $from_currency ?> = <b><?php echo $coverted_data ->conversion_rate; ?></b> <?php echo $to_currency?></p>
        <p><b><?php echo $convertion_amount ?></b> <?php echo $from_currency ?> = <b><?php echo $coverted_data -> conversion_result; ?></b>  <?php echo $to_currency?></p>
      </div>
    </div>

    <?php }?>
  </main>

  </body>
</html>
