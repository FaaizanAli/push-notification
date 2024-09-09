


self.addEventListener('push', function(event) {
    const data = event.data.json();

    const options = {
        body: data.body,
        icon: data.icon || '/default-icon.png',
        image: data.image || '/default-image.png',
    };

    event.waitUntil(
        self.registration.showNotification(data.title, options)
    );
});


