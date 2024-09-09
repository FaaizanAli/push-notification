<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>
<body>
<div class="min-h-screen bg-gray-900 flex flex-col items-center justify-center">
    <h1 class="text-5xl text-white font-bold mb-8 animate-pulse">
        Push Notification
    </h1>
    <p class="text-white text-lg mb-8">
        Is there you just receive Web Notification!
    </p>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        if ('serviceWorker' in navigator && 'PushManager' in window) {
            navigator.serviceWorker.getRegistration().then(function(registration) {
                if (!registration) {
                    navigator.serviceWorker.register('/service-worker.js').then(function(reg) {
                        console.log('Service Worker registered with scope:', reg.scope);
                    }).catch(function(error) {
                        console.error('Service Worker registration failed:', error);
                    });
                }
            });
        }

        // Request notification permission as soon as the page loads
        requestNotificationPermission();
    });

    function requestNotificationPermission() {
        Notification.requestPermission().then(permission => {
            if (permission === "granted") {
                subscribeUserToPush();
            } else {
                console.log("Notification permission denied.");
            }
        });
    }

    function urlBase64ToUint8Array(base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4);
        const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/');
        const rawData = window.atob(base64);
        const outputArray = new Uint8Array(rawData.length);

        for (let i = 0; i < rawData.length; ++i) {
            outputArray[i] = rawData.charCodeAt(i);
        }
        return outputArray;
    }

    function subscribeUserToPush() {
        navigator.serviceWorker.ready.then(function(registration) {
            const options = {
                userVisibleOnly: true,
                applicationServerKey: urlBase64ToUint8Array('{{ env('VAPID_PUBLIC_KEY') }}')
            };
            registration.pushManager.subscribe(options).then(function(subscription) {
                const subscriptionJson = subscription.toJSON();
                fetch('/api/guest', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(subscriptionJson)
                }).then(response => response.json()).then(data => {
                    console.log('Subscription saved:', data);
                }).catch(error => {
                    console.error('Error saving subscription:', error);
                });
            }).catch(function(error) {
                console.error('Subscription failed:', error);
            });
        });
    }
</script>
</body>
</html>
