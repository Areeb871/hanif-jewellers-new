

     <script
       src="https://code.jquery.com/jquery-1.12.4.min.js"
       integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
       crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>

     <input id="Key1" name="Key1" type="hidden" value="{{ config('services.bank_alfalah.key_1') }}">
     <input id="Key2" name="Key2" type="hidden" value="{{ config('services.bank_alfalah.key_2') }}">

     <h3>Handshake</h3>
     <form action="{{ config('services.bank_alfalah.handshake_url') }}" id="HandshakeForm" method="post">
         <input id="HS_RequestHash" name="HS_RequestHash" type="hidden" value="">
         <input id="HS_IsRedirectionRequest" name="HS_IsRedirectionRequest" type="hidden" value="{{ config('services.bank_alfalah.is_redirection_request') }}">
         <input id="HS_ChannelId" name="HS_ChannelId" type="hidden" value="{{ config('services.bank_alfalah.channel_id') }}">
         <input id="HS_ReturnURL" name="HS_ReturnURL" type="hidden" value="{{ config('services.bank_alfalah.return_url') }}">
         <input id="HS_MerchantId" name="HS_MerchantId" type="hidden" value="{{ config('services.bank_alfalah.merchant_id') }}">
         <input id="HS_StoreId" name="HS_StoreId" type="hidden" value="{{ config('services.bank_alfalah.store_id') }}">
         <input id="HS_MerchantHash" name="HS_MerchantHash" type="hidden" value="{{ config('services.bank_alfalah.merchant_hash') }}">
         <input id="HS_MerchantUsername" name="HS_MerchantUsername" type="hidden" value="{{ config('services.bank_alfalah.merchant_username') }}">
         <input id="HS_MerchantPassword" name="HS_MerchantPassword" type="hidden" value="{{ config('services.bank_alfalah.merchant_password') }}">
         <input id="HS_TransactionReferenceNumber" name="HS_TransactionReferenceNumber" autocomplete="off" placeholder="Order ID"  value="">
         <button type="button" class="btn btn-custon-four btn-danger" id="handshake">Handshake</button>
     </form>


     <h3>Page Redirection Request</h3>
     <form action="{{ config('services.bank_alfalah.sso_url') }}" id="PageRedirectionForm" method="post" novalidate="novalidate">
      	<input id="AuthToken" name="AuthToken" type="hidden" value="">
      	<input id="RequestHash" name="RequestHash" type="hidden" value="">
	     	<input id="ChannelId" name="ChannelId" type="hidden" value="{{ config('services.bank_alfalah.channel_id') }}">
      	<input id="Currency" name="Currency" type="hidden" value="PKR">
         <input id="IsBIN" name="IsBIN" type="hidden" value="0">
	     	<input id="ReturnURL" name="ReturnURL" type="hidden" value="{{ config('services.bank_alfalah.return_url') }}">
         <input id="MerchantId" name="MerchantId" type="hidden" value="{{ config('services.bank_alfalah.merchant_id') }}">
         <input id="StoreId" name="StoreId" type="hidden" value="{{ config('services.bank_alfalah.store_id') }}">
	     	<input id="MerchantHash" name="MerchantHash" type="hidden" value="{{ config('services.bank_alfalah.merchant_hash') }}">
	     	<input id="MerchantUsername" name="MerchantUsername" type="hidden" value="{{ config('services.bank_alfalah.merchant_username') }}">
	     	<input id="MerchantPassword" name="MerchantPassword" type="hidden" value="{{ config('services.bank_alfalah.merchant_password') }}">
         <select autocomplete="off" id="TransactionTypeId" name="TransactionTypeId">
             <option value="">Select Transaction Type</option>
             <option value="1">Alfa Wallet</option>
             <option value="2">Alfalah Bank Account</option>
             <option value="3">Credit/Debit Card</option>
         </select>
     	<input autocomplete="off" id="TransactionReferenceNumber" name="TransactionReferenceNumber" placeholder="Order ID" type="text" value="">
     	<input autocomplete="off"  id="TransactionAmount" name="TransactionAmount" placeholder="Transaction Amount" type="text" value="">
     	<button type="submit" class="btn btn-custon-four btn-danger" id="run">RUN</button>
     </form>

     <script type="text/javascript">
        $(function () {

    $("#handshake").click(function (e) {
        e.preventDefault();

        var transactionReferenceNumber = $.trim(
            $("#HS_TransactionReferenceNumber").val()
        );

        if (!transactionReferenceNumber) {
            alert('Error: Please enter an Order ID');
            return;
        }

        $("#HS_TransactionReferenceNumber").val(
            transactionReferenceNumber
        );
        $("#AuthToken, #ReturnURL, #TransactionReferenceNumber").val("");
        $("#handshake").attr('disabled', 'disabled');

        // The request hash field must be empty while its replacement hash is
        // being generated, particularly when retrying a failed handshake.
        $("#HS_RequestHash").val("");
        submitRequest("HandshakeForm");
        if ($("#HS_IsRedirectionRequest").val() == "1") {
            document.getElementById("HandshakeForm").submit();
        }
        else {
            var myData = {
                HS_MerchantId : $("#HS_MerchantId").val(),
                HS_StoreId : $("#HS_StoreId").val(),
                HS_MerchantHash : $("#HS_MerchantHash").val(),
                HS_MerchantUsername : $("#HS_MerchantUsername").val(),
                HS_MerchantPassword : $("#HS_MerchantPassword").val(),
                HS_IsRedirectionRequest : $("#HS_IsRedirectionRequest").val(),
                HS_ReturnURL : $("#HS_ReturnURL").val(),
                HS_RequestHash : $("#HS_RequestHash").val(),
                HS_ChannelId: $("#HS_ChannelId").val(),
                HS_TransactionReferenceNumber: $("#HS_TransactionReferenceNumber").val(),
                _token: @json(csrf_token()),
            }


            $.ajax({
                type: 'POST',
                url: @json(route('bank-alfalah.handshake')),
                contentType: "application/x-www-form-urlencoded",
                data: myData,
                dataType: "json",
                beforeSend: function () {
                },
                success: function (r) {
                    if (r != '') {
                        if (r.success === true || r.success == "true") {
                            $("#AuthToken").val(r.AuthToken);
                            $("#ReturnURL").val(r.ReturnURL);
                            $("#TransactionReferenceNumber").val(
                                $("#HS_TransactionReferenceNumber").val()
                            );
                            alert('Success: Handshake Successful');
                        }
                        else
                        {
	                        	alert('Error: ' + (
	                        	    r.ErrorMessage ||
	                        	    r.message ||
	                        	    'Handshake Unsuccessful'
	                        	));
                        }
                    }
                    else
                    {
                    	alert('Error: Handshake Unsuccessful');
                    }
                },
                error: function (error) {
                    var response = error.responseJSON || {};
                    alert('Error: ' + (
                        response.message || 'An error occurred'
                    ));
                },
                complete: function(data) {
                    $("#handshake").removeAttr('disabled', 'disabled');
                }
            });
        }

    });

    $("#run").click(function (e) {
        e.preventDefault();
        submitRequest("PageRedirectionForm");
        document.getElementById("PageRedirectionForm").submit();
         });
     });

     function submitRequest(formName) {

    var mapString = '', hashName = 'RequestHash';
    if (formName == "HandshakeForm") {
        hashName = 'HS_' + hashName;
    }

    $("#" + formName+" :input").each(function () {
        if ($(this).attr('id') != '') {
            mapString += $(this).attr('id') + '=' + $(this).val() + '&';
        }
    });

    $("#" + hashName).val(CryptoJS.AES.encrypt(CryptoJS.enc.Utf8.parse(mapString.substr(0, mapString.length - 1)), CryptoJS.enc.Utf8.parse($("#Key1").val()),
        {
            keySize: 128 / 8,
            iv: CryptoJS.enc.Utf8.parse($("#Key2").val()),
            mode: CryptoJS.mode.CBC,
            padding: CryptoJS.pad.Pkcs7
        }));
     }

     </script>
