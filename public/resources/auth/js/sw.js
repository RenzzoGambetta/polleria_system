self.addEventListener('install', event => {
    event.waitUntil(
        caches.open('mi-app-cache').then(cache => {
            return cache.addAll([
                '/',

                '../../../global_resources/image/company_logo_icon.ico'
            ]);
        })
    );
});

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request).then(response => {
            return response || fetch(event.request);
        })
    );
});
