console.log('Hello from service-worker.js');
importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js');

if (workbox) {
    console.log(`Yay! Workbox is loaded 🎉`);
} else {
    console.log(`Boo! Workbox didn't load 😬`);
}
this.addEventListener('fetch', function (event) {
    // it can be empty if you just want to get rid of that error
});

