document.addEventListener('DOMContentLoaded', () => {
    let publishable_key = document.querySelector("#publishable_key").value;

const stripe = Stripe(publishable_key);

let elements;

const paymentForm = document.querySelector("#stripe-payment-form");

const submitButton = document.querySelector("#submit-button");

const submitText = document.querySelector("#submit-text");

const spinner = document.querySelector("#spinner");

const messageContainer = document.querySelector("#stripe-payment-message");

const paymentProcessing = document.querySelector("#payment_processing");

const payReinitiate = document.querySelector("#payment-reinitiate");

const checkClientSecret = new URLSearchParams(window.location.search).get(
    "payment_intent_client_secret"
);

stripeProcessing(true);
if(!checkClientSecret){
    stripeProcessing(false);
    initialize();
}

checkStatus();

paymentForm.addEventListener("submit", handlePaymentSubmit);

let payment_intent_id;
async function initialize() {
    const { paymentIntentId, clientSecret } = await fetch("stripe-api/create_payment_intent.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ cart: localStorage.getItem('cart')||'{}', description }),
    }).then((r) => r.json());
    
    const appearance = {
        theme: 'stripe',
        rules: {
            '.Label': {
                fontWeight: 'bold',
            }
        }
    };
    
    elements = stripe.elements({ clientSecret, appearance });
    
    const paymentElement = elements.create("payment");
    paymentElement.mount("#stripe-payment-element");
    
    payment_intent_id = paymentIntentId;
}

async function handlePaymentSubmit(e) {
    e.preventDefault();
    setLoading(true);
    
    let fullname = document.getElementById("fullname").value;
    let email = document.getElementById("email").value;
    
    const { customer_id } = await fetch("stripe-api/create_customer.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ payment_intent_id: payment_intent_id, fullname: fullname, email: email }),
    }).then((r) => r.json());
    
    const form = document.forms['first'];
    const formData = new FormData(form);
    const jsonData = {
        cart: localStorage.getItem('cart')||'{}',
        customer_id: customer_id,
    };
    
    formData.forEach((value, key) => {
      jsonData[key] = value;
    });
    const response = await fetch('checkout-api.php', {
        method:'POST',
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(jsonData),
    }).then(response=>response.json());

    const { error } = await stripe.confirmPayment({
        elements,
        confirmParams: {
            return_url: window.location.href+'?customer_id='+customer_id+'&order_id='+response.order_id,
        },
    });
    

    if (error.type === "card_error" || error.type === "validation_error") {
        showMessage(error.message);
        paymentReinitiate();
    } else {
        showMessage("An unexpected error occured.");
        paymentReinitiate();
    }
    setLoading(false);
}

async function checkStatus() {
    const clientSecret = new URLSearchParams(window.location.search).get(
        "payment_intent_client_secret"
    );
    
    const customer_id = new URLSearchParams(window.location.search).get(
        "customer_id"
    );
    
    const order_id = new URLSearchParams(window.location.search).get(
        "order_id"
    );
    
    if (!clientSecret) {
        return;
    }
    
    const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);
    
    if (paymentIntent) {
        switch (paymentIntent.status) { 
            case "succeeded":
                localStorage.setItem('cart', '{}');
                                   
                fetch("stripe-api/payment_insert.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ 
                        payment_intent: paymentIntent,
                        customer_id: customer_id,
                        order_id: order_id
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.transaction_id) {
                        window.location.href = 'payment-status.php?tid='+data.transaction_id;
                    } else {
                        showMessage(data.error);
                        paymentReinitiate();
                    }
                })
                .catch(console.error);
                break;
            case "processing":
                showMessage("Your payment is processing.");
                paymentReinitiate();
                break;
            case "requires_payment_method":
                showMessage("Your payment was not successful, please try again.");
                paymentReinitiate();
                break;
            default:
                showMessage("Something went wrong.");
                paymentReinitiate();
                break;
        }
    } else {
        showMessage("Something went wrong.");
        paymentReinitiate();
    }
}

function showMessage(messageText) {
    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;
    
    setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageText.textContent = "";
    }, 10000);
}

function setLoading(isLoading) {
    if (isLoading) {
        submitButton.disabled = true;
        spinner.classList.remove("hidden");
        submitText.classList.add("hidden");
    } else {
        submitButton.disabled = false;
        spinner.classList.add("hidden");
        submitText.classList.remove("hidden");
    }
}

function stripeProcessing(isProcessing) {
    if (isProcessing) {
        paymentForm.classList.add("hidden");
        paymentProcessing.classList.remove("hidden");
    } else {
        paymentForm.classList.remove("hidden");
        paymentProcessing.classList.add("hidden");
    }
}

function paymentReinitiate() {
    paymentProcessing.classList.add("hidden");
    payReinitiate.classList.remove("hidden");
    submitButton.classList.add("hidden");
}

function reinitiateStripe() {
    window.location.href=window.location.href.split('?')[0];
}
});