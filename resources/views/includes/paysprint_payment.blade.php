<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Favicon -->
    <link rel="icon" href="https://res.cloudinary.com/pilstech/image/upload/v1602675914/paysprint_icon_png_ol2z3u.png"
        type="image/x-icon" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <script src="https://kit.fontawesome.com/384ade21a6.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>PaySprint Payment</title>

    <style>
        body {
            background: #f5f5f5
        }

        .rounded {
            border-radius: 1rem
        }

        .nav-pills .nav-link {
            color: rgb(255, 255, 255)
        }

        .nav-pills .nav-link.active {
            color: white
        }

        input[type="radio"] {
            margin-right: 5px
        }

        .bold {
            font-weight: bold
        }

        .disp-0 {
            display: none !important;
        }

        .fas {
            font-size: 12px;
        }

        .nav-tabs .nav-link {
            border: 1px solid #6c757d !important;
            /* width: 20%; */
            margin: 0px 5px 5px 0px
        }

        .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #fff3cd !important;
        }

        .space {
            padding: 15px 0px;
        }
    </style>

</head>

<body>
    <div class="container py-5">
        <!-- For demo purpose -->
        <div class="row mb-4">
            <div class="col-lg-4 mx-auto text-center">
                <h1 class="display-4">Make Payment</h1>




            </div>
        </div> <!-- End -->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card ">
                    <div class="card-header">

                        <!-- Credit card form content -->
                        <div class="tab-content">

                            <!-- credit card info-->
                            <div id="credit-card" class="tab-pane fade show active pt-3">


                                <div class="form-group row">



                                </div>
                                <div>
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-home" type="button" role="tab"
                                                aria-controls="nav-home" aria-selected="true">I have a PaySprint
                                                Account</button>
                                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-profile" type="button" role="tab"
                                                aria-controls="nav-profile" aria-selected="false">I don't have a
                                                PaySprint Account</button>
                                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-contact" type="button" role="tab"
                                                aria-controls="nav-contact" aria-selected="false">Create a new
                                                account</button>
                                        </div>
                                    </nav>


                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                            aria-labelledby="nav-home-tab">

                                            {{-- TODO:: 1. Add to the form method, action... --}}
                                            {{-- TODO:: 2. Route the action to the paysprint.user --}}

                                            <form class="space" action="{{ route('paysprint.user') }}" method="post" id="formuser">
                                                {{ csrf_field() }}
                                                


                                                <div class="mb-3">
                                                    <label for="accountNumber" class="form-label">Enter your PaySprint
                                                        account number</label>
                                                    <div class="input-group-append"> <span
                                                            class="input-group-text text-muted">
                                                            <img
                                                                src="https://img.icons8.com/windows/24/000000/merchant-account.png" /></span>
                                                        <input type="text" class="form-control" id="accountNumber"
                                                            name="accountNumber" placeholder="Account Number">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">
                                                        <h4>Wallet balance</h4>
                                                    </label>

                                                    <span id="wallet" ></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">Enter amount</label>
                                                    <div class="input-group-append"> <span
                                                            class="input-group-text text-muted">
                                                            <img
                                                                src="https://img.icons8.com/external-tal-revivo-bold-tal-revivo/24/000000/external-mail-invoice-for-digital-payment-receipt-amount-money-bold-tal-revivo.png" /></span>
                                                        <input type="text" class="form-control" name="amount"
                                                            id="amount" placeholder="Amount" value="{{ $data->amount }}"
                                                            readonly>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="pin" class="form-label">Prochatr Subscription</label>
                                                    <div class="input-group-append"> <span
                                                            class="input-group-text text-muted">
                                                            <img
                                                                src="https://img.icons8.com/external-bearicons-glyph-bearicons/24/000000/external-Target-business-and-marketing-bearicons-glyph-bearicons.png" /></span>
                                                        <input type="text" name="purpose" class="form-control"
                                                            id="subscription" placeholder="Prochatr Subscription"
                                                            value='{{ $data->type }}' readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pin" class="form-label">Password</label>
                                                    <div class="input-group-append"> <span
                                                            class="input-group-text text-muted">
                                                            <img
                                                                src="https://img.icons8.com/ios-glyphs/24/000000/enter-pin.png" /></span>
                                                        <input type="text" name="transactionPin" class="form-control" id="pin"
                                                            placeholder="Password">
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-block cardSubmit"
                                                    onclick="submit('user')">Submit</button>
                                            </form>
                                        </div>


                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                            aria-labelledby="nav-profile-tab">

                                            {{-- TODO:: 1. Add to the form method, action... --}}
                                            {{-- TODO:: 2. Route the action to the paysprint.guest --}}
                                          

                                            <form class="space" action="{{route('paysprint.guest')}}" method="post" id="formguest">
                                                {{ csrf_field() }}
                                               

                                                <div class="mb-3">
                                                    <label for="firstname" class="form-label">Enter your first
                                                        name</label>
                                                    <div class="input-group-append"> <span
                                                            class="input-group-text text-muted">
                                                            <img
                                                                src="https://img.icons8.com/windows/24/000000/name.png" />
                                                        </span>
                                                        <input type="text" class="form-control" id="firstname"
                                                            placeholder="Firstname" name="firstname">
                                                        <input name="email" id="pay_guest_email" type="hidden"
                                                            class="form-control" value="" required="">

                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="lastname" class="form-label">Enter your last
                                                        name</label>
                                                    <div class="input-group-append"> <span
                                                            class="input-group-text text-muted">
                                                            <img
                                                                src="https://img.icons8.com/windows/24/000000/name.png" />
                                                        </span>
                                                        <input type="text" class="form-control" id="walletbalance"
                                                            placeholder="Lastname" name="lastname" value="">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Enter your email</label>
                                                    <div class="input-group-append"> <span
                                                            class="input-group-text text-muted">
                                                            <img
                                                                src="https://img.icons8.com/ios/24/email-open.png" />
                                                        </span>
                                                        <input type="text" class="form-control" id="email"
                                                            placeholder="Email" name="email" value="">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phonenumber" class="form-label">Enter your phone
                                                        number</label>
                                                    <div class="input-group-append"> <span
                                                            class="input-group-text text-muted">
                                                            <img
                                                                src="https://img.icons8.com/ios/24/000000/apple-phone.png" />
                                                        </span>
                                                        <input name="phone" id="pay_guest_phone" type=""
                                                            placeholder="Phone Number" class="form-control" value=""
                                                            required="">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">Enter amount</label>
                                                    <div class="input-group-append"> <span
                                                            class="input-group-text text-muted">
                                                            <img
                                                                src="https://img.icons8.com/material-outlined/24/000000/money--v1.png" />
                                                        </span>
                                                        <input type="text" class="form-control" id="amount"
                                                            placeholder="Amount" name="amount"
                                                            value="{{ $data->amount }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="country" class="form-label">country</label>
                                                    <div class="input-group-append"> <span
                                                            class="input-group-text text-muted">
                                                            <img
                                                                src="https://img.icons8.com/plumpy/24/000000/country.png" />
                                                        </span>
                                                        <input type="text" class="form-control" id="country"
                                                            placeholder="Country" name="country" value="">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="payment" class="form-label">Purpose of Payment</label>
                                                    <div class="input-group-append"> <span
                                                            class="input-group-text text-muted">
                                                            <img
                                                                src="https://img.icons8.com/external-bearicons-glyph-bearicons/24/000000/external-Target-business-and-marketing-bearicons-glyph-bearicons.png" /></span>
                                                        <input type="text" class="form-control" id="payment"
                                                            placeholder="Purpose of Payment" name="purpose" value="">
                                                    </div>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label for="cardnumber" class="form-label">Card Number</label>
                                                        <input type="text" class="form-control" id="cardnumber"
                                                            placeholder="Card Number" name="cardNumber" value="">
                                                    </div class="conent">
                                                    <div class="col-md-3">
                                                        <label for="Month" class="form-label"> Month</label>
                                                        <input type="number" name="expiryMonth"
                                                            id="pay_guest_expiryMonth" min="00" step="01" max="12"
                                                            maxlength="2" class="form-control" placeholder="01"
                                                            required="" value="">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="Year" class="form-label">Year</label>
                                                        <input name="expiryYear" id="pay_guest_expiryYear" type="number"
                                                            min="00" step="01" maxlength="2" class="form-control"
                                                            placeholder="22" required="" value="">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="cardType" class="form-label">Card Type</label>
                                                    <select name="cardType" id="pay_guest_cardType" type="text"
                                                        min="0.00" step="0.01" class="form-control"
                                                        placeholder="Card Number :" required="" value="">

                                                        <option value="">Select Card Type</option>
                                                        <option value="Credit Card">Credit Card</option>
                                                        <option value="Debit Card">Debit Card</option>
                                                    </select>
                                                </div>

                                                <button class="btn btn-primary btn-block cardSubmit" type="button"
                                                    onclick="submit('guest')">Make Payment</button>

                                        </div>
                                        </form>

                                        <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                            aria-labelledby="nav-contact-tab">
                                            <form class="row g-3 space" style="justify-content: center">
                                                <center>
                                                    <p>Create a PaySprint account to pay at a lesser rate.</p>
                                                    <p>
                                                        <a type="button" class="btn btn-primary"
                                                            href="https://paysprint.ca/register" target="_blank">Click
                                                            here
                                                            to
                                                            CREATE AN
                                                            ACCOUNT</a>
                                                    </p>

                                                    <p>
                                                        or
                                                    </p>

                                                    <p>DOWNLOAD OUR APP</p>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <a href="https://play.google.com/store/apps/details?id=com.fursee.damilare.sprint_mobile"
                                                                target="_blank"
                                                                class="btn text-white gr-hover-y px-lg-9">
                                                                <img src="https://res.cloudinary.com/paysprint/image/upload/v1651130088/assets/l6-download-gplay_o9rcfj_l6erwf.png"
                                                                    alt="play store" width="100%">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <a href="https://apps.apple.com/gb/app/paysprint/id1567742130"
                                                                target="_blank"
                                                                class="btn text-white gr-hover-y px-lg-9">
                                                                <img src="https://res.cloudinary.com/paysprint/image/upload/v1651130088/assets/l6-download-appstore_odcskf_atgygf.png"
                                                                    alt="apple store" width="100%">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </center>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End -->
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
                integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
                integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
                crossorigin="anonymous"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

            <script>
                //  Wallet Balance
                $('#accountNumber').on('keyup', function () {
                    $('#wallet').text('');
                    //  axios POST...

                    var data = new FormData();
                    data.append('accountNumber', $('#accountNumber').val());

                    var config = {
                        method: 'post',
                        url: 'https://paysprint.ca/api/v1/walletbalance',

                        data: data
                    };

                    axios(config)
                        .then(function (response) {
                          

                            $('#wallet').text(response.data.data.currencySymbol + ' ' + parseFloat(response
                                .data.data.wallet_balance).toFixed(2));
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    });


                function submit(val) {



                    var formData;
                    if (val == 'user') {
                        route = "{{route('paysprint.user')}}";
                        formData = new FormData(formuser);
                    } else {
                        route = "{{route('paysprint.guest')}}";
                        formData = new FormData(formguest);
                    }



                    setHeaders();
                    $.ajax({
                        url: route,
                        method: 'post',
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        dataType: 'JSON',
                        beforeSend: function () {
                            $('.cardSubmit').text('Please wait...');
                        },
                        success: function (result) {
                            console.log(result);

                            $('.cardSubmit').text('Make Payment');
                            if (result.status == 200) {
                                swal("Success", result.message, "success");

                            } else {
                                swal("Oops", result.message, "error");
                            }


                        },
                        error: function (err) {
                            $('.cardSubmit').text('Make Payment');
                            swal("Oops", err.responseJSON.message, "error");

                        }

                    });
                }


                function setHeaders() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}",
                            'Authorization': "Bearer " + "{{ env('PAYSPRINT_TOKEN') }}"

                        }
                    });




                }
            </script>

</body>

</html>
