Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');

Vue.transition('notes', {
    enterClass: 'fadeIn',
    leaveClass: 'zoomOut'
});

Vue.transition('share-user', {
    enterClass: 'fadeIn',
    leaveClass: 'zoomOut'
});

Vue.transition('restore-alert', {
    enterClass: 'fadeInDown',
    leaveClass: 'fadeOutUp'
});