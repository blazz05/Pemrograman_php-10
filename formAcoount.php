<?php
session_start();

// Initialize the customerData array in the session if it doesn't exist
if (!isset($_SESSION['customerData'])) {
    $_SESSION['customerData'] = [];
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $nomorRekening = $_POST['nomor_rekening'];
    $namaCustomer = $_POST['nama_customer'];
    $saldoAwal = $_POST['saldo_awal'];

    // Add the form data to the customerData array
    $_SESSION['customerData'][] = [
        'nomor_rekening' => $nomorRekening,
        'nama_customer' => $namaCustomer,
        'saldo_awal' => $saldoAwal,
    ];
}

// Function to display the customer data in a table
function displayCustomerData()
{
    if (empty($_SESSION['customerData'])) {
        echo '<tr><td colspan="4">No data available</td></tr>';
    } else {
        foreach ($_SESSION['customerData'] as $index => $customer) {
            echo '<tr>';
            echo '<th scope="row">' . ($index + 1) . '</th>';
            echo '<td>' . $customer['nomor_rekening'] . '</td>';
            echo '<td>' . $customer['nama_customer'] . '</td>';
            echo '<td>' . $customer['saldo_awal'] . '</td>';
            echo '</tr>';
        }
    }
}

// Check if the "Clear Data" button is clicked
if (isset($_POST['clear_data'])) {
    // Clear all session data
    session_unset();
    session_destroy();
    // Redirect to refresh the page
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Customer Data</title>
</head>

<body>
  <div>
    <h1 align="center">Form Account Bank</h1>
  </div>
    <div class="container mt-5">
        <form method="post">
            <div class="form-group row">
                <label for="nomor_rekening" class="col-2 col-form-label">Nomor Rekening</label>
                <div class="col-5">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-credit-card-alt"></i>
                            </div>
                        </div>
                        <input id="nomor_rekening" name="nomor_rekening" type="text" required="required"
                            class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama_customer" class="col-2 col-form-label">Nama Customer</label>
                <div class="col-5">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-address-card"></i>
                            </div>
                        </div>
                        <input id="nama_customer" name="nama_customer" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="saldo_awal" class="col-2 col-form-label">Saldo Awal</label>
                <div class="col-5">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-money"></i>
                            </div>
                        </div>
                        <input id="saldo_awal" name="saldo_awal" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-2 col-8">
                    <button name="submit" type="submit" class="btn btn-primary ml-2">Submit</button>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">No.Rekening</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Saldo</th>
                </tr>
            </thead>
            <tbody>
                <?php displayCustomerData(); ?>
            </tbody>
        </table>
    </div
