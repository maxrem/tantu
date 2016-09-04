Vue.http.interceptors.push((request, next) => {
    request.headers['X-CSRF-TOKEN'] = Laravel.csrfToken;

    next();
});

window.Laravel = { csrfToken: '{{ csrf_token() }}' };