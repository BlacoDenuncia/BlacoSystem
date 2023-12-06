const CACHE_VERSION = 'v0';

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_VERSION)
            .then(cache => {
                console.log('Cache opened successfully');
                return cache.addAll([
                    '/blaco/',
                    '/blaco/utils/js/custom_script.js',
                    '/blaco/utils/js/moment.js',
                    '/blaco/utils/js/jquery.mask.min.js',
                    '/blaco/utils/js/jquery.min.js',
                    '/blaco/utils/js/jquery-ui.min.js',
                    '/blaco/utils/js/bootstrap.bundle.min.js',
                    '/blaco/utils/js/bootstrap-datepicker.min.js',
                    '/blaco/utils/js/boletim.js',
                    '/blaco/utils/js/admin.js',
                    '/blaco/conteudo_view.html',
                    /*'./',
                    '/utils/js/custom_script.js',
                    '/utils/js/moment.js',
                    '/utils/js/jquery.mask.min.js',
                    '/utils/js/jquery.min.js',
                    '/utils/js/jquery-ui.min.js',
                    '/utils/js/bootstrap.bundle.min.js',
                    '/utils/js/bootstrap-datepicker.min.js',
                    '/utils/js/boletim.js',
                    '/utils/js/admin.js',
                    './conteudo_view.html',*/
                ]);
            })
            .then(() => {
                console.log('Resources added to cache');
            })
            .catch(error => {
                console.error('Cache error:', error);
            })
    );
    self.skipWaiting();
});

/*self.addEventListener('install', async function () {
    const cache = await caches.open(blacoCache);
    cache.addAll(staticAssets);
});*/
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            // Exclua caches antigos (exceto a versão atual)
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (cacheName !== CACHE_VERSION) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
    self.clients.claim();
});

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
        return cachedResponse || await caches.match('/blaco/conteudo_view.html');
    }
}
