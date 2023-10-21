
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open('blaco-offline-v1')
            .then(cache => {
                console.log('Cache opened successfully');
                return cache.addAll([
                    './',
                    '/utils/js/custom_script.js',
                    '/utils/js/moment.js',
                    '/utils/js/jquery.mask.min.js',
                    '/utils/js/jquery.min.js',
                    '/utils/js/jquery-ui.min.js',
                    '/utils/js/bootstrap.bundle.min.js',
                    '/utils/js/bootstrap-datepicker.min.js',
                    '/utils/js/boletim.js',
                    '/utils/js/admin.js',
                    './conteudo_view.html',

                ]);
            })
            .then(() => {
                console.log('Resources added to cache');
            })
            .catch(error => {
                console.error('Cache error:', error);
            })
    );
});

/*self.addEventListener('install', async function () {
    const cache = await caches.open(blacoCache);
    cache.addAll(staticAssets);
});*/

self.addEventListener('fetch', event => {
    const request = event.request;
    const url = new URL(request.url);
    if (url.origin === location.origin) {
        event.respondWith(cacheFirst(request));
    } else {
        event.respondWith(networkFirst(request));
    }
});

async function cacheFirst(request) {
    const cachedResponse = await caches.match(request);
    return cachedResponse || fetch(request);
}

async function networkFirst(request) {
    const dynamicCache = await caches.open('blaco-dynamic');
    
    try {
        const networkResponse = await fetch(request);
        dynamicCache.put(request, networkResponse.clone());
        return networkResponse;
    } catch (err) {
        const cachedResponse = await dynamicCache.match(request);
        return cachedResponse || await caches.match('/conteudo_view.html');
    }
}
