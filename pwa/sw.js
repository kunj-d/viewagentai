		const CACHE_NAME = 'pwa-cache-v1781859792';

// const CACHE_NAME = 'pwa-cache-v1';
// const urlsToCache = [
//   '/index.html',
//   '/pwa/manifest.json',
//   '/pwa/images/icon-192x192.png',
//   '/pwa/images/icon-512x512.png'
// ];
const baseUrl = self.location.origin; 
const urlsToCache = [
 baseUrl+'/pwa-conversation',
  baseUrl+'/app/pwa/manifest.json',
  baseUrl+'/app/pwa/images/icon-192x192.png', 
 baseUrl+'/app/pwa/images/icon-512x512.png'
];


self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => cache.addAll(urlsToCache))
  );
  console.log('✅ Service Worker Installed');
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request).then(response => response || fetch(event.request))
  );
});