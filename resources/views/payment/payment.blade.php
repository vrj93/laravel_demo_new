<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
</head>
<body>
    <label>Name</label><br><input type="text" name="name" id="name"><br><br>
    <label>Amount</label><br><input type="number" name="amount" id="amount"><br><br>
    <label>Email</label><br><input type="email" name="email" id="email"><br><br>
    <label>Phone</label><br><input type="tel" name="phone" id="phone"><br><br>
    <button id="rzp-button1" onclick="payment()">Pay</button>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function payment() {
            var name = document.getElementById('name').value;
            var amount = document.getElementById('amount').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
        
            const xhttp = new XMLHttpRequest();
    
            xhttp.onload = function() {
    
                var options = {    
                    "key": "{{ config('payment.razor_pay_id') }}",
                    "amount": amount * 100,
                    "currency": "INR",    
                    "name": "Laravel 9",    
                    "description": "Demo Project",    
                    // "image": "https://example.com/your_logo",    
                    // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1    
                    "handler": function (response){        
                        alert(response.razorpay_payment_id);        
                        alert(response.razorpay_order_id);        
                        alert(response.razorpay_signature)    
                    },    
                    "prefill": {        
                        "name": name,
                        "amount": amount,        
                        "email": email,        
                        "contact": phone    
                    },    
                    "notes": {        
                        "address": "Razorpay Corporate Office"    
                    },    
                    "theme": {        
                        "color": "#3399cc"   
                    }
                };
                
                var rzp1 = new Razorpay(options);
                
                rzp1.on('payment.failed', function (response){        
                    alert(response.error.code);        
                    alert(response.error.description);        
                    alert(response.error.source);        
                    alert(response.error.step);        
                    alert(response.error.reason);        
                    alert(response.error.metadata.order_id);        
                    alert(response.error.metadata.payment_id);
                });
            
                rzp1.open();    
            
            }
    
            var data = {
                phone: phone,
                email: email,
                amount: amount * 100
            }
    
            xhttp.open('POST', '{{ route("payment") }}');
            xhttp.setRequestHeader('Content-Type', 'application/json');
            xhttp.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            xhttp.send(JSON.stringify(data));
    
        }
        
    </script>
</body>
</html>