// Listen for incoming push notifications
self.addEventListener('push', function(event) {
  var data = event.data.json();
  console.log('Push received:', data);

  var options = {
    body: data.body,
    //icon: '/path/to/icon.png', // Replace with path to your icon
    //badge: '/path/to/badge.png', // Replace with path to your badge
    data: { url: data.url }
  };

  event.waitUntil(
    self.registration.showNotification(data.title, options)
  );
});

// Handle notification click events
self.addEventListener('notificationclick', function(event) {
  var notification = event.notification;
  var action = event.action;

  console.log('Notification clicked:', notification);

  event.waitUntil(
    clients.openWindow(notification.data.url)
  );
});
