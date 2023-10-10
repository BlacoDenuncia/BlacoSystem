
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open('blaco-offline-v1')
            .then(cache => {
                console.log('Cache opened successfully');
                return cache.addAll([
                    './',
                    '/blaco/utils/js/custom_script.js',
                    '/blaco/utils/js/moment.js',
                    '/blaco/utils/js/jquery.mask.min.js',
                    '/blaco/utils/js/jquery.min.js',
                    '/blaco/utils/js/jquery-ui.min.js',
                    '/blaco/utils/js/bootstrap.bundle.min.js',
                    '/blaco/utils/js/bootstrap-datepicker.min.js',
                    '/blaco/utils/js/boletim.js',
                    '/blaco/utils/js/admin.js',
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
    console.log("fetch");
});
